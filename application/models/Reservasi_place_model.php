<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi_place_model extends CRUD_Model {
	protected $table_name = "reservasi_place";
	protected $primary_key = "reservasi_place_id";

	public $editable_column = array(
		'reservasi_id',
		'place_detail_id',
	);
}