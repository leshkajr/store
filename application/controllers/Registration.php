<?php
class Registration extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('customer_model');
	}
	public function index()
	{
		$data['action_page'] = "Registration";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('login', 'login',
			"trim|max_length[30]|min_length[5]|is_unique[customers.login]",
			array("is_unique" => "<span class='error' title='This %s already in use'>&#128711;</span>", "min_length" => "<span class='error' title='Field {field} must contain {param} characters'>&#128711;</span>"));

		$this->form_validation->set_rules('password', 'email', 'required');
		$this->form_validation->set_rules('repeat_password', 'пароль', 'required|matches[password]',array("matches" => "Passwords do not match"));

		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[customers.email]',
			array("is_unique" => "<span class='error' title='This %s already in use'>&#128711;</span>"));
		if ($this->form_validation->run() === false) {
			$this->load->view('registration',$data);
		} else {
			$data['success'] = "Successfully registered.";
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$customer = array("Login" => $login, "Password" => $password, "Email" => $email, "RoleId" => 2);
			$customerId = $this->customer_model->insert_customer($customer);
			if (isset($customerId)) {
				$data['message'] = "You have successfully registered.";
				$this->session->set_userdata(array('customerId' => $customerId,'login' => $login,'roleId' => 2));
			}
			$this->load->view('registration', $data);
		}
	}
}
