<?php
session_start();
if (isset($_SESSION['user'])) {
	 $_SESSION['user'];
}

else{
      echo "<script>window.location.href='login.php'</script>";
  }
?>