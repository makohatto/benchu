<?php
require_once 'h.php';
//require_once 'checkInput.php';
require_once 'sendmail.php';

$mailTo = 'info@plandomakohatto.sakura.ne.jp';
$subject = '注文が入りました';
//Return-Pathにしていするメールアドレス
$returnMail = $mailTo;
header('X-FRAME-OPTIONS: SAMEORIGIN');

session_start();
//$_POST = checkInput($_POST);
if (isset($_POST['token']) && isset($_SESSION['token'])) {
  $token = $_POST['token'];
  if($token != $_SESSION['token']) {
    die('不正アクセスの疑いがあります。');
  }
} else {
  die('不正アクセスの疑いがあります。');
}

//変数にセッション変数を代入する
$username = $_SESSION['username'];
//$email = $_SESSION['email'];
//$comment = $_SESSION['comment'];

//mbstringの日本語設定をする
mb_language('ja');
mb_internal_encoding('UTF-8');

//送信結果をお知らせする変数を初期化する
$message = '';

//メールの送信と結果を判定する
$result = sendmail($username,$mailTo,$subject,$returnMail);
if($result) {
  $message = '注文内容の送信が完了しました！';
//セッション変数を破棄する
  $_SESSION = array();
  session_destroy();
} else {
  $message = '送信失敗';
}
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>メール送信</title>
  </head>
  <body>
    <h1>お弁当注文内容送信フォーム</h1>
    <p><?php echo h($message); ?></p>
  </body>
</html>
