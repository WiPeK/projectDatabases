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
		$query = $this->db->query("SELECT * from item_relation");
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
		//$this->db->trans_start();
		$canIBuy = true;
		$data['items'] = $this->getToBasket();

		foreach($data['items'] as $pr)
		{
			$key = array_search($pr->ID_ITEMS, array_column($_SESSION['basket'], 'id'));
			if($pr->QUANTITY_ITEMS < $_SESSION['basket'][$key]['value'])
			{
				$canIBuy = false;
				$_SESSION['statusBuy'] .= 'W twoim koszyku znajduje się przedmiot, który chcesz kupić lecz nie posiadamy w magazynie tyle sztuk ile potrzebujesz';
				return false;
			}
		}

		if($canIBuy)
		{
			$name = $this->input->post('name');
			$surname = $this->input->post('surname');
			$email = $this->input->post('email');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$canDoSale = false;
			$query = $this->db->query("SELECT count(id_clients) as cnt from clients where name_clients = '$name' and surname_clients = '$surname' and email_clients = '$email' and address_clients = '$address' and phone_number_clients = '$phone'");
			if ($query->row()->CNT == (int)1) {
				$canDoSale = true;
			}
			elseif ($query->row()->CNT > (int)1) {
				$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany (Zdublowani klienci)';
				//$this->db->trans_off();
				return false;
			}
			else
			{
				$query = $this->db->query("INSERT INTO clients VALUES(clients_seq.NEXTVAL, '$name', '$surname', '$email', '$address', '$phone')");
				if($this->db->affected_rows())
					$canDoSale = true;
			}

			if($canDoSale)
			{
				$query = $this->db->query("SELECT id_clients FROM clients WHERE name_clients = '$name' and surname_clients = '$surname' and email_clients = '$email' and address_clients = '$address' and phone_number_clients = '$phone'");
				$id = $query->row()->ID_CLIENTS;
				if($id == NULL || $id == 0)
				{
					$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany (Nie znaleziono clienta)';
					//$this->db->trans_off();
					return false;
				}
				$basketPrice = $_SESSION["basketPrice"];
				$query = $this->db->query("INSERT INTO sales VALUES(sales_seq.NEXTVAL, NULL, $id, NULL, '$basketPrice', 0)");
				if($this->db->affected_rows())
				{
					$query = $this->db->query("SELECT MAX(id_sales) as mis FROM sales WHERE id_clients = $id");
					$id_sales = $query->row()->MIS;
					foreach ($_SESSION['basket'] as $bskt) {
						$sid = $bskt['id'];
						$sval = $bskt['value'];
						$query = $this->db->query("INSERT INTO sales_items VALUES('$id_sales', '$sid', '$sval')");
						if(!$this->db->affected_rows())
						{
							$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany (Nie dodano do sales_items)';
							//$this->db->trans_off();
							return false;
						}

						$query = $this->db->query("UPDATE items SET quantity_items = quantity_items - $sval WHERE id_items = '$sid' AND (quantity_items - '$sval') >= 0");
						if(!$this->db->affected_rows())
						{
							$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany. Brak przedmiotu w magazynie';
							//$this->db->trans_off();
							return false;
						}
					}
					return true;
					//$this->db->trans_complete();
				}
				else
				{
					$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany (Nie dodano sprzedazy)';
					//$this->db->trans_off();
					return false;
				}
			}
			else
			{
				$_SESSION['statusBuy'] .= 'Zakup nie może zostać wykonany (Nie dodano clienta lub nie istnieje)';
				//$this->db->trans_off();
				return false;
			}
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$query = $this->db->query("SELECT count(id_employees) as cnt FROM employees WHERE email_employees = '$email' AND password_employees = DBMS_OBFUSCATION_TOOLKIT.md5 (input => UTL_RAW.cast_to_raw('$pass'))");
		if($query->row()->CNT == 1)
		{
			$_SESSION['logged'] = true;
			return true;
		}
		else
			return false;
	}

}

/* End of file model_m.php */
/* Location: ./application/models/model_m.php */