<?php
/**
* @package Crust Framework
* @version 0.9.4
* @author Ahmet Özışık
*
* Interface between smarty and crust
*/


class SmartyAdapter
{

  private $smarty = null;
  private $path   = null;
  public  $layout = null;

  public function __construct()
  {
    $this->smarty = new Smarty(); 

    $this->smarty->setTemplateDir(VIEWS);
    $this->smarty->setCompileDir(TEMPLATE_COMPILE_FOLDER);
    $this->smarty->setCacheDir(TEMPLATE_CACHE_FOLDER);
    $this->smarty->muteExpectedErrors(); // don't whine much

    // Automatically assign some of the system variables
    $this->assign('url', CrustConfig::get('url'));
  }

  public function assign($name, $value)
  {
    $this->smarty->assign($name, $value);
  }
  
  public function Layout($name)
  {
    $this->layout = 'layouts/'.$name.'.tpl';
  }
  
  public function render($controller, $name)
  {
  	$this->smarty->assign('yield', $this->smarty->fetch($controller.'/'.$name.'.tpl'));	    
    $this->smarty->display($this->layout);	
  }
  
  public function fetch($file)
  {
    return $this->smarty->fetch($file);
  }
    
}