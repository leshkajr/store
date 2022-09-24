<?php
	class category_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function get_categories(){
			$categories = $this->db->get('categories');
			return $categories->result_array();
		}
		public function get_category($id){
			$category = $this->db->get_where('categories',array('id' => $id));
			return $category->result();
		}
		public function get_category_by_name($name){
			$category = $this->db->get_where('categories',array('categoryName' => $name));
			return $category->result();
		}
		public function insert_category($category){
			$this->db->insert('categories',$category);
			$id = $this->db->insert_id();
			return $id;
		}
	}
