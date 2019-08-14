<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	private $pag_inicial = 0;
	private $pag_maximo = 10;
	private $pag_maximocnt = 9;
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	session_destroy();
		$array_items = array('uID' => '', 'user_email' => '', 'usertype' => '');
		$this->session->unset_userdata($array_items);
		redirect('/login/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */