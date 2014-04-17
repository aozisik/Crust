<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Miscellaneous 
*/


class CrustToolbox
{

	public static function regulateSession()
	{
		session_start();
		$expected_hash = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].CrustConfig::get('secret_salt'));

		if(!isset($_SESSION) or empty($_SESSION) or !isset($_SESSION['_crust_signature']) or $_SESSION['_crust_signature'] != $expected_hash)
		{
			/**
			* The session is either
			* 1. Empty, it's never created.
			* 2. Does not contain a signature
			* 3. The signature is tampered with and not the one we expected to see
			*
			* IMPORTANT!! For maximum security please change your secret salt in env/production.php
			*/
			session_regenerate_id();
			$_SESSION['_crust_signature'] = $expected_hash;
		}
	}

	/**
	* Arranges errors
	*/
	public static function InteralError($errno, $errstr, $errfile, $errline)
	{
		if($errno == E_NOTICE)
			return;

		if(!defined('NO_TEMPLATE_OUTPUT')) define('NO_TEMPLATE_OUTPUT', true);
		require_once E500_PAGE;
	}


	/**
	* Arranges errors
	*/
	public static function NotFound()
	{
		if(!defined('NO_TEMPLATE_OUTPUT')) define('NO_TEMPLATE_OUTPUT', true);
		require_once E404_PAGE;
	}	

	public static function InternalException($exception)
	{
		if(!defined('NO_TEMPLATE_OUTPUT')) define('NO_TEMPLATE_OUTPUT', true);
		$errstr = $exception->getMessage();
		require_once E500_PAGE;
	}	

	public static function RequireAjax()
	{
	    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	      //ajax
	      define('NO_TEMPLATE_OUTPUT', true);
	    }
	    else
	    {
	      trigger_error('This page cannot be requested directly');
	      exit;
	    }
	}

	/** 
	* Returns valid timestamp for mySQL timestamp format
	* 
	*/
	public static function timestamp($time=null)
	{
	  $format = 'Y-m-d H:i:s';
	  return isset($time) ? date($format, $time) : date($format);
	}	


	/**
	 * normalize strings for web addresses
	 */
	public static function slug($str)
	{
	  $str = str_replace(array('ğ', 'Ğ', 'İ', 'ı', 'ü', 'Ü', 'ş', 'Ş', 'ö', 'Ö', 'ç', 'Ç'), array('g', 'g', 'i', 'i', 'u', 'u', 's', 's', 'o', 'o', 'c', 'c'), $str); 
	  
	  $str = strtolower(trim($str));
	  $str = preg_replace('/[^a-z0-9-]/', '-', $str);
	  $str = preg_replace('/-+/', "-", $str);
	  return $str;
	}	

}


function redirect_to($request, $to_referer=false)
{
	if(filter_var($request, FILTER_VALIDATE_URL))
	{
		header('Location: '.$request);
		exit;
	}

  header(($to_referer) ? 'Location: '.$_SERVER['HTTP_REFERER'] : 'Location: '.URL.$request);
  exit;
}	
