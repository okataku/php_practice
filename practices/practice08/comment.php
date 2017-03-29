<?php
$error = "";
$userId = "";
$username = "";
$createAt = "";
session_start();

if (!isset($_SESSION["id"]) || strlen($_SESSION["id"]) == 0) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: practices/practice07/login.php");
} else {
  $userId = $_SESSION["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && strlen($_GET["id"]) > 0) {
  $pdo = new PDO("mysql:host=localhost;dbname=practice;", "root", "mysql", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
  $statement = $pdo->prepare("select t2.name, DATE_FORMAT( t1.create_at,  '%Y年%m月%d日 %k時%i分%s秒' ) AS  `create_at`  from entries as t1 left outer join users as t2 on t1.user_id = t2.id where t1.id = :id");
  $statement->bindValue("id", $_GET["id"], PDO::PARAM_STR);
  $statement->execute();
  if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $entryId = $_GET["id"];
    $username = $row["name"];
    $createAt = $row["create_at"];
  } else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /practices/practice08/board.php");
  }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["entryId"]) && isset($_POST["comment"])) {
    $pdo = new PDO("mysql:host=localhost;dbname=practice;", "root", "mysql", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $statement = $pdo->prepare("insert into comments (entry_id, user_id, comment, create_at) values (:p1, :p2, :p3, now())");
    $statement->bindValue("p1", $_POST["entryId"], PDO::PARAM_INT);
    $statement->bindValue("p2", $userId, PDO::PARAM_STR);
    $statement->bindValue("p3", nl2br(htmlspecialchars($_POST["comment"])), PDO::PARAM_STR);
    $statement->execute();
    exit();
    if ($statement->rowCount() < 1) {
      $error = "コメントを登録できませんでした。";
    } else {
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: /practices/practice08/board.php");
    }
  } else {
    $error = "コメントを登録できませんでした。。";
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /practices/practice08/board.php");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CSS 画像掲示板 -コメント-</title>

    <style type="text/css">
      body {
      width: 600px;
        margin: 0px auto;
      }

      #header {

      }

      #title {
        font-size: 18pt;
        margin: 10px 10px 5px;
        padding-left: 35px;
        background-image: url("../../images/logo.gif");
        background-repeat: no-repeat;
        background-size: 25px 25px;
      }

      #main {
        margin: 10px 0px 10px;
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 50px;
        border-top: 1px solid #808080;
        border-bottom: 1px solid #808080;
      }

      #main tbody tr td {
      vertical-align: top;
      }

      #footer {
        padding: 0px 10px;
      }
    </style>
  </head>
  <body>
    <div id="header">
      <div id="title">画像掲示板 -コメント-</div>
  	</div>
    <div id="main">
      <div style="color:red"><?php print $error ?></div>
      <form action="./comment.php" method="post">
        <input type="hidden" name="entryId" value="<?php print $entryId ?>" />
        <table>
          <tbody>
            <tr>
              <td colspan="2"><span>[投稿者]&nbsp;<?php print $username ?>&nbsp;&nbsp;<?php print $createAt ?></span></td>
              </tr>
            <tr>
              <td><span>コメント</span></td>
              <td><textarea name="comment" cols="50" rows="5"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" align="right">
                <input type="submit" value="コメント送信" />
                <input type="button" onClick="location.href='./board.php'" value="戻る" />
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <div id="footer">
      <div style="width: 350px; margin: 0px auto; font-size: 9pt; color: #808080;">Copyright © 20XX XXXXXXXXXX Co.,Ltd. All rights reserved.</div>
    </div>
  </body>
</html>
