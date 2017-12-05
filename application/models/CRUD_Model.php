<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class CRUD_Model extends CI_Model
{

	/*
	 | 
	 | List Content
	 | 
	 | create()
	 | create_bulk()
	 | gets()
	 | get()
	 | gets_view()
	 | get_view()
	 | update()
	 | delete()
	 | 
	*/

	protected $table_name = false;
	protected $table_view_name = false;
	protected $primary_key = false;
	public $read_limit = false;

	function __construct()
	{
		parent::__construct();
	}

	public function create( $args )
	{
		$this->db->trans_start();
		$this->db->insert($this->table_name, $args);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		
		return $insert_id;
	}
	
	public function create_bulk( $args )
	{
		$this->db->insert_batch($this->table_name, $args); 
	}

	public function gets( $args = array(), $from_view_table = false  ){
		
		if( !is_array( $args ) ) $args = array();

		$defaults = array(
			'select'        => false,
			'limit'         => $this->read_limit,
			'start'         => 0,
			'where'         => array(),
			'where_in'      => array(),
			'where_not_in'  => array(),
			'or_where'      => array(),
			'between'       => array(),     // array('field_name' => array('start_between', 'end_between'))
			'group_by'      => false,       // 'field_name'
			'order_by'      => false,       // array('field_name' => 'ASC|DESC')
			'join'          => false,       // array()
			'left_join' 	=> false,       // array()
			'like'          => false,       // array()
		);
		
		$args = array_merge($defaults, $args);
		extract( $args );
		
		if( count( $where ) > 0 ){

			if( isAssoc( $where ) ){
				foreach( $where as $w_key=>$w_val ){
					$this->db->where( $w_key, $w_val );
				}
			}else{
				foreach( $where as $w_val ){
					$this->db->where( $w_val);
				}
			}
		} 

		if( count( $where_in ) > 0 ){
			foreach( $where_in as $wi_key => $wi_val ){
				$this->db->where_in( $wi_key, $wi_val );
			}
		} 
			
		if( count( $where_not_in ) > 0 ){

			if( isAssoc( $where_not_in ) ){
				foreach( $where_not_in as $wni_key=>$wni_val ){
					$this->db->where_not_in( $wni_key, $wni_val );
				}
			}else{
				foreach( $where_not_in as $wni_val ){
					$this->db->where_not_in( $wni_val);
				}
			}
		} 
		
		if( !is_array($or_where) ){
			$this->db->or_where( $or_where );
		}else{
			if( count( $or_where ) > 0 ) {
				if( isAssoc( $or_where ) ){
					foreach( $or_where as $ow_key=>$ow_val ){
						$this->db->or_where( $ow_key, $ow_val);
					}
				}else{
					foreach( $or_where as $ow_val ){
						$this->db->or_where( $ow_val);
					}
				}
			}
		}
		

		if( $limit !== false ){
			$this->db->limit( $limit, $start );
		}

		if( !is_array($where) ){
			$this->db->where( $this->primary_key, $id );
		}
		
		if( count( $between ) > 0 ) foreach( $between as $bw_key=>$bw_val ){
			$this->db->where( $bw_key . " >= '" . $bw_val[0] . "' AND " . $bw_key . " <= '" . $bw_val[1] . "'");
		}

		if( $group_by ) {
			$this->db->group_by($group_by);
		}

		if( $order_by ) {
			foreach ($order_by as $ob_key => $ob_val) {
				$this->db->order_by($ob_key, $ob_val);
			}
		}

		if( $join ){
			foreach ($join as $join_key => $join_value) {
				$this->db->join($join_key, $join_value);
			}
		}

		if( $left_join ){
			foreach ($left_join as $join_key => $join_value) {
				$this->db->join($join_key, $join_value, 'left');
			}
		}

		if( $like ){
			foreach ($like as $like_key => $like_value) {
				$this->db->like($like_key, $like_value);
			}
		}

		if( !$select ){
			$this->db->select('*');
		}else{
			$this->db->select($select);
		}

		if( is_string($from_view_table) )
			$this->db->from( $from_view_table );
		elseif( $from_view_table )
			$this->db->from( $this->table_view_name );
		else 
			$this->db->from( $this->table_name );

		$query = $this->db->get();
		return $query->result();
	}

	public function get( $args = array(), $from_view_table = false ){
		if( is_array($args) ){
			if( $data = $this->gets($args, $from_view_table) ){
				return $data[0];
			}
			
			return false;
		}else{
			if ($data = $this->gets(array('where' => array($this->primary_key => $args)), $from_view_table)) {
				return $data[0];
			}

			return false;
		}
	}
	
	public function gets_view($args = array(), $view = true)
	{
		return $this->gets($args, $view);
	}

	public function get_view($args = array(), $view = true)
	{
		return $this->get($args, $view);
	}

	public function update( $id, $args )
	{
		if( is_array($id) ){
			$update_where = $id; 
		}else{
			$update_where = array($this->primary_key => $id); 
		}

		$this->db->where($update_where);
		$this->db->update($this->table_name, $args);
		
		return $id;
	}
	
	public function delete( $id )
	{
		if( is_array($id) ){
			$delete_where = $id; 
		}else{
			$delete_where = array($this->primary_key => $id); 
		}

		$this->db->delete( $this->table_name, $delete_where );
	}

	public function check_isset( $field, $data )
	{
		return (($this->get(array('where' => array($field => $data)))) ? true : false);
	}
	
}