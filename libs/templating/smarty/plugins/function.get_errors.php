<?php

function smarty_function_get_errors($params, $template)
{
	
	if(!class_exists('ApplicationHelper'))
	{
		require_once APPLICATION_HELPER;
	}
	
	$fields = ApplicationHelper::returnFieldNames();
	
	if(!is_array($fields))
	{
		$fields = array();
	}
  
  $errors = array('notblank'  => 'should not be empty.'
                 ,'notnull'   => 'should be filled.'
                 ,'regexp'    => 'is not valid.'
                 ,'minlength' => 'is too short.'
                 ,'unique'    => 'is taken by someone else.'
                 ,'email'     => 'is invalid.'
                 ,'type'      => 'is invalid.'
                 ,'wrong'     => 'does not match'
                 ,'length'    => 'is too long.'
                 );
  
  $error_stack = $template->getTemplateVars('error');
  
  if(empty($error_stack))
  {
    if(!isset($params['no_br']))
      echo '<br />';
      
    return;
  }
  
  if(is_string($error_stack))
  {
    echo '<div class="error"><ul><li>'.$error_stack.'</li></ul></div>';
    return;
  }
  
  $error_array = ((is_object($error_stack))) ? $error_stack->toArray() : $error_stack;
  $error_count = count($error_array);
  

  echo '<div class="error">';
  echo $error_count.' error(s) occured';
  echo '<ul>';
  foreach($error_array as $k => $v)
  {                  
    $f = ($fields[$k]) ? $fields[$k] : $k;
    echo '<li>'.ucwords($f).' '.$errors[$v[0]].'</li>';
  }
  echo '</ul></div>';

} 

?>