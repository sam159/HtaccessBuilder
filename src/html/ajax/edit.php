<?php
if (!defined('AJAX')) die('Invalid invocation');
$rules = new HtRule_List();

$rule = $rules->GetAtIndex($params['id']);

/* @var $rule HtRule */

$params = $rule->GetParams();

if (count($params) == 0)
  return;

$form = new HtRule_Form($rule);
?>

<?php $form->ShowForm(); ?>
