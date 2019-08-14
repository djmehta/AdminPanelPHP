<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant_home extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
                
	}

	public function chk_sess() {
        $user_id = $this->session->userdata('uID');
        if (isset($user_id) && $user_id > 0) {
            return true;
        } else {
            redirect('login/');
        }
    }

	public function logout() {
        session_destroy();
        $array_items = array('uID' => '', 'user_email' => '', 'usertype' => '');
        $this->session->unset_userdata($array_items);
        redirect('/login/');
    }
	
	public function index()
	{	
		$this->chk_sess();
        $this->load->helper('url');
        $this->load->view('include/header');
	
		$this->load->view('merchant_home');
        $this->load->view('include/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */