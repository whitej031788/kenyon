<?php
require_once __DIR__ . "/libs/myAutoLoad.php";

$autoloader = new KenyonClassLoader();
$autoloader->addPrefix('FrontController', __DIR__ . '/controller');
$autoloader->addPrefix('IndexController', __DIR__ . '/controller');
$autoloader->addPrefix('ErrorController', __DIR__ . '/controller');
$autoloader->addPrefix('LostController', __DIR__ . '/controller');
$autoloader->addPrefix('RegistrationController', __DIR__ . '/controller');
$autoloader->addPrefix('LoginController', __DIR__ . '/controller');
$autoloader->addPrefix('KenyonView', __DIR__ . '/view');
$autoloader->addPrefix('Smarty', __DIR__ . '/view/smarty');
$autoloader->addPrefix('KenyonDatabaseModel', __DIR__ . '/model');
$autoloader->addPrefix('RegistrationClass', __DIR__ . '/model');
$autoloader->addPrefix('LoginClass', __DIR__ . '/model');

$autoloader->register();

require_once __DIR__ . "/libs/appSettings.php";
?>