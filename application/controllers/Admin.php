<?php
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("category_model");
		$this->load->model("customer_model");
		$this->load->model("good_model");
		$this->load->model("image_model");
	}
	public function index() {
		header('Location: index.php/admin/panel');
	}
	// добавление категорий и товаров
	public function panel(){
		$submit = $this->input->post('category_submit');
		if(isset($submit)){
			$this->category_model->insert_category(array('categoryName'=> $this->input->post('category_input')));
		}
		else{
			$submit = $this->input->post('good_submit');
			if(isset($submit)){
				$good = array('itemName'=> $this->input->post('good_input'),
					'categoryId'=> $this->input->post('category_select'),
					'priceIn'=> $this->input->post('price_input'),
					'priceSale'=> $this->input->post('price_input')
					);
				$this->good_model->insert_good($good);
			}
		}
		$data['action_page'] = "Admin";
		$data['categories'] = $this->category_model->get_categories();
		$data['goods'] = $this->good_model->get_goods_with_category();
		$this->load->view('AddGoods',$data);
	}
	public function upload()
	{
		$data['action_page'] = "Admin";
		$id = $this->input->get('id');
		$data['good'] = $this->good_model->get_good_by_id($id);
//		$this->load->view('AddImage', $data);


		$send=$this->input->post('send');
		if(!$send)
			$this->load->view('AddImage', $data);
		else
		{
			$config['upload_path'] = './contents/images/';
			$config['allowed_types'] ='gif|jpg|png|jpeg';
			$config['max_size'] = 2048;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$this->load->library('upload', $config);
			$number_of_files = count($_FILES['upfile']['tmp_name']);
			$files = $_FILES['upfile'];
			$error = array();
			$success = array();
			for ($i = 0; $i < $number_of_files; $i++)
			{
				$_FILES['upfile']['name'] =$files['name'][$i];
				$_FILES['upfile']['type'] =$files['type'][$i];
				$_FILES['upfile']['tmp_name'] =$files['tmp_name'][$i];
				$_FILES['upfile']['error'] = $files['error'][$i];
				$_FILES['upfile']['size'] =$files['size'][$i];
				if($_FILES['upfile']['error'] != 0)
				{
					$error['msg'.$i]='Not uploaded file '.$_FILES['upfile']['name'][$i];
					continue;
				}
				if (!$this->upload->do_upload('upfile'))
				{
					$error['msg'.$i]= 'Not uploaded file'.$_FILES['upfile']['name'][$i];
				}
				else
				{
					$final_files_data[] = $this->upload->data();
					$info = array('upload_data' =>$this->upload->data());
					$path='contents/images/';
					$image=array('itemId'=>$id,'imagePath'=>$path.$info['upload_data']['file_name']);
					$itemId=$this->image_model->insert_image($image);
					$success['msg'.$i]= 'Successfuly inserted new image';
				}
			}
			$data['error']=$error;
			$data['success']=$success;
			$this->load->view('AddImage',$data);
		}
	}
}
