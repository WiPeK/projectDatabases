<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['stats'] = $this->admin_m->getStats();
		$this->data['subview'] = 'admin/dashboard';
		$this->load->view('admin/template', $this->data);
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */