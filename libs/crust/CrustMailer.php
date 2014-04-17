<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Prepares mails using Smarty Templating Engine
*/



class CrustMailer
{
	private $smarty_instance;
	private $template;
	private $subject;
	private $to;


	public static function create($to, $subject, $template)
	{
		return new self($to, $subject, $template);
	}

	public function __construct($to,$subject,$template)
	{
		$this->smarty_instance = new SmartyAdapter();
		$this->template 	   = $template;
		$this->subject         = $subject;
		$this->to 			   = $to;

	    return $this;
	}

	public function assign($key, $value)
	{
		$this->smarty_instance->assign($key, $value);
		return $this;
	}

	public function send()
	{
		$message 	  = $this->smarty_instance->fetch($this->template);
    	$mail_header  = 'To: <'.$this->to.'>'." \r\n"
        	           .'From: '.SERVICE_NAME.' <'.SERVICE_MAIL."> \r\n";  
		$mail_header .= 'Content-type: text/html; charset=UTF-8'."\r\n";

        $mail_action = mail($this->to, "=?utf-8?B?".base64_encode($this->subject)."?=", $message, $mail_header);

        if(!$mail_action)
            trigger_error('Email could not be sent.');

		return $this;
	}
}