<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	private $status_reservasi = array(
		'1' => 'Pesan Menu',
		'2' => 'Pesan Tempat dan Tanggal',
		'3' => 'Pembayaran',
		'4' => 'Pembayaran Terverifikasi',
		'5' => 'Dibatalkan',
		'6' => 'Dibatalkan Sistem',
		'7' => 'Hidangan Siap',
	);

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->model('reservasi_model');
	}

	public function index()
	{
		$params = array(
			'title' 		=> 'Laporan',
			'acive_menu' 	=> 'laporan',
			'status' 		=> $this->status_reservasi,
		);

		if ($post = $this->input->post()) {
			if (isset($post['start']) && isset($post['end'])) {
				$where = array('where' => array(
					'status' => 7,
					'date >=' => $post['start'],
					'date <=' => $post['end'],
				));
				$params['data'] = $this->reservasi_model->gets_view($where);
				$params['start'] = $post['start'];
				$params['end'] = $post['end'];
			}
		}else{
			$params['data'] = $this->reservasi_model->gets_view(array('where' => array('status' => 7)));
		}

		$this->load->view('header', $params);
		$this->load->view('laporan', $params);
		$this->load->view('footer', $params);
	}
}