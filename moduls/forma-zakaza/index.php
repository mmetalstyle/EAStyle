<?php
/*!
 * EA-Style Site engine
 * http://eastyle.com.ua/
 *
 * Files:
 *	- /modils/forma-zakaza.php
 *	- /templates/forma-zakaza.html
 *
 * Copyright 2011, Yury Balakhonov
 *
 * Date: Mon Jan 23 19:25:33 2011
*/

global $db;
if($_SESSION['user'] && !$_POST['senddata']){
	    	if ($result) {
	            $data['content'] = str_replace('{addeddate}', iconv("windows-1251", "utf-8", $result['addeddate']), $data['content']);
	            $data['content'] = str_replace('{firstname}', iconv("windows-1251", "utf-8", $result['firstname']), $data['content']);
	            $data['content'] = str_replace('{secondname}', iconv("windows-1251", "utf-8", $result['secondname']), $data['content']);
	            $data['content'] = str_replace('{datadiapazon}', iconv("windows-1251", "utf-8", $result['datadiapazon']), $data['content']);
	            $data['content'] = str_replace('{nomerastyles}', iconv("windows-1251", "utf-8", $result['nomerastyles']), $data['content']);
	            $data['content'] = str_replace('{peoplesnumber}', iconv("windows-1251", "utf-8", $result['peoplesnumber']), $data['content']);
	            $data['content'] = str_replace('{telephone}', iconv("windows-1251", "utf-8", $result['telephone']), $data['content']);
	            $data['content'] = str_replace('{email}', iconv("windows-1251", "utf-8", $result['email']), $data['content']);
	            $data['content'] = str_replace('{comment}', iconv("windows-1251", "utf-8", $result['comment']), $data['content']);
	    	}
	    	$result= $db->fetch_array("UPDATE modul_zakaz_nomera SET neworold='1' where id=".$_GET['z_id']."");
		} else {
			if ($result) {
				$data['title'] = "��������� &laquo;������&raquo;. �������� �����.";
				$data['keywords'] = "��������� &laquo;������&raquo;. �������� �����.";
				$data['link'] = "<link rel=\"stylesheet\" href=\"/moduls/forma-zakaza/css/forma-zakaza.css\" />";

		        $result= $db->fetch_big_array("SELECT id, neworold, addeddate FROM `modul_zakaz_nomera` order by id ASC");
		        if ($result) {
					$res = array();
					//$data['content'] = str_replace('{zayavki}', $result[1][''], $data['content']);
					for ($i = 0; $i < $result[0]; $i++)
					{
						$res[$i] = $result[$i + 1];
						}
					}
					$data['content'] = str_replace('{zayavki}', $zayavki, $data['content']);
				} else {
				}

			} else {
		        if ($_POST['create']) {
		        	$query = "CREATE TABLE `modul_zakaz_nomera` (".
								"`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,";
					if ($_POST['nomerastyles']=="ON") { $query .= "`nomerastyles` VARCHAR( 80 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";}
					if ($_POST['peoplesnumber']=="ON") { $query .= "`peoplesnumber` VARCHAR( 10 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";}
					if ($_POST['datadiapazon']=="ON") { $query .= "`datadiapazon` VARCHAR( 50 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";  }
					if ($_POST['firstname']=="ON") { $query .= "`firstname` VARCHAR( 25 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";      }
					if ($_POST['secondname']=="ON") { $query .= "`secondname` VARCHAR( 25 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";      }
					if ($_POST['telephone']=="ON") { $query .= "`telephone` VARCHAR( 50 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";        }
					if ($_POST['email']=="ON") { $query .= "`email` VARCHAR( 25 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";             }
					if ($_POST['comment']=="ON") { $query .= "`comment` TEXT SET cp1251 COLLATE cp1251_general_cs NOT NULL ,";                                                                 }
					$query .= "`neworold` VARCHAR( 1 ) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL COMMENT '0-1',";
					$query .= "PRIMARY KEY ( `id` )";
					$query .= ") ENGINE = MYISAM ";

					$result= $db->query($query);
					if ($result) {
					} else {
					}
		        } else {
					$data['content'] = file_get_contents("moduls/forma-zakaza/forma-zakaza-install.html");
		        }
			}
		}
	}
} else {
	if ($_POST['senddata']) {
			$values = "'0', '".date("j.m.Y G:i")."'";
			if ($_POST['peoplesnumber']) { $field .= ", ".'peoplesnumber'; $values .= ", '".$_POST['peoplesnumber']."'"; }
			if ($_POST['firstDate'] && $_POST['secondDate']) { $field .= ", ".'datadiapazon'; $values .= ", '".$_POST['firstDate']." - ".$_POST['secondDate']."'"; }
			if ($_POST['firstname']) { $field .= ", ".'firstname'; $values .= ", '".$_POST['firstname']."'";  }
			if ($_POST['secondname']) { $field .= ", ".'secondname'; $values .= ", '".$_POST['secondname']."'"; }
			if ($_POST['telephone']) { $field .= ", ".'telephone'; $values .= ", '".$_POST['telephone']."'"; }
			if ($_POST['email']) { $field .= ", ".'email'; $values .= ", '".$_POST['email']."'"; }
			if ($_POST['comment']) { $field .= ", ".'comment'; $values .= ", '".$_POST['comment']."'"; }

			$result= $db->query("INSERT INTO modul_zakaz_nomera (".$field.") VALUES (".$values.");");
			if ($result) {
					$data['content'] = "���� ������ ����������, �� �������� � ���� � ��������� �����.<br />";
					$_SESSION['captcha_keystring']="";
				} else {
					$data['content'] = "������. ��� ������ �� ���������.<br />";
				}
		} else {
		}
	} else {
		$data['title'] = "��������� &laquo;������&raquo;. �������� �����.";
		$data['keywords'] = "��������� &laquo;������&raquo;. �������� �����.";
		$data['link'] = "<link rel=\"stylesheet\" href=\"/moduls/forma-zakaza/css/forma-zakaza.css\" />";
	}
}
?>