<?php
//Copyright DMTSOFT (c) - http://dmtsoft.ru
//Make by DMT
error_reporting (E_ALL); // ���������� � error_reporting (0);

/* ������������� Using:
<?php session_start(); ?>
<form action="" method="post">
<p>������� ����� � ��������:</p>
<p><img src="./index.php?<?php echo session_name()?>=<?php echo session_id()?>"></p>
<p>
	<!-- ��������, ������������� ������ �� http://DMTSOFT.ru - �����������!!!
	���� �� ���������� �������� � ���� ������ ������ �� DMTSOFT.ru, �� ������ ����� �������� ���� ���� ������.
	 -->
</noindex><small><a href="http://DMTSoft.ru/"><b>���������������� C/��++ PHP Pascal/�������</b></a></small></p>
<p><input type="text" name="keystring"><input type="submit" value="Check"></p>
</form>
<?php
if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
		echo "���������";
	}else{
		echo "������ - ������������ ���� �����";
	}
}
unset($_SESSION['captcha_keystring']);
*/

include('DMT-captcha-gen.php');

if(isset($_REQUEST[session_name()])){
	session_start();
}

$captcha = new DMTcaptcha();

if($_REQUEST[session_name()]){
	$_SESSION['captcha_keystring'] = $captcha->getKeyString();
}

?>