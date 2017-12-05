<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
	}

	public function login()
	{
		if ($capability = current_user_data('capability')) {
			set_message_flash('Anda sudah login.');
			redirect('home');
		}
		$params = array(
			'title' 		=> 'Login',
			'acive_menu' 	=> 'login',
		);

		if ($post = $this->input->post()) {
			if (isset($post['email']) && isset($post['password'])) {
				$login = $this->user_model->login($post['email'], $post['password']);
				if ($login['value']) {
					set_message_flash($login['message'], 'success');

					if (isset($post['go'])) {
						redirect($post['go']);
					}

					if (current_user_data('capability') == 'member') {
						redirect('home');
					}else{
						redirect('reservasi/view');
					}
				}else{
					set_message_flash($login['message']);
					redirect('user/login');
				}
			}
		}

		$this->load->view('header', $params);
		$this->load->view('login', $params);
		$this->load->view('footer', $params);
	}

	public function register()
	{
		if ($capability = current_user_data('capability')) {
			set_message_flash('Anda sudah login.');
			redirect('minuman');
		}

		$params = array(
			'title' 		=> 'Register',
			'acive_menu' 	=> 'register',
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
				$params['data'] 	= $post;
				$params['error'] 	= $error;
			} else {
				$allowed_add = $this->user_model->editable_column;
				$data = array_input_filter($post, $allowed_add);
				$data['capability'] = 1;
				$insert_id = $this->user_model->create( $data );

				set_message_flash('Selamat datang ' . $data['name'] . ', silahkan login.', 'success');
				redirect('user/login');
			}
		}

		$this->load->view('header', $params);
		$this->load->view('register', $params);
		$this->load->view('footer', $params);
	}

	public function logout()
	{
		$this->user_model->logout();
		set_message_flash('Success Logout.', 'success');
		redirect('user/login');
	}

	public function profile()
	{
		$user_id = current_user_data('user_id');
		$data = $this->user_model->get($user_id);

		if (!$data || !$user_id) {
			show_404();
		}

		$params = array(
			'title' 		=> 'Input Member',
			'acive_menu' 	=> 'profile',
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
				if (isset($data['capability'])) {
					unset($data['capability']);
				}
				$insert_id = $this->user_model->update($user_id, $data);

				set_message_flash('Profile telah berhasil diedit.', 'success');
				redirect('user/profile');
			}
		}
		$this->load->view('header', $params);
		$this->load->view('profile', $params);
		$this->load->view('footer', $params);
	}
}
