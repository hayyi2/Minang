<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CRUD_Model {
	protected $table_name = "payment";
	protected $primary_key = "payment_id";
	protected $table_view_name = "payment_view";

	public $editable_column = array(
		'reservasi_id',
		'no_account',
		'name_account',
		'bank_account',
		'proof',
	);

	public function create( $args )
	{
		$args['created_at'] = date('Y-m-d H:i:s');
		return parent::create($args);
	}
}