<?php
$server = explode('/', $_SERVER["SERVER_SOFTWARE"]);
if($server['0'] == 'nginx'){
    define ('SERVER', 'http://prototipe');
}else{
	define ('SERVER', 'http://localhost/prototipe');
}

//config email server 
define('SERVER_TYPE', 'LOCAL');
define('EMAIL_SERVER', '');
define('HOST_SERVER', '');
define('PASS_EMAIL_SERVER', '');

define('MAIL_ADMIN', '');
?>