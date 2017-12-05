<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi extends CI_Controller {

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
		$this->load->model('reservasi_menu_model');
		$this->load->model('reservasi_place_model');

		$this->load->model('menu_model');
		$this->load->model('place_detail_model');
		$this->load->model('payment_model');
	}

	public function index()
	{
		protected_page(array('member'));

		$this->auto_batal();
		
		$params = array(
			'title' 		=> 'Reservasi',
			'acive_menu' 	=> 'reservasi',
			'data' 			=> $this->reservasi_model->gets_view(array('where' => array('user_id' => current_user_data('user_id')))),
			'status' 		=> $this->status_reservasi,
		);

		$this->load->view('header', $params);
		$this->load->view('reservasi', $params);
		$this->load->view('footer', $params);
	}

	public function detail( $reservasi_id = false)
	{
		protected_page(array('member'));

		$this->auto_batal();
		$data = $this->reservasi_model->get(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_id' => $reservasi_id)));

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		$params = array(
			'title' 		=> 'Reservasi',
			'acive_menu' 	=> 'reservasi',
			'status' 		=> $this->status_reservasi,
			'data' 			=> $data,
			'data_menu' 	=> $this->reservasi_menu_model->gets_view(array('where' => array('reservasi_id' => $reservasi_id))),
			'data_tempat' 	=> $this->reservasi_place_model->gets(array('where' => array('reservasi_id' => $reservasi_id)), 'place_detail_view'),
		);

		$this->load->view('header', $params);
		$this->load->view('reservasi-detail', $params);
		$this->load->view('footer', $params);
	}

	public function cetak( $reservasi_id = false)
	{
		protected_page(array('member'));

		$this->auto_batal();
		$data = $this->reservasi_model->get_view(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_id' => $reservasi_id)));

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		$params = array(
			'print_title' 	=> 'Cetak Invoice',
			'status' 		=> $this->status_reservasi,
			'data' 			=> $data,
			'data_menu' 	=> $this->reservasi_menu_model->gets_view(array('where' => array('reservasi_id' => $reservasi_id))),
			'data_tempat' 	=> $this->reservasi_place_model->gets(array('where' => array('reservasi_id' => $reservasi_id)), 'place_detail_view'),
		);

		$this->load->view('print-header', $params);
		$this->load->view('print-reservasi', $params);
		$this->load->view('print-footer', $params);
	}

	public function batal( $reservasi_id = false)
	{
		protected_page(array('member'));

		$data = $this->reservasi_model->get(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_id' => $reservasi_id)));

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}
		if ($data->status == 3) {
			set_message_flash('Reservasi telah dibatalkan.');
			redirect('reservasi');
		}
		if (strtotime($data->date) < strtotime('+3 hours', strtotime(date('Y-m-d H:00')))) {
			set_message_flash('Reservasi kurang dari Tiga jam lagi dan tidak bisa dibatalkan.');
			redirect('reservasi/detail/'. $reservasi_id);
		}

		$this->reservasi_model->update($reservasi_id, array('status' => 5, ));

		set_message_flash('Reservasi telah dibatalkan.', 'success');
		redirect('reservasi/detail/'. $reservasi_id);
	}

	public function menu($id, $category = 'semua')
	{
		protected_page(array('member'));

		$this->auto_batal();
		if ($post = $this->input->post()) {
			$data = $this->menu_model->get_view($id);

			if ($data) {
				if (isset($post['sum'])) {
					$where = array('where' => array(
						'user_id' 	=> current_user_data('user_id'), 
						'status <=' => 2,
					));
					$data_reservasi = $this->reservasi_model->get($where);

					if ($data_reservasi) {
						$reservasi_id = $data_reservasi->reservasi_id;
					}else{
						$new_data = array(
							'user_id' 	=> current_user_data('user_id'), 
							'date' 		=> date('Y-m-d H:i:s'), 
							'status' 	=> 1, 
						);
						$reservasi_id = $this->reservasi_model->create($new_data);
					}

					$new_data = array(
						'reservasi_id' 	=> $reservasi_id, 
						'menu_id' 		=> $id, 
						'sum' 			=> $post['sum'], 
					);
					$this->reservasi_menu_model->create($new_data);

					$message = 'Sukses pesan ' . $data->category_label . ' ' . $data->name . ' jumlah ' . $post['sum'] . '. ';
					$message .= 'Silahkan cek data <a href="' . base_url('reservasi/detail/'. $reservasi_id) . '">reservasi</a>, atau melanjutkan memesan';
					set_message_flash($message, 'success');
					redirect('menu/'.$category);
				}
			}
		}
		
		set_message_flash('Data tidak ditemukan.');
		redirect('menu/'.$category);
	}

	public function edit_menu($reservasi_menu_id)
	{
		protected_page(array('member'));

		$data = $this->reservasi_menu_model->get_view(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_menu_id' => $reservasi_menu_id)));
		$data_reservasi = $this->reservasi_model->get_view($data->reservasi_id);

		if ($data) {
			if($post = $this->input->post()){
				if (isset($post['sum'])) {
					if ($data->sum > $post['sum']) {
						if ($data_reservasi->can_add_table - $data_reservasi->table <= floor(($data->sum - $post['sum'])/ 2) ) {
							set_message_flash('Pemesanan meja lebih banyak dari makanan, anda harus menghapus pesanan tempat terlebih dahulu.');
							redirect('reservasi/detail/'.$data->reservasi_id);
						}
					}

					$this->reservasi_menu_model->update($reservasi_menu_id, array('sum' => $post['sum'], ));

					set_message_flash('Data telah berhasil diubah.', 'success');
					redirect('reservasi/detail/'.$data->reservasi_id);
				}
			}
		}

		set_message_flash('Data tidak ditemukan.');
		redirect('reservasi');

	}

	public function delete_menu($reservasi_menu_id)
	{
		protected_page(array('member'));

		$data = $this->reservasi_menu_model->get_view(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_menu_id' => $reservasi_menu_id)));
		$data_reservasi = $this->reservasi_model->get_view($data->reservasi_id);

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		if ($data_reservasi->can_add_table - $data_reservasi->table <= floor($data->sum / 2) ) {
			set_message_flash('Pemesanan meja lebih banyak dari makanan, anda harus menghapus pesanan tempat terlebih dahulu.');
			redirect('reservasi/detail/'.$data->reservasi_id);
		}
		
		$this->reservasi_menu_model->delete($reservasi_menu_id);
		set_message_flash('Data telah berhasil dihapus.', 'success');
		redirect('reservasi/detail/'.$data->reservasi_id);
	}

	public function tempat($id)
	{
		protected_page(array('member'));

		$this->auto_batal();
		if ($post = $this->input->post()) {
			$data = $this->place_detail_model->get($id);

			if ($data) {
				echo "string";
				if (isset($post['date'])) {
					$where = array('where' => array(
						'user_id' 	=> current_user_data('user_id'), 
						'status <=' => 2,
					));
					$data_reservasi = $this->reservasi_model->get($where);
					$data_update = array(
						'date' 		=> $post['date'], 
						'status' 	=> 2,
					);
					$this->reservasi_model->update($data_reservasi->reservasi_id, $data_update);

					$new_data = array(
						'reservasi_id' 	=> $data_reservasi->reservasi_id, 
						'place_detail_id' => $id, 
					);
					$this->reservasi_place_model->create($new_data);

					$message = 'Sukses pesan meja ' . $data->name . '. ';
					$message .= 'Silahkan cek data <a href="' . base_url('reservasi/detail/'. $data_reservasi->reservasi_id) . '">reservasi</a>, atau melanjutkan memesan';
					set_message_flash($message, 'success');
					redirect('denah');
				}
			}
		}
		
		set_message_flash('Data tidak ditemukan.');
		redirect('denah');
	}

	public function delete_tempat($reservasi_place_id)
	{
		protected_page(array('member'));

		$data = $this->reservasi_place_model->get(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_place_id' => $reservasi_place_id)), 'place_detail_view');

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		$this->reservasi_place_model->delete($reservasi_place_id);
		set_message_flash('Data telah berhasil dihapus.', 'success');
		redirect('reservasi/detail/'.$data->reservasi_id);
	}

	public function change_date($reservasi_id)
	{
		protected_page(array('member'));
		$data = $this->reservasi_model->get_view(array('where' => array('user_id' => current_user_data('user_id'), 'reservasi_id' => $reservasi_id)));

		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi');
		}

		$this->reservasi_place_model->delete(array('reservasi_id' => $reservasi_id));
		set_message_flash('Data telah berhasil dihapus tanggal lama.', 'success');
		redirect('denah');
	}

	private function auto_batal()
	{
		$user_id = current_user_data('user_id');

		$where = array(
			'user_id' => $user_id,
			'status' => 2,
			'date <' => date('Y-m-d H:00', strtotime('+3 hours', strtotime(date('Y-m-d H:00')))),
		);

		$data = $this->reservasi_model->get(array('where' => $where));
		if ($data) {
			$this->reservasi_model->update($data->reservasi_id, array('status' => 6));
			set_message_flash('Reservasi dibatalkan sistem karena belum melakukan pembayaran kurang dari Tiga jam dari waktu reservasi.');
			redirect('reservasi/detail/'.$data->reservasi_id);
		}
	}

	/**
	* Admin
	*/
	
	public function view()
	{
		protected_page(array('admin'));
		
		$params = array(
			'title' 		=> 'Data Reservasi',
			'acive_menu' 	=> 'reservasi',
			'data' 			=> $this->reservasi_model->gets_view(),
			'status' 		=> $this->status_reservasi,
		);

		$this->load->view('header', $params);
		$this->load->view('reservasi-list', $params);
		$this->load->view('footer', $params);
	}

	public function ready($reservasi_id)
	{
		protected_page(array('admin'));

		if ($data = $this->reservasi_model->get_view($reservasi_id)) {
			$this->reservasi_model->update($data->reservasi_id, array('status' => 7));
			set_message_flash('Sukses rubah status.', 'success');
			redirect('reservasi/view');
		}

		set_message_flash('Data tidak ditemukan.');
		redirect('reservasi/view');
	}

	public function konfirmasi($reservasi_id)
	{
		protected_page(array('admin'));

		if ($data = $this->reservasi_model->get_view($reservasi_id)) {
			$this->reservasi_model->update($data->reservasi_id, array('status' => 4));
			set_message_flash('Sukses rubah status.', 'success');
			redirect('reservasi/view');
		}

		set_message_flash('Data tidak ditemukan.');
		redirect('reservasi/view');
	}

	public function full($reservasi_id)
	{
		protected_page(array('admin'));
		
		$data = $this->reservasi_model->get_view($reservasi_id);
		if (!$data) {
			set_message_flash('Data tidak ditemukan.');
			redirect('reservasi/view');
		}

		$params = array(
			'title' 		=> 'Reservasi',
			'acive_menu' 	=> 'reservasi',
			'status' 		=> $this->status_reservasi,
			'data' 			=> $data,
			'data_pembayaran' => $this->payment_model->get(array('where' => array('reservasi_id' => $reservasi_id))),
		);

		$this->load->view('header', $params);
		$this->load->view('reservasi-detail-admin', $params);
		$this->load->view('footer', $params);
	}

	public function delete($reservasi_id)
	{
		protected_page(array('admin'));

		if ($data = $this->reservasi_model->get_view($reservasi_id)) {
			$this->reservasi_model->delete($data->reservasi_id);
			set_message_flash('Sukses delete data.', 'success');
			redirect('reservasi/view');
		}

		set_message_flash('Data tidak ditemukan.');
		redirect('reservasi/view');
	}
}

