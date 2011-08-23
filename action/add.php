<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}
global $db;
// lolololo

if ($_POST['Title'] && $_POST['Name']) {

	$result = $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
					VALUES ('".$db->quote_smart($_POST['Name'])."','".$db->quote_smart($_POST['Name2'])."','".$db->quote_smart($_POST['Category'][0])."','".$db->quote_smart($_POST['Level'])."','".$db->quote_smart($_POST['Metka'])."','".$db->quote_smart($_POST['Title'])."','".$db->quote_smart($_POST['Zagolovok'])."','".$db->quote_smart($_POST['Full'])."','".$db->quote_smart($_POST['Shot'])."','".$db->quote_smart($_POST['Meta_tegs'])."','".$db->quote_smart($_POST['Template'])."');");
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
