<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Does everything.
*/
error_reporting(E_ALL);
ini_set('display_errors', 'on');


# read config
require dirname(__FILE__).'/crust.php';
require CRUST_CONFIG;
require CRUST_TOOLBOX;

set_error_handler(array('CrustToolbox', 'InteralError'));
set_exception_handler(array('CrustToolbox', 'InternalException'));

require TEMPLATE_ENGINE; // smarty
require TEMPLATE_ADAPTER; // smarty adapter
require APPLICATION_CONTROLLER;
require ORM; // Doctrine ORM 1.2.4
require ROUTER; // class
require ROUTES; // mapping

// starts session if none is found, prevents session forgery
CrustToolbox::regulateSession(); 

// doctrine autoloaders
spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

$manager = Doctrine_Manager::getInstance();
$manager->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
$manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

$dbh       = new PDO(CrustConfig::buildDoctrineDsn(), CrustConfig::get('db_user'), CrustConfig::get('db_pass'));
$oDB       = Doctrine_Manager::connection($dbh);

$oDB->setOption('username', CrustConfig::get('db_user'));
$oDB->setOption('password', CrustConfig::get('db_pass'));

$oDB->setCharset('utf8');
$oDB->setCollate('utf8_general_ci');
Doctrine_Core::generateModelsFromDb(MODELS, array('Doctrine'), array('generateTableClasses' => true));
Doctrine::loadModels(MODELS);  


$crust_router->run(); // belirlenen controller ve action tetiklenir.