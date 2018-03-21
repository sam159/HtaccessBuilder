<?php

define('INDEX',True);

require('includer.php');

$id = $_GET['id'];

if (strlen($id) < 5)
  redirect ('/');

$ds = DIRECTORY_SEPARATOR;
$dir = BASE_PATH.$ds.'Saved'.$ds;
$dir .= substr($id, 0,2).$ds;
$dir .= substr($id, 2,2).$ds;

$file = $dir.$id.'.txt';

$file = realpath($file);

if (strpos($file, $dir) !== 0 || $file == false)
  redirect ('/');

$fileContents = file_get_contents($file);

$rules = unserialize($fileContents);
$rules->SetID(false);
$rules->Save();

redirect ('/');