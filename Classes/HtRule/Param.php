<?php

class HtRule_Param
{
  const TYPE_STRING = 1;
  const TYPE_TEXT = 2;
  const TYPE_INT = 3;
  const TYPE_DECIMAL = 4;
  const TYPE_BOOLEAN = 5;
  const TYPE_DUALTEXT = 6;
  
  private $name;
  private $title;
  private $type;
  private $multi;
  private $default;
  private $help;
  
  private $value;
  
  public function Name() { return $this->name; }
  public function Title() { return $this->title; }
  public function Type() { return $this->type; }
  public function IsMulti() { return $this->multi; }
  public function DefaultValue() { return $this->default; }
  public function Help() { return $this->help; }
  
  public function __construct($name, $title, $type, $default='',  $help='', $multi=false)
  {
    $this->name = (string)$name;
    $this->title = (string)$title;
    $this->multi = (bool)$multi;
    $this->type = (int)$type;
    $this->default = (string)$default;
    $this->help = (string)$help;
    
    $this->Value($this->default);
    
    if (!($type == self::TYPE_STRING ||
        $type == self::TYPE_TEXT ||
        $type == self::TYPE_INT ||
        $type == self::TYPE_DECIMAL ||
        $type == self::TYPE_BOOLEAN ||
        $type == self::TYPE_DUALTEXT))
      throw new Exception("Invalid Type");
  }
  
  function Value($newValue = null)
  {
    if ($newValue !== null)
    {
      if ($this->multi)
        $this->value = $newValue;
      else
        $this->value = (string)$newValue;
    }
    
    return $this->value;
  }
}