<?php

App::uses('AppModel', 'Model');

class PointLog extends AppModel {

    var $name = 'PointLog';
    var $validate = array(
        'status' => array(
            'numberFormat' => array(
                'rule' => 'numeric',
                'message' => 'Wrong format',
                'allowEmpty' => true,
            ),
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required',
            ),
        ),
    );
    var $actsAs = array(
    );
    var $belongsTo = array(
        'Point' => array(
            'foreignKey' => 'Point_id',
            'className' => 'Point',
        ),
    );

    function afterSave($created, $options = array()) {
        
    }

}
