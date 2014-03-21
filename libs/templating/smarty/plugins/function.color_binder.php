<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_color_binder($params, &$smarty)
{
  if(!isset($params['p'])) return false;
  
  $colors = array('#DDFFFF', '#FFFFDD',  '#E7FFCE', '#E5E5E5', '#FFCAFF', '#FFDBCA');
  
  $key = $params['p'] % count($colors);
  
  return $colors[$key];
}
  
?>