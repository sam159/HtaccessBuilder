<?php

class HtRule_List
{
  public static function ListRules()
  {
    $files = glob('Classes/HtRule/Rule/*.php');
    $classes = array();
    foreach($files as $file)
    {
      $class = 'HtRule_Rule_'.basename($file,'.php');
      include_once($file);
      if (class_exists($class) && is_subclass_of($class, 'HtRule'))
      {
        $name = call_user_func(array($class,'GetName'));
        if ($name)
        {
          $classes[$class] = $name;
        }
      }
    }
    asort($classes);
    return $classes;
  }
  
  private $rules = array();
  private $id = false;
  private $changed = false;
  
  public function __construct()
  {
    $this->Load();
  }
  public function __destruct()
  {
    $this->Save();
  }
  
  public function Load()
  {
    if (!isset($_SESSION['HtRules']['rules']))
    {
      $this->AddRule(new HtRule_Rule_EnableRewrite());
    }
    else
    {
      $this->rules = $_SESSION['HtRules']['rules'];
      if (!is_array($this->rules))
        $this->rules = array();
    }
    if (isset($_SESSION['HtRules']['id']))
      $this->id = $_SESSION['HtRules']['id'];
  }
  public function Save()
  {
    if ($this->changed)
    {
      $this->id = false;
    }
    $_SESSION['HtRules']['rules'] = $this->rules;
    $_SESSION['HtRules']['id'] = $this->id;
  }
  public function MarkChanged()
  {
    $this->changed = true;
  }
  
  public function SetID($id)
  {
    $this->id = $id;
  }
  public function GetID()
  {
    return $this->id;
  }
  public function SaveToFile()
  {
    $this->id = uniqid();
    
    $ds = DIRECTORY_SEPARATOR;
    $dir = BASE_PATH.$ds.'Saved'.$ds;
    $dir .= substr($this->id, 0,2).$ds;
    $dir .= substr($this->id, 2,2).$ds;
    
    if (!is_dir($dir))
      mkdir($dir, 0755, True);
   
    file_put_contents($dir.$this->id.'.txt', serialize($this));
  }

  public function AddRule(HtRule $rule, $position=False)
  {
    if (count($this->rules) > 250)
      return;
    if ($position !== False)
    {
      array_splice($this->rules, $position, 0, array($rule));
    }
    else
      $this->rules[] = $rule;
    
    $this->MarkChanged();
    
    return array_search($rule, $this->rules);
  }
  public function DeleteRule(HtRule $rule)
  {
    array_splice($this->rules, array_search($rule, $this->rules), 1);
    $this->MarkChanged();
  }
  public function GetRules()
  {
    return $this->rules;
  }
  public function GetAtIndex($index)
  {
    if (isset($this->rules[$index]))
      return $this->rules[$index];
    return False;
  }
  public function ClearRules()
  {
    $this->rules = array();
    $this->MarkChanged();
  }
  
  public function UpdateOrder(array $newOrder)
  {
    $newRules = array();
    
    foreach($newOrder as $index)
    {
      $rule = $this->GetAtIndex($index);
      if ($rule)
        $newRules[] = $rule;
    }
    
    $this->rules = $newRules;
    $this->MarkChanged();
  }
  
  public function GetHeaderText()
  {
    $str = '# Created by '.System::Config()->BasePath."\n";
    if ($this->GetID())
      $str .= '# Edit at '.System::Config()->BasePath.'rules/'.$this->GetID()."/\n";
    $str.= "# ".  date('D, jS F Y');
    foreach($this->rules as $rule)
    {
      /* @var $rule HtRule */
      if ($rule->RequireRewriteEngine())
      {
        $str .= "\n<IfModule mod_rewrite.c>";
        break;
      }
    }
    return $str;
  }
  
  public function GetFooterText()
  {
    $str = '';
    foreach($this->rules as $rule)
    {
      /* @var $rule HtRule */
      if ($rule->RequireRewriteEngine())
      {
        $str .= "</IfModule>";
        break;
      }
    }
    return $str;
  }
  
  public function __toString()
  {
    $str = $this->GetHeaderText()."\n\n";
    foreach($this->rules as $rule)
    {
      /* @var $rule HtRule */
      $str .= strval($rule);
      $str .= "\n\n";
    }
    
    $str .= $this->GetFooterText();
    return $str;
  }
}