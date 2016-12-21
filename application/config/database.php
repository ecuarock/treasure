<?php defined('SYSPATH') or die('No direct access allowed.');


return array
(
    'default' => array
    (
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'root',
            'password'   => '',
            'persistent' => FALSE,
            'database'   => 'treasure',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
    ),
    'remote' => array(
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => '55.55.55.55',
            'username'   => 'remote_user',
            'password'   => 'mypassword',
            'persistent' => FALSE,
            'database'   => 'my_remote_db_name',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
    ),
);