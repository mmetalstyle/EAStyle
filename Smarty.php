<?php
require_once(SMARTY_DIR . 'Smarty.class.php');

class SmartyEAStyle extends Smarty {

	function SmartyEAStyle() {
		$this->Smarty();
		$smarty->debugging = true;

		$smarty->template_dir = ROOT_DIR . '/templates/';
		$smarty->compile_dir = ROOT_DIR . '/templates_c/';
		$smarty->config_dir = ROOT_DIR . '/configs/';
		$smarty->cache_dir = ROOT_DIR . '/cache/';

		//$this->caching = true;
		}

}
$smarty = new SmartyEAStyle();

$smarty->assign('topMenu1', true);
$smarty->assign('topMenu2', true);
$smarty->assign('staticHeader', true);
$smarty->assign('leftPanel1', true);
$smarty->assign('leftPanel2', true);
$smarty->assign('block1', true);
$smarty->assign('content', true);
$smarty->assign('block2', true);
$smarty->assign('rightPanel1', true);
$smarty->assign('rightPanel2', true);
$smarty->assign('block3', true);
$smarty->assign('bottomMenu1', true);
$smarty->assign('footer', true);
$smarty->assign('bottomMenu2', true);
?>