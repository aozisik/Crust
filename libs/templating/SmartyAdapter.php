<?php
/**
* @package Crust Framework
* @version 0.9.3
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
    $this->smarty->compile_dir  = TEMPLATE_COMPILE_FOLDER;
    $this->smarty->cache_dir    = TEMPLATE_CACHE_FOLDER;
    $this->smarty->template_dir = VIEWS;
    $this->assign('url', URL);
  
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