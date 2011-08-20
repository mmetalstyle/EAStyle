<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}
if ($_SESSION['user']) {

	global $db;
	global $work;

	if (isset($_GET['editor'])) {
		$query = "SELECT * FROM catalog where ID='".$db->quote_smart($_POST['id'])."'";
		$result = $db->fetch_array($query);

		if ($result) {
			$edit = file_get_contents(ROOT_DIR."/admin/template/edit_news.html");
			$edit = str_replace('{id_news}', $_POST['id'], $edit);
			echo $edit.$work->getFullContentWithTemplate($result);
		} else {
			//TODO echo error
		}

	} else {
		$fullText = str_replace("\n", "\r", $_POST['Full']);
		$fullText = str_replace("\v", "", $fullText);
		$fullText = str_replace("\t", "", $fullText);
		$query = "UPDATE catalog SET title = '".$db->quote_smart($_POST['Zagolovok'])."', full_descr ='".$db->quote_smart($fullText)."', page_keys = '".$db->quote_smart($_POST['Keys'])."' WHERE ID = '".$db->quote_smart($_POST['id'])."'";
		$result = $db->query($query);

		if ($result) {
			$query = "SELECT * FROM catalog where ID='".$db->quote_smart($_POST['id'])."'";
			$result = $db->fetch_array($query);
			if ($result) {
				$edit = file_get_contents(ROOT_DIR."/admin/template/edit_news.html");
				$edit = str_replace('{id_news}', $_POST['id'], $edit);
				die($edit.$work->getFullContentWithTemplate($result));
			} else {
				//TODO echo error
			}
		}
	}
} else {
	echo "not a user";
	//TODO echo error
}

$downloadAdminTemplate = false;
?>