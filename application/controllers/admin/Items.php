<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['items'] = $this->admin_m->getItems();
		$this->data['subview'] = 'admin/items/index';
		$this->load->view('admin/template', $this->data);
	}

	public function params()
	{
		$this->data['features'] = $this->admin_m->getFeatures();
		$this->data['subview'] = 'admin/items/params';
		$this->load->view('admin/template', $this->data);
	}

	public function edit($id = NULL)
	{
		if($id)
			$this->data['item'] = $this->admin_m->getItem($id);
		else
			$this->data['item'] = $this->admin_m->get_new_item();

		$this->data['producers'] = $this->admin_m->getProducersToItem();
		$this->data['features'] = $this->admin_m->getFeatures();

		$rules = $this->admin_m->rules_item;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$status = false;
			if($id == NULL)
			{
				if ($this->admin_m->addNewItem())
					$status = true;
			}
			else
			{
				if ($this->admin_m->updateItem($id))
					$status = true;
			}
			if($status)
			{
				$_SESSION['status_edit'] = "Przedmioty zostały zaaktualizowane";
				redirect(site_url('admin/items/edit/') . $id);
			}
			else
				$_SESSION['status_edit'] = "Przedmioty nie zostały zaaktualizowane";
		}

		$this->data['subview'] = 'admin/items/edit';
		$this->load->view('admin/template', $this->data);
	}

	public function addParam($id)
	{
		if($this->admin_m->addParam($id))
			$_SESSION['status_edit'] = "Parametr został dodany";
		else
			$_SESSION['status_edit'] = "Parametr nie został dodany";
		redirect(site_url('admin/items/edit/') . $id);
	}

	public function deleteParam($idFeature, $idItem)
	{
		if($this->admin_m->deleteParam($idFeature, $idItem))
			$_SESSION['status_edit'] = "Parametr został usunięty";
		else
			$_SESSION['status_edit'] = "Parametr nie został usunięty";
		redirect(site_url('admin/items/edit/') . $idItem);
	}

	public function delete($id)
	{
		if($this->admin_m->deleteItem($id))
			$_SESSION['status_edit'] = "Przedmiot został usunięty";
		else
			$_SESSION['status_edit'] = "Przedmiot nie został usunięty";
		redirect(site_url('admin/items'));
	}

	public function addFeature()
	{
		if($this->admin_m->addFeature())
			$_SESSION['status_edit'] = "Parametr został dodany";
		else
			$_SESSION['status_edit'] = "Parametr nie został dodany";
		redirect(site_url('admin/items/params'));
	}

	public function deleteFeature($id)
	{
		if($this->admin_m->deleteFeature($id))
			$_SESSION['status_edit'] = "Parametr został usunięty";
		else
			$_SESSION['status_edit'] = "Parametr nie został usunięty";
		redirect(site_url('admin/items/params'));
	}

}

/* End of file Items.php */
/* Location: ./application/controllers/Items.php */