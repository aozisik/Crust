<?php
/**
* MANAGES JSON FILES
*/
class CrustConfig {

	/**
	* Fetches value for a given hashkey from config json file.
	*/
	public static function get($config_name) {

		global $CRUST_ENVIRONMENT_HASH;

		if(!isset($CRUST_ENVIRONMENT_HASH[$config_name]))
			return null;

		return $CRUST_ENVIRONMENT_HASH[$config_name];
	}


	public static function buildDoctrineDsn()
	{
		return CrustConfig::get('db_adapter').':dbname='.CrustConfig::get('db_name').';host='.CrustConfig::get('db_host');
	}
}