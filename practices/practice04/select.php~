<?php
$pdo = new PDO("mysql:host=localhost;dbname=practice_x;", "root", "css0515", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$statement = $pdo->prepare("select * from human");
$statement->execute();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題４ -レコード一覧-</title>
    <style type="text/css">
      table {
      	margin: 5px;
      	border-spacing: 0;
      }
      
      thead td {
      	color: #FFF;
      	background-color: #3C3C3C;
      	border-bottom: 1px dashed #808080;
      	padding: 3px;
      }
      
      tbody td {
      	border-bottom: 1px dashed #808080;
      	padding: 3px 10px;
      }
    </style>
  </head>
  <body>
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">humanテーブルのレコード一覧</div>
    <div>
    <?php
    if ($statement->rowCount() == 0) {
      print "レコードが登録されていません。";
    } else {
      print "<table>";
      print "<thead><tr>";
      print "<td>氏名</td>";
      print "<td>性別</td>";
      print "<td>生年月日</td>";
      print "<td>身長</td>";
      print "<td>体重</td>";
      print "<td>編集</td>";
      print "<td>削除</td>";
      print "</tr></thead>";
      print "<tbody>";
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      	print "<tr>";
        print "<td>".$row["name"]."</td>";
        print "<td>".($row["sex"] == 0 ? "男性" : "女性")."</td>";
        print "<td>".$row["birthday"]."</td>";
        print "<td>".$row["height"]."</td>";
        print "<td>".$row["weight"]."</td>";
        print "<td><a href=\"./update.php?id=".$row["id"]."\">編集</a></td>";
        print "<td><a href=\"./delete.php?id=".$row["id"]."\">削除</a></td>";
        print "</tr>";
      }
      print "</tbody></table>";
    }
	?>  
    </div>
    <br/>
    <div>
      <a href="./insert.php">レコードを追加する</a>
    </div>
  </body>
</html>
