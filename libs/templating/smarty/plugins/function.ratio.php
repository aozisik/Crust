<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_ratio($params, &$smarty)
{
  
  
  $d = ($params['a'] == 0) ? 0 : (($params['b']*$params['c']) / $params['a']);
  
  if($d > $params['c'])
    $d = $params['c'];
    
  return round($d, 2);
}
  
?>