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

	function count_all($cond) {
        $query = $this->db->query('SELECT `chat`.*, `users`.`username`, CONCAT(users.firstname, " ", users.lastname) as full_name, `users`.`profilePic`, `to_user`.`username` as `to_username`, CONCAT(to_user.firstname, " ", to_user.lastname) as to_fullname FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` group by userfrom_id order by id DESC');
        return $this->db->count_all_results();
    }

    function count_filtered($cond) {
        $query = $this->db->query('SELECT `chat`.*, `users`.`username`, CONCAT(users.firstname, " ", users.lastname) as full_name, `users`.`profilePic`, `to_user`.`username` as `to_username`, CONCAT(to_user.firstname, " ", to_user.lastname) as to_fullname FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` group by userfrom_id order by id DESC');
        return $query->num_rows();
    }

	function ajax_manage_page() {
		$cond = "1=1";
		//$GetData = $this->db->query('SELECT `chat`.*, `users`.`username`, CONCAT(users.firstname, " ", users.lastname) as full_name, `users`.`profilePic`, `to_user`.`username` as `to_username`, CONCAT(to_user.firstname, " ", to_user.lastname) as to_fullname FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` group by userfrom_id order by id DESC')->result_array();
		$GetData = $this->db->query('SELECT `chat`.* FROM `chat` JOIN `users` ON `users`.`userId`=`chat`.`userfrom_id` JOIN `users` `to_user` ON `to_user`.`userId`=`chat`.`userto_id` group by userfrom_id order by id DESC')->result_array();
		$no=0;
		$data = array();
		foreach ($GetData as $row) {
			$btn = '<span class="btn btn-sm bg-success-light mr-2" data-toggle="modal" data-target="#viewModal" onclick="view_data(3)" data-placement="right"><i class="far fa-eye mr-1"></i><a href="'.admin_url('chat_details/'.$row['userfrom_id'].'/'.$row['userto_id']).'">View Chat</a></span>';

			$getFromUser = $this->db->query("SELECT * FROM `users` WHERE userId = '".$row['userfrom_id']."'")->result_array();
			if($getFromUser[0]['userType'] == '1') {
				if(!empty($getFromUser[0]['firstname'])) {
					$fullname = $getFromUser[0]['firstname'].' '.$getFromUser[0]['lastname'];
				} else {
					$fullname = $getFromUser[0]['companyname'];
				}
			}

			$gettoUser = $this->db->query("SELECT * FROM `users` WHERE userId = '".$row['userto_id']."'")->result_array();
			if($gettoUser[0]['userType'] == '2') {
				if(!empty($gettoUser[0]['firstname'])) {
					$fullname1 = $gettoUser[0]['firstname'].' '.$gettoUser[0]['lastname'];
				} else {
					$fullname1 = $gettoUser[0]['companyname'];
				}
			}

			$getJobtitle = $this->db->query("SELECT * FROM `postjob` WHERE id = '".$row['postjob_id']."'")->result_array();
			$post_title = $getJobtitle[0]['post_title'];
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($post_title);
			$nestedData[] = ucwords($fullname1);
			$nestedData[] = ucwords($fullname);
			$nestedData[] = date('d-m-Y',strtotime($row['created_date']));
			$nestedData[] = $btn;
			$data[] = $nestedData;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->count_all($cond),
			"recordsFiltered" => $this->count_filtered($cond),
			"data" => $data,
		);
		echo json_encode($output);
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
