<?php

define('INDEX',True);

require('includer.php');

$rules = new HtRule_List();

if (!$rules->GetID())
{
  $rules->SaveToFile();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
  redirect('/');
}