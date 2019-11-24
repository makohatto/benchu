<?php
function h($var) //htmlでのエスケープ処理をする関数
{
  if (is_array($var)) {
    return array_mpp('h',$var);
  }else{
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}
/* ?>終了タグ省略*/
