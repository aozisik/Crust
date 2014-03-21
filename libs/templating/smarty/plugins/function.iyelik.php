<?php
/**
* @author Ahmet Özışık
* 
* Bu fonksiyon Türkçe isimlere gelecek olan iyelik eklerinin son heceye göre çekimlemelerini yapar.
* 
*/

function smarty_function_iyelik($params, $template)
{
  if(!isset($params['name']))
    return false;
    
  /**
  * Son hecesi e, i ile bitiyorsa "in" (Güneş'in Beren'in, selimin )
  *   Son harfi e ise nin
  * Son hecesi a, ı ile bitiyorsa "ın" (Ozan'ın aydın'ın '')
  *   Son harfi a ise nın
  * 
  *  Son hecesi o, u ile bitiyorsa un   (oğuzun, orhonun)
  * 
  *  Son hecesi ö ü ile bitiyorsa ün  (özümün, üzümün)
  */                         
  return iyelik($params['name']);
}

?>
