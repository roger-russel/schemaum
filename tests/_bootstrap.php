<?php

global $DB;

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$DB = new DB();

$DB->addConnection([
    'driver'    => 'mysql',
    'host'      => 'entropy-migration-db',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$DB->setEventDispatcher(new Dispatcher(new Container));
$DB->setAsGlobal();
$DB->bootEloquent();
