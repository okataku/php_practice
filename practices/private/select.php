<?php
$pdo = new PDO("mysql:host=175.184.33.60;dbname=cp9h7pt_ate;", "cp9h7pt_ate", "GKC5aKnI", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$statement = $pdo->prepare("select * from test");
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
      print "<tbody>";
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      	print "<tr>";
        print "<td>".$row["name"]."</td>";
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