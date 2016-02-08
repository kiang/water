<?php

App::uses('AppModel', 'Model');

class Point extends AppModel {

    var $name = 'Point';
    var $validate = array(
        'status' => array(
            'numberFormat' => array(
                'rule' => 'numeric',
                'message' => 'Wrong format',
                'allowEmpty' => true,
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required',
            ),
        ),
        'latitude' => array(
            'numberFormat' => array(
                'rule' => 'numeric',
                'message' => 'Wrong format',
                'allowEmpty' => true,
            ),
        ),
        'longitude' => array(
            'numberFormat' => array(
                'rule' => 'numeric',
                'message' => 'Wrong format',
                'allowEmpty' => true,
            ),
        ),
    );
    var $actsAs = array(
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

    function afterSave($created, $options = array()) {
        
    }

}
