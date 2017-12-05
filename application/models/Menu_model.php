<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CRUD_Model {
	protected $table_name = "menu";
	protected $primary_key = "menu_id";
	protected $table_view_name = "menu_view";

	public $editable_column = array(
		'name',
		'description',
		'price',
		'category',
		'thumbnail',
	);
}