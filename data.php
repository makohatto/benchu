<?php
require_once('side.php');
require_once('omori.php');
require_once('menu.php');

$soup = new Side('スープ',100,'image/soup.png', 'コーンスープ');
$misoshiru = new Side('味噌汁',100,'image/butajiru.png','豚汁');
$maku = new Omori('幕ノ内弁当', 400, 'image/maku.png',3);
$onigiri = new Omori('おにぎり弁当', 300, 'image/onigiri.png',3);
$hanbagu = new Omori('ハンバーグ弁当',500, 'image/hanbagu.png',2);


$menus = array($soup,$misoshiru,$maku,$onigiri,$hanbagu);
?>
