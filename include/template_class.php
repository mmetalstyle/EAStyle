<?php
/*
 ==========================================================
 EA-Style Engine
 ----------------------------------------------------------
 http://www.eastyle.com.ua/
 ----------------------------------------------------------
 Copyright 2011, Yury Balakhonov
 ----------------------------------------------------------
 Date: Mr 9 19:15 2011
 ==========================================================
 Данный код БУДЕТ защищен авторскими правами :)
 ==========================================================
 Файл: template_class.php
 ----------------------------------------------------------
 Назначение: Подстановка в шаблон данных
 ==========================================================
 */

class template {

	var $template = null;
	var $copy_template = null;
	var $data = array ();
	var $block_data = array ();
	var $result = array ('info' => '', 'vote' => '', 'speedbar' => '', 'content' => '' );
	var $allow_php_include = true;

	var $template_parse_time = 0;

	function set($name, $var) {
		if( is_array( $var ) && count( $var ) ) {
			foreach ( $var as $key => $key_var ) {
				$this->set( $key, $key_var );
			}
		} else
		$this->data[$name] = $var;
	}

//	function set_block($name, $var) {
//		if( is_array( $var ) && count( $var ) ) {
//			foreach ( $var as $key => $key_var ) {
//				$this->set_block( $key, $key_var );
//			}
//		} else
//		$this->block_data[$name] = $var;
//	}

	function load_template($tpl_name) {
		
		if($tpl_name == '') $tpl_name = 'main';
		
		if(! file_exists( TEMAPLATE_DIR . "/" . $tpl_name . ".html" )) {
			die( "Шаблон не найден: " . $tpl_name);
			return false;
		}
		
		$this->template = file_get_contents(TEMAPLATE_DIR . "/" . $tpl_name . ".html");

		$this->copy_template = $this->template;
		
		return true;
	}

	function load_file( $name ) {
		global $db, $is_logged, $member_id, $cat_info, $config, $user_group, $category_id, $_TIME, $lang, $smartphone_detected, $dle_module;

		$name = str_replace( '..', '', $name );

		$url = parse_url ($name);
		$type = explode( ".", $url['path'] );
		$type = strtolower( end( $type ) );

		if ($type == "tpl") {

			return $this->sub_load_template( $name );

		} else {

			if ( !$this->allow_php_include ) return;

			if ($type != "php") return "��� ����������� ����������� ������ ����� � ����������� .tpl ��� .php";

			if ($url['path']{0} == "/" )
			$file_path = dirname (ROOT_DIR.$url['path']);
			else
			$file_path = dirname (ROOT_DIR."/".$url['path']);

			$file_name = pathinfo($url['path']);
			$file_name = $file_name['basename'];

			if ( stristr ( php_uname( "s" ) , "windows" ) === false )
			$chmod_value = @decoct(@fileperms($file_path)) % 1000;

			if ($chmod_value == 777 ) return "���� {$url['path']} ��������� � �����, ������� �������� ��� ������ (CHMOD 777). � ����� ������������ ����������� ������ �� ����� ����� ����������. �������� ����� �� �����, ����� �� ��� ������ ���� �� ������.";

			if ( !file_exists($file_path."/".$file_name) ) return "���� {$url['path']} �� ������, ��� �������� ����������.";

			if ( $url['query'] ) {

				parse_str( $url['query'] );

			}

			ob_start();
			$tpl = new dle_template( );
			$tpl->dir = TEMPLATE_DIR;
			include $file_path."/".$file_name;
			return ob_get_clean();

		}


	}

	function sub_load_template( $tpl_name ) {

		$tpl_name = totranslit( $tpl_name );

		if( $tpl_name == '' || ! file_exists( $this->dir . DIRECTORY_SEPARATOR . $tpl_name ) ) {
			return "����������� ���� �������: " . $tpl_name ;
			return false;
		}
		$template = file_get_contents( $this->dir . DIRECTORY_SEPARATOR . $tpl_name );

		if (strpos ( $template, "[aviable=" ) !== false) {
			$template = preg_replace ( "#\\[aviable=(.+?)\\](.*?)\\[/aviable\\]#ies", "\$this->check_module('\\1', '\\2')", $template );
		}

		if (strpos ( $template, "[not-aviable=" ) !== false) {
			$template = preg_replace ( "#\\[not-aviable=(.+?)\\](.*?)\\[/not-aviable\\]#ies", "\$this->check_module('\\1', '\\2', false)", $template );
		}

		if (strpos ( $template, "[not-group=" ) !== false) {
			$template = preg_replace ( "#\\[not-group=(.+?)\\](.*?)\\[/not-group\\]#ies", "\$this->check_group('\\1', '\\2', false)", $template );
		}

		if (strpos ( $template, "[group=" ) !== false) {
			$template = preg_replace ( "#\\[group=(.+?)\\](.*?)\\[/group\\]#ies", "\$this->check_group('\\1', '\\2')", $template );
		}

		return $template;
	}

	function check_module($aviable, $block, $action = true) {
		global $dle_module;

		$aviable = explode( '|', $aviable );

		$block = str_replace( '\"', '"', $block );

		if( $action ) {
				
			if( ! (in_array( $dle_module, $aviable )) and ($aviable[0] != "global") ) return "";
			else return $block;

		} else {
				
			if( (in_array( $dle_module, $aviable )) ) return "";
			else return $block;

		}

	}

	function check_group($groups, $block, $action = true) {
		global $member_id;

		$groups = explode( ',', $groups );

		if( $action ) {
				
			if( ! in_array( $member_id['user_group'], $groups ) ) return "";

		} else {
				
			if( in_array( $member_id['user_group'], $groups ) ) return "";

		}

		$block = str_replace( '\"', '"', $block );

		return $block;

	}

	function _clear() {

		$this->data = array ();
		$this->block_data = array ();
		$this->copy_template = $this->template;

	}

	function clear() {

		$this->data = array ();
		$this->block_data = array ();
		$this->copy_template = null;
		$this->template = null;

	}

	function global_clear() {

		$this->data = array ();
		$this->block_data = array ();
		$this->result = array ();
		$this->copy_template = null;
		$this->template = null;

	}

	function compile($tpl) {

		$time_before = $this->get_real_time();

		if( count( $this->block_data ) ) {
			foreach ( $this->block_data as $key_find => $key_replace ) {
				$find_preg[] = $key_find;
				$replace_preg[] = $key_replace;
			}
				
			$this->copy_template = preg_replace( $find_preg, $replace_preg, $this->copy_template );
		}

		foreach ( $this->data as $key_find => $key_replace ) {
			$find[] = $key_find;
			$replace[] = $key_replace;
		}

		$this->copy_template = str_replace( $find, $replace, $this->copy_template );

		if( isset( $this->result[$tpl] ) ) $this->result[$tpl] .= $this->copy_template;
		else $this->result[$tpl] = $this->copy_template;

		$this->_clear();
	
		$this->template_parse_time += $this->get_real_time() - $time_before;
	}

	function get_real_time() {
		list ( $seconds, $microSeconds ) = explode( ' ', microtime() );
		return (( float ) $seconds + ( float ) $microSeconds);
	}
}
$tpl = new template();
?>