<?php

Router::connect('/', array('controller' => 'points', 'action' => 'map'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
