<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Commonmodel');
	}

	function index() {
		$header = array('title' => 'Messages');
		$data = array('heading' => 'Messages');
		$data['chat_list'] = $this->db->query('SELECT `chat`.*, `users`.`username`, CONCAT(users.firstname, " ", users.lastname) as full_name, `users`.`profilePic`, `to_user`.`username` as `to_username`, CONCAT(to_user.firstname, " ", to_user.lastname) as to_fullname FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` group by userfrom_id order by id DESC')->result_array();
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/chat/list',$data);
        $this->load->view('admin/footer');
	}

	function adminShowMessage_list($fromid,$toid) {
		$get_data = $this->Commonmodel->getChat($fromid,$toid);
		//echo "<pre>"; print_r($get_data);
		$get_chatuser = $this->Crud_model->get_single('users', "userId IN ('".$fromid."','".$toid."')");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->username;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}
		//$html_data = '<div class="contact-profile">' . $userpic . '<p>' . ucfirst($name) . '</p><div class="social-media"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><a href="javascript:void(0);" onclick="openVideoCallWindow('.$user_id.');"><i class="fa fa-video-camera" aria-hidden="true"></i></a></div></div><div class="messages"><ul>';
		$html_data = '';
		//echo $fromid. "" .$toid; echo "<pre>"; print_r($get_data); die;
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if ($key->userfrom_id == $toid && $key->userto_id == $fromid) {
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p></li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $toid && $key->userfrom_id == $fromid) {
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p></li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		$header = array('title' => 'Messages');
		$data = array('heading' => 'Messages');
		$data['chat_detail'] = $html_data;
		$this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/chat/details',$data);
        $this->load->view('admin/footer');
	}
}
?>
