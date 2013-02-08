<?php

define('AJAX',True);

include('includer.php');

if (!isset($_REQUEST['action']))
  return;

$rules = new HtRule_List();

$action = $_REQUEST['action'];
switch($action)
{
  case "rules":
    return_html('rules');
    break;
  case "delete":
    $id = (int)get_post('id');
    $rule = $rules->GetAtIndex($id);
    $rules->DeleteRule($rule);
    return_json(True);
    break;
  case "add":
    $type = (string)get_post('type');
    $ruleTypes = HtRule_List::ListRules();
    if (!array_key_exists($type, $ruleTypes))
      return_json (array('error'=>'Unknown Rule'));
    $position = False;
    if ($type == 'HtRule_Rule_EnableRewrite')
      $position = 0;
    $id = $rules->AddRule(new $type(), $position);
    return_json(array('id'=>$id));
    break;
  case "edit":
    return_html('edit', array('id'=>(int)get_post('id')));
    break;
  case "save":
    $rule = $rules->GetAtIndex((int)get_post('id'));

    $form = new HtRule_Form($rule);
    
    if ($form->Validate($_POST, $error))
    {
      //Save
      $form->Save($_POST);
      $rules->MarkChanged();
      return_json(True);
    }
    else
    {
      return_json(array('error'=>$error));
    }
    break;
  case "listing":
    return_json((string)$rules);
    break;
  case 'updateOrder':
    if (!is_array($_POST['order']))
      break;
    
    $order = $_POST['order'];
    
    array_walk($order, 'intval');
    $order = array_unique($order);
    
    $rules->UpdateOrder($order);
    
    break;
}

function return_html($file, $params=array())
{
  ob_start();
  include("html/ajax/$file.php");
  $html = ob_get_contents();
  ob_end_clean();
  return_json($html);
}

function return_json($return)
{
  header('Content-Type: application/json');
  echo json_encode($return);
  exit;
}