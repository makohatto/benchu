<?php
require_once('menu.php');

class Omori extends Menu{
  private $zoryo;

  public function __construct($name, $price, $image, $zoryo){
    parent::__construct($name, $price, $image);

    $this->zoryo = $zoryo;
  }

  public function getZoryo(){
    return $this->zoryo;
  }
}
 ?>
