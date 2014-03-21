<?php
/**
* @package Crust Framework
* @version 0.9.3
* @author Ahmet Özışık
*
* Router handles REQUEST URLs and directs them to corresponding controllers and actions 
*/

class CrustRouter
{
	private $default_controller;
	private $default_action;

	private $request_uri;

	public static $controller;
	public static $action;
	public static $params;


	public function __construct($default_controller='home', $default_action='index',$subfolder='')
	{
		$this->default_controller = $default_controller;
		$this->default_action 	  = $default_action;
		$this->extract_request($_SERVER['REQUEST_URI']);
	}

	public function run()
	{
		$class 			 = CrustToolbox::slug(CrustRouter::$controller);
		$controller_path = CONTROLLERS.$class.'.controller.php';

		if(!file_exists($controller_path) or !is_readable($controller_path))
		{
			trigger_error('Controller not found: <b>'.CrustRouter::$controller.'</b>', E_USER_ERROR);
			return;
		}
			
		require $controller_path;

		$class    = ucwords($class).'Controller';
		$instance = new $class();
		$call 	  = (method_exists($instance, CrustRouter::$action)) ? CrustRouter::$action : 'index';

		if(!is_callable(array($instance, $call)))
		{
			trigger_error('Action does not exist on controller: <b>'.CrustRouter::$controller.':'.CrustRouter::$action.'</b>', E_USER_ERROR);
			return;
		}

		$instance->$call();
	}

	private function routing_sanitize($param)
	{
		return strip_tags($param);
	}

	public function extract_request($request_uri)
	{
		$this->request_uri = $request_uri;
		$process 		   = $this->request_uri;



		if(SUB_FOLDER)
			$process = substr($process, strlen(SUB_FOLDER), strlen($process));

		// clear any query strings
		$process = str_replace('?'.$_SERVER['QUERY_STRING'], '', $process);
		// Explode the URL into an array
		$process_array = explode('/', $process);
		// Sanitize request
		$process_array = array_map(array($this,'routing_sanitize'), $process_array);

		CrustRouter::$controller  = (!empty($process_array[0])) ? $process_array[0] : $this->default_controller;
		CrustRouter::$action 	  = (!empty($process_array[1])) ? $process_array[1] : $this->default_action;
		CrustRouter::$params      = (count($process_array) > 2) ? array_slice($process_array, 2) : array();
	}

	private function wildcard_keys($key)
	{
		if($key == ':controller')
			return CrustRouter::$controller;

		if($key == ':action')
			return CrustRouter::$action;

		if($key == ':params')
			return CrustRouter::$params;		

		return $key;
	}

	/**
	* :controller and :action and :params are wildcard
	*/
	public function map($source, $target)
	{
		$source_array = explode('/', $source);
		$target_array = explode('/', $target);

		$source_params = (count($source_array) > 2) ? array_slice($source_array, 2) : array();		
		$target_params = (count($target_array) > 2) ? array_slice($target_array, 2) : array();		
		
		if(isset($source_array[0]) and isset($target_array[0]) and (CrustRouter::$controller == $source_array[0] or $source_array[0] == ':controller'))
		{
			CrustRouter::$controller = $this->wildcard_keys($target_array[0]);
		}

		if(isset($source_array[1]) and (CrustRouter::$action == $source_array[1] or $source_array[1] == ':action'))
		{
			CrustRouter::$action = $this->wildcard_keys($target_array[1]);
		}

		if(!empty($source_params) and !empty($target_params) and (CrustRouter::$params == $source_params or $source_array[2] == ':params'))
		{
			$target_params = ($this->wildcard_keys($target_params[0]) == $target_params[0]) ? $target_params : $this->wildcard_keys($target_params[0]);
			CrustRouter::$params = $target_params;
		}
	}
}