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

    $path = parse_url(self::$config->BasePath, PHP_URL_PATH);

    //Strip any port from host name
    $host = $_SERVER["HTTP_HOST"];
    $host = preg_replace("/:\d+$/", "", $host);

    session_set_cookie_params(60*60*24, $path, $host, False, True);
    session_start();
  }
}
