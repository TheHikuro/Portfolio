<?php session_start();
/* var_dump($_SESSION['mail']); */
unset($_SESSION['mail']);
if(empty($_SESSION['mail'])){
	header("Location: ".$_server['server_name']."/assets/projects/Workshop/index.php");
}
?>