<?php
	session_start();
	unset($_SESSION['user']);
 	echo "<script>window.location.href='login.php'</script>";
 	
?>