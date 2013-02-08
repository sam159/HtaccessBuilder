<?php
class System
{
  private static $db;
  private static $config;
  
  public static function Init(array $config)
  {
    self::$config = (object) $config;
    self::StartSession();
    
  }
  
  public static function Config()
  {
    return self::$config;
  }
  public static function StartSession()
  {
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');

    session_set_cookie_params(60*60*24, self::$config->BasePath, $_SERVER['HTTP_HOST'], False, True);
    session_start();
  }
}
