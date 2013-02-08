<?php

define('BASE_PATH', dirname(__FILE__));
chdir(BASE_PATH);

ini_set('display_errors', True);
error_reporting(E_ALL);

function sys_autoload($class)
{
  if (strpos($class, '_') !== False)
  {
    $path = 'Classes/'.str_replace('_', '/', $class);
    if (is_file($path.'.php'))
      include_once($path.'.php');
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



