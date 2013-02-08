<?php

class HtRule_Rule_MapIndex extends HtRule
{
  public static function GetName()
  {
    return 'Map urls to index.php';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('Target', 'Target File', HtRule_Param::TYPE_STRING, 'index.php', 'The file to map request to'));
    $this->AddParam(new HtRule_Param('AppendUrl', 'Append Url to rewrite', HtRule_Param::TYPE_BOOLEAN, False, 'This adds the url to the end of the rewritten url, ie /test/ => /index.php/test/'));
    $this->AddParam(new HtRule_Param('AppendMethod', 'Method of appending', HtRule_Param::TYPE_STRING, '/', 'eg. ? or ?page= (/ May not work in a CGI environment)'));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $params = $this->ParamValues();
    
    $append = '';
    if ($params['AppendUrl'])
      $append .= $params['AppendMethod'].'$1';
    
    return <<<EOT
# Map urls to $params[Target]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*) $params[Target]{$append} [L,QSA]
EOT;
  }
}