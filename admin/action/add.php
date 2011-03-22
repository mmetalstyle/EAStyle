<?php
if($_SESSION['user']){

		global $db;

	    if($_POST['Title'] && $_POST['Name'] && $_GET['ok']=="ok")
        {
                   if($_POST['Metka']=="2"){
                   		if($_POST['Category'][0]=="0"){
                   			$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, metategs, template  )
						VALUES ('".$_POST['Name']."','','','1','2','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");

                   		}else{
                   			$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, metategs, template  )
						VALUES ('".$_POST['Name']."','','".$_POST['Category'][0]."','2','2','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");

                   		}
                   }else{
                       //echo "Созда страницу <br />";
						if($_POST['Category'][0]=="0"){
                           //echo "Без каталога <br />";
							$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
							VALUES ('".$_POST['Name']."','','','1','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");

                    	}else{
                    		//echo "В каталоге ";
                    		$result= $db->fetch_big_array("SELECT name_1,levelup FROM `catalog` WHERE  name='".$_POST['Category'][0]."' ");

					    	if($result)
							{
								//echo " tyt ";
					            $res = array();
					            $cats="";
								for ($i = 0; $i < $result[0]; $i++)
								{
									$res[$i] = $result[$i + 1];
									$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
									$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
									//echo $res[$i]['levelup'];
								}

								if($res[0]['levelup']=="1"){
                                    //echo "1го уровня <br />";
									$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
									VALUES ('".$_POST['Name']."','','".$_POST['Category'][0]."','2','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");

                    			}else{
                                    //echo "2го уровня <br />";
                    				$result= $db->query("INSERT INTO catalog (name, name_2, name_1, levelup,  metka, title , zagolovok, full_descr, shot_descr, metategs,template  )
									VALUES ('".$_POST['Name']."','".$res[0]['name_1']."','".$_POST['Category'][0]."','3','1','".$_POST['Title']."','".$_POST['Zagolovok']."','".$_POST['Full']."','".$_POST['Shot']."','".$_POST['Meta_tegs']."','".$_POST['Template']."');");

                    			}
				            }


                    	}
                    }
           header('Location: /admin.php?action=add');

			        //echo $result;
	    }else{
	    	$result= $db->fetch_big_array("SELECT ID,name,name_1, title,levelup FROM `catalog` WHERE  metka='2' ");
	    	if($result)
			{
	            $res = array();
	            $cats="";
				for ($i = 0; $i < $result[0]; $i++)
				{
					$res[$i] = $result[$i + 1];
					$res[$i]['name'] = stripslashes($res[$i]['name']);
					$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
					$res[$i]['title'] = stripslashes($res[$i]['title']);
					$res[$i]['ID'] = stripslashes($res[$i]['ID']);
					$res[$i]['levelup'] = stripslashes($res[$i]['levelup']);
					$cats.= "<option value=".$res[$i]['name'].">".$res[$i]['title']."</option>";
					if($res[$i]['levelup']=="1"){

						$cats_list.= "<td class=\"table_line\">".$res[$i]['ID']."</td><td class=\"table_line\"> <a href=\"/".$res[$i]['name']." \" target=\"_blank\">".$res[$i]['title']."</a></td><td class=\"table_line\">  ".$res[$i]['name']."</td><td class=\"table_line\">[редактировать][<a href=\"/admin.php?action=add&option=delete_cats&id=".$res[$i]['ID']."\">удалить</a>]</td></tr><tr>";

						$result2= $db->fetch_big_array("SELECT ID,name,name_1, title,levelup FROM `catalog` WHERE  metka='2'AND name_1='".$res[$i]['name']."' ");
						if($result2)
						{
						  	$res2 = array();
							for ($j = 0; $j < $result2[0]; $j++)
							{
								$res2[$j] = $result2[$j + 1];
								$res2[$j]['name'] = stripslashes($res2[$j]['name']);
								$res2[$j]['name_1'] = stripslashes($res2[$j]['name_1']);
								$res2[$j]['title'] = stripslashes($res2[$j]['title']);
								$res2[$j]['ID'] = stripslashes($res2[$j]['ID']);
								$cats_list.= "<td class=\"table_line\">".$res2[$j]['ID']."</td><td class=\"table_line\">-- <a href=\"/".$res2[$j]['name_1']."/".$res2[$j]['name']." \" target=\"_blank\">".$res2[$j]['title']."</a></td><td class=\"table_line\">  ".$res2[$j]['name']."</td><td class=\"table_line\">[редактировать][<a href=\"/admin.php?action=add&option=delete_cats&id=".$res2[$j]['ID']."\">удалить</a>]</td></tr><tr>";

							}
						}
					}
				}
            }
            $result= $db->fetch_big_array("SELECT name, title FROM `catalog` WHERE  metka='2'AND levelup='1' ");
	    	if($result)
			{
	            $res = array();
	            $cats2="";
				for ($i = 0; $i < $result[0]; $i++)
				{
					$res[$i] = $result[$i + 1];
					$res[$i]['name'] = stripslashes($res[$i]['name']);
					$res[$i]['title'] = stripslashes($res[$i]['title']);
					$cats2.= "<option value=".$res[$i]['name'].">".$res[$i]['title']."</option>";
				}
            }
	    	if($_GET['st']=="st")$data['content'] = file_get_contents("admin/template/add_str.html");
	    	else $data['content'] = file_get_contents("admin/template/add_cats.html");
	    	$data['content'] = str_replace('{cats}', $cats, $data['content']);
	    	$data['content'] = str_replace('{cats2}', $cats2, $data['content']);
	    	$data['content'] = str_replace('{cats_list}', $cats_list, $data['content']);
	    }
}
?>
