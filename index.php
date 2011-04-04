<?php
/*
 ==========================================================
 EA-Style Engine
 ----------------------------------------------------------
 http://www.eastyle.com.ua/
 ----------------------------------------------------------
 Copyright 2011, Yury Balakhonov
 ----------------------------------------------------------
 Date: Mon Jan 23 19:25:33 2011
 ==========================================================
 Файл: index.php
 ==========================================================
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

session_start();

define('EASTYLEENGINE', 'true');
define('ROOT_DIR', dirname(__FILE__) . '/');
define('INCLUDE_DIR', ROOT_DIR . '/include/');
define('SMARTY_DIR', '/usr/share/php/smarty/');

require_once(ROOT_DIR . 'config.php');
require_once(ROOT_DIR . 'Smarty.php');
require_once(INCLUDE_DIR . 'db.php');
require_once(INCLUDE_DIR . 'common.php');
require_once(INCLUDE_DIR . 'errors.php');
require_once(INCLUDE_DIR . 'template_class.php');
require_once(INCLUDE_DIR . 'PageCatalog.php');
define('TEMAPLATE_DIR', 'templates/first/');

if (isset($_GET['modul'])) {
	if (!file_exists(ROOT_DIR . 'moduls/' . $_GET['modul'] . '/index.php')) {
		include_once('moduls/' . $_GET['modul'] . '/index.php');
	} else {
		$errors->error = 4;
	}
} else {
	if (isset($_GET['action'])) {
		if (!file_exists(ROOT_DIR . '/action/' . $_GET['action'] . '.php')) {
			include_once('action/' . $_GET['action'] . '.php');
		} else {
			$errors->error = 3;
		}
	} else {
		$pageCatalog = new PageCatalog($db, $smarty);
	}
}

if (!$pageCatalog->pageData) {
	$errors->error = 0;
}

if ($errors->getErrorID() != - 1) {
	$smarty->assign('content', $errors->getErrorMessage());
	$smarty->display(ROOT_DIR . TEMAPLATE_DIR . 'index.tpl');
} else {
	$smarty->display(ROOT_DIR . TEMAPLATE_DIR . 'index.tpl');
}
