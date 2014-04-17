<?php
/**
* Dilgeç custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_img($params, &$smarty)
{
  $src   = (filter_var($params['src'], FILTER_VALIDATE_URL)) ? $params['src'] : CrustConfig::get('url').IMAGES_PATH.$params['src'];
  $params['alt'] = (isset($params['alt'])) ? $params['alt'] : '';
  $html  = '<img src="'.$src.'" alt="'.$params['alt'].'" ';
  
  unset($params['src']);
  unset($params['alt']);
  
  foreach($params as $f => $v)
  {
    $html .= $f.'="'.$v.'" ';
  }
  
  return $html.'/>';
  
}
  
?>
