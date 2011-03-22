<?php
//Copyright DMTSOFT © - http://dmtsoft.ru
//Make by DMT
$use_symbols = "012345679"; // Здесь Только те буквы, которые Вы хотите выводить
$use_symbols_len=strlen($use_symbols);
$variant=0; // 0 или 1  - Вариант написания символов
$amplitude_min=10; // Минимальная амплитуда волны
$amplitude_max=20; // Максимальная амплитуда волны

$font_width=32; // Приблизительная ширина символа в пикселях

$rand_bsimb_min=1; // Минимальное расстояние между символами (можно отрицательное)
$rand_bsimb_max=3; // Максимальное расстояние между символами

$margin_left=30;// отступ слева
$margin_top=60; // отступ сверху

$font_size=50; // Размер шрифта

$jpeg_quality = 90; // Качество картинки
$back_count = 1; // Количество фоновых рисунков в папке DMT_captcha_fonts идущих по порядку от 1 до $back_count
$length = mt_rand(3,4); 
	// Количество символов случайно от 3 до 4
	// Если Вы укажите символов больше 4, 
	// то увеличте ширину фонового рисунка ./DMT_captcha_fonts/back[все номера].gif
	// Да и вообще нарисуйте свой фон!!!
$use_fonts=array(
	'GROTI_23.TTF',
	'COOPE_10.TTF',
	'BREMEN_3.TTF',
	'Candles Chrome.ttf', //  © Bright Ideas
	'CARTOON8.TTF', // Converted by ALLTYPE ©1998
	'CHARO___.TTF' // Character Open ©1998
		//  Cheri ©2001
	);
?>