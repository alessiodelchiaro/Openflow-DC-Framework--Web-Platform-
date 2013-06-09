<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

$port_list = array();

function checkEmail($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}


function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}

function get_port()
{
	global $port_list;
    $rnumber = mt_rand(1024,60000);

    while (in_array($rnumber, $port_list))
    	$rnumber = mt_rand(1000,6000);

    return $rnumber;
}

function free_port($portnumber)
{
	global $port_list;

	if(($key = array_search($portnumber, $port_list)) !== false) 
	    unset($port_list[$key]);

	array_values($port_list);
}

function insert_vm($usr_name, $cpu, $ram, $disk, $io, $ip, $time, $now)
{
	mysql_query("	INSERT INTO vms(usr_id,cpu,ram,disk,io,ipv4,time,dt,active)
						VALUES((
							select id from users where usr='".$usr_name."'),
							'".$cpu."',
							'".$ram."',
							'".$disk."',
							'".$io."',
							INET_ATON('".$ip."'),
							'".$time."',
							'".$now."',
							1
						)");
}

function remove_vm($usr_id, $vm_id)
{
	mysql_query("update vms set active = 0 where usr_id =".$usr_id);
}

function get_vm($usr_name)
{
	$query = mysql_query("SELECT id,cpu,ram,disk,io,INET_NTOA(`ipv4`),time,dt,active FROM vms where usr_id = (select id from users where usr='".$usr_name."')");
 	$result = array();

 	if ($query == False)
 		echo mysql_error();
 	array_push($result,array("ID", "CPU (#Cores)", "RAM (MB)", "DISK (GB)", "IO (Mbps)","IP Address", "Expiration date", 
 		"Date created", "Status", "Group ID"));

 	$row = mysql_fetch_assoc($query);
	while($row != false)
	{
		array_push($row, get_vm_group($row['id']));
		array_push($result,$row);
		$row = mysql_fetch_assoc($query);
	}
	return $result;
}

function get_vm_group($vm_id)
{
	$query = mysql_query("SELECT group_id FROM vm_groups where vm_id=".$vm_id." ");
	$row = mysql_fetch_assoc($query);
	if ($row == false)
		return 'None';

	return $row['group_id'];
}

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
	// $datetime1 = strtotime($time);
	// $datetime2 = strtotime($now);
	$a=strtotime($time);
	$b=strtotime($now);
	$secs = $a - $b;

	$type = 1;

	$request_type = 1;
	//Construct the string to do the request
	$vm_request_str = $request_type."/".$cpu."/".$ram."/".$disk."/".$io."/".$type."/".$secs;

	socket_write($socket, $vm_request_str, strlen($vm_request_str)+10) or die("Could not write output\n");
	 
    $result = socket_read($socket, 30);

    socket_close($socket);

	return $result;
}

function request_intervm_communication($vm_list)
{
	return True;
}
?>