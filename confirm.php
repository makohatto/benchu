<?php
require_once 'login.php';
require_once 'h.php';
//require_once 'checkInput.php';
require_once 'data.php';
header('X-FRAME-OPTIONS: SAMEORIGIN');

if(!isset($_SESSION)){
session_start();
}
//$_POST = checkInput($_POST) ;
if (isset($_POST['token']) && isset($_SESSION['token'])) {
  $token = $_POST['token'];
  if ($token != $_SESSION['token']) {
    die('不正アクセスの疑いがあります。');
  }
} else {
  die('不正アクセスの疑いがあります。');
}

//変数にPOSTされたデータを代入します。
$username = isset($_POST['username']) ? $_POST['username'] :'';

$error = array();

//メールアドレス欄をチェック
//if (trim($name) == '') {
//  $error[] = 'お名前は必須項目です。';
//} elseif (mb_strlen($email) > 256) {
//  $error[] = 'メールアドレスは256文字以内でお願い致します。';
//} else {
//  $pattern = '/￥A([a-z0-9_￥-￥+￥/￥?]+)(￥.[a-z0-9_￥-￥+￥/￥?]+)*'.
//              '@([a-z0-9￥-]+￥.)+[a-z]{2,6}￥z/i';
//  if (! preg_match($pattern, $email)) {
//    $error[] = 'メールアドレスの形式が正しくありません。';
//  }
//}
//コメント欄をチェック
//if (trim($comment) == '') {
//  $error[] = 'コメント欄は必須項目です。';
//} elseif (mb_strlen($comment) > 500) {
//  $error[] = 'コメントは500文字以内でお願い致します。';
//}

//POSTされたデータとエラーメッセージをセッション変数に保存する
$_SESSION['username'] = $username;
//$_SESSION['email'] = $email;
//$_SESSION['comment'] = $comment;
$_SESSION['error'] = $error;

//エラー数を確認
if (count($error) > 0) {
//エラーがある場合、入力フォームに戻す
  $dirname = dirname($_SERVER['SCRIPT_NAME']);
  $dirname = ($dirname == DIRECTORY_SEPARATOR)? '' : $dirname;
  $uri = 'http://' . $_SERVER['SERVER_NAME'] .
          $dirname . 'orderform.php';
  header('HTTP/1.1 303 See Other');
  header('Location: ' . $uri);
  //確認画面を表示する
} else {
?>
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>弁当注文フォーム</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div class="order-wrapper">
      <h2><?php echo h($username); ?>さんの注文内容確認</h2>
      <h3>以下の内容でよろしければ、.<br>.送信ボタンを押してください。</h3>
      <?php $totalPayment = 0 ?>
      <?php foreach ($menus as $menu): ?>
        <?php
          $orderCount = $_POST[$menu->getName()];
          $menu->setOrderCount($orderCount);
          $totalPayment += $menu->getTotalPrice();

        ?>
        <p class="order-amount">
          <?php echo $menu->getName() ?>
          x
          <?php echo $orderCount ?>
          個
        </p>
        <p class="order-price"><?php echo $menu->getTotalPrice() ?>円</p>
      <?php endforeach ?>
      <h3>合計金額：<?php echo $totalPayment ?>円</h3>
    </div>

    <form action="orderform.php" method="post">
      <input type="submit" name="back" value="入力画面へ戻る">
    </form>
    <form action="thanks.php" method="post">
      <input type="hidden" name="token" value="<?php echo h($token); ?>">
      <input type="submit" name="submit" value="送信する">
    </form>
　
  </body>
</html>
<?php
}
/* ?>*/
