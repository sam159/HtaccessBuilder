<?php

class HtRule_Rule_RedirectUrls extends HtRule
{
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('permanent', 'Permanent Redirects', HtRule_Param::TYPE_BOOLEAN, True, ''));
    $this->AddParam(new HtRule_Param('host', 'Check Host', HtRule_Param::TYPE_BOOLEAN, false, 'Check the hostname is correct for each redirect'));
    $this->AddParam(new HtRule_Param('ignorewww', 'Ignore www. prefix', HtRule_Param::TYPE_BOOLEAN, false, 'Ignores the www, from the domain name. Requires check host be enabled'));
    $this->AddParam(new HtRule_Param('urls', 'Urls', HtRule_Param::TYPE_DUALTEXT, '', 'Full Urls, from on the left, to on the right', True));
    
    parent::__construct();
  }
  public static function GetName()
  {
    return 'Redirect Urls';
  }
  
  public function __toString()
  {
    $values = $this->ParamValues();
    
    $type = ($values['permanent']) ? 301 : 302;
    $typeText = ($values['permanent']) ? 'Permanent' : 'Temporary';
    
    $urls = $values['urls'];
    
    $rules = '';
    if (is_array($urls) && count($urls) == 2)
    {
      $fromUrls = explode("\n", str_replace("\r", '', $urls[0]));
      $toUrls = explode("\n", str_replace("\r", '', $urls[1]));
      foreach($fromUrls as $key => $from)
      {
        $from = trim($from);
        if ($from == "")
          continue;
        if (isset($toUrls[$key]))
        {
          $to = trim($toUrls[$key]);
          if ($to == "")
            continue;
          $rule = $this->CreateRewrite($from, $to, $type, $values['host'], @$values['ignorewww']);
          if ($rule)
            $rules .= $rule.PHP_EOL;
        }
      }
    }
    
    return <<<EOT
# Redirect Urls ($typeText)
$rules
EOT;
  }
  
  private function CreateRewrite($from, $to, $type, $checkhost, $ignorewww)
  {
    $from = parse_url($from);
    $toUrl = $to;
    $to = parse_url($to);
    
    if (!$from || !$to)
      return False;
    $default = array('scheme'=>false,'host'=>false,'port'=>false,'path'=>false,'query'=>false,'fragment'=>false);
    $from = array_replace($default, $from);
    $to = array_replace($default, $to);
    $rule = '';
    if ($checkhost)
    {
      $domain = $from['host'];
      $domainCheck = '^'.str_replace(array('.','\-'),array('\.','\-'),$domain).'$';
      if ($ignorewww)
      {
        $domain = preg_replace('/^www\./', '', $domain);
        $domainCheck = "^(www\.)?".str_replace(array('.','\-'),array('\.','\-'),$domain)."\$";
      }
      $rule .= 'RewriteCond %{HTTP_HOST} '.$domainCheck.PHP_EOL;
    }
    if (!empty($from['query']))
    {
      $end = '';
      if ($to['query'] == false)
        $end = '?';
      
      
      $rule .= "RewriteCond %{QUERY_STRING} ^".str_replace('.','\.',$from['query'])."\$".PHP_EOL;
      $rule .= "RewriteRule ^".ltrim(preg_quote($from['path']),'/')."\$  $toUrl$end [R=$type,L]";
    }
    else
    {
      $rule .= "RewriteRule ^".ltrim(preg_quote($from['path']),'/')."\$  $toUrl [R=$type,L]";
    }
    
    return $rule;
  }
}