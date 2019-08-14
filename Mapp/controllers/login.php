<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {

        $this->load->helper('url');
        $this->load->view('login');
    }

    public function auth() {
		
		$name = $_POST['email'];
		$pwd  = $_POST['passwd'];		
		
			$url = 'https://stgapi.ticketstodo.com/merchants/validate';
			$fields = array(
								'email'=>urlencode($name),
								'password'=>urlencode($pwd)
							);

			//url-ify the data for the POST
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string,'&');

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

			//execute post
			$result = curl_exec($ch);
			$json_decode = json_decode($result ,true);
			if($json_decode['error']['code'] == 403){
				echo 'fail';
				//$data = array('message'=>'fail');
				//$this->load->view(login, $data);
			}
			if($json_decode['error']['code'] == 200){
				$newdata = array(
                    'uID' => $json_decode['result'][0]['id'],
                    'user_email' => $json_decode['result'][0]['email'],
                    'user_name' => $json_decode['result'][0]['name']
                );
                $this->session->set_userdata($newdata);
				echo 'suss';
				//redirect('merchant_home', "location");
			}
		
    }
	public function register(){
		
		$registerData['email']			= $_POST['email'];
		$registerData['password']		= $_POST['password'];
		$registerData['name']			= $_POST['name'];
		$registerData['description']	= $_POST['description'];
		$registerData['address']		= $_POST['address'];
		$registerData['telephone']		= $_POST['telephone'];
		$registerData['company_url']	= $_POST['company_url'];
		$registerData['tier']       	= '1';
		$registerData['status']      	= '1';
		$registerData['cities']			= array(
											array(
												"id" 			=>  "1",
												"citycode"		=>  "London",
												"name"			=>	"London",
											),
											array(
												"id" 			=>  "2",
												"citycode"		=>  "NewYork",
												"name"			=>	"NewYork",
											)
										);
		
		$registerDataJSON = json_encode($registerData);
		
		$url = 'https://stgapi.ticketstodo.com/merchants';
		$headers= array('Accept: application/json','Content-Type: application/json');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$registerDataJSON);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

		//execute post
		$result = curl_exec($ch);
		$json_decode = json_decode($result ,true);
		if($json_decode['error']['code'] == 403){
			$data = array('message'=>'fail');
			$this->load->view(login, $data);
		}
		if($json_decode['error']['code'] == 200){
			$newdata = array(
				'uID' => $json_decode['result'][0]['id'],
				'user_email' => $json_decode['result'][0]['email'],
				'user_name' => $json_decode['result'][0]['name']
			);
			$this->session->set_userdata($newdata);
			$recipient = $registerData['email'];
			$subject = 'Successful registeration with TicketsToDo as Merchant';
			$message = 'Hi '.$registerData['name'].', </br> Thank you for registering with TicketsToDo. We are here to help. ';
			$this->register_mail($recipient, $subject, $message);
			redirect('merchant_home', "location");
		}
	}
	
	public function register_mail($recipient, $subject, $message){
         $to       = $recipient;
         $subject  = $subject;
         $message  = "<b>Merchant Registration.</b>";
         $message .= "<p>".$message."</p>";
         $header   = "From:noreply@ticketstodo.com \r\n";
         $header  .= "MIME-Version: 1.0\r\n";
         $header  .= "Content-type: text/html\r\n";
         
         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully..."; exit;
         } else {
            echo "Message could not be sent..."; exit;
         }
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
