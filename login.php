<?php                    /*レシピ213（p546）*/
require_once 'h.php'; // h()関数を[221]読み込みます[041]
  //password_verify関数[220]を読み込みます　require_once '../../../../lib/password_compat/password.php';
header('X-FRAME-OPTIONS: SAMEORIGIN');  //クリックジャッキング対策[290]をする
session_start();  //セッションを開始

//ユーザー名をパスワード設定する、複数名分の設定ができる
$userid[]  ='kimura';
$username[] = 'サワ子';
$hash[] = '$2y$10$wsGPsM8n3RNAEKP9zRZ.Ieaow9iFirUECm3sBLZYgjOQjDqH2YrW6'; //パスワード[sawako305]をpassword_hash()関数でハッシュ化した文字列

$userid[] = 'sato';
$username[] = '雅行';
$hash[] = '$2y$10$BpfbfeWje/6BPVXJ7tIyQ.7Rx9tWJYBLATlRbnCOZS6Iy2xzzfXni'; //[sato310]同上

$error= '';  //エラーメッセージの変数を初期化する

//認証済かどうかのセッション変数を初期化する
if(! isset($_SESSION['auth'])) {
  $_SESSION['auth'] = false;
}

if (isset($_POST['userid']) && isset($_POST['password'])){
  foreach ($userid as $key => $value){
    if ($_POST['userid'] === $userid[$key] &&
    password_verify($_POST['password'], $hash[$key])) {  //入力されたパスワード文字列とハッシュ化済パスワードを照合

//セッション固定化攻撃[301]を防ぐためにセッションIDを変更する
      session_regenerate_id(true);
      $_SESSION['auth'] = true;
      $_SESSION['username'] = $username[$key];
      break;
    }
}

if ($_SESSION['auth'] === false) {
  $error = 'ユーザーIDかパスワードに誤りがあります。';
 }
}

if ($_SESSION['auth'] !== true) {
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <title>お弁当注文フォーム</title>
  </head>
  <body>
  <div id="login">
    <h1>認証フォーム</h1>
    <h3>だいこん畑お弁当注文フォーム</h3>
    <?php
    if ($error){    //エラー文がセットされていれば赤色で表示
      echo '<p style="color:red;">' .h($error).'</p>';
    }
    ?>
  <form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="post">
    <dl>
      <dt><label for="userid">ユーザID：</label></dt>
      <dd><input type="text" name="userid" id="userid" value=""></dd>
    </dl>
  <dl>
    <dt><label for="password">パスワード：</label></dt>
    <dd><input type="password" name="password" id="password" value=""></dd>
  </dl>
  <input type="submit" name="submit" value="ログイン" >
  </form>
  </div>
  </body>
</html>
<?php
// スクリプトを終了し、認証が必要なページ表示されないようにします。
  exit();
}
/* ?>終了タグ省略*/
