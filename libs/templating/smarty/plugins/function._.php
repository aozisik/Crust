<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function__($params, &$smarty)
{
  return l_($params);
}
  
?>