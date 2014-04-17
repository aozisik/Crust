<?php
/**
* Dilgeç custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_js($params, &$smarty)
{
  $src = (filter_var($params['src'], FILTER_VALIDATE_URL)) ? $params['src'] : CrustConfig::get('url').JS_PATH.$params['src'];
  return '<script type="text/javascript" language="javascript" src="'.$src.'"></script>';
}
  
?>