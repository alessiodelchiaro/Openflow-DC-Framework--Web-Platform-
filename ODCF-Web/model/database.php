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

function set_vm_group($vm_id, $vm_group){
	mysql_query("update vm_groups set group_id=".$vm_group." where vm_id=".$vm_id.";");
}

function insert_vm_group($vm_id, $vm_group)
{
	mysql_query("insert into vm_groups(group_id,vm_id) values (".$vm_group.",".$vm_id.")");
	echo "insert into vm_groups(group_id,vm_id) values (".$vm_group.",".$vm_id.")";
}

function get_next_vm_groupid()
{
	$query = mysql_query("select max(group_id) from vm_groups");
	$group_id = mysql_fetch_assoc($query)['max(group_id)'] +1;

	return $group_id;
}

function get_vm_groupid($vm_group_list)
{
	$counter = 1;
	$vm_group_str="";
	foreach ($vm_group_list as $vm) {
		if ($counter ==1)
			$vm_group_str= $vm_group_str.$vm;
		else
			$vm_group_str= $vm_group_str.",".$vm;
		$counter+=1;
	}
	
	$query = mysql_query(" select min(id) from vm_groups where id not in (select group_id from vm_groups where vm_id not in (".$vm_group_str."))");
	$group_id = mysql_fetch_assoc($query);
	if ($group_id['min(id)']=="")
		return 1;

	return $group_id['min(id)'];
}
?>