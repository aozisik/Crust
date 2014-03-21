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

session_start();
# session fixation precaution
if(!isset($_SESSION) or empty($_SESSION)) session_regenerate_id();
# read config
require dirname(__FILE__).'/config.php';

require CRUST_TOOLBOX;
set_error_handler(array('CrustToolbox', 'InteralError'));
set_exception_handler(array('CrustToolbox', 'InternalException'));


require TEMPLATE_ENGINE; // smarty
require TEMPLATE_ADAPTER; // smarty adapter
require APPLICATION_CONTROLLER;
require ORM; // ActiveRecord 1.0 ORM
require ROUTER; // class
require ROUTES; // mapping


// TO ACTIVATE DATABASE CONNECTION UNCOMMENT THIS SECTION
/*
ActiveRecord\Config::initialize(function($cfg)
{
   $cfg->set_model_directory(MODELS);
   $cfg->set_connections(array('development' =>
     DB_DSN));
});

// Check if the connection is actually established
$connection = \Activerecord\Connection::instance();
*/


$crust_router->run(); // belirlenen controller ve action tetiklenir.