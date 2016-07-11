<?php
//phpinfo(); die();

ini_set(display_errors, 1);

require 'config.php';
require 'autoload_tmp.php';

$builder = new Blog\BlogApplication\Builder($config);


$applicaion = new \Blog\Core\Application($config['routing'], $builder->getLocator());
$applicaion->addToRegistry('server', $_SERVER);

$applicaion->web(array_merge($_REQUEST, $_FILES));