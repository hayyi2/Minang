<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makanan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('admin'));

		$this->load->library('upload');

		$this->load->model('menu_model');
	}

	public function index()
	{
		$this->view();
	}
	public function view()
	{
		$params = array(
			'title' 		=> 'Data Makanan',
			'acive_menu' 	=> 'makanan',
			'category' 		=> 'makanan',
			'data' 			=> $this->menu_model->gets(array('where' => array('category' => 1))),
		);

		$this->load->view('header', $params);
		$this->load->view('menu-list', $params);
		$this->load->view('footer', $params);
	}
	public function input()
	{
		$params = array(
			'title' 		=> 'Input Makanan',
			'acive_menu' 	=> 'makanan',
			'category' 		=> 'makanan',
			'mode' 			=> 'add',
		);

		if ($post = $this->input->post()) {

			if (isset($_FILES['image']) && $_FILES['image']['error']== 0) {
				$config['file_name'] 	 = 'menu-makanan';
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';

				$this->upload->initialize($config);

				if ( $this->upload->do_upload('image')){
					$file_data = $this->upload->data();
					$post['thumbnail'] = $file_data['file_name'];
				}
			}else{
				$post['thumbnail'] = "";
			}

			$allowed_add = $this->menu_model->editable_column;
			$data = array_input_filter($post, $allowed_add);
			$data['category'] = 1;
			$insert_id = $this->menu_model->create( $data );

			set_message_flash('Data telah berhasil ditambah.', 'success');
			redirect('makanan/edit/'. $insert_id);
		}
		$this->load->view('header', $params);
		$this->load->view('menu-input', $params);
		$this->load->view('footer', $params);
	}
	public function edit($id_user)
	{
		$data = $this->menu_model->get($id_user);

		if (!$data || $data->category != 1) {
			set_message_flash('Data tidak ditemukan.');
			redirect('makanan');
		}

		$params = array(
			'title' 		=> 'Input Makanan',
			'acive_menu' 	=> 'makanan',
			'category' 		=> 'makanan',
			'mode' 			=> 'edit',
			'data' 			=> $data,
		);
		
		if ($post = $this->input->post()) {

			if (isset($post['deleted'])) {
				unlink('./uploads/'.$post['deleted']);
				$post['thumbnail'] = "";
			}
			
			if (isset($_FILES['image']) && $_FILES['image']['error']== 0) {
				$config['file_name'] 	 = 'menu-makanan';
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';

				$this->upload->initialize($config);

				if ( $this->upload->do_upload('image')){
					$file_data = $this->upload->data();
					$post['thumbnail'] = $file_data['file_name'];
				}
			}
			
			$allowed_add = $this->menu_model->editable_column;
			$data = array_input_filter($post, $allowed_add);
			$insert_id = $this->menu_model->update($id_user, $data );

			set_message_flash('Data telah berhasil diedit.', 'success');
			redirect('makanan/edit/'. $id_user);
		}
		$this->load->view('header', $params);
		$this->load->view('menu-input', $params);
		$this->load->view('footer', $params);
	}
	public function delete($id_user)
	{
		$data = $this->menu_model->get($id_user);

		if (!$data || $data->category != 1) {
			set_message_flash('Data tidak ditemukan.');
			redirect('makanan');
		}

		$this->menu_model->delete($id_user);

		set_message_flash('Data telah berhasil dihapus.', 'success');
		redirect('makanan');
	}
}
