<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->library('upload');

		$this->load->model('reservasi_model');
		$this->load->model('payment_model');
	}

	public function index()
	{
		protected_page(array('member'));

		$where = array('where' => array(
			'user_id' 	=> current_user_data('user_id'), 
			'status <=' => 2,
		));

		$data = $this->reservasi_model->get_view($where);

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		if ($post = $this->input->post()) {
			
			if (isset($_FILES['proof']) && $_FILES['proof']['error']== 0) {
				$config['file_name'] 	 = 'proof';
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';

				$this->upload->initialize($config);

				if ( $this->upload->do_upload('proof')){
					$file_data = $this->upload->data();
					$post['proof'] = $file_data['file_name'];
				}
			}else{
				$post['proof'] = "";
			}

			$allowed_add = $this->payment_model->editable_column;
			$new_data = array_input_filter($post, $allowed_add);
			$new_data['reservasi_id'] = $data->reservasi_id;
			$insert_id = $this->payment_model->create( $new_data );

			$this->reservasi_model->update($data->reservasi_id, array('status' => 3));

			set_message_flash('Konfirmasi pembayaran berhasil disimpan.', 'success');
			redirect('reservasi/detail/'. $data->reservasi_id);
		}

		$params = array(
			'title' 		=> 'Pembayaran',
			'acive_menu' 	=> 'reservasi',
			'data' 			=> $data,
		);

		$this->load->view('header', $params);
		$this->load->view('pembayaran', $params);
		$this->load->view('footer', $params);
	}

}
