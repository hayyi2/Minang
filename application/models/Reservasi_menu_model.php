<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi_menu_model extends CRUD_Model {
	protected $table_name = "reservasi_menu";
	protected $primary_key = "reservasi_menu_id";
	protected $table_view_name = "reservasi_menu_view";

	public $editable_column = array(
		'reservasi_id',
		'menu_id',
		'sum',
	);
}