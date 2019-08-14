<?php

class Featured_section extends CI_Model {

    public function __construct() {
       // echo "ffff";
        parent::__construct();
    }

	/**
	this function will fetch 5 playlists created by admin
	*/
    public function get_current_themes()
	{
		$this->db->select('PLAYLIST_ID, TITLE, DESCRIPTION, DISPLAYFLAG',true);
		$this->db->from('TBL_PLAYLISTS');
		$this->db->order_by('DISPLAYFLAG','ASC');
		$qry = $this->db->get();
		return $qry->result_array();
	}

    
	/**
	this function will fetch songs in each playlist created by admin
	*/
    public function get_playlist_songs($pid)
	{
       // echo "vvvvvvvv"; exit;
		$this->db->select('TBL_PLAYLIST_CONTENTS.PLAYLIST_ID, TBL_PLAYLIST_CONTENTS.CONTENT_ID, tbl_songs.title, tbl_songs.description',true);
		$this->db->from('TBL_PLAYLIST_CONTENTS');
		$this->db->join('tbl_songs', 'tbl_songs.metasea_id = TBL_PLAYLIST_CONTENTS.content_id', 'left');
		$this->db->where('TBL_PLAYLIST_CONTENTS.PLAYLIST_ID', $pid);
		$this->db->order_by('TBL_PLAYLIST_CONTENTS.playlist_id, TBL_PLAYLIST_CONTENTS.LISTING_INDEX','asc');
		$query = $this->db->get();
        return $query->result_array();
	}

	public function update_playlist($pid, $cid)
	{
		$this->db->delete('TBL_PLAYLIST_CONTENTS', array('PLAYLIST_ID' => $pid, 'CONTENT_ID' => $cid)); 
	}

	public function update_playlist_title($pid, $title, $desc)
	{
		$data = array(
               'TITLE' => $title,
               'DESCRIPTION' => $desc,
               'UPDATED_ON' => date("Y-m-d H:i:s")
            );

		$this->db->where('PLAYLIST_ID', $pid);
		$this->db->update('TBL_PLAYLISTS', $data); 
		 
	}

	public function update_playlist_order($plist)
	{
		$pids = array();
		$pids = explode(',', $plist);
		//print_r($pids);
		
		$listing_in = array();
		foreach($pids as $in => $au_id)
		{
			$listing_in[$au_id] = $in;
		}
		//print_r($listing_in);
		
					
		foreach($listing_in as $key => $p_id)
		{
			//$p_id = $list_info;
					
			$data = array(
						   'DISPLAYFLAG' => $p_id+1,
						   'UPDATED_ON' => date("Y-m-d h:i:s")
						);

			//print_r($data);
			//echo $key;
			
			$this->db->update('TBL_PLAYLISTS', $data, array('PLAYLIST_ID' => $key));
			unset($data);
		}
		
		unset($listing_in);
		unset($pids);
	}

	public function add_song_to_playlist($nw_song)
	{
		$pid		= $nw_song['pid'];
		$content_id = $nw_song['content_id'];

		## get last index for current playlist
		$this->db->select_max('LISTING_INDEX');
		$query = $this->db->get_where('TBL_PLAYLIST_CONTENTS', array('PLAYLIST_ID' => $pid), 1);
	    $res = $query->result_array();
		

		$listing_ind = $res[0]['LISTING_INDEX'] + 1;

		$data = array(
		   'PLAYLIST_ID' => $pid ,
		   'LISTING_INDEX' => $listing_ind ,
		   'CONTENT_ID' => $content_id ,
		   'CREATED_ON' => date("Y-m-d H:i:s"),
		   'UPDATED_ON' => date("Y-m-d H:i:s")
		);

		$res1 = $this->db->insert('TBL_PLAYLIST_CONTENTS', $data); 
		
		if(!$res1)
		{
			$num = $this->db->_error_number();
			if($num == "1062")
			{
				return $e = "Err";
			}
		}

	}


	public function update_songs_order($slist, $pid)
	{
		$sids = array();
		$sids = explode(',', $slist);
		//print_r($sids);
		
		$listing_in = array();
		foreach($sids as $in => $au_id)
		{
			$listing_in[$au_id] = $in;
		}
		//print_r($listing_in);
		
					
		foreach($listing_in as $key => $s_id)
		{
			//$p_id = $list_info;
					
			$data = array(
						   'LISTING_INDEX' => $s_id+1,
						   'UPDATED_ON' => date("Y-m-d h:i:s")
						);

			//print_r($data);
			//echo $key;
			
			$this->db->update('TBL_PLAYLIST_CONTENTS', $data, array('PLAYLIST_ID' => $pid, 'CONTENT_ID' => $key));
			unset($data);
		}
		
		unset($listing_in);
		unset($pids);
	}

}

