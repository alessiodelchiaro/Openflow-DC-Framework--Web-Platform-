<?php

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

?>