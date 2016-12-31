<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Providers extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['providers'] = $this->admin_m->getProviders();
		$this->data['subview'] = 'admin/providers/index';
		$this->load->view('admin/template', $this->data);
	}

	public function show_provides($id)
	{
		$this->data['provides'] = $this->admin_m->getProviderProvides($id);
		$this->data['subview'] = 'admin/providers/provides';
		$this->load->view('admin/template', $this->data);
	}

	public function edit($id = NULL)
	{
		if($id)
			$this->data['provider'] = $this->admin_m->getProvider($id);
		else
			$this->data['provider'] = $this->admin_m->get_new_provider();

		$rules = $this->admin_m->rules_provider;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$status = false;
			if($id == NULL)
			{
				if ($this->admin_m->addNewProvider())
					$status = true;
			}
			else
			{
				if ($this->admin_m->updateProvider($id))
					$status = true;
			}
			if($status)
			{
				$_SESSION['status_edit'] = "Dostawcy zostali zaaktualizowani";
				redirect(site_url('admin/providers'));
			}
			else
				$_SESSION['status_edit'] = "Dostawcy nie zostali zaaktualizowani";
		}

		$this->data['subview'] = 'admin/providers/edit';
		$this->load->view('admin/template', $this->data);


	}

	public function delete($id)
	{
		if($this->admin_m->deleteProvider($id))
			$_SESSION['status_edit'] = "Dostawca został usunięty";
		else
			$_SESSION['status_edit'] = "Dostawca nie został usunięty";

		redirect(site_url('admin/providers'));
	}

}

/* End of file  */
/* Location: ./application/controllers/ */