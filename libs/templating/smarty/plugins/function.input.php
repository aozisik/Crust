<?php

function smarty_function_input($params, &$smarty)
{
  $id   = ($params['id']) ? $params['id'] : $params['name'];
  $type = ($params['type']) ? $params['type'] : 'text';
  #$name = ($params['form']) ? $params['form'].'['.$params['name'].']' : 'form['.$params['name'].']';
  $required = ($params['required']) ? ' <span class="red">*</span>' : '';
  
  if(!$params['no_refill'])
  {
    $value = $smarty->getTemplateVars('form');
    $value = $value[$params['id']];    
  }

  $html = '<!-- Start '.$params['id'].' element -->'."\n";
  
  # add label if set
  if($params['label'])
    $html.= '<label for="'.$params['id'].'">'.$params['label'].$required.'</label><br />'."\n";
    
  
  $html .= '<input type="'.$type.'" name="'.$params['name'].'" id="'.$id.'"';
  
  if($params['type'] == 'checkbox' and $value == 'on')
    $html .= 'checked="checked"';
  
	$value = htmlspecialchars($value);
  if(strlen($value) > 0) $html .= ' value="'.$value.'"';
	
	if(isset($params['placeholder'])) $html .= ' placeholder="'.$params['placeholder'].'"';
  
  if($params['readonly']) $html .= ' readonly="readonly"';
  if($params['disabled']) $html .= ' readonly="disabled"';
  if($params['title'])    $html .= ' title="'.$params['title'].'"';
  
  
  $html.= ($params['class']) ? ' class="'.$params['class'].'"' : ' class="'.$params['id'].'-element iphorm-tooltip"';
  
  $html .= ' />'."\n";

  $html .= '<!-- End '.$params['id'].' element -->'."\n";
  
  return $html;
}

?>
