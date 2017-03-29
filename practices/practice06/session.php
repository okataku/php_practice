<?php
$error = "";
$name = "";
$log = array();

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["function"]) && $_POST["function"] == "1") {
    if (isset($_POST["name"]) && strlen($_POST["name"]) > 0) {
      $_SESSION["name"] = $_POST["name"];
      $_SESSION["log"] = array(date("Y年m月d日 H時i分s秒"));
      $name = $_SESSION["name"];
      $log = $_SESSION["log"];
    } else {
      $error = "名前を入力してください。";
    }
  } else if (isset($_POST["function"]) && $_POST["function"] == "2") {
    session_destroy();
    $_SESSION = array();
    setcookie("PHPSESSID", "", time() - 3600 * 24 * 7);
  }
} else if (isset($_SESSION["name"]) && strlen($_SESSION["name"]) > 0 && isset($_SESSION["log"])) {
  $name = $_SESSION["name"];
  $log = $_SESSION["log"];
  if (count($log) >= 5) {
    array_shift($log);
  }
  array_push($log, date("Y年m月d日 H時i分s秒"));
  $_SESSION["log"] = $log;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題６</title>
  </head>
  <body>
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">演習課題６</div>
    <?php
    if (strlen($error) > 0) {
      printf("<div style=\"color:red\">%s</div>", $error);
    }
    if (is_array($log) && count($log) > 0) {
      printf ("<div style=\"\">ようこそ%sさん。</div>", $name);
    }
	?>
    <table>
      <tbody>
        <?php
        if (is_array($log) && count($log) > 0) {
          foreach(array_reverse($log) as $l) {
            printf("<tr><td>%s</td></tr>", $l);
          }
        ?>
        <form action="./session.php" method="POST">
          <input type="hidden" name="function" value="2" />
          <tr><td></td><td><input type="submit" value="セッション終了" /></td></tr>
        </form>
        <?php } else { ?>
        <form action="./session.php" method="POST">
          <input type="hidden" name="function" value="1" />
          <tr><td>名前</td><td><input type="text" name="name" /></td></tr>
          <tr><td></td><td><input type="submit" value="セッション開始" /></td></tr>
        </form>
        <?php } ?>
      </tbody>
    </table>
    <a href="./session.php">ページを更新する</a>
  </body>
</html>