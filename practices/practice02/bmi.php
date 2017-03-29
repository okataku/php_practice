<?php
$stdBmi = 22;
$height = 0;
$weight = 0;
$bmi = 0;
$stdWeight = 0;
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["height"]) && isset($_POST["weight"]) &&
    is_numeric($_POST["height"]) && is_numeric($_POST["weight"])) {
  
  $height = (float)$_POST["height"];
  $weight = (float)$_POST["weight"];
  
  $bmi = round($weight / pow(($height / 100), 2), 2);
  $stdWeight = round(pow(($height / 100), 2) * $stdBmi, 2);
  
  if ($bmi < 18.5) { $result = "痩せ"; }
  else if ($bmi >= 30) { $result = "高度肥満"; }
  else if ($bmi >= 25) { $result = "肥満"; }
  else { $result = "標準"; }
  
} else {
  
  $height = "";
  $weight = "";
  $bmi = "";
  $stdWeight = "";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>演習課題２</title>
  </head>
  <body>
    <div style="font-weight:bold; margin:5px 0px; padding:10px 5px; width:300px; border-bottom:1px dashed #808080;">BMIチェッカー</div>
    <form action="./bmi.php" method="POST">
      <table>
        <tbody>
          <tr>
            <td>身長</td>
            <td><input type="text" name="height" value="<?php print $height ?>" />&nbsp;cm</td>
          </tr>
          <tr>
            <td>体重</td>
            <td><input type="text" name="weight" value="<?php print $weight ?>" />&nbsp;kg</td>
          </tr>
          <tr>
            <td>判定</td>
            <td><input type="text" name="result" disabled="disabled" value="<?php print $result ?>" /></td>
          </tr>
          <tr>
            <td>BMI値</td>
            <td><input type="text" name="bmi" disabled="disabled" value="<?php print $bmi ?>" /></td>
          </tr>
          <tr>
            <td>標準体重</td>
            <td><input type="text" name="stdWight" disabled="disabled" value="<?php print $stdWeight ?>"/>&nbsp;kg</td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" value="計算実行" /></td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
</html>