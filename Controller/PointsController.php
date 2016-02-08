<?php

App::uses('AppController', 'Controller');

class PointsController extends AppController {

    public $name = 'Points';
    public $paginate = array();
    public $helpers = array();

    function index($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();


        $habtmKeys = array(
            'Tag' => 'Tag_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Point.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Tag' => array(
                    0 => array(
                        'table' => 'points_tags',
                        'alias' => 'PointsTag',
                        'type' => 'inner',
                        'conditions' => array('PointsTag.Point_id = Point.id'),
                    ),
                    1 => array(
                        'table' => 'tags',
                        'alias' => 'Tag',
                        'type' => 'inner',
                        'conditions' => array('PointsTag.Tag_id = Tag.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Point.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['Point']['joins'] = $joins[$foreignModel];
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Point']['limit'] = 20;
        $items = $this->paginate($this->Point, $scope);
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function view($id = null) {
        if (!$id || !$this->data = $this->Point->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();


        $habtmKeys = array(
            'Tag' => 'Tag_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Point.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Tag' => array(
                    0 => array(
                        'table' => 'points_tags',
                        'alias' => 'PointsTag',
                        'type' => 'inner',
                        'conditions' => array('PointsTag.Point_id = Point.id'),
                    ),
                    1 => array(
                        'table' => 'tags',
                        'alias' => 'Tag',
                        'type' => 'inner',
                        'conditions' => array('PointsTag.Tag_id = Tag.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Point.' . $foreignKeys[$foreignModel]]);
                if ($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['Point']['joins'] = $joins[$foreignModel];
                }
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Point']['limit'] = 20;
        $items = $this->paginate($this->Point, $scope);

        if ($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach ($items AS $key => $item) {
                $items[$key]['option'] = $this->Point->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        'Point.id' => $item['Point']['id'],
                        $foreignModel . '.id' => $foreignId,
                    ),
                ));
                if ($items[$key]['option'] > 0) {
                    $items[$key]['option'] = 1;
                }
            }
            $this->set('op', $op);
        }

        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_view($id = null) {
        if (!$id || !$this->data = $this->Point->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Point->create();
            if ($this->Point->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->Point->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Point->read(null, $id);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->Point->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
            'Tag' => array(
                'associationForeignKey' => 'Tag_id',
                'foreignKey' => 'Point_id',
                'alias' => 'PointsTag',
            ),
        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if (empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', __('Wrong Parameters'));
        } else {
            $habtmModel = &$this->Point->$habtmKeys[$foreignModel]['alias'];
            $conditions = array(
                $habtmKeys[$foreignModel]['associationForeignKey'] => $foreignId,
                $habtmKeys[$foreignModel]['foreignKey'] => $id,
            );
            $status = ($habtmModel->find('count', array(
                        'conditions' => $conditions,
                    ))) ? 'on' : 'off';
            if ($status == $switch) {
                $this->set('habtmMessage', __('Duplicated operactions', true));
            } else if ($switch == 'on') {
                $habtmModel->create();
                if ($habtmModel->save(array($habtmKeys[$foreignModel]['alias'] => $conditions))) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            } else {
                if ($habtmModel->deleteAll($conditions)) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            }
        }
    }

}
