<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant_activities extends CI_Controller {

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

	public function index()
	{	
		$this->chk_sess();
        $this->load->helper('url');
        $this->load->view('include/header');
        $this->load->view('include/footer');
	}
	
	// Get Citites for the dropdown for the Add Activity form
	public function get_cities(){
		$url= 'https://stgapi.ticketstodo.com/cities';

		$cities = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $cities );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		return $json_decode['result'];
	}
	
	
	// Get City by Id for the dropdown for the Add Activity form
	public function get_city_by_id($cityid){
		$url= 'https://stgapi.ticketstodo.com/cities/'.$cityid;

		$city = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $city );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		return $json_decode['result'][0];
	}
	
	// Display list of all merchants
	public function display_all_merchants(){
		$url= 'https://stgapi.ticketstodo.com/merchants';

		$merchants = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $merchants );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		
		$data['merchants_data']	= $json_decode['result'];
		$data['city_data']			= $this->get_city_by_id($json_decode['result'][0]['city_id']);
		$data['merchant_data']		= $this->get_merchant_by_id($json_decode['result'][0]['merchant_id']);
		$this->load->view('include/header');
		$this->load->view('list_all_merchants',$data);
        $this->load->view('include/footer');
	}
	
	
	// Get Countries for the dropdown for the Add Activity form
	public function get_countries(){
		$url= 'https://stgapi.ticketstodo.com/countries';

		$countries = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $countries );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
	}
	
	
	// Get Currencies for the dropdown for the Add Activity form
	public function get_currencies(){
		$url= 'https://stgapi.ticketstodo.com/currencies';

		$currencies = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $currencies );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
	}
	
	// Get Banner for the dropdown for the Add Activity form
	public function get_banner(){
		$url= 'https://stgapi.ticketstodo.com/banner';

		$banner = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $banner );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
	}
	
	
	// Display list of all activities by Merchant
	public function display_all_activities(){
		$url= 'https://stgapi.ticketstodo.com/activities';

		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		
		$data['activities_data']	= $json_decode['result'];
		$data['city_data']			= $this->get_city_by_id($json_decode['result'][0]['city_id']);
		$data['merchant_data']		= $this->get_merchant_by_id($json_decode['result'][0]['merchant_id']);
		$this->load->view('include/header');
		$this->load->view('list_all_activities',$data);
        $this->load->view('include/footer');
	}
	
	public function get_activities(){
		$url= 'https://stgapi.ticketstodo.com/activities';

		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		
		return $json_decode['result'];
		
	}
	
	// Get Merchant details by ID
	public function get_merchant_by_id($merchantid){
		$url= 'https://stgapi.ticketstodo.com/merchants/'.$merchantid;

		$merchant = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		

		$ch = curl_init( $url );
		curl_setopt_array( $ch, $merchant );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		return $json_decode['result'][0];
	}
	
	// Add an Activity for a Merchant
	public function add_activity(){
		$data['cities_data']	= $this->get_cities();
		$this->load->view('include/header');
		$this->load->view('add_activity', $data);
        $this->load->view('include/footer');
	}
	
	// Post an Activity for a Merchant through API
	public function post_merchant_activity(){
		$_POST['activity_id'] 		= '';
		$_POST['merchant_id'] 		= $this->session->userdata('uID');
		$_POST['status'] 			= 0;
		$_POST['activity_images'] 	= 1;
		$_POST['activity_videos'] 	= 1;
		$_POST['type'] 				= 'open';
		$_POST['calltoaction'] 		= 'Not Required';
		$_POST['created_at'] 		= date("Y-m-d H:i:s");
		$_POST['updated_at'] 		= date("Y-m-d H:i:s");
		$_POST['images'] 			= array(
										array(
											"activity_id" 	=> "",
											"image_url"		=>	"https://stgimgs.ticketstodo.com/imgs/200-200/u/uploadimage.jpg",
											"description"	=>	"Images for  better understanding of activity",
											"filename"		=>	"uploadimage.jpg",
											"mime_type"		=>	"image/jpeg",
											"file_type"		=>	"image",
										),
										array(
											"activity_id" 	=> "",
											"image_url"		=>	"https://stgimgs.ticketstodo.com/imgs/200-200/u/uploadimage.jpg",
											"description"	=>	"Images for  better understanding of activity",
											"filename"		=>	"uploadimage.jpg",
											"mime_type"		=>	"image/jpeg",
											"file_type"		=>	"image",
										)
									);
		$_POST['videos'] 			= array(
										array(
											"activity_id" 	=> "",
										"video_url"	=>"https://stgimages.ticketstodo.com/show_video.php?filename=3052397_VIDEO_HIGH_H264.mp4",
											"description"	=>	"Images for  better understanding of activity",
											"filename"		=>	"3052397_VIDEO_HIGH_H264.mp4",
											"mime_type"		=>	"video/mp4",
											"file_type"		=>	"video",
										)
									);
		
		// $activityData['activity_id']		= $_POST['activity_id'];
		$activityData['merchant_id']		= $_POST['merchant_id'];
		$activityData['name']				= $_POST['name'];
		$activityData['neighborhood']		= $_POST['neighborhood'];
		$activityData['address']			= $_POST['address'];
		$activityData['city_id']			= 2;
		$activityData['type']				= $_POST['type'];
		$activityData['status']				= $_POST['status'];
		$activityData['venue_location']		= $_POST['venue_location'];
		$activityData['google_map_link']	= $_POST['google_map_link'];
		$activityData['location_map']		= $_POST['location_map'];
		// $activityData['activity_images']	= $_POST['activity_images'];
		// $activityData['activity_videos']	= $_POST['activity_videos'];
		// $activityData['cashtip']			= $_POST['cashtip'];
		$activityData['tip1']				= $_POST['tip1'];
		$activityData['tip2']				= $_POST['tip2'];
		$activityData['calltoaction']		= $_POST['calltoaction'];
		$activityData['reviews']			= $_POST['reviews'];
		// $activityData['created_at']			= $_POST['created_at'];
		// $activityData['updated_at']			= $_POST['updated_at'];
		$activityData['images']				= $_POST['images'];
		$activityData['videos']				= $_POST['videos'];
		
		// print_r($activityData); exit;
		
		// print_r(json_encode($activityData)); exit;
		
		$activityDataJSON = json_encode($activityData);
		
		$url = 'https://stgapi.ticketstodo.com/activities';
		$headers= array('Accept: application/json','Content-Type: application/json');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$activityDataJSON);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

		//execute post
		$result = curl_exec($ch);
		
		// print_r($result); exit;
		
		$json_decode = json_decode($result ,true);
		if($json_decode['error']['code'] == 403){
			$data = array('message'=>'fail');
			redirect('merchant_activities/display_all_activities', "location");
		}
		if($json_decode['error']['code'] == 200){
			$data = array('message'=>'activity_added');
			redirect('merchant_activities/display_all_activities', "location");
		}
	}
	
	// Edit an Activity for a Merchant
	public function edit_activity(){
		$url= 'https://stgapi.ticketstodo.com/activities/'.$_GET['id'];

		$activity = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $activity );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		// echo '<pre>';
		// print_r($json_decode['result'][0]);
		
		$data['activity_data'] 	= $json_decode['result'][0];
		$data['city_data']		= $this->get_city_by_id($json_decode['result'][0]['city_id']);
		$data['cities_data']	= $this->get_cities();
		$this->load->view('include/header');
		$this->load->view('edit_activity', $data);
        $this->load->view('include/footer');
	}
	
	
	// Display list of all packages by Merchant
	public function display_all_packages(){
		$url= 'https://stgapi.ticketstodo.com/packages';

		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		
		
		$data['packages_data']	= $json_decode['result'];
		// print_r($data); exit; 
		// $data['city_data']			= $this->get_city_by_id($json_decode['result'][0]['city_id']);
		// $data['merchant_data']		= $this->get_merchant_by_id($json_decode['result'][0]['merchant_id']);
		$this->load->view('include/header');
		$this->load->view('list_all_packages',$data);
        $this->load->view('include/footer');
	}
	
	// Add an Package for a Merchant
	public function add_package(){
		$data['cities_data']	= $this->get_cities();
		$data['activity_data']	= $this->get_activities();
		$data['categories_data']	= $this->get_categories();
		$this->load->view('include/header');
		$this->load->view('add_package', $data);
        $this->load->view('include/footer');
	}
	
	// Edit an Package for a Merchant
	public function edit_package(){
		$url= 'https://stgapi.ticketstodo.com/packages/'.$_GET['id'];

		$package = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "ticketstodo", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $package );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);
		// echo '<pre>';
		// print_r($json_decode['result'][0]);
		
		$data['package_data'] 	= $json_decode['result'][0];
		/* $data['city_data']		= $this->get_city_by_id($json_decode['result'][0]['city_id']);
		$data['cities_data']	= $this->get_cities(); */
		$this->load->view('include/header');
		$this->load->view('edit_package', $data);
        $this->load->view('include/footer');
	}
	
	public function get_categories(){
		$url= 'https://stgapi.ticketstodo.com/categories';

		$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_USERAGENT      => "ticketstodo", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		curl_close( $ch );
		$json_decode = json_decode($content,true);

		return $json_decode['result'];

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */