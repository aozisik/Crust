<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_time_left($params, &$smarty)
{
  if(!isset($params['t'])) return false;

  $interval_time = strtotime($params['t']);
  $time          = time();
 
  if($time > $interval_time)
    return 'GEÇTİ';
    
  $sub = $interval_time - $time;
  
  $ret = '' ;
  
  $time_strings = array(31556926 => 'Yıl', 2629743 => 'Ay', 604800 => 'Hafta', 86400 => 'Gün', 3600 => 'Saat', 60 => 'Dakika',1 => 'Saniye');
  

  $long = 0;
  
  foreach($time_strings as $t => $string)
  {
    if($t > $sub or $sub == 0)
      continue;
    
    if($t == $sub)
    {
      $ret .= '1 '.$string.' ';
      $sub = 0;
    }
    else
    {
      if($long >= 2)
        continue;
        
      $d = round($sub / $t);
      $sub -= $d*$t;
            
      $ret .= $d.' '.$string.' ';
      $long++;
    }
  }
   
  return $ret.' kaldı';
}
  
?>