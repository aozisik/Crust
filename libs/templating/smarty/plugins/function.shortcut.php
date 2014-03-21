<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_shortcut($params, &$smarty)
{
  $file  = IMAGES_PATH.$params['href'];
  if(NOCACHE === true) $file .= '?'.time();
  
  return '<link rel="shortcut icon" href="'.$file.'" />';
}
  
?>