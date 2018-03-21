<?php

class HtRule_Rule_IndexToRoot extends HtRule
{
  public static function GetName()
  {
    return 'Redirect index.php to /';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('indexfile', 'Index File', HtRule_Param::TYPE_STRING, 'index.php'));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $name = self::GetName();
    $file = str_replace('.', '\\.', $this->params['indexfile']->Value());
    return <<<EOT
# $name
RewriteCond %{QUERY_STRING} ^$
RewriteCond %{REQUEST_METHOD} !^POST$
RewriteRule ^$file$ / [R=301,L]
EOT;
  }
}