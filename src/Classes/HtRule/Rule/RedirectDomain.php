<?php

class HtRule_Rule_RedirectDomain extends HtRule
{
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('permanent', 'Permanent', HtRule_Param::TYPE_BOOLEAN, true, ''));
    $this->AddParam(new HtRule_Param('subdomains', 'Include All Subdomains', HtRule_Param::TYPE_BOOLEAN, true, ''));
    $this->AddParam(new HtRule_Param('to', 'Destination Domain', HtRule_Param::TYPE_STRING, 'http://newdomain.com/', 'The full url to direct to'));
    $this->AddParam(new HtRule_Param('from', 'Source Domains', HtRule_Param::TYPE_TEXT, 'olddomain.com', ''));
    
    parent::__construct();
  }
  public static function GetName()
  {
    return 'Redirect Domains';
  }
  public function __toString()
  {
    $values = $this->ParamValues();
    
    $type = ($values['permanent']) ? 301 : 302;
    $typeText = ($values['permanent']) ? 'Permanent' : 'Temporary';
    
    $domains = explode("\n", str_replace("\r", '', $values['from']));
    
    $subdomains = ($values['subdomains']) ? '' : '^';
    
    $rules = "# Redirect Domains ($typeText)".PHP_EOL;
    if (empty($domains))
      return $rules;
    foreach($domains as $domain)
    {
      $rules .= "RewriteCond %{HTTP_HOST} {$subdomains}".preg_quote($domain)."$ [OR]".PHP_EOL;
    }
    $rules = substr($rules, 0, strlen($rules)-strlen(" [OR]".PHP_EOL)).PHP_EOL;
    
    $destination = rtrim($values['to'], '/');
    $destination = preg_quote($destination);
    
    $rules .= "RewriteRule ^(.*)$ {$destination}/$1 [R=$type,L]";
    
    return $rules;
  }
}