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
		if($this->admin_m->acceptSale($id))
			$_SESSION['status_edit'] = "Sprzedaz została zaakceptowana";
		else
			$_SESSION['status_edit'] = "Sprzedaz nie została zaakceptowana";
		redirect(site_url('admin/sales'));
	}

	public function declineSale($id)
	{
		if($this->admin_m->declineSale($id))
			$_SESSION['status_edit'] = "Sprzedaz została odrzucona";
		else
			$_SESSION['status_edit'] = "Sprzedaz nie została odrzucona";
		redirect(site_url('admin/sales'));
	}

	public function showItems($id)
	{
		$this->data['itpr'] = $this->admin_m->getItemsToSale($id);
		$this->data['subview'] = 'admin/sales/items';
		$this->load->view('admin/template', $this->data);
	}

}

/* End of file Sales.php */
/* Location: ./application/controllers/Sales.php */