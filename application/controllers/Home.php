<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$params = array(
			'title' 		=> 'Home',
			'acive_menu' 	=> 'home',
		);

		$this->load->view('header', $params);
		$this->load->view('home', $params);
		$this->load->view('footer', $params);
	}
}
