<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CRUD_Model {
	protected $table_name = "user";
	protected $primary_key = "user_id";

	public $editable_column = array(
		'email',
		'name',
		'password',
		'capability',
	);

	private $allowed_session = array('user_id', 'email', 'name', 'capability');

	public function login($email , $password)
	{
		$user_data = parent::get(array('where' => array('email' => $email)));

		if ($user_data != null) {
			if ($user_data->password == $this->generate_password($password)) {
				$user_data = (array)$user_data;
				$user_data['capability'] = get_app_config('capability')[$user_data['capability']];

				$sess_array = array_input_filter($user_data, $this->allowed_session);
				$this->session->set_userdata('current_user', $sess_array);
				return array(
					'value' => true,
					'message' => "Success Login, Selamat datang {$user_data['name']}."
				);
			}else{
				return array(
					'value' => false,
					'message' => "Password Salah."
				);
			}
		}else{
			return array(
				'value' => false,
				'message' => "Email Tidak Ditemukan."
			);
		}
	}

	public function email_exists($email)
	{
		return parent::check_isset( 'email', $email );
	}

	public function logout()
	{
		$this->session->unset_userdata('current_user');
	}

	public function create( $args )
	{
		$args['password'] = $this->generate_password($args['password']);
		$args['created_at'] = date('Y-m-d H:i:s');
		$args['updated_at'] = date('Y-m-d H:i:s');
		return parent::create($args);
	}

	public function update( $id, $args )
	{
		if (isset($args['password']))
			$args['password'] = $this->generate_password($args['password']);
		$args['updated_at'] = date('Y-m-d H:i:s');
		return parent::update( $id, $args );
	}

	private function generate_password($password){
		return sha1('a'.$password.'2=/');
	}

}