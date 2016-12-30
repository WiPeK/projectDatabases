<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['subview'] = '';
	}

}

/* End of file Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */