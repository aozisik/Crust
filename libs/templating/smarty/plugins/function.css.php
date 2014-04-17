<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_css($params, &$smarty)
{
  $file  = CrustConfig::get('url').CSS_PATH.$params['href'];

  if(NOCACHE === true) $file .= '?'.time();
  $media = (isset($params['media'])) ?  $params['media'] : 'screen';
  
  return '<link rel="stylesheet" href="'.$file.'" media="'.$media.'" />';
}
  
?>