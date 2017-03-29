<?php
$message = "";
$id = -9999;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && strlen($_GET["id"])) {
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=practice_x;", "root", "css0515", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $statement = $pdo->prepare("delete from human where id = :id");
    $statement->bindValue("id", $_GET["id"], PDO::PARAM_INT);
    $statement->execute();
    $message = sprintf("id=%sのレコードを削除しました。", $_GET["id"]);
  } catch(Exception $ex) {
   	$message = "削除処理が失敗しました。";
  }
} else {
  $message = "削除対象が指定されませんでした。";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題４ -レコード削除-</title>
  </head>
  <body>  
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">humanテーブルのレコード削除</div>
    <div>
      	<br/><?php print $message ?>
    	<br/><br/><a href="./select.php">戻る</a>
    </div>
  </body>
</html>
