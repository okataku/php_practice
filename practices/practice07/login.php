<?php
session_start();
$hasError = false;

// セッションに関連付いたユーザーであるとき掲示板ページへリダイレクトします。
if (isset($_SESSION["id"]) && $_SESSION["id"] != null) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /practices/practice07/board.php");
  exit();
}

// ログイン処理を行います。
// ログインが成功したとき掲示板ページへリダイレクトします。
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["password"])) {
  $pdo = new PDO("mysql:host=localhost;dbname=practice;", "root", "mysql", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
  $statement = $pdo->prepare("select id from users where id = :id and password=md5(:password)");
  $statement->bindValue("id", $_POST["id"], PDO::PARAM_STR);
  $statement->bindValue("password", $_POST["password"], PDO::PARAM_STR);
  $statement->execute();
  if ($statement->rowCount() > 0) {
    $_SESSION["id"] = $_POST["id"];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /practices/practice07/board.php");
    exit();
  } else {
    $hasError = true;
  }
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>CSS 画像掲示板 -ログイン-</title>

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
      background-image: url("../../images/logo.png");
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

    #footer {
      padding: 0px 10px;
    }
  </style>
</head>
<body>
  <div id="header">
    <div id="title">画像掲示板 -ログイン-</div>
  </div>
  <div id="main">
    <form action="./login.php" method="post">
      <table>
        <tbody>
          <?php
          if ($hasError) {
            print "<tr>";
            print "<td colspan=\"2\" style=\"color: red \">ログインできませんでした。</td>";
            print "</tr>";
          }
          ?>
          <tr>
            <td><span>ユーザー名</span></td>
            <td><input type="text" name="id" /><br />
            <!--admin-->
            </tr>
          <tr>
            <td><span>パスワード</span></td>
            <td><input type="password" name="password" /></td>
            <!--css-->
          </tr>
          <tr>
            <td colspan="2" align="right"><input type="submit" value="ログイン" /></td>
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
