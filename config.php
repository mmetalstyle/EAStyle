<?php
if (! defined ( 'EASTYLEENGINE' )) {
	die ( "Hacking attempt!" );
}
$config['dbhost'] = 'localhost';
$config['dbuser'] = 'root';
$config['dbpass'] = 'root';
$config['dbname'] = 'eastyle';

if (isset($_SERVER['HTTPS'])) $config['site_url'] = 'https://'; else $config['site_url'] = 'http://';
$config['site_url'] .= 
$config['site_url'] .= $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$config['site_url'] = str_replace('index.php', '', $config['site_url']);
?>