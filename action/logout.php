<?php
       //Завершаем сессию
		if($_SESSION['user']){			session_destroy();
			header('Location: /');
			}

?>