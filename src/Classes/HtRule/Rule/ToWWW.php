<?php

class HtRule_Rule_ToWWW extends HtRule
{
  public static function GetName()
  {
    return 'Redirect to www.';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('domain', 'Domain Name', HtRule_Param::TYPE_STRING, 'domain.com', 'The domain without the www'));
    $this->AddParam(new HtRule_Param('https', 'Use Https', HtRule_Param::TYPE_BOOLEAN, False, 'Redirect to https'));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $domain = $this->params['domain']->Value();
    $name = self::GetName();
    $proto = 'http';
    if ($this->params['https']->Value())
      $proto = 'https';
    return <<<EOT
# $name
RewriteCond %{HTTP_HOST} ^${domain}$
RewriteRule (.*) ${proto}://www.${domain}/$1 [R=301,L] 
EOT;
  }
}