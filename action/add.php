<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}
global $db;

if ($_POST['Title'] && $_POST['Name']) {

	$result = $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
					VALUES ('".$_POST['Name']."','".$_POST['Name2']."','".$_POST['Category'][0]."','".$_POST['Level']."','".$_POST['Metka']."','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");
} else {
	$result = $db->fetch_big_array("SELECT name, title FROM `catalog` WHERE  metka='2' ");
	if ($result) {
		$res = array();
		$cats = "";
		for ($i = 0; $i < $result[0]; $i++) {
			$res[$i] = $result[$i + 1];
			$res[$i]['name'] = stripslashes($res[$i]['name']);
			$res[$i]['title'] = stripslashes($res[$i]['title']);
			$cats .= "<option value=".$res[$i]['name'].">".$res[$i]['title']."</option>";
		}
	}
	$data['content'] = file_get_contents("template/add.html");
	$data['content'] = str_replace('{cats}', $cats, $data['content']);
}
?>