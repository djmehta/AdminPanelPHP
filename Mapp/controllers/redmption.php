<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Redmption extends CI_Controller {

    public function index() {

        $this->load->helper('url');
    }

    public function redeem_voucher() {
		
		$this->load->view('include/header');
		$this->load->view('redeem_vouchers');
        $this->load->view('include/footer');
    }
	public function get_redmption() {
		
		$this->load->view('include/header');
		$this->load->view('list_redmption');
        $this->load->view('include/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
