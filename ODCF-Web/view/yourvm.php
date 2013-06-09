<?php
define('INCLUDE_CHECK',true);
require '../debug.php';
require 'login_panel/login_panel.php';

if ((!isset($_SESSION['id'])) or (!isset($_POST['cpu'])) or (!isset($_POST['ram'])) or (!isset($_POST['disk'])) or (!isset($_POST['io'])) or (!isset($_POST['date'])))
	{ 
		header("location: ../index.php");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OF Datacenter</title> 
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
</head>
<body>
	<div id="main">
		<div class="container">
			<?php include '../controller/vm/requestvm.php';?>
        </div>     
    </div>   
</body>
</html>