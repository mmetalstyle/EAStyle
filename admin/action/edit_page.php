<?php
if ($_SESSION['user']) {

	global $db;
	global $work;

	if (isset($_GET['editor'])) {		$query = "SELECT * FROM catalog where ID='" . $_POST['id'] . "'";
		$result= $db->fetch_array($query);

		if ($result) {
			$edit = file_get_contents(ROOT_DIR . "/admin/template/edit_news.html");
			$edit = str_replace('{id_news}', $_POST['id'], $edit);
			echo $edit . $work -> getFullContentWithTemplate($result);
		} else {
			//TODO echo error
		}

	} else {
		$query = "UPDATE catalog SET zagolovok = '" . $_POST['Zagolovok'] . "', full_descr ='"
		. $_POST['Full'] . "', page_keys = '" . $_POST['Keys'] . "' WHERE ID = '"
		. $_POST['id'] . "'";
		$result= $db->query($query);

		if ($result) {			$query = "SELECT * FROM catalog where ID='" . $_POST['id'] . "'";
			$result= $db->fetch_array($query);
			if ($result) {				$edit = file_get_contents(ROOT_DIR . "/admin/template/edit_news.html");
				$edit = str_replace('{id_news}', $_POST['id'], $edit);
				echo $edit . $work -> getFullContentWithTemplate($result);
			} else {				//TODO echo error
			}
		}
	}
} else {	echo "not a user";
	//TODO echo error}

$downloadAdminTemplate = false;
?>