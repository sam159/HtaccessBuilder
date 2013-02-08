<?php

class HtRule_Form
{
  private $rule;
  private $index;
  
  public function __construct(HtRule $rule)
  {
    $this->rule = $rule;
    $rules = new HtRule_List();
    $this->index = array_search($rule, $rules->GetRules());
  }
  
  function Validate($values, &$error)
  {
    $params = $this->rule->GetParams();
    foreach($params as $p)
    {
      /* @var $p HtRule_Param */
      $name = $p->Name();
      $value = get_request($name);
      if ($value === False && $p->Type() != HtRule_Param::TYPE_BOOLEAN)
      {
        $error = "Missing value for ".$p->Title();
        return False;
      }
      switch($p->Type())
      {
        case HtRule_Param::TYPE_STRING:
          
          break;
        case HtRule_Param::TYPE_TEXT:
          
          break;
        case HtRule_Param::TYPE_INT:
          if (!preg_match('/-?[0-9]+/', $value))
          {
            $error = "Invalid integer for ".$p->Title();
            return False;
          }
          break;
        case HtRule_Param::TYPE_DECIMAL:
          if (!is_numeric($value))
          {
            $error = "Invalid number for ".$p->Title();
            return False;
          }
          break;
      }//Switch
    }//For each
    return True;
  }
  function Save($values)
  {
    $params = $this->rule->GetParams();
    foreach($params as $p)
    {
      /* @var $p HtRule_Param */
      $name = $p->Name();
      $value = get_request($name);
      
      if ($p->Type() == HtRule_Param::TYPE_BOOLEAN)
        $p->Value(False);
      
      if ($value === False)
        continue;
      
      if ($p->Type() == HtRule_Param::TYPE_BOOLEAN &&
          $value == 'yes')
        $p->Value(True);
      else
        $p->Value($value);
    }
  }
  
  function ShowForm()
  {
    $params = $this->rule->GetParams();
    
    $formName = 'form_'.get_class($this->rule);
    echo '<h3>Edit "'.$this->rule->GetName().'"</h3>';
    echo '<div id="rule-edit-form"><form name="'.$formName.'" id="'.$formName.'" method="POST" class="ajaxForm" onsubmit="return rules.completeRuleEdit()">';
    echo '<input type="hidden" name="id" value="'.$this->index.'"/>';
    foreach($params as $p)
    {
      /* @var $p HtRule_Param */
      $id = 'field-'.$p->Name();
      $name = $p->Name();
      $class = '';
      if ($p->IsMulti())
      {
        $class .= ' multi';
        $name .= '[]';
      }
      $value = $p->Value();
      
      if ($p->Help() != "")
        $help = 'class="tooltip" title="'.$p->Help().'"';
      else
        $help = '';
      
      switch($p->Type())
      {
        case HtRule_Param::TYPE_STRING:
          $class .= ' type-string';
          if ($p->IsMulti())
          {
            echo '<div class="multi">';
            foreach($p->Value() as $value)
            {
              echo "<label $help>".$p->Title().'</label>';
              echo '<input type="text" name="'.$name.'" class="'.$id.' '.$class.'" value="'.$value.'"/>';
            }
            echo '</div>';
          }
          else
          {
            echo '<label '.$help.' for="'.$id.'">'.$p->Title().'</label>';
            echo '<input type="text" name="'.$name.'" id="'.$id.'" class="'.$class.'" value="'.$value.'"/>';
          }
          break;
        case HtRule_Param::TYPE_TEXT:
          $class .= ' type-text';
          echo '<label '.$help.' for="'.$id.'">'.$p->Title().'</label><textarea name="'.$name.'" id="'.$id.'" class="'.$class.'" rows="5">'.$value.'</textarea>';
          break;
        case HtRule_Param::TYPE_DUALTEXT:
          $class .= ' type-dualtext';
          echo '<label '.$help.' for="'.$id.'-0">'.$p->Title().'</label>'.
            '<div style="clear:both;"></div>'.
            '<textarea name="'.$name.'" id="'.$id.'-0" class="'.$class.'" wrap="off">'.((isset($value[0])) ? $value[0] : '').'</textarea>'.
            '<textarea name="'.$name.'" id="'.$id.'-1" class="'.$class.'"wrap="off">'.((isset($value[1])) ? $value[1] : '').'</textarea>';
          break;
        case HtRule_Param::TYPE_INT:
          $class .= ' type-int';
          echo '<label '.$help.' for="'.$id.'">'.$p->Title().'</label><input type="text" name="'.$name.'" id="'.$id.'" class="'.$class.'" value="'.$value.'"/>';
          break;
        case HtRule_Param::TYPE_DECIMAL:
          $class .= ' type-decimal';
          echo '<label '.$help.' for="'.$id.'">'.$p->Title().'</label><input type="text" name="'.$name.'" id="'.$id.'" class="'.$class.'" value="'.$value.'"/>';
          break;
        case HtRule_Param::TYPE_BOOLEAN:
          $class .= ' type-checkbox';
          $checked = '';
          if ($value == True)
            $checked = ' checked="checked"';
          echo '<label '.$help.' for="'.$id.'">'.$p->Title().'</label><input type="checkbox" name="'.$name.'" id="'.$id.'" class="'.$class.'" value="yes"'.$checked.'/>';
          break;
      }//Switch
    }//Foreach param
    echo '<label>&nbsp;</label><input type="submit" class="button" value="Save" id="button-save"/><input type="button" class="button" value="Cancel" onclick="javascript:rules.cancelRuleEdit();" id="button-cancel"/>';
    echo '</form></div>';
    echo '<div style="clear:both;"></div>';
  }//ShowForm
}