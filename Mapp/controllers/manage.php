<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage extends CI_Controller {

    public function index() {

        $this->load->helper('url');
    }

    public function manage_booking() {
		
		$this->load->view('include/header');
		$this->load->view('manage_bookings');
        $this->load->view('include/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
