<?php

App::uses('AppModel', 'Model');

class Point extends AppModel {

    var $name = 'Point';
    var $validate = array(
        'address' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => '住址必須輸入',
            ),
        ),
    );
    var $hasAndBelongsToMany = array(
        'Tag' => array(
            'joinTable' => 'points_tags',
            'foreignKey' => 'Point_id',
            'associationForeignKey' => 'Tag_id',
            'className' => 'Tag',
        ),
    );
    var $hasMany = array(
        'PointLog' => array(
            'foreignKey' => 'Point_id',
            'dependent' => false,
            'className' => 'PointLog',
        ),
    );

    public function beforeSave($options = array()) {
        if(isset($this->data['Point']['member_id']) && empty($this->data['Point']['member_id'])) {
            $this->data['Point']['member_id'] = '0';
        }
        return parent::beforeSave($options);
    }

}
