<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->library('upload');

		$this->load->model('reservasi_model');

		$this->load->model('place_model');
		$this->load->model('place_detail_model');
	}

	public function index()
	{
		$where = array('where' => array(
			'user_id' 	=> current_user_data('user_id'), 
			'status <=' => 2,
		));
		$can_add = false;

		$data_reservasi = $this->reservasi_model->get_view($where);

		if (!$data_reservasi) {
			$message = 'Silahkan <a href="' . base_url('menu') . '">pesan makanan</a> terlebih dahulu sebelum memesan tempat.';
		}else if ($data_reservasi->can_add_table > $data_reservasi->table) {
			$message = 'Anda dapat memesan 1 meja untuk dua makanan untuk pemesanan makanan ke dua. <br>';
			$message .= 'Anda dapat memesan ' . $data_reservasi->can_add_table . ' meja, ';
			$message .= 'anda telah memesan ' . $data_reservasi->table . ' meja. ';
			$can_add = true;
		}else{
			$message = 'Anda sudah tidak bisa memesan tempat, anda dapat memesan jika menambahkan makanan.';
		}

 		$session_flash = $this->session->flashdata('message');
		if (!$session_flash) {
			set_message_flash($message , 'warning');
		}
		
		$new_date = false;
		if ($input_date = $this->input->post('date')) {
			if (!isset($data_reservasi->table) || isset($data_reservasi->table) && $data_reservasi->table == 0) {
				$new_date = true;
			}
			$date = date('Y-m-d H:00', strtotime($input_date));
		}else if (isset($data_reservasi->status) && $data_reservasi->status == 2) {
			$date = date('Y-m-d H:00', strtotime($data_reservasi->date));
			if ($data_reservasi->table == 0) {
				$new_date = true;
			}
		}else{
			$date = date('Y-m-d H:00');
			$new_date = true;
		}

		$where = array('where' => array(
			'date >=' => date('Y-m-d H:00', strtotime('-3 hours', strtotime($date))), 
			'date <=' => date('Y-m-d H:00', strtotime('+3 hours', strtotime($date))), 
		));

		$params = array(
			'title' 		=> 'Denah Meja',
			'acive_menu' 	=> 'denah',
			'date' 			=> $date,
			'new_date' 		=> $new_date,
			'can_add' 		=> $can_add,
			'data' 			=> $this->place_model->gets_view(),
			'data_date' 	=> $this->place_model->gets($where, 'place_detail_view'),
		);

		if ($data_reservasi) {
			$params['reservasi_id'] = $data_reservasi->reservasi_id;
		}

		$this->load->view('header', $params);
		$this->load->view('denah', $params);
		$this->load->view('footer', $params);
	}

	/**
	* CRUD Denah
	*/

	public function view()
	{
		protected_page(array('admin'));

		$params = array(
			'title' 		=> 'Data Denah',
			'acive_menu' 	=> 'denah',
			'data' 			=> $this->place_model->gets_view(),
		);

		$this->load->view('header', $params);
		$this->load->view('denah-list', $params);
		$this->load->view('footer', $params);
	}

	public function input($type, $id = false)
	{
		protected_page(array('admin'));

		$params = array(
			'acive_menu' 	=> 'denah',
			'mode' 			=> 'add',
		);

		if ($type == 'poin') {
			$params['title'] = 'Input Denah';

			if ($post = $this->input->post()) {
				$form_valid = true;
				$error = null;

				if( !$form_valid ){
					$params['data'] 	= (object)$post;
					$params['error'] 	= $error;
				} else {

					if (isset($_FILES['denah']) && $_FILES['denah']['error']== 0) {
						$config['file_name'] 	 = 'denah';
						$config['upload_path']   = './uploads/';
						$config['allowed_types'] = 'jpg|jpeg|gif|png';

						$this->upload->initialize($config);

						if ( $this->upload->do_upload('denah')){
							$file_data = $this->upload->data();
							$post['thumbnail'] = $file_data['file_name'];
						}
					}else{
						$post['thumbnail'] = "";
					}

					$allowed_add = $this->place_model->editable_column;
					$data = array_input_filter($post, $allowed_add);
					$insert_id = $this->place_model->create( $data );

					set_message_flash('Data telah berhasil ditambah.', 'success');
					redirect('denah/edit/poin/'. $insert_id);
				}
			}

			$view = 'denah-input-point';
		}else{
			$data = $this->place_model->get($id);

			if (!$data) {
				set_message_flash('Data tidak ditemukan.');
				redirect('denah/view');
			}

			$params['title'] = 'Input Meja';
			$params['data'] = $data;
			$view = 'denah-input-table';

			if ($post = $this->input->post()) {
				$form_valid = true;
				$error = null;

				if (!isset($post['name']) || count($post['name']) <= 1) {
					$form_valid = false;
					$error = 'Anda harus mengisi Meja';
				}

				if( !$form_valid ){
					$params['error'] 	= $error;
				} else {
					foreach ($post['name'] as $meja) {
						if ($meja != "") {
							$data_input['place_id'] 	= $id;
							$data_input['name'] 		= $meja;
							$insert_id = $this->place_detail_model->create( $data_input );
						}
					}

					set_message_flash('Data telah berhasil ditambah.', 'success');
					redirect('denah/view');
				}
			}
		}

		$this->load->view('header', $params);
		$this->load->view($view, $params);
		$this->load->view('footer', $params);
	}

	public function edit($type = 'poin', $id)
	{
		protected_page(array('admin'));

		$params = array(
			'acive_menu' 	=> 'denah',
			'mode' 			=> 'edit',
		);

		if ($type == 'poin') {
			$data = $this->place_model->get($id);

			if (!$data) {
				set_message_flash('Data tidak ditemukan.');
				redirect('denah/view');
			}

			$params['title'] = 'Edit Denah';
			$params['data'] = $data;

			if ($post = $this->input->post()) {
				$form_valid = true;
				$error = null;

				if( !$form_valid ){
					$params['data'] 	= (object)$post;
					$params['error'] 	= $error;
				} else {

					if (isset($post['deleted'])) {
						unlink('./uploads/'.$post['deleted']);
						$post['thumbnail'] = "";
					}

					if (isset($_FILES['denah']) && $_FILES['denah']['error']== 0) {
						$config['file_name'] 	 = 'denah';
						$config['upload_path']   = './uploads/';
						$config['allowed_types'] = 'jpg|jpeg|gif|png';

						$this->upload->initialize($config);

						if ( $this->upload->do_upload('denah')){
							$file_data = $this->upload->data();
							$post['thumbnail'] = $file_data['file_name'];
						}
					}

					$allowed_add = $this->place_model->editable_column;
					$data = array_input_filter($post, $allowed_add);
					$insert_id = $this->place_model->update( $id, $data );

					set_message_flash('Data telah berhasil ditambah.', 'success');
					redirect('denah/edit/poin/'. $insert_id);
				}
			}

			$view = 'denah-input-point';
		}else{
			$data = $this->place_detail_model->get($id);

			if (!$data) {
				set_message_flash('Data tidak ditemukan.');
				redirect('denah/view');
			}

			$params['title'] = 'Input Meja';
			$params['data'] = $data;

			if ($post = $this->input->post()) {
				if (isset($post['name'])) {
					$insert_id = $this->place_detail_model->update( $id, array('name' => $post['name']) );

					set_message_flash('Data telah berhasil ditambah.', 'success');
					redirect('denah/edit/meja/'. $id);
				}else{
					$data['error'] = 'Filed form.';
				}
			}

			$view = 'denah-input-table';
		}

		$this->load->view('header', $params);
		$this->load->view($view, $params);
		$this->load->view('footer', $params);
	}

	public function delete($type = 'poin', $id)
	{
		protected_page(array('admin'));

		if ($type == 'poin') {
			$data = $this->place_model->get($id);
			if (!$data) {
				set_message_flash('Data tidak ditemukan.');
				redirect('denah/view');
			}
			if ($data->thumbnail != "") {
				unlink('./uploads/'.$data->thumbnail);
			}
			$this->place_model->delete($id);

			set_message_flash('Data telah berhasil dihapus.', 'success');
			redirect('denah/view');
		}else{
			$data = $this->place_detail_model->get($id);
			if (!$data) {
				set_message_flash('Data tidak ditemukan.');
				redirect('denah/view');
			}
			$this->place_detail_model->delete($id);
			
			set_message_flash('Data telah berhasil dihapus.', 'success');
			redirect('denah/view');
		}
	}
}