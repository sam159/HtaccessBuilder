<?php

define('INDEX',True);

require('includer.php');

$filename = get_request('filename');
$filename = preg_replace('/[^a-z0-9\.\-_]/i', '', $filename);

if (empty($filename))
  $filename = '.htaccess';

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$rules = new HtRule_List();
$rules = $rules->__toString();
echo $rules;