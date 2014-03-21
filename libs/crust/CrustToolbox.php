<?php
/**
* @package Crust Framework
* @version 0.9.3
* @author Ahmet Özışık
*
* Miscellaneous 
*/


class CrustToolbox
{

	/**
	* Arranges errors
	*/
	public static function InteralError($errno, $errstr, $errfile, $errline)
	{
		if(!defined('NO_TEMPLATE_OUTPUT')) define('NO_TEMPLATE_OUTPUT', true);
		require_once E500_PAGE;
	}

	public static function InternalException($exception)
	{
		if(!defined('NO_TEMPLATE_OUTPUT')) define('NO_TEMPLATE_OUTPUT', true);
		$errstr = $exception->getMessage();
		require_once E500_PAGE;
	}	

	public static function redirect_to($request, $to_referer=false)
	{
		if(filter_var($request, FILTER_VALIDATE_URL))
		{
			header('Location: '.$request);
			exit;
		}

	  header(($to_referer) ? 'Location: '.$_SERVER['HTTP_REFERER'] : 'Location: '.URL.$request);
	  exit;
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

	/**
	* Obviously sends mail
	* 
	* @param mixed $to
	* @param mixed $subject
	* @param mixed $template_vars
	* @param mixed $template
	*/
	public static function send_mail($to, $subject, $template_vars=array(), $template)
	{
	  $smarty = new t_smarty();
	  
	  if(!empty($template_vars))
	    foreach($template_vars as $x => $y)
	      $smarty->assign($x, $y);
	  
	  $message = $smarty->fetch($template);
	  
	  $mail_header = 'Content-type: text/html; charset:UTF-8'."\r\n"
	                .'To: <'.$to.'>'." \r\n"
	                .'From: '.get_config('service_name').' <'.get_config('service_mail')."> \r\n";  
	  
	  if(ENVIRONMENT == 'development')
	  {
	    file_put_contents(LOCAL_MAIL_DIR.'/mail_'.md5(microtime()).'.html', $message);
	  }
	  else
	  {
	  		require LIB_PHP_MAILER;

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->From     = MAIL_SENDER; //Gönderen kısmında yer alacak e-mail adresi
			$mail->Sender   = MAIL_SENDER;
			$mail->ReplyTo  = MAIL_REPLY_TO;
			$mail->FromName =  get_config('service_name');
			$mail->Host     = SMTP_SERVER; //SMTP server adresi
			$mail->SMTPAuth = true; //SMTP server'a kullanıcı adı ile bağlanılcağını belirtiyoruz
			$mail->Username = SMTP_USERNAME; //SMTP kullanıcı adı
			$mail->Password = SMTP_PASSWORD; //SMTP şifre
			$mail->WordWrap = 50;
			$mail->Subject  = $subject; // Konu		
			$mail->IsHTML(true);

			$mail->Body = $message;
			$mail->AltBody = strip_tags($message);

			$mail->AddAddress($to);

			$mail->Send(); 

			$mail->ClearAddresses();
			$mail->ClearAttachments();

	   //@mail($to, $subject, $message, $mail_header);  
	  }
	}	
}