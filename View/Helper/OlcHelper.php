<?php

class OlcHelper extends AppHelper {

    public $helpers = array('Html');
    public $status = array(
        0 => '關閉',
        1 => '淹水中',
        2 => '淹水已退',
    );
    public $status2 = array(
        0 => '有障礙物',
        1 => '障礙物已經清除',
    );
    public $groups = array(
        1 => '淹水',
        2 => '障礙物',
    );

}
