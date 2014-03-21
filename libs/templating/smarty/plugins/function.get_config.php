<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_get_config($params, &$smarty)
{
  return get_config($params['name']);
}
  
?>