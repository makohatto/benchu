<?php
//セッションを開始します
session_start();
//セッションを破棄します
$_SESSION = array();
session_destroy();
?>
 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1.0" >
     <title>ログアウト</title>
   </head>
   <body>
     <div>
       <h3>だいこん畑お弁当注文フォーム</h3>
       <p>ログアウトしました。</p>
       <p><a href="orderform.php" >もう一度ログインする</a></p>
     </div>
   </body>
 </html>
