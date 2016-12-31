<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['clients'] = $this->admin_m->getClients();
		$this->data['subview'] = 'admin/clients/index';
		$this->load->view('admin/template', $this->data);
	}

	public function show_sales($id)
	{
		$this->data['emp_sales'] = $this->admin_m->getClientSales($id);
		$this->data['subview'] = 'admin/clients/sales';
		$this->load->view('admin/template', $this->data);
	}

	public function delete($id)
	{
		if($this->admin_m->deleteClient($id))
			$_SESSION['status_edit'] = "Klient został usunięty";
		else
			$_SESSION['status_edit'] = "Klient nie został usunięty";

		redirect(site_url('admin/clients'));
	}

}

/* End of file Clients.php */
/* Location: ./application/controllers/Clients.php */