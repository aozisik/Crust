<?php
/**
* @package Crust Framework
* @version 0.9.3
* @author Ahmet Özışık
*
* Config file
*/

define('CRUST_VERSION', '0.9.3');
define('IN_SCRIPT'   , true);                  

define('SERVICE_MAIL', 'no-reply@example.com');
define('SMTP_SERVER', 'smtp.example.com');
define('SMTP_USERNAME', 'smtp@example.com');
define('SMTP_PASSWORD', '123456');
define('MAIL_REPLY_TO', 'no-reply@example.com');
define('MAIL_SENDER', 'no-reply@example.com');


define('ENVIRONMENT', 'development');
#define('ENVIRONMENT', 'production');
#define('ENVIRONMENT', 'local');

/**
 * Configure here!!
 */
if(ENVIRONMENT == 'development')
{

  define('SUB_FOLDER'     , str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
  define('ROOT'           , $_SERVER['DOCUMENT_ROOT'].'/'.SUB_FOLDER);
  define('URL'            , 'http://localhost'.SUB_FOLDER);
  define('NOCACHE'        , true);      
  define('DB_DSN'         , 'mysql://root:root@127.0.0.1/crust?charset=utf8');

  //define('LOCAL_MAIL_DIR', 'C:/Users/pc/Desktop/inbox');
}
elseif(ENVIRONMENT == 'local')
{
  /**
  * Local environment
  */
}

else
{
  /**
  * Production environment
  */
}

// Templating
define('TEMPLATE_ADAPTER', ROOT.'libs/templating/SmartyAdapter.php');
define('TEMPLATE_ENGINE', ROOT.'libs/templating/smarty/Smarty.class.php');
define('TEMPLATE_COMPILE_FOLDER'      , ROOT.'tmp/cache/');
define('TEMPLATE_CACHE_FOLDER'        , ROOT.'tmp/cache/');

// Routing
define('ROUTER' , ROOT.'libs/crust/CrustRouter.php');
define('ROUTES' , ROOT.'app/routes.php');

// Class name db
define('ORM', ROOT.'libs/orm/activerecord/ActiveRecord.php');


#define('VIEWS_ERRORS', VIEWS);

define('APPLICATION_CONTROLLER', ROOT.'app/controllers/application.php');
define('APPLICATION_HELPER', ROOT.'app/helpers/application.helper.php');
define('CRUST_TOOLBOX' , ROOT.'libs/crust/CrustToolbox.php');

define('VIEWS', ROOT.'app/views/');
define('VIEWS_LAYOUTS', VIEWS.'layouts/');
define('HELPERS', ROOT.'app/helpers/');
define('CONTROLLERS', ROOT.'app/controllers/');
define('MODELS', ROOT.'app/models/');
define('LIBS', ROOT.'libs/');

define('CSS_PATH', URL.'public/stylesheets/');
define('IMAGES_PATH', URL.'public/images/');
define('JS_PATH', URL.'public/javascript/');
define('JSON_PATH' ,  URL.'public/json/');

define('UPLOADS_PATH', ROOT.'public/uploads/');
define('LIB_PHP_MAILER', ROOT.'libs/crust/PhpMailer.php');


define('E500_PAGE', ROOT.'public/500.php');
define('E404_PAGE', ROOT.'public/404.php');