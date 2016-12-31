<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producers extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['producers'] = $this->admin_m->getProducers();
		$this->data['subview'] = 'admin/producers/index';
		$this->load->view('admin/template', $this->data);
	}

	public function addProducer()
	{
		$rules = $this->admin_m->rules_producer;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			if($this->admin_m->addProducer())
				$_SESSION['status_edit'] = "Producent został dodany";
			else
				$_SESSION['status_edit'] = "Producent nie został dodany";
			}
		redirect(site_url('admin/producers'));
	}

	public function show_items($id)
	{
		$this->data['itpr'] = $this->admin_m->getItemsToProducer($id);
		$this->data['subview'] = 'admin/producers/items';
		$this->load->view('admin/template', $this->data);
	}

	public function deleteProducer($id)
	{
		if($this->admin_m->deleteProducer($id))
			$_SESSION['status_edit'] = "Producent został usunięty";
		else
			$_SESSION['status_edit'] = "Producent nie został usunięty";

		redirect(site_url('admin/producers'));
	}

}

/* End of file Producers.php */
/* Location: ./application/controllers/Producers.php */