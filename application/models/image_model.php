<?php
class image_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_images(){
		$goods = $this->db->get('images');
		return $goods->result_array();
	}
	public function get_image_by_id($id){
		$good = $this->db->get_where('images',array('id' => $id));
		return $good->result();
	}
	public function get_image_by_itemId($id){
		$good = $this->db->get_where('images',array('itemId' => $id));
		return $good->result();
	}
	public function insert_image($data){
		$res = $this->db->insert("images",$data);
		if($res){
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}
}
