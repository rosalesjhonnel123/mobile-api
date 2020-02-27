<?php
header("Access-Control-Allow-Origin: *");
@ini_set('display_errors', 'on');

/* DATABASE CONFIGURATION */
define('DB_EGN', 'InnoDB');
define('DB_SVR', 'e70cf06bd1bdb470ce10c5e90b794128c46be624.rackspaceclouddb.com');
define('DB_USER', 'proweaveruser700');
define('DB_PRE', 'pre_');
define('DB_NAME', 'proweaverdb703');
define('DB_PASS', 'dbCeBuctI2014');
define('DB_TYP', 'MySQL');

/* DEFINES */
define('_CONTROLLER_DIR_', dirname(__FILE__).'/../applications/controllers/');
define('_MODEL_DIR_', dirname(__FILE__).'/../applications/models/');


/* Router PHP */
require_once('core/router.php');
require_once('core/url.php');
require_once('core/controller.php');
require_once('core/model.php');
/* DB */
require_once('core/db.php');


/* AUTO LOAD CLASS */
function loadmyclass($className)
{	
	$classcontrollers = _CONTROLLER_DIR_;
	$classmodels = _MODEL_DIR_;	

	$file_in_controllers = file_exists($classcontrollers.strtolower($className).'.php');
	$file_in_models = file_exists($classmodels.strtolower($className).'.php');		
	
	if ($file_in_controllers) require_once($classcontrollers.strtolower($className).'.php');
	if ($file_in_models) require_once($classmodels.strtolower($className).'.php');	
}
spl_autoload_register('loadmyclass');