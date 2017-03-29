<?php
$message = "";
$error = "";
$id = "";
$name = "";
$sex = "";
$year = "";
$month = "";
$day = "";
$height = "";
$weight = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && strlen($_GET["id"]) > 0) {
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=practice_x;", "root", "css0515", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $statement = $pdo->prepare("select * from human where id = :id");
    $statement->bindValue("id", $_GET["id"], PDO::PARAM_INT);
    $statement->execute();
    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $id = $row["id"];
      $name = $row["name"];
      $sex = $row["sex"];
      $birthday = strtotime($row["birthday"]);
      $year = date("Y", $birthday);
      $month = date("n", $birthday);
      $day = date("j", $birthday);
      $height = $row["height"];
      $weight = $row["weight"];
    } else {
      $error = "レコードが見つかりませんでした。";
    }
  } catch (Exception $ex) {
    $error = "編集対象のレコード取得処理が失敗しました。";
    var_dump($ex);
  }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["id"])) $id = $_POST["id"];
  if (isset($_POST["name"])) $name = $_POST["name"];
  if (isset($_POST["sex"])) $sex = $_POST["sex"];
  if (isset($_POST["year"])) $year = $_POST["year"];
  if (isset($_POST["month"])) $month = $_POST["month"];
  if (isset($_POST["day"])) $day = $_POST["day"];
  if (isset($_POST["height"])) $height = $_POST["height"];
  if (isset($_POST["weight"])) $weight = $_POST["weight"];
  
  if (strlen($error) == 0 && strlen($id) == 0) {
    $error = "IDが指定されていません。";
  }
  
  if (strlen($error) == 0 && strlen($name) == 0) {
    $error = "名前を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($sex) == 0) {
    $error = "性別を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($year) == 0) {
    $error = "生年月日の年を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($month) == 0) {
    $error = "生年月日の月を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($day) == 0) {
    $error = "生年月日の日を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($height) == 0) {
    $error = "身長を入力してください。";
  }
  
  if (strlen($error) == 0 && strlen($weight) == 0) {
    $error = "体重を入力してください。";
  }
  
  if (strlen($error) == 0 && !preg_match("/^\d+$/", $year)) {
    $error = "生年月日の年は整数を入力してください。";
  }
  
  if (strlen($error) == 0 && !preg_match("/^\d+$/", $month)) {
    $error = "生年月日の月は整数を入力してください。";
  }
  
  if (strlen($error) == 0 && !preg_match("/^\d+$/", $day)) {
    $error = "生年月日の日は整数を入力してください。";
  }
  
  if (strlen($error) == 0 && !checkdate($month, $day, $year)) {
    $error = "生年月日に正しい日付を入力してください。";
  }
  
  if (strlen($error) == 0 && !is_numeric($height)) {
    $error = "身長は数値を入力してください。";
  }
  
  if (strlen($error) == 0 && !is_numeric($weight)) {
    $error = "体重は数値を入力してください。";
  }
  
  try {
    if (strlen($error) == 0) {
      $pdo = new PDO("mysql:host=localhost;dbname=practice_x;", "root", "css0515", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
      $statement = $pdo->prepare("update human set name=:name, sex=:sex, birthday=:birthday, height=:height, weight=:weight where id = :id");
      $statement->bindValue("id", $id, PDO::PARAM_INT);
      $statement->bindValue("name", $name, PDO::PARAM_STR);
      $statement->bindValue("sex", $sex, PDO::PARAM_INT);
      $statement->bindValue("birthday", date("Y/m/d", strtotime($year."/".$month."/".$day)), PDO::PARAM_STR);
      $statement->bindValue("height", $height, PDO::PARAM_STR);
      $statement->bindValue("weight", $weight, PDO::PARAM_STR);
      $statement->execute();
      $message = sprintf("id=%sのレコードを更新しました。(%s)", $id, $name);
    }
  } catch (Exception $ex) {
    $error = "更新処理が失敗しました。";
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: http://localhost/master/practices/practice04/select.php");
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題４ -レコード編集-</title>
  </head>
  <body>
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">humanテーブルのレコード削除</div>
    <form action="./update.php" method="POST">
      <input type="hidden" name="id" value="<?php print $id ?>" />
      <table>
        <tbody>
          <?php
  			if (strlen($message) > 0) {
  				printf ("<tr><td style=\"color: blue;\" colspan=\"2\">%s</td></tr>", $message);
          	}
            if (strlen($error) > 0) {
  				printf ("<tr><td style=\"color: red;\" colspan=\"2\">%s</td></tr>", $error);
          	}
          ?>
          <tr>
            <td>氏名</td>
            <td><input type="text" name="name"  value="<?php print $name ?>" /></td>
          </tr>
          <tr>
            <td>性別</td>
            <td>
              <input type="radio" name="sex" value="0" <?php if ($sex == 0) { print "checked"; } ?>/>男性&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="sex" value="1" <?php if ($sex == 1) { print "checked"; } ?>/>女性
            </td>
          </tr>
          <tr>
            <td>生年月日</td>
            <td>
              <input type="text" name="year" maxlength="4" size="2" value="<?php print $year ?>" />&nbsp;年&nbsp;
              <input type="text" name="month" maxlength="2" size="1" value="<?php print $month ?>" />&nbsp;月&nbsp;
              <input type="text" name="day" maxlength="2" size="1"  value="<?php print $day ?>" />&nbsp;日&nbsp;
            </td>
          </tr>
          <tr>
            <td>身長</td>
            <td><input type="text" name="height" size="4"  value="<?php print $height ?>" />&nbsp;cm</td>
          </tr>
          <tr>
            <td>体重</td>
            <td><input type="text" name="weight" size="4"  value="<?php print $weight ?>" />&nbsp;kg</td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" value="登録" /><a href="./select.php">&nbsp;&nbsp;戻る</a></td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
</html>
