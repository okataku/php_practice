<?php
$date = null;
$starSign = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_GET["month"]) && isset($_GET["day"]) &&
    is_numeric($_GET["month"]) && is_numeric($_GET["day"])) {
  
  $m = (int)$_GET["month"];
  $d = (int)$_GET["day"];
  
  if (!checkdate($m, $d, 2000)) {
    $error = "日付の値が正しくありません。";
    
  } else {
    
    $date = strtotime("2000/".$m."/".$d." 00:00:00");
    if (strtotime("2000/01/21 00:00:00") <= $date && $date <= strtotime("2000/02/20 00:00:00")) {
      $starSign = "水瓶座";
    } else if ($date <= strtotime("2000/03/20 00:00:00")) {
      $starSign = "魚座";
    } else if ($date <= strtotime("2000/04/20 00:00:00")) {
      $starSign = "牡羊座";
    } else if ($date <= strtotime("2000/05/20 00:00:00")) {
      $starSign = "牡牛座";
    } else if ($date <= strtotime("2000/06/20 00:00:00")) {
      $starSign = "双子座";
    } else if ($date <= strtotime("2000/07/20 00:00:00")) {
      $starSign = "蟹座";
    } else if ($date <= strtotime("2000/08/20 00:00:00")) {
      $starSign = "獅子座";
    } else if ($date <= strtotime("2000/09/20 00:00:00")) {
      $starSign = "乙女座";
    } else if ($date <= strtotime("2000/10/20 00:00:00")) {
      $starSign = "天秤座";
    } else if ($date <= strtotime("2000/11/20 00:00:00")) {
      $starSign = "蠍座";
    } else if ($date <= strtotime("2000/12/20 00:00:00")) {
      $starSign = "射手座";
    } else {
      $starSign = "山羊座";
    }
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: practices/practice01/input.html");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題１</title>
  </head>
  <body>
  <?php
    if (strlen($error) == 0) {
      print "<div>あなたは".$starSign."です。</div>";
    } else {
      print "<div style=\"color: red;\">".$error."</div>";
    }
  ?>
    <a href="./input.html">戻る</a>
  </body>
</html>
