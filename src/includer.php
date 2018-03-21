<?php

define('BASE_PATH', dirname(__FILE__));
chdir(BASE_PATH);

if (array_key_exists('SAVED_PATH', $_ENV)) {
    define('SAVED_PATH', $_ENV['SAVED_PATH']);
} else {
    define('SAVED_PATH', realpath(BASE_PATH . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Saved'));
}

function sys_autoload($class)
{
    if (strpos($class, '_') !== False) {
        $path = 'Classes/' . str_replace('_', '/', $class);
        if (is_file($path . '.php'))
            include_once($path . '.php');
    }

    if (is_file("Classes/$class/$class.php"))
        include_once("Classes/$class/$class.php");

    if (is_file("Classes/$class.php"))
        include_once("Classes/$class.php");
}

spl_autoload_register('sys_autoload');

require('config.php');
require('functions.php');

System::Init($config);



