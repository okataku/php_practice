<?php
$error = "";
$id = "";
$message = "";
$dir = "./images/";
$ext = "";

session_start();

// セッションの状態を確認します。
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /practices/practice07/login.php");
} else {
 $id = $_SESSION["id"];
}

// このブロックがアップロード処理です。
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {

    if (strlen($error) == 0 && !isset($_FILES["image"])) {
      $error = "画像ファイルを指定してください。";
    }

    if (strlen($error) == 0 && preg_match("/^image\/(jpg|jpeg|png|gif)$/i", $_FILES["image"]["type"], $matches)) {
      $errror = "JPEG、GIF、PNG以外のファイル形式はアップロードできません。";
    }
    if ($matches != null) {
      $ext = ".".strtolower($matches[1]);
      if ($ext == ".jpeg") $ext = ".jpg";
    }

    if (strlen($error) == 0 && $_FILES["image"]["size"] == 0) {
      $error = "画像ファイルのサイズが0バイトです。";
    }

    if (strlen($error) == 0 && $_FILES["image"]["size"] > 1024 * 1024) {
      $error = "1Mバイトを超える画像ファイルはアップロードできません。";
    }

    if (strlen($error) == 0 && $_FILES["image"]["error"] != UPLOAD_ERR_OK) {
      $error = "アップロードが失敗しました。";
    }

    if (strlen($error) == 0) {
      if (isset($_POST["message"]) && strlen($_POST["message"]) > 0) {
       	$message = nl2br(htmlspecialchars($_POST["message"]));
      }

      sleep(1);
      $dt = date("YmdHis", time());
      $image = $dt.$ext;
      $imagePath = $dir.$image;
      $thumbnail = "thumb_".$dt.$ext;
      $thumbnailPath = $dir.$thumbnail;
      rename($_FILES["image"]["tmp_name"], $imagePath);

      // サムネイルを作成します。
      $length = 200;
      list($w, $h) = getimagesize($imagePath);
      if ($w > $length || $h > $length) {
        if ($w >= $h) {
          $nw = $length;
          $nh = $h * $length / $w;
        } else {
          $nh = $length;
          $nw = $w * $length / $h;
        }
        $src = imagecreatefromstring(file_get_contents($imagePath));
        $dst = imagecreatetruecolor($nw, $nh);
        imagecopyresized($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
        if ($ext == ".jpg") imagejpeg($dst, $thumbnailPath);
        else if ($ext == ".png") imagepng($dst, $thumbnailPath);
		else if ($ext == ".gif") imagegif($dst, $thumbnailPath);

      } else {
        copy($imagePath, $thumbnailPath);
      }

      // データベースに登録します。
      $pdo = new PDO("mysql:host=localhost;dbname=practice;", "root", "mysql", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
      $commandText = "insert into entries (user_id, message, image, thumbnail, create_at) values (:p1, :p2, :p3, :p4, NOW())";
      $statement = $pdo->prepare($commandText);
      $statement->bindValue("p1", $id, PDO::PARAM_STR);
      $statement->bindValue("p2", $message, PDO::PARAM_STR);
      $statement->bindValue("p3", $image, PDO::PARAM_STR);
      $statement->bindValue("p4", $thumbnail, PDO::PARAM_STR);
      $statement->execute();
    }
  }
  catch (Exception $ex) {
    var_dump($ex);
    $error = "予期せぬエラーが発生しました。";
  }
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>CSS 画像掲示板 -画像アップロード-</title>

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

    #menu {
        margin: 0px 5px;
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
      padding: 0px 10x;
    }
  </style>
</head>
<body>
    <div id="header">
      <div id="title">画像掲示板 -アップロード-</div>
      <div id="menu">
        <input type="button" onClick="location.href = './logout.php'" value="ログアウト" />
      </div>
    </div>
    <div id="main">
      <form action="./upload.php" method="POST" enctype="multipart/form-data">
        <table>
          <tbody>
            <?php
			if (strlen($error) > 0) {
            	printf("<tr><td colspan=\"2\" style=\"color:red\">%s</td></tr>", $error);
            }
            ?>
            <tr>
              <td>ファイル</td>
              <td><input type="file" name="image" /></td>
            </tr>
            <tr>
              <td style="vertical-align: top">メッセージ</td>
              <td><textarea cols="50" rows="5" name="message"></textarea></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="submit" value="アップロード" />
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
