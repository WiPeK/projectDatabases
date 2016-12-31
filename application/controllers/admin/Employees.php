<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['employees'] = $this->admin_m->getEmployees();
		$this->data['subview'] = 'admin/emp/index';
		$this->load->view('admin/template', $this->data);
	}

	public function show_sales($id)
	{
		$this->data['emp_sales'] = $this->admin_m->getEmployeeSales($id);
		$this->data['subview'] = 'admin/emp/sales';
		$this->load->view('admin/template', $this->data);
	}

	public function show_provides($id)
	{
		$this->data['emp_pr'] = $this->admin_m->getEmployeeProvides($id);
		$this->data['subview'] = 'admin/emp/provides';
		$this->load->view('admin/template', $this->data);
	}

	public function edit($id = NULL)
	{
		if($id)
			$this->data['employee'] = $this->admin_m->getEmployee($id);
		else
			$this->data['employee'] = $this->admin_m->get_new_employee();

		$rules = $this->admin_m->rules_employee;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$status = false;
			if($id == NULL)
			{
				if ($this->admin_m->addNewEmployee())
					$status = true;
				else
					$status = false;
			}
			else
			{
				if ($this->admin_m->updateEmployee($id))
					$status = true;
				else
					$status = false;
			}
			if($status)
				$_SESSION['status_edit'] = "Pracownicy zostali zaaktualizowani";
			else
				$_SESSION['status_edit'] = "Pracownicy nie zostali zaaktualizowani";
		}

		$this->data['subview'] = 'admin/emp/edit';
		$this->load->view('admin/template', $this->data);


	}

	public function delete($id)
	{
		if($this->admin_m->deleteEmployee($id))
			$_SESSION['status_edit'] = "Pracownik został usunięty";
		else
			$_SESSION['status_edit'] = "Pracownik nie został usunięty";

		redirect(site_url('admin/employees'));
	}

}

/* End of file Employees.php */
/* Location: ./application/controllers/Employees.php */