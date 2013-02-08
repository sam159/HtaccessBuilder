<?php

define('INDEX',True);
define('CREATOR',True);

require('includer.php');

$rules = new HtRule_List();

if (isset($_GET['addrule']))
{
  $rules->AddRule(new HtRule_EnableRewrite());
  redirect('');
}
if (isset($_GET['delete']))
{
  $file = BASE_PATH.DIRECTORY_SEPARATOR.'Saved'.DIRECTORY_SEPARATOR.$rules->GetID().'.txt';
  if (is_file($file) && $rules->GetID())
    unlink($file);
  $rules->SetID(False);
  $rules->ClearRules();
  redirect('');
}

$pageid = 'page-builder';
include('html/top.php');

include('html/creator.php');

include('html/bottom.php');