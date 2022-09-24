<?php
class good_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_goods(){
		$goods = $this->db->get('items');
		return $goods->result_array();
	}
	public function get_goods_with_category(){
		$goods = $this->db->query('SELECT items.id, categoryName, itemName,priceIn,priceSale,info,rate,imagepath,action FROM items,categories WHERE categories.Id = items.categoryId;');
		return $goods->result_array();
	}
	public function get_good_by_id($id){
		$good = $this->db->get_where('items',array('id' => $id));
		return $good->result()[0];
	}
	public function get_goods_by_categoryId($id){
		$good = $this->db->get_where('items',array('categoryId' => $id));
		return $good->result_array();
	}
	public function get_goods_by_name($name){
		$good = $this->db->get_where('items',array('itemName' => $name));
		return $good->result_array();
//		$goods = $this->db->get('items');
//		$result = array();
//		echo $name;
//		foreach ($goods->result_array() as $good){
//			var_dump($good['itemName']);
//			if(str_contains($good['itemName'],$name)){
//				var_dump($good);
//				$result[] = $good;
//			}
//		}
//		if(!empty($result)){
//			return $result;
//		}
//		else{
//			return false;
//		}
	}
	public function insert_good($good){
		$this->db->insert('items',$good);
		$id = $this->db->insert_id();
		return $id;
	}
}
