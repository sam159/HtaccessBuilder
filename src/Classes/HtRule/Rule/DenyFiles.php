<?php

class HtRule_Rule_DenyFiles extends HtRule
{
  public static function GetName()
  {
    return 'Deny access to File Types';
  }
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('filetypes', 'File Type', HtRule_Param::TYPE_TEXT, ".sql\n.log", 'Specify the file extensions that you want to deny access to (one per line)', False));
    
    parent::__construct();
  }
  
  public function __toString()
  {
    $params = $this->ParamValues();
    
    $types = $params['filetypes'];
    
    $types = str_replace("\r", "", $types);
    $types = explode("\n", $types);
    
    $rules = '';
    for($i=0;$i < count($types);$i++)
    {
      $type = preg_quote($types[$i]);
      $rules .= "RewriteCond %{REQUEST_FILENAME} $type$";
      if ($i < count($types))
        $rules .= ' [OR]';
      $rules .= "\n";
    }
    $rules .= "RewriteRule .* - [F,L]\n";
    
    return $rules;
  }
}