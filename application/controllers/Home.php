<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['items'] = $this->model_m->getItemsView();
		$this->data['subview'] = 'front/index';
		$this->load->view('front/template', $this->data);
	}

	public function addToBasket($id)
	{
		if(!is_numeric($_POST['itemtobasket']) || $_POST['itemtobasket'] < 1)
			redirect(site_url());
		$key = array_search($id, array_column($_SESSION['basket'], 'id'));
		if($key !== false)
		{
			$_SESSION['basket'][$key] = array(
				'id' => $id,
				'value' => $_POST['itemtobasket']
			);
		}
		elseif (empty($_SESSION['basket']))
		{
			$_SESSION['basket'][0] = array(
				'id' => $id,
				'value' => $_POST['itemtobasket']
			);
		}
		else
		{
			array_push($_SESSION['basket'],array('id' => $id, 'value' => $_POST['itemtobasket']));
		}
		redirect(site_url('home/basket'));
	}

	public function basket()
	{
		if(empty($_SESSION['basket']))
			redirect(site_url());
		$this->data['items'] = $this->model_m->getToBasket();
		$this->data['basketPrice'] = 0;
		foreach($this->data['items'] as $pr)
		{
			$key = array_search($pr->ID_ITEMS, array_column($_SESSION['basket'], 'id'));
			if($key !== false)
			{
				$pr->IN_BASKET = $_SESSION['basket'][$key]['value'];
				$this->data['basketPrice'] += $pr->PRICE_ITEMS * $_SESSION['basket'][$key]['value'];
			}
		}
		$_SESSION['basketPrice'] = $this->data['basketPrice'];
		$this->data['subview'] = 'front/basket';
		$this->load->view('front/template', $this->data);
	}

	public function deleteFromBasket($id)
	{
		$key = array_search($id, array_column($_SESSION['basket'], 'id'));
		unset($_SESSION['basket'][$key]);
			$_SESSION['basket'] = array_values($_SESSION['basket']);
		redirect(site_url('home/basket'));
	}

	public function buy()
	{
		$_SESSION['statusBuy'] = "";
		$rules = $this->model_m->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run())
		{
			if($this->model_m->doBuy())
			{
				$_SESSION['statusBuy'] .= 'Zakup zakończony powodzeniem';
				unset($_SESSION['basket']);
				$_SESSION['basket'] = array();
				redirect(site_url());
			}
		}
		$this->data['subview'] = 'front/buy';
		$this->load->view('front/template', $this->data);
	}

	public function login()
	{
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */