<?php

/**
 * @property Member Member
 *
 */
class MembersController extends AppController {

    public $name = 'Members';
    public $paginate = array();

    public function beforeFilter() {
        parent::beforeFilter();
        if (isset($this->Auth)) {
            $this->Auth->allow('login', 'logout', 'setup');
        }
    }

    public function login() {
        if (!$this->Member->hasAny()) {
            $this->redirect(array('action' => 'setup'));
        }
        if (!empty($this->request->data['Member']['username'])) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Username or password is wrong', true));
            }
        }
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect(array('action' => 'login'));
    }

    public function setup() {
        /*
         * to empty the tables
         * 
         * TRUNCATE `acos`;
          TRUNCATE `aros`;
          TRUNCATE `aros_acos`;
          TRUNCATE `groups`;
          TRUNCATE `group_permissions`;
          TRUNCATE `members`;
         */
        if ($this->Member->hasAny(array('user_status' => 'Y'))) {
            $this->Session->setFlash('帳號已經存在，如果希望重設，請先清空會員資料庫');
            $this->redirect('/members/login');
        } elseif (!empty($this->request->data)) {
            $this->loadModel('Group');
            $this->Group->query("TRUNCATE `acos`;");
            $this->Group->query("TRUNCATE `aros`;");
            $this->Group->query("TRUNCATE `aros_acos`;");
            $this->Group->query("TRUNCATE `groups`;");
            $this->Group->query("TRUNCATE `group_permissions`;");
            $this->Group->query("TRUNCATE `members`;");
            $this->Group->create();
            if ($this->Group->save(array('Group' => array(
                            'id' => 1,
                            'name' => 'Admin',
                            'parent_id' => 0,
                )))) {
                $this->request->data['Member']['id'] = 1;
                $this->request->data['Member']['group_id'] = 1;
                $this->request->data['Member']['user_status'] = 'Y';
                $this->Member->create();
                if ($this->Member->save($this->request->data)) {
                    $this->loadModel('Permissible.PermissibleAro');
                    $this->PermissibleAro->reset();
                    $this->loadModel('Permissible.PermissibleAco');
                    if ($this->PermissibleAco->reset()) {
                        /*
                         * @var Acl AclComponent
                         */
                        $this->Acl->deny('everyone', 'app');
                        $this->Acl->allow('Group1', 'app');
                    }
                    $this->Acl->Aco->recover();
                    $this->Acl->Aro->recover();
                    $this->Session->setFlash('管理者帳號已經建立，請登入繼續操作');
                    $this->redirect('/members/login');
                } else {
                    $this->Session->setFlash('管理者帳號建立失敗');
                }
            } else {
                $this->Session->setFlash('管理者帳號建立失敗');
            }
        }
    }

    public function admin_index() {
        $scope = array();
        $keyword = '';
        if (isset($this->params['named']['keyword'])) {
            if (is_array($this->params['named']['keyword'])) {
                foreach ($this->params['named']['keyword'] AS $keyword) {
                    continue;
                }
            } else {
                $keyword = $this->params['named']['keyword'];
            }
            $this->Session->write('Members.index.keyword', $keyword);
        } else {
            $keyword = $this->Session->read('Members.index.keyword');
        }
        if (!empty($keyword)) {
            $scope['OR'] = array(
                'Member.username LIKE' => '%' . $keyword . '%',
                'Group.name LIKE' => '%' . $keyword . '%',
            );
        }
        $this->paginate['Member'] = array(
            'order' => array('Member.id DESC'),
            'contain' => array('Group'),
            'limit' => 40,
        );
        $this->set('members', $this->paginate($this->Member, $scope));
        $this->set('keyword', $keyword);
    }

    public function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('member', $this->Member->read(null, $id));
    }

    public function admin_add() {
        if (!empty($this->request->data)) {
            $this->Member->create();
            if ($this->Member->save($this->request->data)) {
                $this->Acl->Aro->saveField('alias', 'Member/' . $this->Member->getInsertID());
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('groups', $this->Member->Group->find('list'));
    }

    public function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $oldgroupid = $this->Member->field('group_id', array('Member.id' => $this->request->data['Member']['id']));
            if ($this->Member->save($this->request->data)) {
                if ($oldgroupid !== $this->request->data['Member']['group_id']) {
                    $aro = & $this->Acl->Aro;
                    $member = $aro->findByForeignKeyAndModel($this->request->data['Member']['id'], 'Member');
                    $group = $aro->findByForeignKeyAndModel($this->request->data['Member']['group_id'], 'Group');
                    $aro->id = $member['Aro']['id'];
                    $aro->save(array('parent_id' => $group['Aro']['id']));
                }
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Member->read(null, $id);
        }
        $this->set('groups', $this->Member->Group->find('list'));
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Member->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_test($count = 50) {
        $count = intval($count);
        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $uid = uniqid();
                $this->Member->create();
                if ($this->Member->save(array('Member' => array(
                                'username' => $uid,
                                'password' => $this->Auth->password($uid),
                                'group_id' => 1,
                                'user_status' => 'Y',
                                'nick' => $uid,
                                'email' => $uid . '@example.com',
                    )))) {
                    $this->Acl->Aro->saveField('alias', 'Member' . $this->Member->getInsertID());
                }
            }
        }
        $this->Session->setFlash(__('Testing members generated.', true));
        $this->redirect($this->referer());
    }

    public function admin_acos() {
        $this->loadModel('Permissible.PermissibleAco');
        $this->PermissibleAco->refresh();
        $this->redirect($this->referer());
    }

}
