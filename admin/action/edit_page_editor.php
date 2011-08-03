<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

if ($_SESSION['user']) {
	global $db;

	if (isset($_GET['page_id'])) {
		//$out = array();
		$page = file_get_contents(ROOT_DIR . "/admin/template/edit_page.html");
		$result = $db->fetch_array("SELECT * FROM catalog where ID='".$_GET['page_id']."'");

		if ($result) {
			$out['title'] = $result['title'];
			$out['description'] = $result['full_descr'];
			$out['keys'] = $result['page_keys'];
			$out['ID'] = $result['ID'];

			$page = str_replace("{title}", $out['title'], $page);
			$page = str_replace("{description}", $out['description'], $page);
			$page = str_replace("{keys}", $out['keys'], $page);
			$page = str_replace("{id_news}", $out['ID'], $page);

		} else {
			//$page = iconv("windows-1251", "utf-8", "������ �������!");
			die("page not found[".$_GET['page_id']."]");
		}
	}
	echo $page;
} else {
	echo "not a user";
}
$downloadAdminTemplate = false;
?>