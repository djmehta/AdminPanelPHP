<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index() {

        $this->load->helper('url');
    }

    public function change_pwd() {
		
		$this->load->view('include/header');
		$this->load->view('change_password');
        $this->load->view('include/footer');
    }
	public function change_user_pwd(){
		
		$userData['email']        = $_POST['email'];
		$userData['new_password'] = $_POST['new_password'];
		$userData['old_password']  = $_POST['old_password'];
		
		$userDataJSON = json_encode($userData);
		
		$url = 'https://stgapi.ticketstodo.com/merchants/changepassword';
		$headers= array('Accept: application/json','Content-Type: application/json');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$userDataJSON);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

		//execute post
		$result = curl_exec($ch);		
		$json_decode = json_decode($result ,true);
		if($json_decode['error']['code'] == 403){
				if(!empty($json_decode['error']['message']['old_password'][0])){
				 $data = array('message'=>'wrong_old_password');
				 $this->load->view('include/header');
				 $this->load->view('change_password',$data);
				 $this->load->view('include/footer');	
				}
				
			}
			if($json_decode['error']['error_code'] == 403){
				 $data = array('message'=>'wrong_email_old_password');
				 $this->load->view('include/header');
				 $this->load->view('change_password',$data);
				 $this->load->view('include/footer');
				
			}
			if($json_decode['error']['code'] == 200){
				 $data = array('message'=>'suss');
				 $this->load->view('include/header');
				 $this->load->view('change_password',$data);
				 $this->load->view('include/footer');	
			}
		
		
			
	}
	
	public function forgot_password(){
		
		$userData['to'] = $_POST['email'];
		$userData['action_url'] = "https://stgstatic.ticketstodo.com/test";
		$userData['operating_system'] = "Windows 7";
		$userData['browser_name'] = "Mozzila";
		$userData['name'] = "Abhishek Agrawal";
		$userData['support_url'] = "https://support.ticketstodo.com/hc/en-us/requests/new";
		
		$userDataJSON = json_encode($userData);
		//print_r($userDataJSON); exit;
		$url = 'https://stgapi.ticketstodo.com/resetpassword';
		$headers= array('Accept: application/json','Content-Type: application/json');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$userDataJSON);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

		//execute post
		$result = curl_exec($ch);		
		$json_decode = json_decode($result ,true);
		    if($json_decode['error']['error_code'] == 403){
				echo 'error';
			}
			if($json_decode['error']['code'] == 502){
				echo 'inactive';
			}
			if($json_decode['error']['error_code'] == 200){
				echo 'success';
			}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
