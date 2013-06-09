<?php

function connect_controller($ip, $port)
{
	#
	#Connect to the controller
	#
	$socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
	if ($socket == false)
	{
    	return false;
    }	

    socket_connect($socket, $ip, $port);

    //close the old socket
	//socket_close($socket);

	return $socket;
}

function request_vm($cpu, $ram, $disk, $io, $time, $now)
{
	$socket = connect_controller("127.0.0.1","3000");
	
	//get the difference between $time and $date and convert to seconds
	$a=strtotime($time);
	$b=strtotime($now);
	$secs = $a - $b;

	$type = 1;

	$request_type = 1;
	//Construct the string to do the request
	$vm_request_str = $request_type."/".$cpu."/".$ram."/".$disk."/".$io."/".$type."/".$secs;

	socket_write($socket, $vm_request_str, strlen($vm_request_str)+10);
	 
    $result = socket_read($socket, 30);

    socket_close($socket);

	return $result;
}

function request_intervm_communication($vm_list)
{
	$socket = connect_controller("127.0.0.1","3000");
	
	//get the difference between $time and $date and convert to seconds
	$a=strtotime($time);
	$b=strtotime($now);
	$secs = $a - $b;

	$request_type = sizeof($vm_list);

	//Construct the string to do the request
	$vm_request_str = $request_type;
	foreach ($vm_list as $vm_ip) {
		$vm_request_str = $vm_request_str."/".$vm_ip;
	}

	socket_write($socket, $vm_request_str, strlen($vm_request_str)+10);
	 
    $result = socket_read($socket, 30);

    socket_close($socket);

	return $result;
}

?>