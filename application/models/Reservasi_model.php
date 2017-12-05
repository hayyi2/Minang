<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi_model extends CRUD_Model {
	protected $table_name = "reservasi";
	protected $primary_key = "reservasi_id";
	protected $table_view_name = "reservasi_view";

	public $editable_column = array(
		'user_id',
		'date',
		'status',
	);

	public function create( $args )
	{
		$args['created_at'] = date('Y-m-d H:i:s');
		$args['updated_at'] = date('Y-m-d H:i:s');
		return parent::create($args);
	}

	public function update( $id, $args )
	{
		$args['updated_at'] = date('Y-m-d H:i:s');
		return parent::update( $id, $args );
	}

	public function auto_batal($user_id)
	{
		# code...
	}
}