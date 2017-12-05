<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	private $category = array('semua', 'makanan', 'minuman');

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('menu_model');
	}

	public function index()
	{
		$this->semua();
	}

	private function view($params)
	{
		if (!current_user_data()) {
			set_message_flash('Silahkan <a href="' . base_url('user/login?go=menu/' . $params['active_submenu']) . '">Login</a> atau <a href="' . base_url('user/register') . '">Register</a> terlebih dulu sebelum Memesan.', 'warning');
		}

		$params['acive_menu'] 	= 'menu';
		$params['category'] 	= $this->category;

		$this->load->view('header', $params);
		$this->load->view('menu', $params);
		$this->load->view('footer', $params);
	}

	public function semua()
	{
		$params = array(
			'title' 		=> 'Makanan & Minuman',
			'active_submenu' => 'semua',
			'data' 			=> $this->menu_model->gets_view(),
		);
		
		$this->view($params);
	}

	public function makanan()
	{
		$params = array(
			'title' 		=> 'Makanan',
			'active_submenu' => 'makanan',
			'data' 			=> $this->menu_model->gets_view(array('where' => array('category' => 1))),
		);
		$this->view($params);
	}

	public function minuman()
	{
		$params = array(
			'title' 		=> 'Minuman',
			'active_submenu' => 'minuman',
			'data' 			=> $this->menu_model->gets_view(array('where' => array('category' => 2))),
		);
		$this->view($params);
	}
}
