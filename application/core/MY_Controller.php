<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['errors'] = array();
		if(!isset($_SESSION['basket']))
			$_SESSION['basket'] = array();
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */