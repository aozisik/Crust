<?php
$CRUST_ENVIRONMENT_HASH = array();

############### DATABASE ###########################
$CRUST_ENVIRONMENT_HASH['db_user'] 	  = 'root';
$CRUST_ENVIRONMENT_HASH['db_pass'] 	  = 'root';
$CRUST_ENVIRONMENT_HASH['db_name'] 	  = 'crust';
$CRUST_ENVIRONMENT_HASH['db_host'] 	  = '127.0.0.1';
$CRUST_ENVIRONMENT_HASH['db_adapter'] = 'mysql';
$CRUST_ENVIRONMENT_HASH['db_charset'] = 'utf8';
############### DATABASE ###########################


############### SERVER ##############################
$CRUST_ENVIRONMENT_HASH['subfolder'] 		  	    = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
$CRUST_ENVIRONMENT_HASH['url'] 		  			    = 'http://localhost'.$CRUST_ENVIRONMENT_HASH['subfolder'];
$CRUST_ENVIRONMENT_HASH['secret_salt'] 				= 'afejn4qk4jgfu347fg34bfhm34fg2ch14fy134fq';
$CRUST_ENVIRONMENT_HASH['enable_asset_compression'] = true;
############### SERVER ##############################