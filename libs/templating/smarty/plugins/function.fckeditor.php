<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_fckeditor($params, &$smarty)
{
  if(!isset($params['name']))
    return false;
    
  require_once LIB_FCKEDITOR;
  
  $editor = new FCKeditor($params['name']);
  
  $editor->BasePath = SUB_FOLDER.'libs/fckeditor/';
  
  if(isset($params['value']))
    $editor->Value = $params['value'];
    
  if(isset($params['width']))
    $editor->Width = $params['width'];
    
  if(isset($params['height']))
    $editor->Height = $params['height'];
    
  $editor->ToolbarSet = 'Default';
  $editor->Config['AutoDetectLanguage']    = false ;
  $editor->Config['DefaultLanguage']        = 'tr';  
  
  $editor->Create(); //FckEditör oluştur 
}
  
?>