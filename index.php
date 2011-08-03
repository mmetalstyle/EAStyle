<?php
/*
 ==========================================================
 Copyright 2011, Yury Balakhonov
 ----------------------------------------------------------
 Date: Mon Jan 23 19:25:33 2011
 ==========================================================
 Файл: index.php
 ==========================================================
 */

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: public");
header("Expires: " . date("r", time() + 3600));
//error_reporting(E_ALL);
//ini_set('display_errors', true);
//ini_set('html_errors', true);

session_start();

define('EASTYLEENGINE', 'true');
define('ROOT_DIR', dirname(__FILE__).'/');
define('INCLUDE_DIR', ROOT_DIR.'/include/');
define('SMARTY_DIR', 'smarty/');
define('TEMAPLATE_DIR', 'templates/first/');

require_once(ROOT_DIR.'config.php');
require_once(ROOT_DIR.'Smarty.php');
require_once(INCLUDE_DIR.'db.php');
require_once(INCLUDE_DIR.'common.php');
require_once(INCLUDE_DIR.'errors.php');
require_once(INCLUDE_DIR.'template_class.php');
require_once(INCLUDE_DIR.'PageCatalog.php');

class Main {
	var $db;
	var $smarty;
	var $errors;
	var $pageCatalog;
	
	function Main($db, $smarty, $errors) {
		$this->db = $db;
		$this->smarty = $smarty;
		$this->errors = $errors;
		
		if (isset($_GET['modul'])) {
			if (file_exists(ROOT_DIR.'moduls/'.$_GET['modul'].'/index.php')) {
				include_once('moduls/'.$_GET['modul'].'/index.php');
			} else {
				return $this->printError(4);
			}
		} else {
			if (isset($_GET['action'])) {
				if (file_exists(ROOT_DIR.'/action/'.$_GET['action'].'.php')) {
					include_once('action/'.$_GET['action'].'.php');
				} else {
					return $this->printError(3);
				}
			} else {
				$this->pageCatalog = new PageCatalog($this->db, $this->smarty);
			}
		}

		if (!$this->pageCatalog->pageData) {
			return $this->printError(0);
		}

		$this->smarty->display(ROOT_DIR.TEMAPLATE_DIR.'index.tpl');
	}
	
	public function printError($aErrorCode){
		$this->errors->error = $aErrorCode;
		$this->smarty->assign('content', $this->errors->getErrorMessage());
		$this->smarty->display(ROOT_DIR.TEMAPLATE_DIR.'index.tpl');
	}
}

$main = new Main($db, $smarty, $errors);
