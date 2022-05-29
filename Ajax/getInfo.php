<?php 
  require('../database.php');

  $info = query("SELECT text_info FROM info")[0];

  echo $info['text_info'];

?>