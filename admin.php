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
 Файл: admin.php
----------------------------------------------------------
 Назначение: организация управления админ панелью
==========================================================
*/

session_start();

define ( 'EASTYLEENGINE', 'true');
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'INCLUDE_DIR', ROOT_DIR . '/include' );
define ( 'TEMAPLATE_DIR', ROOT_DIR . '/template' );

include_once (ROOT_DIR . '/config.php');
include_once (INCLUDE_DIR . '/db.php');
include_once (ROOT_DIR . '/admin/include/common.php');
include_once (INCLUDE_DIR . '/errors.php');



if($_SESSION['user']) { 
	$downloadAdminTemplate = true;

	$data = array();

	$data['template']="main";

    if (isset($_GET['option'])) {
        if ($_GET['option'] == "delete_cats") {          	$result = $work -> delete_cats($_GET['id']);
        	echo $result;        }

        //TODO
    }

	if(isset($_GET['action'])){		if (@fopen(ROOT_DIR.'/admin/action/' . $_GET['action'] . '.php', 'r')) {
		    include_once(ROOT_DIR . '/admin/action/' . $_GET['action'] . '.php');
	    } else {
	    	//TODO echo error
	    	//header('Location: /admin.php?action=add');
	    }
	}



    if($downloadAdminTemplate) {
		if($error){echo $error;}  //����� ������

		$main_content = file_get_contents("admin/template/".$data['template'].".html");
		$main_content = str_replace('{content}', $data['content'], $main_content);


		$main_content = str_replace('{title_news}', $data['title_news'], $main_content);
		$main_content = str_replace('{title}', $data['title'], $main_content);

		echo $main_content;
	}
} else {	echo file_get_contents("admin/template/login_p.html");}
?>