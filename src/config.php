<?php

$config = array();

$config['BasePath'] = (@$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/';

$config['Debug'] = False;

if ($_ENV["HTACCESS_DEBUG"] == "true") {
    $config['debug'] = true;
}

if (isset($_ENV["HTACCESS_BASE_PATH"])) {
    $config['BasePath'] = $_ENV["HTACCESS_BASE_PATH"];
}

if (is_file('config.local.php'))
  include('config.local.php');