<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

if ($_SESSION['user']) {
	global $db;
	$data['content'] = file_get_contents("admin/template/adm_main.html");

}
?>