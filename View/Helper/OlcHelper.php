<?php

class OlcHelper extends AppHelper {

    public $helpers = array('Html');
    public $status = array(
        0 => '停用',
        1 => '正常供應',
        2 => '暫停供應',
    );
    public $status2 = array(
        0 => '水來了',
        1 => '缺水中',
    );
    public $groups = array(
        1 => '供水',
        2 => '缺水',
    );

}
