<?php

class HtRule_Rule_Custom extends HtRule
{
  public static function GetName()
  {
    return 'Custom Directives';
  }
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('Text', 'Directives', HtRule_Param::TYPE_TEXT));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $params = $this->ParamValues();
    
    return $params['Text'];
  }
}