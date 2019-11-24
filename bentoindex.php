<?php
require_once('data.php');
require_once('menu.php');
 ?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>お弁当注文フォーム</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div class="menu-wrapper container">
      <h1 class="logo">PoKaPoKaBeN!</h1>
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
                <p>ごはん増量：<?php echo $menu->getZoryo() ?>倍</p>
                <?php for($i=0;$i<$menu->getZoryo();$i++): ?>
                  <img src="image/zoryo.png" class="icon-spiciness">
                <?php endfor ?>
              <?php endif ?>
              <p class="price">￥<?php echo $menu->getTaxIncludedPrice() ?>（税込）</p>
              <input type="text" name="<?php echo $menu->getName() ?>" value="0">
              <span>個</span>
            </div>
          <?php endforeach ?>
        </div>
        <input type="submit" value="注文する">
      </form>
    </div>
  </body>
</html>
