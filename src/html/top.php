<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="keywords" content="htaccess, htaccess builder, htaccess generator, apache, apache rewrite, rewrite" />
    <meta name="description" content="Build htaccess rules for apache 2 easily." />
    <title>Htaccess Builder</title>
    <base href="<?php echo System::Config()->BasePath; ?>"/>
    <link href="Media/style.css" rel="stylesheet" type="text/css"/>
    <link href='https://fonts.googleapis.com/css?family=Oswald|Arvo|Telex' rel='stylesheet' type='text/css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    if(typeof jQuery == 'undefined'){document.write("<scr"+"ipt src=\"Media/jquery.min.js\" type=\"text/javascript\"><\/scr"+"ipt>");}
    </script>
    <?php if (defined('CREATOR')): ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
    <link href="Media/impromptu.css" rel="stylesheet" type="text/css"/>
    <script src="Media/jquery-impromptu.3.2.min.js" type="text/javascript"></script>
    <link href="Media/tooltipster-1.2/css/tooltipster.css" rel="stylesheet" type="text/css"/>
    <script src="Media/tooltipster-1.2/js/jquery.tooltipster.min.js" charset="UTF-8" type="text/javascript"></script>
    <script src="Media/index.js" type="text/javascript"></script>
    <script src="Media/rules.js" type="text/javascript"></script>
    <?php endif; ?>
    <?php if (System::Config()->Debug): ?>
    <style type="text/css">
      body {
        background-color: #700000;
      }
    </style>
    <?php endif; ?>
    <?php
    if (is_file(dirname(__FILE__).'/head-custom.php'))
      include(dirname(__FILE__).'/head-custom.php');
    ?>
    <?php if (isset($head)) echo $head; ?>
  </head>
  <body id="<?php if (isset($pageid)) echo $pageid; ?>">
    <a href="https://github.com/sam159/HtaccessBuilder"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
    <div id="wrapper">
      <div id="header-wrapper">
        <div id="header">
          <div id="logo">
            <h1><a href="#">Htaccess Builder</a></h1>
            <p>
              Beta!
            </p>
          </div>
        </div>
      </div>
      <div id="menu-wrapper">
        <div id="menu">
          <ul>
            <li class="page-builder"><a href="">Builder</a></li>
          </ul>
        </div>
      </div>
    <?php $class = ''; if (!isset($sidebar) || $sidebar == False) $class = 'class="fullwidth"'?>
    <div id="page" <?=$class?>>
      <div id="page-bgtop" <?=$class?>>
        <div id="page-bgbtm" <?=$class?>>
          <div id="page-content" <?=$class?>>
            <?php if (isset($sidebar) && $sidebar == True): ?>
              <div id="content">
            <?php else: ?>
              <div id="content-fullwidth">
            <?php endif; ?>
                
              <noscript>
              <div id="js-notice">
                Javascript is required to use this website :(
              </div>
              </noscript>

              <img id="loading" src="Media/Images/loading.gif" alt="[*]" style="display: none;"/>