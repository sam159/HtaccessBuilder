<?php

abstract class HtRule
{
  protected $params = array();
  
  static function GetName()
  {
    return false;
  }
  
  public function __construct()
  {
    
  }
  
  function GetParams()
  {
    return $this->params;
  }
  
  function AddParam(HtRule_Param $param)
  {
    $this->params[$param->Name()] = $param;
  }
  
  function ParamValues()
  {
    $values = array();
    foreach($this->params as $param)
    {
      /* @var $param HtRule_Param */
      $values[$param->Name()] = $param->Value();
    }
    return $values;
  }
  
  function RequireRewriteEngine()
  {
    return false;
  }
  
  function __toString()
  {
    return '';
  }
}