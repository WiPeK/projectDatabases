<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['sales'] = $this->admin_m->getSales();
		$this->data['subview'] = 'admin/sales/index';
		$this->load->view('admin/template', $this->data);
	}

	public function acceptSale($id)
	{

	}

}

/* End of file Sales.php */
/* Location: ./application/controllers/Sales.php */