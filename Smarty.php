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

$smarty->assign('topMenu1', false);
$smarty->assign('topMenu2', true);
$smarty->assign('staticHeader', true);
$smarty->assign('leftPanel1', true);
$smarty->assign('leftPanel2', true);
$smarty->assign('block1', false);
$smarty->assign('content', true);
$smarty->assign('block2', false);
$smarty->assign('rightPanel1', false);
$smarty->assign('rightPanel2', false);
$smarty->assign('block3', false);
$smarty->assign('bottomMenu1', false);
$smarty->assign('footer', true);
$smarty->assign('bottomMenu2', false);

$smarty->assign('templateDir', "/".TEMAPLATE_DIR);

if (isset($_SESSION['user'])) {
			$smarty->assign('login', "<a href=\"/?action=logout\">logout</a>");
}





?>