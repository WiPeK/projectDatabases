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

	public $rules_item = array(
		'name' => array(
			'field' => 'name',
			'label' => 'Nazwa przedmiotu',
			'rules' => 'trim|required|xss_clean|max_length[255]'
		),
		'model' => array(
			'field' => 'model',
			'label' => 'Model przedmiotu',
			'rules' => 'trim|required|xss_clean|max_length[255]'
		),
		'quantity' => array(
			'field' => 'quantity',
			'label' => 'Ilość przedmiotu',
			'rules' => 'trim|required|xss_clean|numeric'
		),
		'price' => array(
			'field' => 'price',
			'label' => 'Cena przedmiotu',
			'rules' => 'trim|required|xss_clean'
		),
		'producer' => array(
			'field' => 'producer',
			'label' => 'Producent',
			'rules' => 'trim|required|xss_clean|numeric'
		)
	);

	public $rules_provide = array(
		'provider' => array(
			'field' => 'provider',
			'label' => 'Nazwa dostawcy',
			'rules' => 'trim|required|xss_clean'
		)
	);

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

	public function get_new_item()
	{
		$item = new StdClass();
		$item->ID_ITEMS = '';
		$item->NAME_ITEMS = '';
		$item->MODEL_ITEMS = '';
		$item->QUANTITY_ITEMS = '';
		$item->PRICE_ITEMS = '';
		$item->ID_PRODUCERS = '';
		return $item;
	}

	public function get_new_provide()
	{
		$provide = new stdClass();
		$provide->ID_PROVIDES = '';
		$provide->ID_EMPLOYEES = '';
		$provide->ID_PROVIDERS = '';
		$provide->EXECUTION_DATE_PROVIDES = '';
		$provide->PROVIDES_PRICE = '';
		$provide->STATUS_PROVIDES = 0;
		return $provide;
	}

	public function __construct()
	{
		parent::__construct();
	}

	public function getStats()
	{
		$query = $this->db->query("SELECT * FROM stats");
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

	public function getProducersToItem()
	{
		$query = $this->db->query("SELECT * FROM producers ORDER BY id_producers");

		$array = array();

		if (count($query->result())) {
			foreach ($query->result() as $row) {
				$array[$row->ID_PRODUCERS] = $row->NAME_PRODUCERS;
			}
		}

		// $array = array(
		// 	0 => array(
		// 		'ID_PRODUCERS' => 0,
		// 		'NAME_PRODUCERS' => 'Brak'
		// 	)
		// );
		// $i = 1;
		// if (count($query->result())) {
		// 	foreach ($query->result() as $row) {
		// 		$array[$i] = array(
		// 			'ID_PRODUCERS' => $row->ID_PRODUCERS,
		// 			'NAME_PRODUCERS' => $row->NAME_PRODUCERS
		// 		);
		// 		$i++;
		// 	}
		// }
		return $array;


	}

	public function getProvidersToProvide()
	{
		$query = $this->db->query("SELECT ID_PROVIDERS, NAME_PROVIDERS FROM PROVIDERS ORDER BY id_providers");

		$array = array();

		if (count($query->result())) {
			foreach ($query->result() as $row) {
				$array[$row->ID_PROVIDERS] = $row->NAME_PROVIDERS;
			}
		}
		return $array;
	}

	public function getFeatures()
	{
		$query = $this->db->query("SELECT * FROM features ORDER BY id_features");

		$array = array(
			'0' => 'Brak parametrów'
		);

		if (count($query->result())) {
			foreach ($query->result() as $row) {
				$array[$row->ID_FEATURES] = $row->NAME_FEATURES;
			}
		}
		return $array;
	}

	public function getItemsToProvide()
	{
		$query = $this->db->query("SELECT * FROM itemsToProvide");

		$array = array();

		if (count($query->result())) {
			foreach ($query->result() as $row) {
				$array[$row->ID_ITEMS] = $row->ITEM;
			}
		}
		return $array;
	}

	public function getProducers()
	{
		$query = $this->db->query("SELECT * FROM producers ORDER BY id_producers");
		return $query->result();
	}

	public function getSales()
	{
		$query = $this->db->query("SELECT * FROM salesView");
		return $query->result();
	}

	public function getProvides()
	{
		$query = $this->db->query("SELECT * FROM providesView");
		return $query->result();
	}

	public function getItems()
	{
		$query = $this->db->query("SELECT * FROM getItems");
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

	public function getProvide($id)
	{
		$query = $this->db->query("SELECT * FROM providesView WHERE id_provides = $id");
		return $query->row();

	}

	public function getItem($id)
	{
		$query = $this->db->query("SELECT * FROM item_relation WHERE id_items = $id");
		return $query->row();
	}

	public function getEmployeeSales($id)
	{
		$query = $this->db->query("SELECT * FROM getEmployeeSales WHERE id_employees = $id");
		return $query->result();
	}

	public function getEmployeeProvides($id)
	{
		$query = $this->db->query("SELECT * FROM getEmployeeProvides WHERE id_employees = $id");
		return $query->result();
	}

	public function getProviderProvides($id)
	{
		$query = $this->db->query("SELECT * FROM getEmployeeProvides WHERE id_providers = $id");
		return $query->result();
	}

	public function getClientSales($id)
	{
		$query = $this->db->query("SELECT * FROM getClientSales WHERE id_clients = $id");
		return $query->result();
	}

	public function getItemsToProducer($id)
	{
		$query = $this->db->query("SELECT * FROM getItemsToProducer WHERE items.id_producers = $id");
		return $query->result();
	}

	public function getItemsToSale($id)
	{
		$query = $this->db->query("SELECT * FROM getItemsToSale WHERE sales.id_sales = $id");
		return $query->result();
	}

	public function getProvideItems($id)
	{
		$query = $this->db->query("SELECT * FROM getProvideItems WHERE provides.id_provides = $id");
		return $query->result();
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
		return $this->db->affected_rows();
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
		return $this->db->affected_rows();
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
		return $this->db->affected_rows();
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
		return $this->db->affected_rows();
	}

	public function addNewItem()
	{
		$name = $this->input->post('name');
		$model = $this->input->post('model');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');
		$producer = $this->input->post('producer');
		$this->db->query("INSERT INTO items VALUES(items_seq.NEXTVAL, '$name', '$model', $quantity, '$price', $producer)");
		return $this->db->affected_rows();
	}

	public function updateItem($id)
	{
		$name = $this->input->post('name');
		$model = $this->input->post('model');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');
		$producer = $this->input->post('producer');
		$this->db->query("UPDATE items SET NAME_ITEMS = '$name', MODEL_ITEMS = '$model', QUANTITY_ITEMS = $quantity, PRICE_ITEMS = '$price', ID_PRODUCERS = $producer WHERE ID_ITEMS = $id");
		return $this->db->affected_rows();
	}

	public function deleteEmployee($id)
	{
		$query = $this->db->query("SELECT DELETEEMPLOYEEFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function deleteClient($id)
	{
		$query = $this->db->query("SELECT DELETECLIENTFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function deleteProducer($id)
	{
		$query = $this->db->query("SELECT DELETEPRODUCERFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function deleteProvider($id)
	{
		$query = $this->db->query("SELECT DELETEPROVIDERFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function addProducer()
	{
		$name = $this->input->post('name');
		$query = $this->db->query("INSERT INTO producers VALUES(producers_seq.NEXTVAL, '$name')");
		return $this->db->affected_rows();
	}

	public function acceptSale($id)
	{
		$email = $_SESSION['email'];
		$this->db->query("UPDATE sales SET id_employees = (SELECT id_employees FROM employees WHERE email_employees = '$email'), status_sales = 1, EXECUTION_DATE_SALES = TO_CHAR(CURRENT_TIMESTAMP,'YYYY-MM-DD HH24:MI:SS') WHERE id_sales = $id");
		return $this->db->affected_rows();
	}

	public function declineSale($id)
	{
		$query = $this->db->query("SELECT DECLINESALEFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function addParam($id)
	{
		$id_features = $this->input->post('feature');
		$value = $this->input->post('ftval');
		$this->db->query("INSERT INTO items_features VALUES($id, $id_features, '$value')");
		return $this->db->affected_rows();
	}

	public function deleteParam($idFeature, $idItem)
	{
		$this->db->query("DELETE FROM items_features WHERE ID_ITEMS = $idItem AND ID_FEATURES = $idFeature");
		return $this->db->affected_rows();
	}

	public function deleteItem($id)
	{
		$query = $this->db->query("SELECT DELETEITEMFUNC($id) as RES FROM dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function addFeature()
	{
		$name = $this->input->post('name');
		$this->db->query("INSERT INTO features VALUES(features_seq.NEXTVAL, '$name')");
		return $this->db->affected_rows();
	}

	public function deleteFeature($id)
	{
		$query = $this->db->query("SELECT DELETEFEATUREFUNC($id) as RES FROM dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function addNewProvide()
	{
		$id_providers = $this->input->post('provider');
		$employee_email = $_SESSION['email'];
		$this->db->query("INSERT INTO provides VALUES(provides_seq.NEXTVAL,  (SELECT id_employees as idEmp FROM employees WHERE email_employees = '$employee_email'), $id_providers, NULL, NULL, 0)");
		return $this->db->affected_rows();
	}

	public function addItemToProvide($id)
	{
		$id_item = $this->input->post('item');
		$val_item = $this->input->post('itqn');
		$query = $this->db->query("SELECT ADDITEMTOPROVIDEFUNC($id, $id_item, $val_item) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function deleteItemFromProvide($idItem, $idProvide)
	{
		$query = $this->db->query("SELECT DELETEITEMFROMPROVIDEFUNC($idItem, $idProvide) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function closeProvide($id)
	{
		$this->db->query("UPDATE provides SET EXECUTION_DATE_PROVIDES = TO_CHAR(CURRENT_TIMESTAMP,'YYYY-MM-DD HH24:MI:SS'), PROVIDES_PRICE = (SELECT SUM(PROVIDES_ITEMS.QUANTITY_PROVIDES_ITEMS * ITEMS.PRICE_ITEMS) FROM PROVIDES_ITEMS LEFT OUTER JOIN ITEMS ON PROVIDES_ITEMS.ID_ITEMS = ITEMS.ID_ITEMS WHERE PROVIDES_ITEMS.ID_PROVIDES = $id), STATUS_PROVIDES = 1 WHERE ID_PROVIDES = $id");
		return $this->db->affected_rows();
	}

	public function declineProvide($id)
	{
		$query = $this->db->query("SELECT DECLINEPROVIDEFUNC($id) as res from dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}
}

/* End of file admin_m.php */
/* Location: ./application/models/admin_m.php */