<?php

/*
 * What protocol to use?
 * mail, sendmail, smtp
 */

/*$this->load->library('email');
 
		$this->email->from('noreply@appetals.com', 'noreply');
		$this->email->to('shailesh.mane@appetals.com');
		$this->email->subject('My first email by Mailjet');
		$this->email->message('Hello from Mailjet & CodeIgniter !');
		 
		$this->email->send();*/

/*$config['protocol'] = 'mail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['smtp_user'] = 'inlance@lifeinurl.com';
$config['smtp_pass'] = 'InternLance';
$config['smtp_host'] = 'mail.lifeinurl.com';
$config['smtp_port'] = 25;*/

/*$config['protocol'] = 'mail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['smtp_user'] = 'noreply@interndesk.com';
$config['smtp_pass'] = 'iDeskIndia';
$config['smtp_host'] = 'mail.interndesk.com';
$config['smtp_port'] = 25;
$config['newline'] = "\r\n";*/

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'tls://in.mailjet.com';
//$config['smtp_host'] = 'ssl://in.mailjet.com';
$config['smtp_port'] = '465';
$config['smtp_user'] = 'b68d82b4a31be4797b3a0b2f5836fe5b';
$config['smtp_pass'] = '9ba33a9fbf9cbcb5221f8a9bc87de7d2';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";
