<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index(){
		$this->load->view('header');	
		$this->load->view('login_view');
		$this->load->view('footer');
	}

	public function login(){
		$this->load->model('user_model', 'user');
		$this->form_validation->set_rules('username','username', 'required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	 	 if ($this->form_validation->run() == TRUE) {
	 		$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			$useragent = $this->session->userdata('useragent');
			$data = array(
			"username" => $username,
			"password" => $password,
			);
			$user_id = $this->user->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			$password_encrypt = $this->user->get_password($user_id);
			$password_encrypt = $password_encrypt[0]['salt'];
			$password_decrypt = $this->encrypt->decode($password_encrypt);
			$data['decrypted_password'] = $password_decrypt;
			if (!isset($data['encrypted_password'])){
				$verify_user = $this->user->verify_user($data);
			} else if ($data['password'] == $data['decrypted_password']) {
				$verify_user = TRUE;
			}
			$is_admin = $this->user->is_admin($user_id);
			$is_admin = $is_admin[0]['is_admin'];
			// 1) admin log in
			if ($is_admin == true){
				redirect(base_url('setup_users'));				
			}
			// 2) invalid user - redirect back to login
			if ($verify_user == FALSE){
				$data = array(
					'msg' => '<h4>Invalid username and/or password.</h4>',
					'logged_in' => false
					);
				$this->session->set_userdata($data);
				$this->session->unset_userdata(array("username"=>"","logged_in"=>"","password"=>"","user_id"=>"","msg"=>""));
				$this->session->sess_destroy();
				$this->index();
			// 3) Successful log in - move to admin dashboard 
			} else if ($verify_user == TRUE){
				if ($username == "admin" && $password == "warwick1"){
					$data = array(
					"username" => saul,
					"password" => warwick1,
					"user_id" => 17,
					"msg"=>"",
					"logged_in" => TRUE);
					$this->session->set_userdata($data);
					redirect(base_url('setup_users'));
					// 4) Succesful log in and move to customer dashboard
				} else {
					$user_id = $this->user_model->get_user_id($username);
					$user_id = $user_id[0]['user_id'];

					$data = array(
						"username" => $username,
						"password" => $password,
						"user_id" => $user_id,
						"msg"=>"",
						"logged_in" => TRUE);

					$this->user_model->add_last_login($user_id);

					$this->session->set_userdata($data);
					$session_data = $this->session->all_userdata();
					redirect(base_url('rawdata/index/'.$username)); 
				}
			}
		} else {
			$data = array(
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'error' => validation_errors(),
				'msg' => '<h4> Enter your username and password please.</h4>'
				);
			$this->index();
		}			
	}

	public function logout(){
		$newdata = array(
			'user_id' => '',
			'user_name' => '',
			'user_email' => '',
			'loggin_in' => FALSE,
			);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$this->index();
	}
}

?>