<?php

if (! defined ( 'EASTYLEENGINE' )) {
	die ( "Hacking attempt!" );
}

class Work
{
	/**
	 * Enter description here ...
	 * @return string
	 */
	function getCategoryList(){
		global $db,$data;

		$query =" SELECT name_1, name_2,name, title,levelup FROM catalog WHERE metka='2'";
		$result= $db->fetch_big_array($query);
		$res = array();
		$list="";
		for ($i = 0; $i < $result[0]; $i++)
		{
			$res[$i] = $result[$i + 1];
			$res[$i]['title'] = stripslashes($res[$i]['title']);
			$res[$i]['name'] = stripslashes($res[$i]['name']);
			$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
			$res[$i]['name_2'] = stripslashes($res[$i]['name_2']);
			$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
			$selected ="";
			if($data['levelup']==2 && $res[$i]['levelup']==1 && $res[$i]['name']==$_GET['catalog']){
				$selected ="selected";
			}else{
				if($data['levelup']==3 && $res[$i]['levelup']==2){
					if($res[$i]['name_1']==$_GET['catalog']&& $res[$i]['name']==$_GET['podcatalog']){$selected ="selected";}
				}
			}


			// �������/%/����������
			if(!$res[$i]['name_1']){
				$list.="<option  value=\"".$res[$i]['name']."/%/\" $selected><b>".$res[$i]['title']."</b></option>";
			}else{
				$list.="<option  value=\"".$res[$i]['name_1']."/%/".$res[$i]['name']."\" $selected><b>&nbsp;&nbsp;&nbsp;-&nbsp;".$res[$i]['title']."</b></option>";
			}

			//echo $res[$i]['title']."]  [".$res[$i]['name_1']."]  [".$res[$i]['name']."<br />";
		}                        //echo $data['levelup']."]  [".$_GET['catalog']."]  [".$_GET['podcatalog']."<br />";
		return $list;
	}


	/**
	 * Enter description here ...
	 * @param unknown_type $result
	 * @return Ambigous <string, mixed>
	 */
	function getNewsCollection($result){
		$res = array();
		$content="";
		for ($i = 0; $i < $result[0]; $i++)
		{
			$res[$i] = $result[$i + 1];
			$res[$i]['title'] = stripslashes($res[$i]['title']);
			$res[$i]['shot_descr'] = stripslashes($res[$i]['shot_descr']);
			$res[$i]['name'] = stripslashes($res[$i]['name']);
			$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
			$res[$i]['ID'] = stripslashes($res[$i]['ID']);

			$con =file_get_contents(ROOT_DIR . "/template/shotstory.html");

			$con = str_replace('{shot-story}', $res[$i]['shot_descr'], $con);
			$con = str_replace('{title}', $res[$i]['title'], $con);
			if ($res[$i]['name_2'] == "") {
				$con = str_replace('{full-link}', "/" . $res[$i]['name_1'] . "/"
				. $res[$i]['name'] , $con);
			}else {
				$con = str_replace('{full-link}', "/" . $res[$i]['name_2']. "/" . $res[$i]['name_1'] . "/"
				. $res[$i]['name'] , $con);
			}
			if (isset($_SESSION['user'])) {
				$content.= $this->getContentEditDisplay($content, $res[$i]['ID']) . $con;
			} else {
				$content.= $con;
			}
		}
		return $content;
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $result
	 * @return mixed
	 */
	function getFullContentWithTemplate($result) {
		$dataContent = file_get_contents(ROOT_DIR . "/template/fullstory.html");
		$dataContent = str_replace('{full-story}', $result['full_descr'], $dataContent);
		//$dataContent = str_replace('{keywords}',$data['keywords'], $dataContent);
		//$dataContent = str_replace('{title}', $data['title'], $dataContent);
		//$dataContent = str_replace('{link}', $data['link'], $dataContent);
		//$dataContent = str_replace('{menu_buttons}', $menu_buttons_cont, $dataContent);
		return $dataContent;
	}

	/**
	 * Enter description here ...
	 */
	function getContentEditDisplay($aContent, $aID) {

		$editPanel = file_get_contents(ROOT_DIR . "/admin/template/edit_news.html");
		$editPanel = str_replace('{id_news}', $aID, $editPanel);

		return $editPanel;
	}
}

$work = new Work;
?>
