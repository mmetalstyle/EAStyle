<?php
       //��������� ������
		if($_SESSION['user']){			session_destroy();
			header('Location: /');
			}

?>