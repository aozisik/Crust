<?php
/**
* @package Crust Framework
* @version 0.9.4
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

	private function check_map_match($route)
	{
		if(empty($route))
			return false; // empty array, thus no match

		$controller = $this->wildcard_keys($route[0]);
		$action     = (isset($route[1])) ? $route[1] : $this->wildcard_keys(':action');
		$params		= (count($route) > 2) ? array_slice($route, 2) : $this->wildcard_keys(':params');



		if($controller != CrustRouter::$controller)
			return false; // not matching controller

		if($action != CrustRouter::$action)
			return false; // not matching action

		if($params != CrustRouter::$params)
			return false;

		return true;
	}

	/**
	* :controller and :action and :params are wildcard
	*/
	public function map($source, $target)
	{
		$source_array = explode('/', $source);
		$target_array = explode('/', $target);

		if(!$this->check_map_match($source_array))
			return; // this map does not concern us, it is not a match

		// however if it does match
		CrustRouter::$controller = (!empty($target_array[0])) ? $target_array[0] : $this->default_controller;
		CrustRouter::$action 	 = (!empty($target_array[1])) ? $target_array[1] : $this->default_action;
		CrustRouter::$params     = (count($target_array) > 2) ? array_slice($target_array, 2) : array();
	}
}