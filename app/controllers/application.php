<?php
/**
* Crust Framework Application Controller
* 
* This controller is the main one. 
* Every requested controller is a chlid of this class.
* But this controller cannot be requested directly.
* 
* @author Ahmet Özışık
*/
abstract class ApplicationController extends SmartyAdapter
{
	protected $helper;
    private   $own_helper;

    public function __construct()
    {
        // Initialize smarty
        parent::__construct();
        
        $this->assign('base_url', URL);		

        // Helper for this CLASS
        $this->own_helper = $this->load_helper('Application');
        // Helper for the current controller
        $this->helper     = $this->load_helper(ucwords(CrustRouter::$controller), $this);     				
        
        $this->Layout('default');
        $this->assign('controller', CrustRouter::$controller);
        $this->assign('CRUST_VERSION', CRUST_VERSION);
    }

    private function load_helper($helper_name, $instance=null)
    {
      $file_name = HELPERS.CrustToolbox::slug($helper_name).'.helper.php';    
      if(!file_exists($file_name))
        return null;

      include($file_name);
      $class_name = $helper_name.'Helper';
      
      if(!class_exists($class_name))
        return null;
      
      return (is_null($instance)) ? new $class_name() : new $class_name($instance);
    }


    public function __destruct()
    {
    	
    	if(defined('404'))
		{
			header('HTTP/1.0 404 Not Found');
			$this->controller = 'errors';
			$this->action 		= '404_not_found';
		}
		else if(defined('500'))
		{
			header('HTTP/1.0 500 Internal Server Error');
			$this->controller= 'errors';
			$this->action = '500_server_error';
		}
        
		// no output if requested
		if(defined('NO_TEMPLATE_OUTPUT')) return;
        echo parent::render(CrustRouter::$controller, CrustRouter::$action);
    }

    /**
    * Sends POST data to a model's function
    * 
    * @param mixed $model_name
    * @param mixed $function_name
    * @param mixed $form
    * @param mixed $assign_form_on_failure
    */
    public function process_form($model_name, $function_name, $form, $put_key=null, $assign_form_on_failure=true, $assign_error_on_failure=true, $assign_success=true)
    {
        if(empty($form))
        return false;

        if(!class_exists($model_name))
            trigger_error('Model file not found: '.$model_name);

        $model = new $model_name();



        if(!method_exists($model, $function_name))
            trigger_error('Model method not found: '.$model_name.'::'.$function_name);

        // İşlemi gerçekleştiriyoruz

        $process = (empty($put_key)) ? $model->$function_name($form) : $model->$function_name($form, $put_key);

        if($process !== true)
        {
            if($assign_error_on_failure == true)
                $this->assign('error', $process);
            if($assign_form_on_failure == true)
                $this->assign('form', $form);
        }
        else
            if($assign_success == true)
                $this->assign('success', true);
    }

	/**
	 * Search for the given index for a parameter, if not found redirect back to homepage
	 * Can be used for pages that requires a DB table row id for a task 
	 * 
	 * Usage: $id = $this->require_param(0, true);
	 * 
	 * Also can be used for non-numeric values (can be handy for nosql databases that employ string keys)
	 * Usage: $string_key = $this->require_param(0, false);
	 * 
	 * @param mixed $parameter_key
	 * @param boolean $not_numeric
	 * @return mixed parameter content 
	 */
	public function require_param($parameter_key=0, $not_numeric=false)
	{
		if(!isset(CrustRouter::$params[$parameter_key]) or empty(CrustRouter::$params[$parameter_key]))
			CrustToolbox::redirect_to('home');

		if($not_numeric == false and !is_numeric(CrustRouter::$params[$parameter_key]))
			CrustToolbox::redirect_to('home');

		return CrustRouter::$params[$parameter_key];
	}		

}
?>