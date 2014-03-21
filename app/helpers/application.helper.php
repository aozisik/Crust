<?php
/**
 * ApplicationHelper is the helper accessible from app/controllers/application.php via $this->own_helper
 * It can also be called from any controller via $this->own_helper
 * 
 * So it's a global helper file.
 * 
 * 
 * Create helpers for a particular controller with the same name as the controller
 * then reach the helper simply via $this->helper within that controller.
 * 
 * i.e profile.controller.php > profile.helper.php
 * 
 * 
 * Also name the class after the controller
 * i.e new ProfileController() > new ProfileHelper() 
 * 
 * In a helper, __construct function takes an instance parameter (the instance of the controller)
 * Use this instance to access template functions and other properties of ApplicationController 
 * 
 * @author Ahmet Özışık
 */

 class ApplicationHelper
 {


	/**
	 * Assigns title in smarty to be inserted between <title> </title> tags
	 * 
	 * @param string $title
	 */
	public function title($title)
	{
		$this->assign('title', $title);
	}  		 	

 }