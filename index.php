
<?php
  session_start();
  require('controller.php');
  if(isset($_GET['controller'])){
    $_GET['controller']();
  }else{
      //control_login();
    header('location:home.php');
  }

  if (!isset($_SESSION['id'])) {
    //control_login();
  }


?>
