<?php
require_once 'h.php';

if (isset($_POST['submit'])){
    $password = $_POST['password'];
    $options = array('cost' => 10);
    $hash = password_hash($password,PASSWORD_DEFAULT, $options);
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ハッシュ化済パスワードを取得するスクリプト</title>
  </head>
  <body>
    <?php
    if (isset($hash)){
      echo '生パスワード:'.h($password).'<br>';
      echo 'ハッシュ化済パスワード:'.h($hash).'<br>';
    }

    $auth = password_verify($password, $hash);
    if($auth){
      echo "yay!!!パスワードがハッシュにマッチしてます！";
    }else{
      echo "パスワードがハッシュにマッチしてません";
    }
    ?>

    <hr>
    <form action="password_hash.php" method="post">
      <label for="password">ハッシュ化したいパスワード文字列:</label>
      <input type="text" name="password" id="password" value="">
      <input type="submit" name="submit" value="ハッシュ化">
    </form>
  </body>
</html>
