<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		
		protected_page(array('admin'));
	}

	public function index()
	{
		$this->view();
	}
	public function view()
	{
		$params = array(
			'title' 		=> 'Data Admin',
			'acive_menu' 	=> 'admin',
			'data' 			=> $this->user_model->gets(array('where' => array('capability' => 2))),
		);

		$this->load->view('header', $params);
		$this->load->view('admin-list', $params);
		$this->load->view('footer', $params);
	}
	public function input()
	{
		$params = array(
			'title' 		=> 'Input Admin',
			'acive_menu' 	=> 'admin',
			'mode' 			=> 'add',
		);

		if ($post = $this->input->post()) {
			$form_valid = true;
			$error = null;

			if( $post['password'] != $post['repeat_password'] ) {
				$error 		= "Pengulangan password tidak sama.";
				$form_valid = false;
			}

			if( $this->user_model->email_exists($post['email']) ) {
				$error 		= "Email sudah ada yang menggunakan.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['data'] 	= (object)$post;
				$params['error'] 	= $error;
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['capability'] = 2;
				$insert_id = $this->user_model->create( $data );

				set_message_flash('Data telah berhasil ditambah.', 'success');
				redirect('admin/edit/'. $insert_id);
			}
		}
		$this->load->view('header', $params);
		$this->load->view('admin-input', $params);
		$this->load->view('footer', $params);
	}
	public function edit($id_user)
	{
		$data = $this->user_model->get($id_user);

		if (!$data || $data->capability < 2) {
			set_message_flash('Data tidak ditemukan.');
			redirect('admin');
		}

		$params = array(
			'title' 		=> 'Input Admin',
			'acive_menu' 	=> 'admin',
			'mode' 			=> 'edit',
			'data' 			=> $data,
		);
		
		if ($post = $this->input->post()) {
			$form_valid = true;
			$error = null;

			if (isset($post['change_password'])) {
				if( $post['password'] != $post['repeat_password'] ) {
					$error 		= "Pengulangan password tidak sama.";
					$form_valid = false;
				}
			}else{
				unset($post['password']);
				unset($post['repeat_password']);
			}

			if( $this->user_model->email_exists($post['email']) && $post['email'] != $data->email) {
				$error 		= "Email sudah ada yang menggunakan.";
				$form_valid = false;
			}

			if( !$form_valid ){
				$params['data'] 	= (object)array_merge((array)$data, $post);
				$params['error'] 	= $error;
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$insert_id = $this->user_model->update($id_user, $data );

				set_message_flash('Data telah berhasil diedit.', 'success');
				redirect('admin/edit/'. $id_user);
			}
		}
		$this->load->view('header', $params);
		$this->load->view('admin-input', $params);
		$this->load->view('footer', $params);
	}
	public function delete($id_user)
	{
		$data = $this->user_model->get($id_user);

		if (!$data || $data->capability < 2) {
			set_message_flash('Data tidak ditemukan.');
			redirect('admin');
		}

		$this->user_model->delete($id_user);

		set_message_flash('Data telah berhasil dihapus.', 'success');
		redirect('admin');
	}
}
