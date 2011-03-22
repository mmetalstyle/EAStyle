<?php
class Errors {
	var $err = array();
	var $error = -1;

	function Errors() {
	}

	function initErrors(){
		$this->err[0] = "Code:0 Page not found!";
		$this->err[1] = "12������ �� ������:";
		$this->err[3] = "13�� ���������.";
		$this->err[4] = "14������ �� ������.";
		$this->err[5] = "15fuuuuucckkkkk";
		$this->err[6] = "Code:6 No one page in catalog!";
	}

	function getErrorID() {
		return $this->error;
	}

	function getErrorMessage() {
		return $this->err[$this->error];
	}
}
$errors = new Errors();
$errors->initErrors();
?>
