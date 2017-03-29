<?php
session_start();
if (isset($_SESSION["id"]) && strlen($_SESSION["id"]) > 0) {
  session_destroy();
  $_SESSION = array();
  setcookie("PHPSESSID", "", time() - 3600 * 24);
}
header("HTTP/1.1 301 Moved Permanently");
header("Location: /practices/practice07/login.php");
exit();
?>
