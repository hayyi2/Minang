<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CRUD_Model {
	protected $table_name = "option";
	protected $primary_key = "option_id";

	public $editable_column = array(
		'key',
		'value',
	);

	public function get_value($key)
	{
		$data = parent::get(array('where' => array('key' => $key)));
		return ($data) ? $data->value : "";
	}

	public function get_id($key, $value)
	{
		$data = parent::get(array(
			'where' => array(
				'key' 	=> $key,
				'value' => $value,
			)
		));
		return ($data) ? $data->option_id : false;
	}
	
	public function gets_value($key)
	{
		$data = parent::gets(array(
			'select' => array('option_id', 'value'),
			'where' => array('key' => $key),
		));
		return $data;
	}

	public function check_isset_key($key)
	{
		if (!parent::get(array('where' => array('key' => $key)))) {
			return false;
		}
		return true;
	}

	public function set_value($key, $value)
	{
		return parent::create(array('key' => $key, 'value' => $value));
	}

	public function change_value($key, $value)
	{
		return parent::update(array('key' => $key), array('value' => $value));
	}
}