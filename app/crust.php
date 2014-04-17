<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Framework file paths
*/

define('CRUST_VERSION', '0.9.5');
define('IN_SCRIPT'   , true);                  

define('SERVICE_MAIL', 'no-reply@example.com');
define('SMTP_SERVER', 'smtp.example.com');
define('SMTP_USERNAME', 'smtp@example.com');
define('SMTP_PASSWORD', '123456');
define('MAIL_REPLY_TO', 'no-reply@example.com');
define('MAIL_SENDER', 'no-reply@example.com');

define('ROOT'       , dirname(__FILE__).'/../');

// Templating
define('TEMPLATE_ADAPTER', ROOT.'libs/templating/SmartyAdapter.php');
define('TEMPLATE_ENGINE', ROOT.'libs/templating/smarty/Smarty.class.php');
define('TEMPLATE_COMPILE_FOLDER'      , ROOT.'tmp/cache/');
define('TEMPLATE_CACHE_FOLDER'        , ROOT.'tmp/cache/');

// Routing
define('ROUTER' , ROOT.'libs/crust/CrustRouter.php');
define('ROUTES' , ROOT.'app/routes.php');

// Class name db
define('ORM', ROOT.'libs/orm/Doctrine.php');


#define('VIEWS_ERRORS', VIEWS);

define('APPLICATION_CONTROLLER', ROOT.'app/controllers/application.php');
define('APPLICATION_HELPER', ROOT.'app/helpers/application.helper.php');
define('CRUST_TOOLBOX' , ROOT.'libs/crust/CrustToolbox.php');
define('CRUST_CONFIG' , ROOT.'libs/crust/CrustConfig.php');

define('VIEWS', ROOT.'app/views/');
define('VIEWS_LAYOUTS', VIEWS.'layouts/');
define('HELPERS', ROOT.'app/helpers/');
define('CONTROLLERS', ROOT.'app/controllers/');
define('MODELS', ROOT.'app/models/');
define('LIBS', ROOT.'libs/');

define('CSS_PATH',    'public/stylesheets/');
define('IMAGES_PATH', 'public/images/');
define('JS_PATH',     'public/javascript/');
define('JSON_PATH' ,  'public/json/');

define('UPLOADS_PATH', ROOT.'public/uploads/');
define('LIB_PHP_MAILER', ROOT.'libs/crust/PhpMailer.php');


define('E500_PAGE', ROOT.'public/500.php');
define('E404_PAGE', ROOT.'public/404.php');