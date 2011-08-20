<?php

if (!defined('EASTYLEENGINE')) {
	die("Hacking attempt!");
}

class PageCatalog {
	private $db;
	private $page;
	private $podCatalog;
	private $catalog;
	public $pageData;
	public $pageCatalogData;
	public $pageContent;
	public $smarty;

	function PageCatalog($db, $smarty) {
		$this->smarty = $smarty;
		$this->db = $db;
		$this->page = isset($_GET['page']) ? $_GET['page'] : 0;
		$this->podCatalog = isset($_GET['podcatalog']) ? $_GET['podcatalog'] : 0;
		$this->catalog = isset($_GET['catalog']) ? $_GET['catalog'] : 0;

		$this->getPageData();
		if ($this->pageData) {
			if ($this->pageData['metka'] == 1) {
				$this->getPageContent();
			} else {
				$this->getCatalogContent();
			}

			$this->smarty->assign('title', $this->pageData['title']);
			$this->smarty->assign('page_keys', $this->pageData['page_keys']);
			$this->smarty->assign('links', $this->pageData['links']);
		}
	}

	/**
	 * Enter description here ...
	 */
	public function getPageData() {
		if ($this->catalog && $this->podCatalog && $this->page) {
			$this->pageData = $this->db->fetch_array("SELECT * FROM `catalog` WHERE name='".$this->db->argFilter($_GET['page'])."' AND name_2='".$this->db->argFilter($_GET['catalog'])."' AND name_1='".$this->db->argFilter($_GET['podcatalog'])."'");
			return;
		}

		if ($this->catalog && $this->podCatalog) {
			$this->pageData = $this->db->fetch_array("SELECT * FROM `catalog` WHERE name_1='".$this->db->argFilter($_GET['catalog'])."' AND name='".$this->db->argFilter($_GET['podcatalog'])."' AND levelup='2'");
			return;
		}

		if ($this->catalog) {
			$this->pageData = $this->db->fetch_array("SELECT * FROM `catalog` WHERE name='".$this->db->argFilter($_GET['catalog'])."' AND levelup='1'");
			return;
		}
		/* Load main page */
		$this->pageData = $this->db->fetch_array("SELECT * FROM `catalog` WHERE name='main' AND levelup='1'");
	}

	/**
	 * Enter description here ...
	 */
	public function getPageContent() {
		$this->pageContent = file_get_contents(TEMAPLATE_DIR."/fullstory.html");
		
		if (isset($_SESSION['user'])) {
			$editPanel = file_get_contents(ROOT_DIR . "/admin/template/edit_news.html");
			$editPanel = str_replace('{id_news}', $this->pageData['ID'], $editPanel);
			$this->pageContent = $editPanel.$this->pageContent;
		}
		
		$this->pageContent = str_replace('{fullStory}', $this->pageData['full_descr'], $this->pageContent);
		$this->pageContent = str_replace('{zagolovok}', $this->pageData['zagolovok'], $this->pageContent);
		$this->smarty->assign('content', $this->pageContent);			
	}

	public function getCatalogContent() {
		if ($this->pageData['levelup'] == 1) {
			$this->pageCatalogData = $this->db->fetch_big_array("SELECT * FROM `catalog` WHERE name_1='".$this->db->quote_smart($this->pageData['name'])."' AND levelup='2' ");
		} elseif ($this->pageData['levelup'] == 2) {
			$this->pageCatalogData = $this->db->fetch_big_array("SELECT * FROM `catalog` WHERE name_1='".$this->db->quote_smart($this->pageData['name'])."' AND name_2='".$this->db->quote_smart($this->pageData['name_1'])."' AND levelup='3' ");
		}

		if ($this->pageCatalogData) {
			for ($i = 0; $i < $this->pageCatalogData[0]; $i++) {
				$this->pageContent = $this->getNewsCollection();
			}

			if (isset($_SESSION['user'])) {
				//$tpl->set('{login}', "<a href=\"/?action=logout\">logout</a>");
				} else {
				//$tpl->set('{login}', "");
				}

			$this->smarty->assign('content', $this->pageContent);
		} else {
			//TODO print Error
			}
	}

	function getNewsCollection() {
		$res = array();
		$content = "";
		//die(var_dump($this->pageCatalogData));
		for ($i = 0; $i < $this->pageCatalogData[0]; $i++) {
			$res[$i] = $this->pageCatalogData[$i + 1];
			$res[$i]['title'] = stripslashes($res[$i]['title']);
			$res[$i]['shot_descr'] = stripslashes($res[$i]['shot_descr']);
			$res[$i]['name'] = stripslashes($res[$i]['name']);
			$res[$i]['name_1'] = stripslashes($res[$i]['name_1']);
			$res[$i]['ID'] = stripslashes($res[$i]['ID']);

			$con = file_get_contents(ROOT_DIR.TEMAPLATE_DIR."shotstory.html");

			$con = str_replace('{shot-story}', $res[$i]['shot_descr'], $con);
			$con = str_replace('{title}', $res[$i]['title'], $con);
			if ($res[$i]['name_2'] == "") {
				$con = str_replace('{full-link}', "/".$res[$i]['name_1']."/".$res[$i]['name'], $con);
			} else {
				$con = str_replace('{full-link}', "/".$res[$i]['name_2']."/".$res[$i]['name_1']."/".$res[$i]['name'], $con);
			}
			$content .= $con;
		}
		//die($content);
		return $content;
	}
}
