<?php

$config = array();

$config['BasePath'] = (@$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/';

$config['Debug'] = $_SERVER['HTTP_HOST'] == 'dev.htaccessbuilder.com';