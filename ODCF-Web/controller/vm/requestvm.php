<?php
require dirname(__FILE__).'/../../model/connect.php';
require dirname(__FILE__).'/../../model/controller.php';
require dirname(__FILE__).'/../../model/database.php';
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
$result = request_vm('1',$cpu,$ram,$disk,$io,$date,$now);

// In case of vm NOT allocated
if ($result == "FALSE" or $result == ""){
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
	<h2>The current virtual machine request was sucessfully completed. The IP Address of your virtual machine is 
<?php
echo $result;
?>
	 . <p> To view the list of allocated virtual machines <a href="vm_list.php">Click Here</a></p></h2>
	<?php

	}

?>