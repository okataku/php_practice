<?php
$counter = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["function"])) {
  if ($_POST["function"] == "1") {
    // カウンタをリセット。
    $counter = 1;
    setcookie("practice05", $counter, time() + 3600 * 24 * 7);
  } else if ($_POST["function"] == "2") {
    // Cookieを削除。
    setcookie("practice05", $counter, time() + -3600 * 24 * 7);
  }
} else {
  // カウンタをインクリメント。
  $counter = isset($_COOKIE["practice05"]) && preg_match("/^\d+$/", $_COOKIE["practice05"]) ? (int)$_COOKIE["practice05"] : 0;
  setcookie("practice05", ++$counter, time() + 3600 * 24 * 7);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題５</title>
  </head>
  <body>
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">演習課題５</div>
    <div>
      <?php print $counter ?>回目の訪問です。
    </div>
    <div>
      <form action="./cookie.php">
        <input type="submit" value="更新" />
      </form>
      <form action="./cookie.php" method="POST">
        <input type="hidden" name="function" value="1" />
        <input type="submit" value="リセット" />
      </form>
      <form action="./cookie.php" method="POST">
        <input type="hidden" name="function" value="2" />
        <input type="submit" value="Cookie削除" />
      </form>
    </div>
  </body>
</html>