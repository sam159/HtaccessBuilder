<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="keywords" content="htaccess, htaccess builder, htaccess generator, apache, apache rewrite, rewrite" />
    <meta name="description" content="Build htaccess rules for apache 2 easily." />
    <title>Htaccess Builder</title>
    <base href="<?php echo System::Config()->BasePath; ?>"/>
    <link href="Media/style.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Oswald|Arvo|Telex' rel='stylesheet' type='text/css'/>
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
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-32779476-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <?php if (isset($head)) echo $head; ?>
  </head>
  <body id="<?php if (isset($pageid)) echo $pageid; ?>">
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
      <!--<div id="donate">
        Find this useful? <br/>
        <div>
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick"/>
            <input type="hidden" name="hosted_button_id" value="N7V2ZSKNXCGW8"/>
            <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" class="image" border="0" name="submit" alt="&pound;1" title="&pound;1"/>
            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"/>
          </form>
        </div>
      </div>-->
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