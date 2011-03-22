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
 Данный код БУДЕТ защищен авторскими правами :)
 ==========================================================
 Файл: index.php
 ----------------------------------------------------------
 Назначение: организация 3х уровневой структуры страниц
 ==========================================================
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('html_errors',true);

session_start();

define ( 'EASTYLEENGINE', 'true');
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'INCLUDE_DIR', ROOT_DIR . '/include' );
define ( 'TEMAPLATE_DIR', ROOT_DIR . '/template' );

require_once (ROOT_DIR.'/config.php');
require_once (INCLUDE_DIR.'/db.php');
require_once (INCLUDE_DIR.'/common.php');
require_once (INCLUDE_DIR.'/errors.php');
require_once (INCLUDE_DIR.'/template_class.php');



/* ========== General data ========================================== */
$data = array();
$result_fetch_array = array();
$data['template'] = "main"; // Main template
/* ================================================================== */


/* ========== Perform some jquery action (without reloadPage)======== */
$get_catalog = (isset($_GET['catalog']) ? $_GET['catalog'] : 0);
$get_page = (isset($_GET['page']) ? $_GET['page'] : 0);
$get_podcatalog = (isset($_GET['podcatalog']) ? $_GET['podcatalog'] : 0);

if(isset($_GET['modul']))	{
	if (@fopen($config['site_url'].'moduls/' . $_GET['modul'] . '/index.php', 'r')) {
		include_once('moduls/' . $_GET['modul'] . '/index.php');
	} else {
		$errors->error = 4;
	}
} else {
	
	/* ========== Perform some jquery action (without reloadPage)======== */
	if(isset($_GET['actionjs'])) {
		//TODO
	} else {
		
		/* ========== Perform some action (with reloadPage)============== */
		if(isset($_GET['action']))	{
			if (@fopen( ROOT_DIR . '/action/' . $_GET['action'] . '.php', 'r')) {
				include_once('action/' . $_GET['action'] . '.php');
			} else {
				$errors->error = 3;
			}
		} else {

			if (($get_catalog != "") && ($get_podcatalog != "") && ($get_page != "")) {
				//echo "[level 3]<br />";
				$result_fetch_array= $db->fetch_array("SELECT * FROM `catalog` WHERE name='".$_GET['page']."' AND name_2='".$_GET['catalog']."' AND name_1='".$_GET['podcatalog']."'");
			} else {
					
				if (($get_catalog != "") && ($get_podcatalog != "") && ($get_page == "")) {
					//					echo "[level 2]<br />";
					$result_fetch_array = $db->fetch_array("SELECT * FROM `catalog` WHERE name_1='".$_GET['catalog']."' AND name='".$_GET['podcatalog']."' AND levelup='2'");
				} else {

					if (($get_catalog != "") && ($get_podcatalog == "") && ($get_page == "")) {
						//						echo "[level 1] <br />";
						$result_fetch_array = $db->fetch_array("SELECT * FROM `catalog` WHERE name='" . $_GET['catalog'] . "' AND levelup='1'");
					} else {
						/* ========== Load main page ======== */
						$result_fetch_array = $db->fetch_array("SELECT * FROM `catalog` WHERE name='main' AND levelup='1'");
					}
				}
			}
		}
	}
}
if ($result_fetch_array) {
} else {
	$errors->error = 0;
}
/* ================================================= */


/* ===================Parse Page==================== */
if ($errors->getErrorID() == -1) {
	$res = $result_fetch_array;
	if ($res['metka'] == 1) {

		$content = $work->getFullContentWithTemplate($res);

		$tpl->load_template( $res['template'] );
		$tpl->set('{keywords}', $res['page_keys']);
		$tpl->set('{title}', $res['zagolovok']);
		$tpl->set('{links}', $res['links']);

		if (isset($_SESSION['user'])) {
			$tpl->set('{login}', "<a href=\"/?action=logout\">logout</a>");
			$tpl->set('{content}', $work->getContentEditDisplay($content, $res['ID']) . $content);
		} else {
			$tpl->set('{login}', "");
			$tpl->set('{content}', $content);
		}

	}else{

		if ($res['levelup'] == 1)
		$result= $db->fetch_big_array("SELECT * FROM `catalog` WHERE name_1='" . $res['name'] . "' AND levelup='2' ");
		elseif ($res['levelup'] == 2)
		$result= $db->fetch_big_array("SELECT * FROM `catalog` WHERE name_1='".$res['name']."' AND name_2='" . $res['name_1'] . "' AND levelup='3' ");

		if ($result) {
			for ($i = 0; $i < $result[0]; $i++) {
				$data['content'] = $work->getNewsCollection($result);
			}
			$tpl->load_template ( $res['template'] );
			$tpl->set('{keywords}', $res['page_keys']);
			$tpl->set('{title}', $res['zagolovok']);
			$tpl->set('{links}', $res['links']);
			$tpl->set('{content}', $data['content']);

			if (isset($_SESSION['user'])) {
				$tpl->set('{login}', "<a href=\"/?action=logout\">logout</a>");
			} else {
				$tpl->set('{login}', "");
			}

		} else {
			$errors->error = 6;
		}

	}
}
/* ===================================================== */


/* =================Check Erors========================= */
if ($errors->getErrorID() != -1) {
	$data['content'] = $errors->getErrorMessage();
} else {
	$tpl->compile ( 'main' );
	$data['content'] = $tpl->result['main'];
}
/* ===================================================== */


echo $data['content'];
?>