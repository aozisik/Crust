<?php

function smarty_function_select($params, &$smarty)
{
	$doctrine_enabled = false;
	
  if(!isset($params['json']) and !isset($params['array'])) return false;
	
  $id   = ($params['id']) ? $params['id'] : $params['name'];
  //$type = ($params['type']) ? $params['type'] : 'text';
  $name = 'form['.$params['name'].']';
  
  
  if(isset($params['json']))
  {
    $json_file = JSON_PATH.$params['json'].'.json';
    $json      = @file_get_contents($json_file);
    $array     = json_decode($json, true);
  }
  else
  {
    $array = $params['array'];
   	if(is_object($array))
		{
			$doctrine_enabled = true;
			
		} 
  }
	
	
  // 0 = a, arg = a
  //$keys      = ($params['keys']) ? array_keys($array) : $array;
  
  $html = '';
	
	if(isset($params['label']))
	{
		$html .= '<label for="'.$id.'">'.$params['label'].'</label><br />';
	}
  
  $html      .= '<select name="'.$name.'" id="'.$id.'"';
  if($params['class']) $html .= ' class="'.$params['class'].'"';
  $html     .= '>';
  
  $selected_value  = $smarty->getVariable('form');
  $selected_value  = $selected_value->value[$params['name']];
	
	
	
	
  
  $html .= ($value == '') ? '<option value="" disabled="disabled" selected="selected">Please Select</option>' : '<option value="" disabled="disabled">Please Select</option>';
  
  foreach($array as $v)
  {
  	$id_ 	 = ($doctrine_enabled == true) ? $v['id'] : $v;
		$value = ($doctrine_enabled == true) ? $v[$params['item']] : $v;
		
		
    
    $html .= '<option value="'.$id_.'"';
		
		
    if(($doctrine_enabled == true and $id_ == $selected_value) or ($doctrine_enabled == false and $value == $selected_value))
      $html .= ' selected="selected"';
      
    $html .= '>'.$value.'</option>';
  }
  
  $html .= '</select>';
  return $html;
}
    
    
 
?>
