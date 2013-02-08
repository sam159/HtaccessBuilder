<?php
if (!defined('AJAX')) die('Invalid invocation');

$rules = new HtRule_List();
$ruleList = $rules->GetRules();

echo_pre($rules->GetHeaderText());

echo '<div id="rule-list">';

foreach($ruleList as $index => $rule)
{
  echo_rule($index, $rule);
}

echo '</div>';

echo_pre($rules->GetFooterText());

function echo_rule($index, HtRule $rule)
{
  $text = (string)$rule;
  $class = ($index % 2 == 0) ? 'even' : 'odd';
  echo <<<EOT
<div class="rule $class" data-rule-id="$index">
  <div class="rule-actions">
  <a href="javascript:rules.editRule($index);" class="action-edit">Edit</a>
  <a href="javascript:rules.deleteRule($index);" class="action-delete">Delete</a>
  </div>
  <pre>
$text
</pre>
</div>
EOT;
}

function echo_pre($text)
{
  $text = htmlentities($text, ENT_IGNORE, 'UTF-8');
  echo <<<EOT
<pre>
$text
</pre>
EOT;
}
?>