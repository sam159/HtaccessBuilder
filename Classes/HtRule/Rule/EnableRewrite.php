<?php

class HtRule_Rule_EnableRewrite extends HtRule
{
  public static function GetName()
  {
    return 'Enable Rewrite Engine';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('base', 'Rewrite Base', HtRule_Param::TYPE_STRING, '/', 'With leading and trailing slashes'));
    
    parent::__construct();
  }
  public function __toString()
  {
    $base = $this->params['base']->Value();
    $name = self::GetName();
    return <<<EOT
# $name
RewriteEngine On
RewriteBase $base
EOT;
  }
}