<?php

define('INCLUDE_CHECK',true);
//ini_set('display_errors', 'On');
require 'connect.php';
require 'login_panel.php';

if ((!isset($_SESSION['id'])) or (!isset($_POST['cpu'])) or (!isset($_POST['ram'])) or (!isset($_POST['disk'])) or (!isset($_POST['io'])) or (!isset($_POST['date'])))
	{ 
		header("location: index.php");
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
<?php
//Get the new request values
$cpu = $_POST['cpu'];
$ram = $_POST['ram'];
$disk = $_POST['disk'];
$io = $_POST['io'];
$date = $_POST['date'];
$date = strtotime($date);
	$date = date("Y-m-d H:i:00", $date);
$now = date("Y-m-d H:i:00", time());

// request the vm allocation
$result = request_vm($cpu,$ram,$disk,$io,$date,$now);

// In case of vm NOT allocated
if ($result == "FALSE"){
	// Inform the user that at the moment no virtual machines can be allocated
	?>
	<h1>Virtual Machine Allocation Failed</h1>
	<h2>The current virtual machine request could not be satisfied.</h2>
	<?php
	
}
// In case of vm allocated
else{
	// Add the vm to the database
	insert_vm($_SESSION['usr'], $cpu, $ram, $disk, $io, $result ,$date, $now);
	// give the user the info about the virtual machine
	?>
	<h1>Virtual Machine Allocated</h1>
	<h2>The current virtual machine request was sucessfully completed. The IP Adress of your virtual machine is 
<?php
echo $result;
?>
	 . <p> To view the list of allocated virtual machines <a href="vm_list.php">Click Here</a></p></h2>
	<?php

	}

?>
        </div>     
    </div>   
</body>
</html>