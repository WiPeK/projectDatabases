<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provides extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['provides'] = $this->admin_m->getProvides();
		$this->data['subview'] = 'admin/provides/index';
		$this->load->view('admin/template', $this->data);
	}

	public function edit($id = NULL)
	{
		if($id)
		{
			$this->data['provide'] = $this->admin_m->getProvide($id);
			$this->data['prItems'] = $this->admin_m->getProvideItems($id);
		}
		else
			$this->data['provide'] = $this->admin_m->get_new_provide();

		$this->data['providers'] = $this->admin_m->getProvidersToProvide();
		$this->data['items'] = $this->admin_m->getItemsToProvide();

		$rules = $this->admin_m->rules_provide;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$status = false;
			if($id == NULL)
			{
				if ($this->admin_m->addNewProvide())
					$status = true;
			}
			else
			{
				if ($this->admin_m->updateProvide($id))
					$status = true;
			}
			if($status)
			{
				$_SESSION['status_edit'] = "Dostawy zostały zaaktualizowane";
				redirect(site_url('admin/provides'));
			}
			else
				$_SESSION['status_edit'] = "Dostawy nie zostały zaaktualizowane";
		}

		$this->data['subview'] = 'admin/provides/edit';
		$this->load->view('admin/template', $this->data);
	}

	public function addItem($id)
	{
		if($this->admin_m->addItemToProvide($id))
			$_SESSION['status_edit'] = "Przedmiot został dodany";
		else
			$_SESSION['status_edit'] = "Przedmiot nie został dodany";
		redirect(site_url('admin/provides/edit/') . $id);
	}

	public function deleteItemFromProvide($idItem, $idProvide)
	{
		if($this->admin_m->deleteItemFromProvide($idItem, $idProvide))
			$_SESSION['status_edit'] = "Przedmiot został usunięty";
		else
			$_SESSION['status_edit'] = "Przedmiot nie został usunięty";
		redirect(site_url('admin/provides/edit/') . $idProvide);
	}

	public function closeProvide($id)
	{
		if($this->admin_m->closeProvide($id))
			$_SESSION['status_edit'] = "Dostawa została zamknięta";
		else
			$_SESSION['status_edit'] = "Dostawa nie została zamknięta";
		redirect(site_url('admin/provides'));
	}

	public function declineProvide($id)
	{
		if($this->admin_m->declineProvide($id))
			$_SESSION['status_edit'] = "Dostawa została usunięta";
		else
			$_SESSION['status_edit'] = "Dostawa nie została usunięta";
		redirect(site_url('admin/provides'));
	}

	public function show($id)
	{
		$this->data['provide'] = $this->admin_m->getProvide($id);
		$this->data['prItems'] = $this->admin_m->getProvideItems($id);
		$this->data['subview'] = 'admin/provides/show';
		$this->load->view('admin/template', $this->data);
	}

}

/* End of file Provides.php */
/* Location: ./application/controllers/Provides.php */