<?php
/**
* Dilgeç custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_json($params, &$smarty)
{
  $smarty->assign($params['name'],  getJsonArray(JSON_PATH.$params['json'].'.json'));
  return;
}
  
?>