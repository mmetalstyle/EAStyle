<?php
//Copyright DMTSOFT � - http://dmtsoft.ru
//Make by DMT
$use_symbols = "012345679"; // ����� ������ �� �����, ������� �� ������ ��������
$use_symbols_len=strlen($use_symbols);
$variant=0; // 0 ��� 1  - ������� ��������� ��������
$amplitude_min=10; // ����������� ��������� �����
$amplitude_max=20; // ������������ ��������� �����

$font_width=32; // ��������������� ������ ������� � ��������

$rand_bsimb_min=1; // ����������� ���������� ����� ��������� (����� �������������)
$rand_bsimb_max=3; // ������������ ���������� ����� ���������

$margin_left=30;// ������ �����
$margin_top=60; // ������ ������

$font_size=50; // ������ ������

$jpeg_quality = 90; // �������� ��������
$back_count = 1; // ���������� ������� �������� � ����� DMT_captcha_fonts ������ �� ������� �� 1 �� $back_count
$length = mt_rand(3,4); 
	// ���������� �������� �������� �� 3 �� 4
	// ���� �� ������� �������� ������ 4, 
	// �� �������� ������ �������� ������� ./DMT_captcha_fonts/back[��� ������].gif
	// �� � ������ ��������� ���� ���!!!
$use_fonts=array(
	'GROTI_23.TTF',
	'COOPE_10.TTF',
	'BREMEN_3.TTF',
	'Candles Chrome.ttf', //  � Bright Ideas
	'CARTOON8.TTF', // Converted by ALLTYPE �1998
	'CHARO___.TTF' // Character Open �1998
		//  Cheri �2001
	);
?>