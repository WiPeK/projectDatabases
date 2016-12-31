<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_m extends CI_Model {

	public $rules_employee = array(
		'name' => array(
			'field' => 'name',
			'label' => 'Imie',
			'rules' => 'trim|required|xss_clean|max_length[50]'
		),
		'surname' => array(
			'field' => 'surname',
			'label' => 'Nazwisko',
			'rules' => 'trim|required|xss_clean|max_length[50]'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean|max_length[255]|valid_email'
		),
		'address' => array(
			'field' => 'address',
			'label' => 'Adres',
			'rules' => 'trim|required|xss_clean|max_length[255]'
		),
		'phone' => array(
			'field' => 'phone',
			'label' => 'Nr Telefonu',
			'rules' => 'trim|required|xss_clean|max_length[20]'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'xss_clean|max_length[20]'
		)
	);

	public $rules_provider = array(
		'name' => array(
			'field' => 'name',
			'label' => 'Imie',
			'rules' => 'trim|required|xss_clean|max_length[50]'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean|max_length[255]|valid_email'
		),
		'address' => array(
			'field' => 'address',
			'label' => 'Adres',
			'rules' => 'trim|required|xss_clean|max_length[255]'
		),
		'phone' => array(
			'field' => 'phone',
			'label' => 'Nr Telefonu',
			'rules' => 'trim|required|xss_clean|max_length[20]'
		),
		'nip' => array(
			'field' => 'nip',
			'label' => 'NIP',
			'rules' => 'trim|required|xss_clean|exact_length[10]'
		),
		'regon' => array(
			'field' => 'regon',
			'label' => 'REGON',
			'rules' => 'trim|required|xss_clean|exact_length[9]'
		)
	);

	public $rules_producer = array(
		'name' => array(
			'field' => 'name',
			'label' => 'Nazwa producenta',
			'rules' => 'trim|required|xss_clean|max_length[255]'
		)
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function getStats()
	{
		$query = $this->db->query("SELECT (SELECT COUNT(*) FROM employees) as empl, (SELECT COUNT(*) FROM clients) as clnt, (SELECT COUNT(*) FROM items) as itct, (SELECT COUNT(*) FROM producers) as prdc, (SELECT COUNT(*) FROM providers) as prvd, (SELECT COUNT(*) FROM sales) as slsc, (SELECT SUM(quantity_sales_items) FROM sales_items) as sism, (SELECT SUM(sales_price) FROM sales) as salpr  FROM dual");
		return $query->result();
	}

	public function getEmployees()
	{
		$query = $this->db->query("SELECT * FROM employees ORDER BY id_employees");
		return $query->result();
	}

	public function getClients()
	{
		$query = $this->db->query("SELECT * FROM clients ORDER BY id_clients");
		return $query->result();
	}

	public function getProviders()
	{
		$query = $this->db->query("SELECT * FROM providers ORDER BY id_providers");
		return $query->result();
	}

	public function getProducers()
	{
		$query = $this->db->query("SELECT * FROM producers ORDER BY id_producers");
		return $query->result();
	}

	public function getSales()
	{
		//to ma byc widokiem
		$query = $this->db->query("SELECT sales.id_sales, sales.id_employees, sales.id_clients, sales.execution_date_sales, sales.sales_price, sales.status_sales, CONCAT(employees.name_employees ,CONCAT(' ', employees.surname_employees)) as SPRZEDAWCA, CONCAT(clients.name_clients ,CONCAT(' ', clients.surname_clients)) as KLIENT FROM sales ORDER BY id_sales DESC");
		return $query->result();
	}

	public function getEmployee($id)
	{
		$query = $this->db->query("SELECT * FROM employees WHERE id_employees = $id");
		return $query->row();
	}

	public function getProvider($id)
	{
		$query = $this->db->query("SELECT * FROM providers WHERE id_providers = $id");
		return $query->row();
	}

	public function get_new_employee()
	{
		$employee = new stdClass();
		$employee->ID_EMPLOYEES = '';
		$employee->NAME_EMPLOYEES = '';
		$employee->SURNAME_EMPLOYEES = '';
		$employee->EMAIL_EMPLOYEES = '';
		$employee->PASSWORD_EMPLOYEES = '';
		$employee->ADDRESS_EMPLOYEES = '';
		$employee->PHONE_NUMBER_EMPLOYEES = '';
		return $employee;
	}

	public function get_new_provider()
	{
		$provider = new stdClass();
		$provider->ID_PROVIDERS = '';
		$provider->NAME_PROVIDERS = '';
		$provider->EMAIL_PROVIDERS = '';
		$provider->ADDRESS_PROVIDERS = '';
		$provider->PHONE_NUMBER_PROVIDERS = '';
		$provider->NIP_PROVIDERS = '';
		$provider->REGON_PROVIDERS = '';
		return $provider;
	}

	public function addNewEmployee()
	{
		$name = $this->input->post('name');
		$surname = $this->input->post('surname');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$pass = $this->input->post('password');
		if(empty($pass)) return false;
		$query = $this->db->query("INSERT INTO employees VALUES(employees_seq.NEXTVAL, '$name', '$surname', '$email', DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('$pass')), '$address', '$phone')");
		return ($this->db->affected_rows()? true : false);
	}

	public function updateEmployee($id)
	{
		$name = $this->input->post('name');
		$surname = $this->input->post('surname');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		if(!empty($this->input->post('password')))
		{
			$pass = $this->input->post('password');
			$query = $this->db->query("UPDATE employees SET NAME_EMPLOYEES = '$name', SURNAME_EMPLOYEES = '$surname', EMAIL_EMPLOYEES = '$email', ADDRESS_EMPLOYEES = '$address', PASSWORD_EMPLOYEES = DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('$pass')), PHONE_NUMBER_EMPLOYEES = '$phone' WHERE ID_EMPLOYEES = $id");
		}
		else
		{
			$query = $this->db->query("UPDATE employees SET NAME_EMPLOYEES = '$name', SURNAME_EMPLOYEES = '$surname', EMAIL_EMPLOYEES = '$email', ADDRESS_EMPLOYEES = '$address', PHONE_NUMBER_EMPLOYEES = '$phone' WHERE ID_EMPLOYEES = $id");
		}
		return ($this->db->affected_rows()? true : false);
	}

	public function addNewProvider()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$nip = $this->input->post('nip');
		$regon = $this->input->post('regon');
		$query = $this->db->query("INSERT INTO providers VALUES(providers_seq.NEXTVAL, '$name', '$email', '$address', '$phone', '$nip', '$regon')");
		return ($this->db->affected_rows()? true : false);
	}

	public function updateProvider($id)
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$nip = $this->input->post('nip');
		$regon = $this->input->post('regon');
		$query = $this->db->query("UPDATE providers SET NAME_PROVIDERS = '$name', EMAIL_PROVIDERS = '$email', ADDRESS_PROVIDERS = '$address', PHONE_NUMBER_PROVIDERS = '$phone', NIP_PROVIDERS = '$nip', REGON_PROVIDERS = '$regon' WHERE ID_PROVIDERS = $id");
		return ($this->db->affected_rows()? true : false);
	}

	public function deleteEmployee($id)
	{
		$query = $this->db->query("DELETE FROM employees WHERE id_employees = $id");
		return ($this->db->affected_rows()? true : false);
	}

	public function deleteClient($id)
	{
		$query = $this->db->query("DELETE FROM clients WHERE id_clients = $id");
		return ($this->db->affected_rows()? true : false);
	}

	public function deleteProducer($id)
	{
		$query = $this->db->query("DELETE FROM producers WHERE id_producers = $id");
		return ($this->db->affected_rows()? true : false);
	}

	public function deleteProvider($id)
	{
		$query = $this->db->query("DELETE FROM providers WHERE id_providers = $id");
		return ($this->db->affected_rows()? true : false);
	}

	public function getEmployeeSales($id)
	{
		$query = $this->db->query("SELECT sales.id_sales, sales.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, sales.id_clients, CONCAT(clients.name_clients, clients.surname_clients) as Klient, sales.EXECUTION_DATE_SALES, sales.SALES_PRICE, sales.status_sales FROM sales JOIN employees ON sales.id_employees = employees.id_employees JOIN clients ON sales.id_clients = clients.id_clients WHERE sales.id_employees = $id");
		return $query->result();
	}

	public function getEmployeeProvides($id)
	{
		$query = $this->db->query("SELECT provides.id_provides, provides.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, providers.id_providers, providers.name_providers, provides.EXECUTION_DATE_PROVIDES, provides.PROVIDES_PRICE, provides.status_provides FROM provides JOIN employees ON provides.id_employees = employees.id_employees JOIN providers ON provides.id_providers = providers.id_providers WHERE provides.id_employees = $id");
		return $query->result();
	}

	public function getProviderProvides($id)
	{
		$query = $this->db->query("SELECT provides.id_provides, provides.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, providers.id_providers, providers.name_providers, provides.EXECUTION_DATE_PROVIDES, provides.PROVIDES_PRICE, provides.status_provides FROM provides JOIN employees ON provides.id_employees = employees.id_employees JOIN providers ON provides.id_providers = providers.id_providers WHERE provides.id_providers = $id");
		return $query->result();
	}

	public function getClientSales($id)
	{
		$query = $this->db->query("SELECT sales.id_sales, sales.id_employees, CONCAT(employees.name_employees, employees.surname_employees) as Sprzedawca, sales.id_clients, CONCAT(clients.name_clients, clients.surname_clients) as Klient, sales.EXECUTION_DATE_SALES, sales.SALES_PRICE, sales.status_sales FROM sales JOIN employees ON sales.id_employees = employees.id_employees JOIN clients ON sales.id_clients = clients.id_clients WHERE sales.id_clients = $id");
		return $query->result();
	}

	public function addProducer()
	{
		$name = $this->input->post('name');
		$query = $this->db->query("INSERT INTO producers VALUES(producers_seq.NEXTVAL, '$name')");
		return ($this->db->affected_rows()? true : false);
	}

	public function getItemsToProducer($id)
	{
		$query = $this->db->query("SELECT items.id_items, CONCAT(items.name_items, CONCAT(' ', items.model_items)) as item, producers.name_producers FROM items JOIN producers ON items.id_producers = producers.id_producers WHERE items.id_producers = $id");
		return $query->result();
	}
}

/* End of file admin_m.php */
/* Location: ./application/models/admin_m.php */