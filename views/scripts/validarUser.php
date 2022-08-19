<?php
 session_start();
if($_SESSION["nombre"]=="")
{
  echo "<script> window.location.href='http://localhost/pinchevicky/index.php'</script>";
}


?>