<?php
class Shop extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('good_model');
		$this->load->model('category_model');
//		$this->load->model('image_model');
		$this->load->model('customer_model');
	}
	public function index() {
		self::catalog();
	}
	public function catalog(){
		$data['action_page'] = "Catalog";
		$search_submit = $this->input->post('search_submit');
		$authorization_submit = $this->input->post('authorization');
		if(isset($authorization_submit)){
			$res = $this->customer_model->get_where(array('login'=>$this->input->post('login'),'password'=>$this->input->post('password')))[0];
			if($res !== null){
				$this->session->set_userdata(array('customerId' => $res->id,'login' => $res->login,'roleId' => $res->roleId));
			}
			else{
				modal_show("Error",$res);
			}
		}
		if(isset($search_submit)){
			$search = $this->input->post('search_input');
			$res = $this->good_model->get_goods_by_name($search);
			$data['search'] = $search;
			if($res !== false){
				$data['goods'] = $res;
			}
			else{
				$data['goods'] = array();
			}
			$data['customerId'] = $this->session->userdata('customerId');
			$data['roleId'] = $this->session->userdata('roleId');
			$data['login'] = $this->session->userdata('login');
			$this->load->view("Catalog",$data);
		}
		else{
			$data['goods'] = $this->good_model->get_goods();
			$this->load->view("Catalog",$data);
		}

	}
	public function customers(){
		$data['customers'] = $this->customer_model->get_customers();
		$this->load->view("Customers",$data);
	}
}
