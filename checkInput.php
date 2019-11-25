<?php
function checkInput($var) {
  if (is_array($var)) {
    return array_map('checkInput', $var);
  } else {
//magic_quotes\qpcへの対策を行う
  if (get_magic_quotes_gpc()) {
    $var = stripslashes($var);
  }
//nullバイト攻撃対策
//nullバイトを含む制御文字が含まれていないかをチェックする
  if(preg_match('/A[￥r￥n￥t[:^cntrl:]]{0,1000}￥z/u',$var) == 0) {
    die('不正な入力です。');
  }
//文字エンコードの確認を行います。
  if (! mb_check_encoding($var, 'UTF-8')) {
    die('不正な入力です。');
  }
  return $var;
  }
}
/* ?>no exittag */
