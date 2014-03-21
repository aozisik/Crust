<?php
/**
* Crust Framework
* Link_To Custom Smarty Block
* 
* @param mixed $params
* @param mixed $content
* @param mixed $smarty
*/

function smarty_block_link_to($params, $content, &$smarty)
{
  if(!isset($params['controller'])) return false;
  
  $link   = URL.$params['controller'];
  
  if(isset($params['highlight']) or isset($params['sub_highlight']))
  {
    global $routes_controller, $routes_action, $routes_parameters;
    
    $action = (isset($params['action'])) ? $params['action'] : 'index';
    
    if(!isset($params['params']))
    {
      if($routes_controller == $params['controller'] and $routes_action == $action)
        $params['class'] .= ' highlight';
    }
    else
    {
      if($routes_controller == $params['controller'] and $routes_action == $action and $params['params'] == $routes_parameters[0])
        $params['class'] .= ' highlight';        
    }
    
    if(isset($params['sub_highlight']) and $params['controller'] == $routes_controller)
      $params['class'] .= ' highlight';
  }
  
  if(isset($params['action']))
  $link.= '/'.$params['action'];
  
  if(isset($params['params']))
  $link.= '/'.$params['params'];
  
  $a    = '<a href="'.$link.'"';
  
  if(isset($params['target']))
    $a .= ' target="'.$params['target'].'"';
  if(isset($params['class']))
    $a .= ' class="'.$params['class'].'"';
  if(isset($params['id']))
    $a .= ' id="'.$params['id'].'"';
  if(isset($params['title']))
    $a .= ' title="'.$params['title'].'"';    
    
  return $a.'>'.$content.'</a>';
}  

  
?>
