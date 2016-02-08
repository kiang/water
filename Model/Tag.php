<?php

App::uses('AppModel', 'Model');

class Tag extends AppModel {

    var $name = 'Tag';

    var $validate = array(

        'name' => array(

            'notEmpty' => array(

                'rule' => 'notEmpty',

                'message' => 'This field is required',

            ),

        ),

    );
                

    var $actsAs = array(

    );



    var $hasAndBelongsToMany = array(

        'Point' => array(


            'joinTable' => 'points_tags',



            'foreignKey' => 'Tag_id',



            'associationForeignKey' => 'Point_id',



            'className' => 'Point',


        ),

    );



    function afterSave($created, $options = array()) {

	}

}