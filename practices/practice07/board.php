<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /practices/practice07/login.php");
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>CSS 画像掲示板</title>

  <style type="text/css">
    body {
    position: relative;
    margin: 0px auto;
    padding: 75px 0px 50px;
    width: 600px;
    }

    #header {
    position: fixed;
    top: 0px;
    height: 70px;
    width: inherit;
    background-color: #fff;
    border-bottom: 1px solid #808080;
    }

    #title {
    font-size: 20pt;
    margin: 10px 10px 5px;
    padding-left: 35px;
    background-image: url("../../images/logo.gif");
    background-repeat: no-repeat;
    background-size: 25px 25px;
    }

    #menu {
    margin: 0px 5px;
    }

    #main {

    }

    #footer {
    position: fixed;
    bottom: 0px;
    border-top: 1px solid #808080;
    background-color: #fff;
    height: 50px;
    width: inherit;
    }

    .entry {
    padding: 10px 10px;
    border-bottom: 1px dashed #808080;
    width: 580px;
    }

    .entry .info {
    margin-bottom: 5px;
    }

    .entry .user {

    }

    .entry .createAt {
    margin-left: 10px;
    }

    .entry .message {
    margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div id="header">
    <div id="title">画像掲示板</div>
    <div id="menu">
      <input type="button" onClick="location.href='./logout.php'" value="ログアウト" />
      <input type="button" onClick="location.href='./upload.php'" value="アップロード" />
      <input type="button" onClick="location.href='../practice08/board.php'" value="機能強化版へ(演習８)" />
    </div>
  </div>

  <div id="main">

    <?php
	$pdo = new PDO("mysql:host=localhost;dbname=practice;", "root", "mysql", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
	$statement = $pdo->prepare("
    SELECT t1.id, t1.user_id, t2.name, t1.message, t1.image, t1.thumbnail, DATE_FORMAT( t1.create_at,  '%Y年%m月%d日 %k時%i分%s秒' ) AS  `createAt`
	FROM entries AS t1 LEFT OUTER JOIN users AS t2 ON t1.user_id = t2.id
	ORDER BY t1.create_at DESC ");
	$statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="entry">
      <div class="info"><span class="user"><?php print $row["name"] ?></span><span class="createAt"><?php print $row["createAt"] ?></span></div>
      <div class="message"><?php print $row["message"] ?></div>
      <div class="thumbnail"><a target="_blank" href="./images/<?php print $row["image"] ?>"><img src="./images/<?php print $row["thumbnail"] ?>" /></a></div>
    </div>
    <?php
    }
	?>
  </div>

  <div id="footer">
    <div style="width: 350px; margin:10px auto 0px; font-size: 9pt; color: #808080;">Copyright © 20XX XXXXXXXXXX Co.,Ltd. All rights reserved.</div>
  </div>
</body>
</html>
