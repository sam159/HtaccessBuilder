<?php

class HtRule_Rule_AppendSlash extends HtRule
{
  public static function GetName()
  {
    return 'Append /';
  }
  
  public function RequireRewriteEngine()
  {
    return True;
  }
  
  public function __toString()
  {
    $name = self::GetName();
    return <<<EOT
# $name
RewriteCond %{REQUEST_URI} !^.*/$
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_METHOD} !^POST$
RewriteRule (.*) $1/ [R=301,L]
EOT;
  }
}