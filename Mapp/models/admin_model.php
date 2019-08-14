<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_login_details($username, $passwd) {
        $password = $passwd;
        $this->db->select('id, email');
        $query = $this->db->get_where('TBL_ADMIN', array('email' => $username, 'password' => md5($password)), 1);
        return $query->result_array();
    }

	/**
	This function returns admin selected top 10 Audios
	*/
	public function get_top_audio()
	{
		$this->db->select('TBL_TOP20_AUDIOS.id, TBL_TOP20_AUDIOS.content_id, TBL_TOP20_AUDIOS.listing_index, tbl_songs.title, tbl_songs.description');
		$this->db->from('TBL_TOP20_AUDIOS');
		$this->db->join('tbl_songs', 'tbl_songs.metasea_id = TBL_TOP20_AUDIOS.content_id', 'left');
		$this->db->order_by('TBL_TOP20_AUDIOS.listing_index','asc');
		$query = $this->db->get();
        return $query->result_array();
	
	}
	
	/**
	This function returns admin selected top 10 Videos
	*/
	public function get_top_video()
	{
		$this->db->select('TBL_TOP20_VIDEOS.id, TBL_TOP20_VIDEOS.content_id, TBL_TOP20_VIDEOS.listing_index, tbl_videos.title');
		$this->db->from('TBL_TOP20_VIDEOS');
		$this->db->join('tbl_videos', 'tbl_videos.metasea_id = TBL_TOP20_VIDEOS.content_id', 'left');
		$this->db->order_by('TBL_TOP20_VIDEOS.listing_index','asc');
		$query = $this->db->get();
        return $query->result_array();
	}

	/**
	This function returns audio content details based on ids. 
	I/p: Array of content ids
	*/
	public function get_audio_details($audio_ids)
	{
		//print_r($audio_ids);exit;
		$this->db->select('metasea_id, title, description');
		$this->db->from('tbl_songs');
		$this->db->where_in('metasea_id', $audio_ids);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	This function returns video content details based on ids. 
	I/p: Array of content ids
	*/
	public function get_video_details($video_ids)
	{
		//print_r($video_ids);exit;
		$this->db->select('metasea_id, title');
		$this->db->from('tbl_videos');
		$this->db->where_in('metasea_id', $video_ids);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	This function returns audio content details based on keyword. 
	I/p: search keyword
	*/
	public function search_top_audios($keyword)
	{
		//echo "123";exit;
		$this->db->select('metasea_id, title');
		$this->db->from('tbl_songs');
		$this->db->like('title', $keyword);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	This function returns video content details based on keyword. 
	I/p: search keyword
	*/
	public function search_top_videos($keyword)
	{
		//echo "123";exit;
		$this->db->select('metasea_id, title');
		$this->db->from('tbl_videos');
		$this->db->like('title', $keyword);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	This function updates the admin selected top 10 audio list 
	I/p: Comma separated content ids
	*/
	public function update_top_audios($song_ids)
	{
		$au_ids = array();
		$au_ids = explode(',', $song_ids);
		//print_r($au_ids);
		
		$listing_in = array();
		foreach($au_ids as $in => $au_id)
		{
			$listing_in[$au_id] = $in;
		}
		//print_r($listing_in);

					
		foreach($au_ids as $key => $song_info)
		{
			$content_id = $song_info;
					
			$data = array(
						   'content_id' => $content_id,
						   'admin_id' => $this->session->userdata('uID'),
						   'listing_index' => $listing_in[$content_id]+1,
						   'ip_address' => $this->input->ip_address(),
						   'record_date' => date("Y-m-d h:i:s")
						);

			//print_r($data);
			
			$this->db->update('TBL_TOP20_AUDIOS', $data, array('id' => $key+1));
			unset($data);
		}
		
		unset($listing_in);
		unset($au_ids);
		
	}

	/**
	This function updates the admin selected top 10 audio list 
	I/p: Comma separated content ids
	*/
	public function update_top_videos($song_ids)
	{
		$vid_ids = array();
		$vid_ids = explode(',', $song_ids);
		//print_r($vid_ids);
		
		$listing_in = array();
		foreach($vid_ids as $in => $vid_id)
		{
			$listing_in[$vid_id] = $in;
		}
		//print_r($listing_in);

					
		foreach($vid_ids as $key => $song_info)
		{
			$content_id = $song_info;
					
			$data = array(
						   'content_id' => $content_id,
						   'admin_id' => $this->session->userdata('uID'),
						   'listing_index' => $listing_in[$content_id]+1,
						   'ip_address' => $this->input->ip_address(),
						   'record_date' => date("Y-m-d h:i:s")
						);

			//print_r($data);
			
			$this->db->update('TBL_TOP20_VIDEOS', $data, array('id' => $key+1));
			unset($data);
		}
		
		unset($listing_in);
		unset($vid_ids);
		
	}

   /* public function get_student_list($end, $start, $srch) {
        $this->db->select('id_user, login_email, password, secondary_email, firstname, lastname, displayname, DATE_FORMAT(join_date,"%b %D %Y") AS join_date, program, prm_start_year, prm_end_year', FALSE);
        $this->db->from('gp_users');
        if ($srch != '') {
            $this->db->like('login_email', $srch, 'both');
            $this->db->or_like('secondary_email', $srch, 'both');
            $this->db->or_like('firstname', $srch, 'both');
            $this->db->or_like('lastname', $srch, 'both');
            $this->db->or_like('displayname', $srch, 'both');
            $this->db->or_like('join_date', $srch, 'both');
            $this->db->or_like('program', $srch, 'both');
            $this->db->or_like('prm_start_year', $srch, 'both');
            $this->db->or_like('prm_end_year', $srch, 'both');
        }
        $this->db->limit($start, $end);
        $query = $this->db->get();
        //$this->output->enable_profiler(TRUE);
        return $query->result_array();
    }

    public function count_student_list($srch) {
        $this->db->select('id_user');
        $this->db->from('gp_users');
        if ($srch != '') {
            $this->db->like('login_email', $srch, 'both');
            $this->db->or_like('secondary_email', $srch, 'both');
            $this->db->or_like('firstname', $srch, 'both');
            $this->db->or_like('lastname', $srch, 'both');
            $this->db->or_like('displayname', $srch, 'both');
            $this->db->or_like('join_date', $srch, 'both');
            $this->db->or_like('program', $srch, 'both');
            $this->db->or_like('prm_start_year', $srch, 'both');
            $this->db->or_like('prm_end_year', $srch, 'both');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_student_details($usr_id) {
        $this->db->select('id_user, login_email, password, login_email, firstname, lastname, displayname, DATE_FORMAT(join_date,"%b %D %Y") AS join_date, program, prm_start_year, prm_end_year');
        $this->db->where('id_user', $usr_id);
        $query = $this->db->get('gp_users');
        return $query->result_array();
    }

    public function CurrentAccedamicDetails($usr_id) {
        $this->db->select("*");
        $this->db->from('gp_university u');
        $this->db->join('gp_studentclass g', 'g.uni_id = u.uni_id ');
        $query = $this->db->where('g.userid', $usr_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_details_edit($usr_id) {
        $this->db->select('id_user, login_email, password, secondary_email, firstname, lastname, displayname, DATE_FORMAT(join_date,"%d-%m-%Y") AS join_date, program, prm_start_year, prm_end_year');
        $this->db->where('id_user', $usr_id);
        $query = $this->db->get('gp_users');
        return $query->result_array();
    }

    public function get_student_app_details($usr_id) {
        $this->db->select('module, module_action');
        $this->db->where('id_user', $usr_id);
        $this->db->from('gp_module_rights');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_student_details($PostArr) {
        $jid = $PostArr['Val'] . $PostArr['val1'] . '@api.gradmoz.com';
        $data = array(
            'login_email' => $PostArr['val3'],
            'firstname' => $PostArr['val1'],
            'lastname' => $PostArr['val2'],
            'displayname' => $PostArr['val5'],
            'program' => $PostArr['val7'],
            'prm_start_year' => $PostArr['val8'],
            'prm_end_year' => $PostArr['val9'],
            'jid' => $jid
        );
        if ($PostArr['val4'] != '') {
            $data = array(
                'password' => md5($PostArr['val4'])
            );
        }

        $this->db->where('id_user', $PostArr['Val']);
        $this->db->update('gp_users', $data);
        return $company_id;
    }

    public function delete_student_details($usr_id) {
        $this->db->where('id_user', $usr_id);
        $this->db->delete('gp_users');
    }

    public function delete_user_App_Rights($usr_id) {
        $this->db->where('id_user', $usr_id);
        $this->db->delete('gp_module_rights');
    }

    public function Insert_App_Rights($usr_id, $module, $action) {
        $User_data = array(
            'id_user' => $usr_id,
            'module' => $module,
            'module_action' => $action
        );

        $this->db->insert('gp_module_rights', $User_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function Insert_CSV_File($FileName, $module) {
        $User_data = array(
            'filename' => $FileName,
            'module' => $module
        );

        $this->db->insert('gp_file_upload', $User_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function Get_Csv_File($Fileid) {
        $this->db->select('filename');
        $this->db->where('id', $Fileid);
        $this->db->from('gp_file_upload');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function Insert_Student_Data($PostArr)
	{
		if($PostArr['f'] == '')
		{
			$joinDate = date('Y-m-d H:i:s');
		}
		else
		{
			$joinDate = $PostArr['f'];
		}
		$password = md5($PostArr['e']);
		$User_data = array(
		'login_email' => $PostArr['d'] ,
		'password' => $password ,
		'firstname' => $PostArr['a'] ,
		'lastname' => $PostArr['b'] ,
		'displayname' => $PostArr['c'] ,
		'join_date' => $joinDate ,
		'program' => $PostArr['g'] ,
		'prm_start_year' => $PostArr['h'] ,
		'prm_end_year' => $PostArr['i']
		);
		$this->db->select('login_email'); 
        $this->db->from('gp_users');
        $query = $this->db->where('login_email', $PostArr['d']);
        $query = $this->db->get();
        $results = $query->num_rows();
        If ($results > 0) {
            return 'p';
        } else{
		$this->db->insert('gp_users', $User_data);
		$insert_id = $this->db->insert_id();

		$jid = $insert_id.$PostArr['a'].'@api.gradmoz.com';

		$datajid = array(
		'jid' => $jid
		);
		
		$username = $insert_id.$PostArr['a'];
		$pass = $PostArr['e'];
		//$url="http://api.gradmoz.com:9090/plugins/userService/userservice?type=add&secret=ygw9D4op&username=100sandy&password=1234567890";
		$xmlcall = file_get_contents("http://api.gradmoz.com:9090/plugins/userService/userservice?type=add&secret=ygw9D4op&username=		$username&password=$pass");
		
		$this->db->where('id_user', $insert_id);
		$this->db->update('gp_users', $datajid);
           }
		return $username;
	}

    

    public function Insert_news_Data($PostArr) {
        $User_data = array(
            'news_type' => '2',
            'title' => $PostArr['a'],
            'news' => $PostArr['b'],
            'published' => $PostArr['c']
        );

        $this->db->insert('gp_news', $User_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function Insert_event_Data($PostArr) {
        
        $now = date("Y-m-d H:i:s");
        $User_data = array(
             'title' => $PostArr['a'],
             'description' => $PostArr['b'],
             'cat_id' => $PostArr['c'],
             'ct_datetime' => $now,
             'ct_duration' => $PostArr['e'],
             'org_id' => '11',
             'creator_id' => '11',
             'hours_24' => '1',
             'ct_duration' => $PostArr['e'],
             'location' => $PostArr['f'],
             'edit_allow'=>'1',
             'timezone'=> '',
             'language'=>'English',
             'uni_id'=>'0'
        );

        $this->db->insert('gp_coursetrack', $User_data);
        $insert_id1 = $this->db->insert_id();
        
        $notification_type = 3;
        $request_id = $insert_id1;
        
        $notifiation_data = array(
             'request_id' => $request_id,
             'notification_type' => '3',
             'published'=>$now,
             'delflag'=>'0'
        );
        $this->db->insert('gp_notification', $notifiation_data);
        $insert_id2 = $this->db->insert_id();
        
         $visiblity_data = array(
             'ntfid' => $insert_id2,
             'userid' => '11'
        );
        $this->db->insert('gp_notification_visiblity', $visiblity_data);
        $insert_id3 = $this->db->insert_id();
        
         $invitess_data = array(
             'participate_id' => '11',
             'invite_status' => '1',
             'ct_id'=>$insert_id3
        );
        $this->db->insert('gp_ct_invitees', $invitess_data);
        $insert_id4 = $this->db->insert_id();
        
        return $insert_id1;
    }

    public function delete_Event_details($eve_id) {
        $this->db->where('id', $eve_id);
        $this->db->delete('gp_events');
    }

    public function save_event_details($PostArr) {
        $data = array(
            'title' => $PostArr['val1'],
            'details' => $PostArr['val3'],
            'event_type' => $PostArr['val2'],
            'event_time' => $PostArr['val5'],
            'location' => $PostArr['val7'],
            'event_date' => $PostArr['val4']
        );

        $this->db->where('id', $PostArr['Val']);
        $this->db->update('gp_events', $data);
        return $company_id;
    }

    public function get_event_details_edit($eve_id) {
        $this->db->select('id, title, details, event_type, event_time, location, DATE_FORMAT(event_date,"%d-%m-%Y") AS event_date');
        $this->db->where('id', $eve_id);
        $query = $this->db->get('gp_events');
        return $query->result_array();
    }

    public function get_event_details($eve_id) {
        $this->db->select('id, title, details, event_type, event_time, location, DATE_FORMAT(event_date,"%b %D %Y") AS event_date');
        $this->db->where('id', $eve_id);
        $query = $this->db->get('gp_events');
        return $query->result_array();
    }

    public function get_event_list($end, $start, $srch) {
        $this->db->select('id, title, details, event_type, event_time, location, DATE_FORMAT(event_date,"%b %D %Y") AS event_date', FALSE);
        $this->db->from('gp_events');
        if ($srch != '') {
            $this->db->like('title', $srch, 'both');
            $this->db->or_like('details', $srch, 'both');
            $this->db->or_like('event_type', $srch, 'both');
            $this->db->or_like('event_time', $srch, 'both');
            $this->db->or_like('location', $srch, 'both');
            $this->db->or_like('event_date', $srch, 'both');
        }
        $this->db->limit($start, $end);
        $query = $this->db->get();
        //$this->output->enable_profiler(TRUE);
        return $query->result_array();
    }

    public function count_event_list($srch) {
        $this->db->select('id');
        $this->db->from('gp_events');
        if ($srch != '') {
            $this->db->like('title', $srch, 'both');
            $this->db->or_like('details', $srch, 'both');
            $this->db->or_like('event_type', $srch, 'both');
            $this->db->or_like('event_time', $srch, 'both');
            $this->db->or_like('location', $srch, 'both');
            $this->db->or_like('event_date', $srch, 'both');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function Insert_class_Data($PostArr) {
        $User_data = array(
            'title' => $PostArr['a'],
            'details' => $PostArr['b'],
            'event_type' => $PostArr['c'],
            'event_date' => $PostArr['d'],
            'event_time' => $PostArr['e'],
            'location' => $PostArr['f']
        );

        $this->db->insert('gp_events', $User_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function save_class_details($PostArr) {
        $data = array(
            'semester' => $PostArr['val1'],
            'department' => $PostArr['val2'],
            'course_no' => $PostArr['val3'],
            'professor' => $PostArr['val6'],
            'capacity' => $PostArr['val7']
        );

        $this->db->where('uni_id', $PostArr['val5']);
        $this->db->update('gp_university', $data);

        $datacls = array(
            'title' => $PostArr['val4']
        );

        $this->db->where('ct_id', $PostArr['Val']);
        $this->db->update('gp_coursetrack', $datacls);
        return $PostArr['Val'];
    }

    public function Insert_class_details($PostArr) {
        $data_univ = array(
            'semester' => $PostArr['val1'],
            'department' => $PostArr['val2'],
            'course_no' => $PostArr['val3'],
            'professor' => $PostArr['val6'],
            'capacity' => $PostArr['val7']
        );

        $this->db->insert('gp_university', $data_univ);
        $insert_id = $this->db->insert_id();

        $datacls = array(
            'title' => $PostArr['val4'],
            'uni_id' => $insert_id
        );

        $this->db->insert('gp_coursetrack', $datacls);
        $insert_id_course = $this->db->insert_id();
        return $insert_id;
    }

    public function get_class_details_edit($coursetrack_id) {
        $this->db->select('gp_coursetrack.ct_id AS id, gp_university.uni_id, gp_university.semester, gp_university.department, gp_university.course_no, gp_university.professor, gp_university.capacity, gp_coursetrack.title');
        $this->db->from('gp_university');
        $this->db->join('gp_coursetrack', 'gp_coursetrack.uni_id=gp_university.uni_id');
        $this->db->where('gp_coursetrack.ct_id', $coursetrack_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_Class_details($eve_id) {
        $this->db->where('id', $eve_id);
        $this->db->delete('gp_events');
    }

    public function get_class_details($coursetrack_id) {
        $this->db->select('gp_coursetrack.ct_id AS id, gp_university.uni_id, gp_university.semester, gp_university.department, gp_university.course_no, gp_university.professor, gp_university.capacity, gp_coursetrack.title');
        $this->db->from('gp_university');
        $this->db->join('gp_coursetrack', 'gp_coursetrack.uni_id=gp_university.uni_id');
        $this->db->where('gp_coursetrack.ct_id', $coursetrack_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_class_list($end, $start, $srch) {
        $this->db->select('gp_university.uni_id, gp_university.semester, gp_university.department, gp_university.course_no, gp_university.professor, gp_university.capacity,gp_university.batch_no', FALSE);
        $this->db->from('gp_university');
        //$this->db->join('gp_coursetrack', 'gp_coursetrack.uni_id=gp_university.uni_id');
        if ($srch != '') {
            $this->db->like('gp_university.semester', $srch, 'both');
            $this->db->or_like('gp_university.department', $srch, 'both');
            $this->db->or_like('gp_university.course_no', $srch, 'both');
            $this->db->or_like('gp_university.professor', $srch, 'both');
            $this->db->or_like('gp_university.capacity', $srch, 'both');
            //$this->db->or_like('gp_coursetrack.title', $srch, 'both');
        }
        $this->db->limit($start, $end);
        $query = $this->db->get();
        //$this->output->enable_profiler(TRUE);
        return $query->result_array();
    }

    public function count_class_list($srch) {
        $this->db->select('gp_university.uni_id AS id');
        $this->db->from('gp_university');
        //$this->db->join('gp_coursetrack', 'gp_coursetrack.uni_id=gp_university.uni_id');
        if ($srch != '') {
            $this->db->like('gp_university.semester', $srch, 'both');
            $this->db->or_like('gp_university.department', $srch, 'both');
            $this->db->or_like('gp_university.course_no', $srch, 'both');
            $this->db->or_like('gp_university.professor', $srch, 'both');
            $this->db->or_like('gp_university.capacity', $srch, 'both');
            //$this->db->or_like('gp_coursetrack.title', $srch, 'both');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function set_um_data() {

        $um_mail = $this->input->post('um_mail', TRUE);
        $um_pwd = md5($this->input->post('um_pwd', TRUE));
        $added_date = date("Y-m-d h:i:s");


        $query = $this->db->query("SELECT * FROM gp_admin WHERE user_email='$um_mail'");
       

        $row_user_email = array();

        foreach($query->result_array() as $result){
            $row_user_email[] = $result['user_email'];
        }
        if(in_array($um_mail, $row_user_email)) {
            return false;
        }
        else {
           
                $this->db->query("INSERT INTO gp_admin VALUES('', '$um_mail', '$um_pwd', '$added_date')") or die("Insert problem in gp_admin table");
        }

    }

    public function delete_Chat_details($eve_id) {
        $this->db->where('id', $eve_id);
        $this->db->delete('gp_events');
    }

    public function get_chat_list($srch) {
        $this->db->select('gp_comments.comment_id AS id, gp_comments.description, gp_users.firstname, gp_users.lastname');
        $this->db->from('gp_comments');
        $this->db->join('gp_users', 'gp_users.id_user=gp_comments.creator_id');
        if ($srch != '') {
            $this->db->like('gp_comments.description', $srch, 'both');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_conflict_chat_list($srch, $conflchatlist) {
        $this->db->select('gp_comments.comment_id AS id, gp_comments.description, gp_users.firstname, gp_users.lastname');
        $this->db->from('gp_comments');
        $this->db->join('gp_users', 'gp_users.id_user=gp_comments.creator_id');
        if ($srch != '') {
            $this->db->like('gp_comments.description', $srch, 'both');
        }
        if (sizeof($conflchatlist) > 0) {
            $s = 1;
            foreach ($conflchatlist AS $conflchatlistVal) {
                if ($s == 1) {
                    $this->db->like('gp_comments.description', $conflchatlistVal['description'], 'both');
                } else {
                    $this->db->or_like('gp_comments.description', $conflchatlistVal['description'], 'both');
                }
                $s++;
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_conflict_master_chat_list() {
        $this->db->select('id, description');
        $this->db->from('gp_comments_conflict');
        $query = $this->db->get();
        return $query->result_array();
    }

   

    public function send_msg($message) {
        $User_data = array(
            'message_txt' => $message,
            'added_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('gp_contact_message', $User_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function check_useremail($email) {
        $this->db->select('login_email');
        $this->db->from('gp_users');
        $this->db->where('gp_users.login_email', $email);
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
           $str = 'P';   
        }
        else { 
         $str = 'A';
        }
        echo $str;
    }
	*/
}

?>
