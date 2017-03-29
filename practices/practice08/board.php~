<?php
$offset = 0;
$limit = 5;
$page = 1;
$pages = 0;
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: http://localhost/master/practices/practice07/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["page"]) && preg_match("/[0-9]+/", $_GET["page"])) {
    $page = (int)$_GET["page"];
  }
}

$pdo = new PDO("mysql:host=localhost;dbname=practice_x;", "root", "css0515", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$statement = $pdo->query("select count(*) from entries");
$pages = ceil(((int)$statement->fetchColumn()) / $limit);
if ($page > $pages) $page = $pages;
$offset = $page * $limit - 5;
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
    
    .entry .thumbnail {
    margin-bottom: 10px;
    }
    
    .entry .createAt {
    margin-left: 10px;
    }
    
    .entry .message {
    margin-bottom: 5px;
    }
    
    .comments {
    margin: 2px 10px 2px 20px;
    padding: 3px;
    }
    
    .comments .comment{
    font-size: 9pt;
    color: #585858;
    background-color: #E6E6E6;
    margin: 2px 0px;
    padding: 3px;
    }
  </style>
</head>
<body>
  <div id="header">
    <div id="title">画像掲示板</div>
    <div id="menu">
      <input type="button" onClick="location.href='../practice07/logout.php'" value="ログアウト" />
      <input type="button" onClick="location.href='../practice07/upload.php'" value="アップロード" />
    </div>
  </div>

  <div id="main">
    
    <?php
	$statement = $pdo->prepare("
    SELECT t1.id, t1.user_id, t2.name, t1.message, t1.image, t1.thumbnail, DATE_FORMAT( t1.create_at,  '%Y年%m月%d日 %k時%i分%s秒' ) AS  `createAt` 
	FROM entries AS t1 LEFT OUTER JOIN users AS t2 ON t1.user_id = t2.id
	ORDER BY t1.create_at DESC LIMIT $offset, $limit");
	$statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="entry">
      <div class="info">
        <span class="user"><?php print $row["name"] ?></span>
        <span class="createAt"><?php print $row["createAt"] ?></span>
        <input type="button" onClick="location.href='./comment.php?id=<?php print $row["id"] ?>'" value="コメント"/>
      </div>
      <div class="message"><?php print $row["message"] ?></div>
      <div class="thumbnail"><a target="_blank" href="../practice07/images/<?php print $row["image"] ?>"><img src="../practice07/images/<?php print $row["thumbnail"] ?>" /></a></div>
      <div class="comments">
      <?php
      $statement2 = $pdo->prepare("select t2.name, DATE_FORMAT(t1.create_at,  '%Y年%m月%d日 %k時%i分%s秒') as `createAt`, t1.comment from comments as t1 left outer join users as t2 on t1.user_id = t2.id where entry_id = :p1 order by t1.create_at desc");
      $statement2->bindValue(":p1", $row["id"], PDO::PARAM_INT);
      $statement2->execute();
      while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="comment"><div>&gt;<?php print $row2["name"]."&nbsp&nbsp".$row2["createAt"] ?></div><div><?php print $row2["comment"] ?></div></div>
      <?php
      }
      ?>
      </div>
    </div>
    <?php
    }
	?>
  </div>
  
  <div id="footer">
    <div style="width: 180px; margin:10px auto 0px; font-size: 9pt; color: #808080;">
      <a href="./board.php?page=1">&lt;&lt;</a>&nbsp;&nbsp;
      <a href="./board.php?page=<?php print ($page - 1 < 1 ? 1 : $page - 1) ?>">&lt;</a>&nbsp;&nbsp;
      <?php
	  $e = ($page + $limit - 1 > $pages) || ($pages < $limit) ? $pages : $page + $limit - 1;
	  $s = $e - ($limit - 1) < 1 ? 1 : $e - ($limit - 1);
      
      for(; $s <= $e; $s++) {
        if ($s == $page) print $s."&nbsp;&nbsp;";
        else printf("<a href=\"./board.php?page=%d\">%d &nbsp;&nbsp;</a>", $s, $s);
      }
	  ?>
      <a href="./board.php?page=<?php print ($page + 1 > $pages ? $page : $page + 1) ?>">&gt;</a>&nbsp;&nbsp;
      <a href="./board.php?page=<?php print $pages ?>">&gt;&gt;</a>
    </div>
    <div style="width: 350px; margin:10px auto 0px; font-size: 9pt; color: #808080;">Copyright © 2013 Central Soft Service Co.,Ltd. All rights reserved.</div>
  </div>
</body>
</html>
