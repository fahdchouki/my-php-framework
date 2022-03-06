<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(__DIR__) . DS);
define("APP", ROOT_PATH . 'app' . DS);
define("CORE", APP . 'Core' . DS);
define("CONFIG", APP . 'Config' . DS);
define("CONTROLLERS", APP . 'Controllers' . DS);
define("MODELS", APP . 'Models' . DS);
define("VIEWS", APP . 'Views' . DS);
define("INCS", VIEWS . 'includes' . DS);
define("UPLOADS", ROOT_PATH . 'public' . DS . 'uploads' . DS);
define("APK_UPLOADS", UPLOADS . 'apks' . DS);
define("BOOK_UPLOADS", UPLOADS . 'books' . DS);

// configuration files 
require_once(CONFIG . 'config.php');
require_once(CONFIG . 'helpers.php');
require_once(CONFIG . 'validation.php');
require_once(CONFIG . 'Route.php');



// autoload all classes 
$modules = [ROOT_PATH, APP, CORE, CONTROLLERS, MODELS, CONFIG];
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
function autoloader($classname){
        @require $classname . ".php";
}
spl_autoload_register('autoloader');