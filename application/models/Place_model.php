<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_model extends CRUD_Model {
	protected $table_name = "place";
	protected $primary_key = "place_id";
	protected $table_view_name = "place_view";

	public $editable_column = array(
		'name',
		'thumbnail',
	);
}