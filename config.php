<?php

$config = array();

$config['BasePath'] = (@$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/';

$config['Debug'] = False;

if (is_file('config.local.php'))
  include('config.local.php');