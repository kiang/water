<?php

echo $this->Form->create('Member', array('url' => array('login')));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('登入');
