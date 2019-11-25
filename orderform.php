<?php
require_once 'login.php';
require_once 'h.php';
require_once 'data.php';
require_once 'menu.php';
header('X-FRAME-OPTIONS: SAMEORIGIN');

if(!isset($_SESSION)){
session_start();
}
//固定トークンを生成してセッション変数に保存。
//フォームに隠しフィールドで出力します。
if (! isset($_SESSION['token'])) {
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];
 ?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>お弁当注文フォーム</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  </head>
  <body>

    <div class="row">
    <div class="menu-wrapper container">
      <h1 class="logo">だいこん畑</h1>
      <h1><?php echo h($_SESSION['username']); ?>さんの注文ページ</h1>
      <?php
      //エラーがあったら表示する
      if (isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $value) {
          echo ' <span style="color:red;">' . h($value) . '</span><br>' ."￥n";
        }
      }
      $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
      ?>
      <h3>メニュー<?php echo Menu::getCount() ?>品</h3>
      <form action="confirm.php" method="post">
        <div class="menu-items">
          <?php foreach($menus as $menu): ?>
            <div class="menu-item">
              <img src="<?php echo $menu->getImage() ?>" class="menu-item-image">
              <h3 class="menu-item-name"><?php echo $menu->getName() ?></h3>
              <?php if($menu instanceof Side): ?>
              <p class="menu-item-type"><?php echo $menu->getType() ?></p>
              <?php else: ?>
                <p>ごはん増量：</p>
                <input type="text" name="<?php echo $menu->getName() ?>" value="">
                <span>倍</span>
                <?php for($i=0;$i<$menu->getZoryo();$i++): ?>
                  <img src="image/zoryo.png" class="icon-spiciness">
                <?php endfor ?>
              <?php endif ?>
              <p class="price"><?php echo $menu->getTaxIncludedPrice() ?>円（税込）</p>
              <input type="text" name="<?php echo $menu->getName() ?>" value="0">
              <span>個</span>
            </div>
        <?php endforeach ?>
        </div>
        <input type="hidden" name="token" value="<?php echo h($token); ?>">
        <input type="submit" value="注文する"><br>
        <br>
        <a href="login_logout.php">ログアウトする</a>
      </form>
    </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
