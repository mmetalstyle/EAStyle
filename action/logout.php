<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

if ($_SESSION['user']) {
	session_destroy();
	header('Location: /');
}
?>