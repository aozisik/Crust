<?php
/**
* Crust Framework
* Form Smarty Function
* 
* @param mixed $params
* @param mixed $content
* @param mixed $smarty
*/
function smarty_block_form($params, $content, &$smarty)
{
  if(!isset($params['controller'])) return false;
  
  $link = URL.$params['controller'];
    
  if(isset($params['action']))
  $link.= '/'.$params['action'];
  
  if(isset($params['params']))
  $link.= '/'.$params['params'];
  
  $method = (isset($params['method'])) ? $params['method'] : 'post';
  
  $html = '<form action="'.$link.'" method="'.$method.'"';
  
  if(isset($params['enctype']))
    $html .= ' enctype="multipart/form-data"';
  
  $html .= '>'.$content.'</form>';
  
  return $html;
  
}
?>
