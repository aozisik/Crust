<?php
/**
* Media Upload Class
* @author Ahmet Özışık
* 26 October 2013
* 
*/

class CrustUploader
{
  // 20 mb
  private $max_filesize = 20971520;

  public $is_image;
  
  public $error;
  
  private $image_width;
  private $image_height;
  
  private $file_types = array
    (
      'audio/mpeg' => 'mp3',
      'audio/mp3' => 'mp3'
    );
  
  public $resize_width;
  public $resize_height;
  
  private $image;
  
  public $name;
  
  private $tmp_path;
  
  private $upload_path;
  public  $extension;
  
  public function upload($file_, $upload_path, $resize_width=0, $resize_height=0, $key=null)
  {
  	if($key == null)
  	{
  		$key = microtime();
  	}

    if(is_array($file_))
    {
      $file = array();
      
      foreach($file_ as $k => $v)
      {
        $file[$k] = '';
        if(is_array($v))
        {
          foreach($v as $y)
            $file[$k] = $y;          
        }
        else
        {
          $file = $file_;
        }
  
      }
    }

    if($file['size'] > $this->max_filesize) return 'Dosya boyutu çok büyük';
    // Upload path is broken
    if(!file_exists($upload_path) or !is_dir($upload_path)) return 'Upload gerçekleşmedi: '.$upload_path;
    // An error occured during the upload
    if($file['error'] > 0) return 'Upload sırasında bir sorun oluştu';

    // Uploaded file is not a image                 
    if(!isset($this->file_types[$file['type']])) return 'Yüklemeye çalıştığınız dosya bir geçerli bir medya değil';
    // Set tmp path
    $this->tmp_path = $file['tmp_name'];
    // If file not uploaded by HTTP-POST
    if(!is_uploaded_file($this->tmp_path)) return 'Kötü amaçlı kullanım tespit edildi';
    // Create image from tmp file
    $run = $this->file_types[$file['type']];
    $this->$run();
    
    if($this->is_image == true)
    {
	    $size = getimagesize($file['tmp_name']);
	    $this->image_width = $size[0];
	    $this->image_height = $size[1];    	
    }


    if($this->is_image == true)
    {
    	$this->name = md5($key).'.jpg';
    	if($resize_width != 0 and $resize_height != 0) $this->resizeImage($resize_width, $resize_height);        	
    }
    else
   	{
   		$this->name = md5($key).'.'.$run;
   	}

    $this->save($upload_path.'/'.$this->name);

    

    

    return true;
  }
  
  private function save($path)
  {
  	if($this->is_image)
  	{
  		imagejpeg($this->image, $path, 100);
		unlink($this->tmp_path);
  	}
  	else
  	{
  		move_uploaded_file($this->tmp_path, $path);	
  	} 
  }
  
  private function resizeImage($width, $height)
  {
		/**
		 * Rotate if necessary
		 *
		 *
		*if($this->image_width > $this->image_height)
		*{
		*	$black_color = imagecolorallocate($this->image, 0,0,0);
		*	$this->image = imagerotate($this->image, 90, $black_color);
		*	
		*	$width_ = $this->image_width;
		*	$this->image_width = $this->image_height;
		*	$this->image_height = $width_;
		*}
		*/
		
    $resample = imagecreatetruecolor($width, $height);
		$black = imagecolorallocate($resample, 0, 0, 0);		
    imagecopyresampled($resample, $this->image,0,0,0,0,$width,$height,$this->image_width, $this->image_height);
    $this->image = $resample;
    return;
  }
                         

  private function mp3() {}
  

  
}


?>