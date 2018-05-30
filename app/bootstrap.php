<?php
//LOAD CONFIG
require_once 'config/config.php';

//LOAD LIBRARIES - COMMENTED OUT BECAUSE OF AUTOLOADER
//require_once 'libs/Core.php';
//require_once 'libs/Controller.php';
//require_once 'libs/Database.php';

//Autoload Core libs
spl_autoload_register(function ($className){
require_once 'libs/' . $className . '.php';
});