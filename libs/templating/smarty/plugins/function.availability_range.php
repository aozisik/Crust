<?php
/**
* custom smarty functions lib
* 
* @param mixed $params
* @param mixed $smarty
*/

function smarty_function_availability_range($params, &$smarty)
{
  if(!isset($params['name'])) return false;
  if(!isset($params['label'])) return false;
   
  
  $start_hour = 7;
  $start_min  = '00';
  
  $hours = array('7:00');
  
  
  for($i=0;$i<=34;$i++)
  {
    if($start_min == '00')
    {
      $start_min = '30';
    }
    else
    {
      $start_min = '00';
      $start_hour++;
    }

    $hours[] = $start_hour.":".$start_min;
  }
  
  
  
?>
<script type="text/javascript">





    $(function(){

      //demo 2
      $('select#<?php echo $params['name']; ?>_from, , select#<?php echo $params['name']; ?>_to').selectToUISlider();
      fixToolTipColor();
    });

</script>
<div>
    <fieldset>
    <?php echo $params['label']; ?>     
      <label for="<?php echo $params['name']; ?>_from">Başlangıç:</label>
      <select name="form[<?php echo $params['name']; ?>_from]" id="<?php echo $params['name']; ?>_from">
        <?php
          foreach($hours as $h)
          {
            echo '<option value="'.$h.'"';
            if($h==$params['value_a'])
              echo ' selected="selected"';
            echo '>'.$h.'</option>';
          }
        ?>
      </select>
  
      <label for="<?php echo $params['name']; ?>_to">Bitiş:</label>
      <select name="form[<?php echo $params['name']; ?>_to]" id="<?php echo $params['name']; ?>_to">
        <?php
          foreach($hours as $h)
          {
            echo '<option value="'.$h.'"';
            if($h==$params['value_b'])
              echo ' selected="selected"';
            echo '>'.$h.'</option>';
          }
        ?>
      </select>
    </fieldset>
    <div stlye="clear"></div>
</div><br />
<?php

}
  
?>