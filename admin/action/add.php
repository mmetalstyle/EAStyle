<?php
if($_SESSION['user']){

	//global $db;

	class EditCategories {

		var $category_row = null;
		var $db = null;
		var $work = null;
		
		function EditCategories($db, $work) {
			$this->db = $db;
			$this->work = $work;
			$this->category_row = file_get_contents(ROOT_DIR . "/admin/template/category_row.html");
		}


		/**
		 * Подставляет значения в строки таблицы каталогов
		 * @param unknown_type $aCatId
		 * @param unknown_type $aCatTitle
		 * @param unknown_type $aCatPage
		 * @param unknown_type $aCatChild
		 * @return mixed
		 */
		function replaceCategoryRowValues($aCatId, $aCatTitle, $aCatPage, $aCatChild) {
			$result = str_replace("{cat-id}", $aCatId, $this->category_row);
			$result = str_replace("{cat-title}", $aCatTitle, $result);
			$result = str_replace("{cat-page}", $aCatPage, $result);
			$result = str_replace("{icon-cat-child}", $aCatChild, $result);
			return $result;
		}

		/**
		 * Enter description here ...
		 * @return string
		 */
		function getCategoryListLevel1() {
			$cats2 = "";
			$res = array();
			$result = $this->db->fetch_big_array("SELECT name, title FROM `catalog` WHERE  metka='2' AND levelup='1' ");
			if ($result) {
				for ($i = 0; $i < $result[0]; $i++) {
					$res[$i] = $result[$i + 1];
					$res[$i]['name'] = stripslashes($res[$i]['name']);
					$res[$i]['title'] = stripslashes($res[$i]['title']);
					$cats2.= "<option value=".$res[$i]['name'].">".$res[$i]['title']."</option>";
				}
			}
			return $cats2;
		}
		
		/**
		 * Enter description here ...
		 */
		function getCategoryListTable() {
			$res = array();
			$cats="";
			$cats_list = "";
			$result = $this->db->fetch_big_array("SELECT ID, name, name_1, title, levelup FROM `catalog` WHERE  metka='2' ");
			if ($result) {
				for ($i = 0; $i < $result[0]; $i++) {
					$res[$i] = $result[$i + 1];
					$res[$i]['name'] = stripslashes($res[$i]['name']);
					$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
					$res[$i]['title'] = stripslashes($res[$i]['title']);
					$res[$i]['ID'] = stripslashes($res[$i]['ID']);
					$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
					$cats .= "<option value=" . $res[$i]['name'] . ">" . $res[$i]['title'] . "</option>";

					if ($res[$i]['levelup'] == "1") {
						$cats_list .= $this->replaceCategoryRowValues($res[$i]['ID'],
						$res[$i]['title'], $res[$i]['name'], "");
						$result2 = $this->db->fetch_big_array("SELECT ID, name, name_1, title, levelup FROM `catalog` WHERE  metka='2'AND name_1='".$res[$i]['name']."' ");
						if ($result2) {
							$res2 = array();
							for ($j = 0; $j < $result2[0]; $j++) {
								$res2[$j] = $result2[$j + 1];
								$res2[$j]['name'] = stripslashes($res2[$j]['name']);
								$res2[$j]['name_1'] = stripslashes($res2[$j]['name_1']);
								$res2[$j]['title'] = stripslashes($res2[$j]['title']);
								$res2[$j]['ID'] = stripslashes($res2[$j]['ID']);
								$cats_list .= $this->replaceCategoryRowValues($res2[$j]['ID'],
								$res2[$j]['title'], $res2[$j]['name_1']. "/" . $res2[$j]['name'], " -- ");
							}
						}
					}
				}
			}
			//die($cats_list);
			return $cats_list;
		}
		/**
		 * Create new Catalog
		 * @param unknown_type $aCatalog
		 * @param unknown_type $aName
		 * @param unknown_type $aTitle
		 * @param unknown_type $aZagolovok
		 * @param unknown_type $aMetaTags
		 * @param unknown_type $aTemplate
		 */
		function addNewCatalog($aCatalog, $aName, $aTitle, $aZagolovok, $aMetaTags, $aTemplate) {
			if ($aCatalog == "0") {
				$result= $this->db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, metategs, template  )
						VALUES ('" .$aName . "','','','1','2','".$aTitle."','".$aZagolovok."','".$aMetaTags."','".$aTemplate."');");

			} else {
				$result= $this->db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, metategs, template  )
						VALUES ('" . $aName . "','','".$aCatalog."','2','2','".$aTitle."','".$aZagolovok."','".$aMetaTags."','".$aTemplate."');");
			}
			return $this->getCategoryListLevel1();
		}

		/**
		 * delete catalog by ID
		 * @param int $aId - Catalog id
		 */
		function deleteCatalog($aId) {
			$this->work->delete_cats($aId);
			return $this->getCategoryListLevel1();
		}
		
		/**
		 * Add new page
		 * @param unknown_type $aCatalog
		 * @param unknown_type $aName
		 * @param unknown_type $aTitle
		 * @param unknown_type $aZagolovok
		 * @param unknown_type $aMetaTags
		 * @param unknown_type $aTemplate
		 */
		function addNewPage($aCatalog, $aName, $aTitle, $aZagolovok, $aMetaTags, $aTemplate) {
		}
	}
	$editCats = new EditCategories($db, $work);

	//echo $_POST['Apply'] . " | " . $_GET['option'] . "|" . $_POST['Metka'];
	if (isset($_GET['option'])) {
		if ($_GET['option'] == 'delete_cats') {
			die($editCats->deleteCatalog($_GET['id']));
		}
		
		if ($_GET['option'] == 'updateCategoryList') {
			die($editCats->getCategoryListLevel1());
		}
		
		if ($_GET['option'] == 'updateCategoryListTable') {
			die($editCats->getCategoryListTable());
		}
		
		if (isset($_POST['Apply']) && isset($_GET['option']) && $_GET['option'] == 'addcatalog') {
			die($editCats->addNewCatalog($_POST['Category'][0], $_POST['Name'], $_POST['Title'], $_POST['Zagolovok'], "ключ1", $_POST['Template']));
			
		}
		
	} 
		//TODO Запихнуть в класс
//		if (isset($_POST['Apply']) && isset($_GET['option']) && $_GET['option'] == 'addcatalog') {
//			$editCats->addNewCatalog($_POST['Category'][0], $_POST['Name'], $_POST['Title'], $_POST['Zagolovok'], "ключ1", $_POST['Template']);

	// add new page
//	if (isset($_POST['Apply']) && isset($_GET['option']) && $_GET['option'] == 'addpage') {
//			if ($_POST['Metka'] != "2") {
//				//echo "Созда страницу <br />";
//				if($_POST['Category'][0]=="0"){
//					//echo "Без каталога <br />";
//					$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
//							VALUES ('".$_POST['Name']."','','','1','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");
//
//				} else {
//					//echo "В каталоге ";
//					$result= $db->fetch_big_array("SELECT name_1,levelup FROM `catalog` WHERE  name='".$_POST['Category'][0]."' ");
//
//					if($result)
//					{
//						//echo " tyt ";
//						$res = array();
//						$cats="";
//						for ($i = 0; $i < $result[0]; $i++)
//						{
//							$res[$i] = $result[$i + 1];
//							$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
//							$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
//							//echo $res[$i]['levelup'];
//						}
//
//						if($res[0]['levelup']=="1"){
//							//echo "1го уровня <br />";
//							$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
//									VALUES ('".$_POST['Name']."','','".$_POST['Category'][0]."','2','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");
//
//						}else{
//							//echo "2го уровня <br />";
//							$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
//									VALUES ('".$_POST['Name']."','".$res[0]['name_1']."','".$_POST['Category'][0]."','3','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");
//
//						}
//					}
//
//
//				}
//			}
//			//header('Location: /admin.php?action=add');
//		} 
		
			//die("asd11");
//			$result = $db->fetch_big_array("SELECT ID, name, name_1, title, levelup FROM `catalog` WHERE  metka='2' ");
//			if ($result) {
//				$res = array();
//				$cats="";
//				$cats_list = "";
//				for ($i = 0; $i < $result[0]; $i++) {
//					$res[$i] = $result[$i + 1];
//					$res[$i]['name'] = stripslashes($res[$i]['name']);
//					$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
//					$res[$i]['title'] = stripslashes($res[$i]['title']);
//					$res[$i]['ID'] = stripslashes($res[$i]['ID']);
//					$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
//					$cats .= "<option value=" . $res[$i]['name'] . ">" . $res[$i]['title'] . "</option>";
//
//					if ($res[$i]['levelup'] == "1") {
//						$cats_list .= $editCats->replaceCategoryRowValues($res[$i]['ID'],
//						$res[$i]['title'], $res[$i]['name'], "");
//						$result2 = $db->fetch_big_array("SELECT ID, name, name_1, title, levelup FROM `catalog` WHERE  metka='2'AND name_1='".$res[$i]['name']."' ");
//						if ($result2) {
//							$res2 = array();
//							for ($j = 0; $j < $result2[0]; $j++) {
//								$res2[$j] = $result2[$j + 1];
//								$res2[$j]['name'] = stripslashes($res2[$j]['name']);
//								$res2[$j]['name_1'] = stripslashes($res2[$j]['name_1']);
//								$res2[$j]['title'] = stripslashes($res2[$j]['title']);
//								$res2[$j]['ID'] = stripslashes($res2[$j]['ID']);
//								$cats_list .= $editCats->replaceCategoryRowValues($res2[$i]['ID'],
//								$res2[$i]['title'], $res2[$i]['name'], " -- ");
//							}
//						}
//					}
//				}
			

			$cats2 = $editCats->getCategoryListLevel1();
			$cats_list = $editCats->getCategoryListTable();
			
			if (isset($_GET['st']) && $_GET['st'] == "st") {
				$data['content'] = file_get_contents("admin/template/add_str.html");
				$data['content'] = str_replace('{cats}', $cats, $data['content']);
			}

			if (isset($_GET['st']) && $_GET['st'] == "cat") {
				$data['content'] = file_get_contents("admin/template/add_cats.html");
				$data['content'] = str_replace('{cats2}', $cats2, $data['content']);
			}
				$data['content'] = str_replace('{cats_list}', $cats_list, $data['content']);
			
	//	}
	}


?>
