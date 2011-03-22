<?php
//Copyright DMTSOFT (c) - http://dmtsoft.ru
//Make by DMT
error_reporting (E_ALL); // Установите в error_reporting (0);

/* Использование Using:
<?php session_start(); ?>
<form action="" method="post">
<p>Введите текст с картинки:</p>
<p><img src="./index.php?<?php echo session_name()?>=<?php echo session_id()?>"></p>
<p>
	<!-- Активная, индексируемая ссылка на http://DMTSOFT.ru - обязательна!!!
	Если вы переделали механизм и есть ссылка только на DMTSOFT.ru, то имеете право добавить одну свою ссылку.
	 -->
</noindex><small><a href="http://DMTSoft.ru/"><b>Программирование C/Си++ PHP Pascal/Паскаль</b></a></small></p>
<p><input type="text" name="keystring"><input type="submit" value="Check"></p>
</form>
<?php
if(count($_POST)>0){
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
		echo "Правильно";
	}else{
		echo "Ошибка - неправильный ввод числа";
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