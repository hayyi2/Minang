<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seting extends CI_Controller {

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
		$params = array(
			'title' 		=> 'Seting App',
			'acive_menu' 	=> 'app',
		);

		if ($post = $this->input->post()) {
			$this->save_option($post);

			if (isset($_FILES['image']) && $_FILES['image']['error']== 0) {
				$config['file_name'] 	 = 'banner';
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';

				$this->upload->initialize($config);

				if ( $this->upload->do_upload('image')){
					$file_data = $this->upload->data();
					if ($this->option_model->check_isset_key('banner')) {
						$img_last = $this->option_model->get_value('banner');
						if ($img_last != "") {
							unlink('uploads/'.$img_last);
						}
						
						$this->option_model->change_value('banner', $file_data['file_name']);
					}else{
						$this->option_model->set_value('banner', $file_data['file_name']);
					}
				}
			}

			set_message_flash("Data telah berhasil dirubah.", 'success');
			redirect('seting');
		}

		$this->load->view('header', $params);
		$this->load->view('seting-app', $params);
		$this->load->view('footer', $params);
	}

	public function pembayaran()
	{
		$params = array(
			'title' 		=> 'Seting Pembayaran',
			'acive_menu' 	=> 'setting-pembayaran',
		);

		if ($post = $this->input->post()) {
			$this->save_option($post);

			set_message_flash("Data telah berhasil dirubah.", 'success');
			redirect('seting/pembayaran');
		}
		$this->load->view('header', $params);
		$this->load->view('seting-pembayaran', $params);
		$this->load->view('footer', $params);
	}
	
	private function save_option($post)
	{
		if (isset($post['option']) && isAssoc( $post['option'] )) {
			foreach ($post['option'] as $key => $value) {
				if ($this->option_model->check_isset_key($key)) {
					$this->option_model->change_value($key, $value);
				}else{
					$this->option_model->set_value($key, $value);
				}
			}
		}
	}
}
