<?php

class HtRule_Rule_Comment extends HtRule
{
  public function __construct()
  {
    $this->AddParam(new HtRule_Param('text', 'Comment', HtRule_Param::TYPE_TEXT, 'A Comment'));
    parent::__construct();
  }
  public static function GetName()
  {
    return 'Comment';
  }
  public function RequireRewriteEngine()
  {
    return False;
  }
  public function __toString()
  {
    $text = $this->params['text']->Value();
    
    $text = '# '.str_replace("\n", "\n# ", $text);
    
    return $text;
  }
}