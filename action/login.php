<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

if (!isset($_SESSION['user'])) {
	global $db;

	$data['content'] = file_get_contents("templates/first/login.html");

	if (isset($_POST['login']) && isset($_POST['pass']) && (isset($_GET['ok']) && $_GET['ok'] == "ok")) {

		$query = "SELECT * FROM users WHERE login='".$db->quote_smart($_POST['login'])."'  AND password='".$db->quote_smart($_POST['pass'])."'";
		$result = $db->fetch_array($query);

		if ($result[0]) {

			$_SESSION['user'] = $result['login'];
			$_SESSION['user_up'] = $result['up'];
			$_SESSION['user_id'] = $result['ID'];

			//$data['content'] = "";

			header('Location: /index.php');
		} else {
			//TODO echo error
			header('Location: /index.php');
		}
	} else {
		//TODO echo error
		header('Location: /index.php');
	}
}
?>