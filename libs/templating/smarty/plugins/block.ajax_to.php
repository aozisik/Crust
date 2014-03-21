<?php
/**
* Crust Framework
* Ajax_to Smarty Function
* 
* @param mixed $params
* @param mixed $content
* @param mixed $smarty
*/
function smarty_block_ajax_to($params, $content, &$smarty)
{
  #if(!isset($params['id'])) return false;
  
  $a    = '<a href="javascript:void(0);"';
  
  if(isset($params['class']))
    $a .= ' class="'.$params['class'].'"';
  if(isset($params['id']))
    $a .= ' id="'.$params['id'].'"';
  if(isset($params['title']))
    $a .= ' title="'.$params['title'].'"';    
    
  return $a.'>'.$content.'</a>';
}  

  
?>
