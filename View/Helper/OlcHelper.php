<?php

class OlcHelper extends AppHelper {

    public $helpers = array('Html');

    public $status = array(
        0 => '停用',
        1 => '正常供應',
        2 => '暫停供應',
    );

}
