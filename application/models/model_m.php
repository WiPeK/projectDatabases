<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_m extends CI_Model {

	public $rules = array(
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
	);

	public $rules_login = array(
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|xss_clean|max_length[255]|valid_email'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Hasło',
			'rules' => 'trim|required|xss_clean|max_length[50]'
		),
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function getItemsView()
	{
		$query = $this->db->query("SELECT * from item_relation WHERE id_items > 1");
		return $query->result();
	}

	public function getToBasket()
	{
		$cond = "";
		foreach($_SESSION['basket'] as $bskt)
		{
			$cond .= "items.id_items = " . $bskt["id"] .  ' OR ';
		}
		$cond = substr($cond, 0, -4);
		$query = $this->db->query("SELECT items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, producers.name_producers, LISTAGG(CONCAT(CONCAT(features.name_features, ' '), items_features.value), '; ') WITHIN GROUP (ORDER BY features.name_features) as ftrs FROM items JOIN items_features ON items.id_items = items_features.id_items JOIN features ON items_features.id_features = features.id_features JOIN producers ON items.id_producers = producers.id_producers WHERE $cond GROUP BY items.id_items, items.name_items, items.model_items, items.quantity_items, items.price_items, producers.name_producers");
		return $query->result();
	}

	public function doBuy()
	{
		$name = $this->input->post('name');
		$surname = $this->input->post('surname');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$basketPrice = $_SESSION["basketPrice"];
		$itsvals = "";
		foreach($_SESSION['basket'] as $bskt)
		{
			$itsvals .= $bskt["id"] . ',' . $bskt["value"] . ';';
		}
		$itsvals = substr($itsvals, 0, -1);
		$query = $this->db->query("SELECT DOBUYFUNC('$name', '$surname', '$email', '$address', '$phone', '$basketPrice', '$itsvals') as RES FROM dual");
		if($query->row('RES') == "1")
			return true;
		else
			return false;
	}

	public function login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$query = $this->db->query("SELECT count(id_employees) as cnt FROM employees WHERE email_employees = '$email' AND password_employees = DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('$pass'))");
		if($query->row()->CNT == 1)
		{
			$_SESSION['logged'] = true;
			$_SESSION['email'] = $email;
			return true;
		}
		else
			return false;
	}

}

/* End of file model_m.php */
/* Location: ./application/models/model_m.php */