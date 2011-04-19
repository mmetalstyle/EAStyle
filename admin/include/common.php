<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

class Work {

	function delete_cats($id) {
		global $db;

		$result = $db->fetch_big_array("DELETE FROM `catalog` WHERE `catalog`.`ID` = $id LIMIT 1");

		return $result;
	}

	function getFullContentWithTemplate($result) {
		$dataContent = file_get_contents("template/fullstory.html");
		$dataContent = str_replace('{full-story}', $result['full_descr'], $dataContent);
		//$dataContent = str_replace('{keywords}',$data['keywords'], $dataContent);
		//$dataContent = str_replace('{title}', $data['title'], $dataContent);
		//$dataContent = str_replace('{link}', $data['link'], $dataContent);
		//$dataContent = str_replace('{menu_buttons}', $menu_buttons_cont, $dataContent);
		return $dataContent;
	}

}

$work = new Work;
?>
