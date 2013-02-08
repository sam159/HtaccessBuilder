<?php

if (isset($_SESSION['error']))
{
  echo "<p class=\"error\">Error: ".$_SESSION['error']."</p>";
  unset($_SESSION['error']);
}
if (isset($_SESSION['message']))
{
  echo "<p class=\"message\">".$_SESSION['message']."</p>";
  unset($_SESSION['message']);
}