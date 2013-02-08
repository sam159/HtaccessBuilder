<?php

define('INDEX',True);

require('includer.php');

$rules = new HtRule_List();

$pageid = 'page-test';
$sidebar = True;
include('html/top.php');

?>
<h2>
  Test
</h2>
<p>
<?=print_r(sys_getloadavg(),true)?>
</p>
<?php

include('html/bottom.php');