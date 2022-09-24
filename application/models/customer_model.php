<?php
class customer_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_customers(){
		$customers = $this->db->get('customers');
		return $customers->result_array();
	}
	public function get_customer($id){
		$customer = $this->db->get_where('customers',array('id' => $id));
		return $customer->result();
	}
	public function get_where($options){
		$customer = $this->db->get_where('customers',$options);
		return $customer->result();
	}
	public function insert_customer($customer){
		$this->db->insert('customers',$customer);
		$id = $this->db->insert_id();
		return $id;
	}
}
