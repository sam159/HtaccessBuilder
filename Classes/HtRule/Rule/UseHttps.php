<?php

class HtRule_Rule_UseHttps extends HtRule
{
  public static function GetName()
  {
    return 'Force SSL';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('DetectHttps', 'Detect Using %{HTTPS}', HtRule_Param::TYPE_BOOLEAN, True, 'This will work on most servers'));
    $this->AddParam(new HtRule_Param('Domain', 'Rewrite To Domain', HtRule_Param::TYPE_STRING, 'www.domain.com', 'The full domain to rewrite to'));
    $this->AddParam(new HtRule_Param('DetectPort', 'Detect By Port Number', HtRule_Param::TYPE_BOOLEAN, False, 'HTTP uses port 80 whereas HTTPS uses port 443 (default ports)'));
    $this->AddParam(new HtRule_Param('HttpsPort', 'Https Port', HtRule_Param::TYPE_INT, 443, 'Redirect the request if the port in use is not this port'));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $params = $this->ParamValues();
    
    $rule = "# Force clients to use https\n";
    if ($params['DetectPort'])
    {
      $rule .= "RewriteCond %{SERVER_PORT} !$params[HttpsPort]";
      if ($params['DetectHttps'])
        $rule .= " [OR]";
      $rule .= "\n";
    }
    if ($params['DetectHttps'])
      $rule .= "RewriteCond %{HTTPS} !=on\n";
    
    $port = '';
    if ($params['HttpsPort'] != 443)
      $port = ':'.$params['HttpsPort'];
    
    $rule .= "RewriteRule (.*) https://$params[Domain]{$port}/$1 [R=301,L]";
    
    return $rule;
  }
}