<?php
class db {
	var $link;

	function db($dbhost, $dbuser, $dbpass, $dbname) {
		$this->link = @mysql_connect($dbhost, $dbuser, $dbpass) or die('do not connected!');
		@mysql_select_db($dbname, $this->link) or die('not selected db !');
		//@mysql_query("SET CHARSET 'cp1251'");
		@mysql_query("SET NAMES 'utf8'");
	}

	function query($query) {
		//echo "<br />".$query."<br />";
		$result = @mysql_query($query, $this->link);
		if ($result) {
			//echo "<br />[".count($result)."]===[".$result['ID']."]<br />";
			return $result;
		} else {
			return false;
		}
	}

	function fetch_array($query) {
		//echo "<br />".$query."<br />";
		$temp = $this->query($query);
		if ($temp) {
			$result = @mysql_fetch_array($temp);
			if ($result) {
				return $result;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function fetch_big_array($query) {
		$temp = $this->query($query);
		if ($temp) {
			$i = 0;
			$array_data = array();
			while ($result = @mysql_fetch_array($temp)) {
				$i++;
				$array_data[$i] = $result;
			}
			if ($i != 0) {
				$array_data[0] = $i;
				return $array_data;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function argFilter($value) {
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}

		if (!is_numeric($value)) {
			$value = mysql_real_escape_string($value);
		}
		return $value;
	}
}

$db = new db($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbname']);
?>
