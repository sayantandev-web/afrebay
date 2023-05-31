<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('post_job_model');
		$this->load->model('Users_model');
		if (!$this->session->userdata('afrebay')) {
			header("location" . base_url() . "login");
		}
	}

	function index() {
		$data['get_service'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$data['get_job'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['afrebay']['userId']."' AND is_delete = '0'");
		$data['bid_job'] = $this->db->query("SELECT `postjob`.*, `job_bid`.* FROM `job_bid` JOIN `postjob` ON `postjob`.`id` = `job_bid`.`postjob_id` where `postjob`.user_id = '".$_SESSION['afrebay']['userId']."' AND postjob.is_delete = '0'")->result_array();
		$data['get_subscribe'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['afrebay']['userId'] . "' and userType='1'");
		$data['get_product'] = $this->Crud_model->GetData('user_product', '', "user_id='".$_SESSION['afrebay']['userId']."' AND status = 1 AND is_delete= 1");
		$this->load->view('header');
		$this->load->view('user_dashboard/dashboard', $data);
		$this->load->view('footer');
	}

	public function view_profile() {
		$user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		$data = array(
			'userinfo' => $user_info,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/view_profile', $data);
		$this->load->view('footer');
	}

	public function profile() {
		 $user_id=base64_decode($this->uri->segment(2));
		// echo $user_id;die;
		// echo "ghjhfg";die;
		// echo $this->uri->segment(2);die;
		if($user_id!=''){
			$userid=$user_id;
			$data_request='admin';
		$this->load->view('admin_header');

		}
		else{
			$userid=$_SESSION['afrebay']['userId'];
			$data_request='user';
		$this->load->view('header');



		}
		// echo $userid;die;
		// $user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		$user_info = $this->Crud_model->get_single('users', "userId='" . $userid . "'");
		//   print_r($user_info);die;
		$data = array(
			'userinfo' => $user_info,
			'data_request'=>$data_request,
		);
		$this->load->view('user_dashboard/profile_settings', $data);
		$this->load->view('footer');
	}

	public function update_profile() {
		if ($_FILES['profilePic']['name'] != '') {
			$_POST['profilePic'] = rand(0000, 9999) . "_" . $_FILES['profilePic']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['profilePic']['tmp_name'];
			$config2['new_image'] =   getcwd() . '/uploads/users/' . $_POST['profilePic'];
			$config2['upload_path'] =  getcwd() . '/uploads/users/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if (!$this->image_lib->resize()) {
				echo ('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image  = $_POST['profilePic'];
				@unlink('uploads/users/' . $_POST['old_image']);
			}
		} else {
			$image  = $_POST['old_image'];
		}

		/*if ($_FILES['additional_image']['name'] != '') {
			$_POST['additional_image'] = rand(0000, 9999) . "_" . $_FILES['additional_image']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] =  $_FILES['additional_image']['tmp_name'];
			$config2['new_image'] =   getcwd() . '/uploads/users/additional_image/' . $_POST['additional_image'];
			$config2['upload_path'] =  getcwd() . '/uploads/users/additional_image/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if (!$this->image_lib->resize()) {
				echo ('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$additional_image  = $_POST['additional_image'];
				@unlink('uploads/users/additional_image/' . $_POST['old_additionalimage']);
			}
		} else {
			if(!empty($_POST['old_additionalimage'])) {
				$additional_image  = $_POST['old_additionalimage'];
			} else {
				$additional_image  = '';
			}
		}

		if ($_FILES['video']['error'] == '') {
			$file_element_name = 'video';
			$config['upload_path'] = getcwd() . '/uploads/video/';
			$config['allowed_types'] = '*';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($file_element_name)) {
				$error = $this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
				$data = array('error' => $error);
			}
			$upload_quotation_file = $this->upload->data();
			$video = $upload_quotation_file['file_name'];
			@unlink('uploads/video/' . $_POST['old_video']);
		} else {
			if(!empty($_POST['old_video'])) {
				$video = $_POST['old_video'];
			} else {
				$video  = '';
			}
		}

		if ($_FILES['resume']['name'] != '') {
			$src = $_FILES['resume']['tmp_name'];
			$filEnc = time();
			$avatar = rand(0000, 9999) . "_" . $_FILES['resume']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/uploads/users/resume/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$resume  = $avatar1;
				@unlink('uploads/users/resume/' . $_POST['old_resume']);
			}
		} else {
			if(!empty($_POST['old_resume'])) {
				$resume  = $_POST['old_resume'];
			} else {
				$resume  = '';
			}
		}*/

		if(!empty($this->input->post('key_skills'))) {
			$key_skills = $this->input->post('key_skills');
			for ($i=0; $i < count($key_skills); $i++) {
				$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '".$key_skills[$i]."'")->result();
				if(empty($get_specialist)) {
					$insrt = array(
						'specialist_name'=>ucfirst($key_skills[$i]),
						'created_date'=>date('Y-m-d H:i:s'),
					);
					$this->db->insert('specialist',$insrt);
				}
			}
			$skills = implode(", ",$this->input->post('key_skills',TRUE));
		} else {
			$skills = '';
		}

		$data = array(
			'companyname' => $_POST['companyname'],
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'email' => $_POST['email'],
			'mobile' => $_POST['mobile'],
			'gender' => $this->input->post('gender', TRUE),
			//'experience' => $this->input->post('experience', TRUE),
			//'qualification' => $this->input->post('qualification', TRUE),
			'skills' => $skills,
			'profilePic' => $image,
			'additional_image' => $additional_image,
			'zip' => $_POST['zip'],
			'address' => $_POST['address'],
			'foundedyear' => $_POST['foundedyear'],
			'teamsize' => $_POST['teamsize'],
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude'],
			'short_bio' => $_POST['short_bio'],
			//'video' => $video,
			'resume' => $resume,
		);
		//print_r($data); exit;
		$this->Crud_model->SaveData('users', $data, "userId='" . $_POST['id'] . "'");
		// echo $_POST['from_data_request'];die;
		if($_POST['from_data_request']=='admin'){
		$this->session->set_flashdata('message', 'Profile Updated Successfull !');
		redirect(base_url('admin/users'));

		}
		else{

		
		$this->session->set_flashdata('message', 'Profile Updated Successfull !');
		redirect(base_url('profile'));
		}
	}

	public function subscription() {
		$data['get_subscription'] = $this->Crud_model->GetData('subscription');
		// print_r($data['get_subscription']);die;
		$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		//  print_r($data['subcriber_pack']);die;

		$this->load->view('header');
		$this->load->view('user_dashboard/subscription', $data);
		$this->load->view('footer');
	}

	public function products() {
		$data['product_list'] = $this->Crud_model->GetData('user_product', '', "user_id='".$_SESSION['afrebay']['userId']."' AND status = 1 and is_delete = 1");
		$this->load->view('header');
		$this->load->view('user_dashboard/product/list', $data);
		$this->load->view('footer');
	}

	public function myservice() {
		$data['get_services'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['afrebay']['userId'] . "'");
		$this->load->view('header');
		$this->load->view('user_dashboard/my_service', $data);
		$this->load->view('footer');
	}

	public function service_form() {
		$get_category = $this->Crud_model->GetData('category');
		$data = array(
			'button' => 'Submit',
			'action' => base_url('user/Dashboard/save_service'),
			'service_name' => set_value('service_name'),
			'category_id' => set_value('category_id'),
			'subcategory_id' => set_value('subcategory_id'),
			'description' => set_value('description'),
			'get_category' => $get_category,
			'id' => set_value('id'),
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}

	public function update_service_form($id) {
		$service_id = base64_decode($id);
		$get_category = $this->Crud_model->GetData('category');
		$get_subcategory = $this->Crud_model->GetData('sub_category');
		$get_services = $this->Crud_model->get_single('employer_services', "id='" . $service_id . "'");
		$data = array(
			'button' => 'Update',
			'action' => base_url('user/Dashboard/update_service'),
			//'action'=>admin_url('Event/create_action'),
			'service_name' => $get_services->service_name,
			'category_id' => $get_services->category_id,
			'subcategory_id' => $get_services->subcategory_id,
			'description' => $get_services->description,
			'id' => $get_services->id,
			'get_category' => $get_category,
			'get_subcategory' => $get_subcategory,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}

	public function save_service() {
		$data = array(
			'employer_id' => $_SESSION['afrebay']['userId'],
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('employer_services', $data);
		$this->session->set_flashdata('message', 'Services Created Successfull !');
		redirect(base_url('myservice'));
	}

	public function update_service() {
		$id = $_POST['id'];
		$data = array(
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
		);
		$this->Crud_model->SaveData('employer_services', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Services Updated Successfully !');
		redirect(base_url('myservice'));
	}

	function delete_service($id) {

		$this->Crud_model->DeleteData('employer_services', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Service Deleted successfully !');
		redirect(base_url('myservice'));
	}

	public function myjob() {
		$data['get_postjob'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['afrebay']['userId']."' ");
		//print_r($data); die();
		$this->load->view('header');
		$this->load->view('user_dashboard/my_job', $data);
		$this->load->view('footer');
	}

	public function buy_subscription() {
		$employer_id = $_SESSION['afrebay']['userId'];
		$data = array(
			'employer_id' => $employer_id,
			'subscription_id' => $_POST['subscription_id'],
			'amount' => $_POST['amount'],
			'created_date' => date('Y-m-d, H:i:s'),
		);
		$this->Crud_model->SaveData('employer_subscription', $data);
		$this->session->set_flashdata('message', 'Subscription purchased Successfull !');
		echo '1';
	}

	////////////////////////////////////////// start job bidding//////////////////
	function jobbid() {
		$this->load->model('Post_job_model');
		if($_SESSION['afrebay']['userType'] == '1'){
			//$data['get_postjob'] = $this->db->query("SELECT postjob.*, job_bid.*, users.* from job_bid JOIN postjob ON job_bid.postjob_id = postjob.id JOIN users ON job_bid.user_id = users.userId WHERE postjob.user_id ='".$_SESSION['afrebay']['userId']."'")
			$cond = "job_bid.user_id='" . $_SESSION['afrebay']['userId'] . "'";
		} else {
			//$data['get_postjob'] = $this->db->query("SELECT postjob.*, job_bid.*, users.* from job_bid JOIN postjob ON job_bid.postjob_id = postjob.id JOIN users ON job_bid.user_id = users.userId WHERE postjob.user_id =")
			$cond = "postjob.user_id='" . $_SESSION['afrebay']['userId'] . "'";
		}
		$data['get_postjob'] = $this->Post_job_model->postjob_bid($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/my_jobbid', $data);
		$this->load->view('footer');
	}

	function save_postbid() {
		$data = array(
			'postjob_id' => $_POST['postjob_id'],
			'user_id' => $_SESSION['afrebay']['userId'],
			'bid_amount' => $_POST['bid_amount'],
			'email' => $_POST['email'],
			'duration' => $_POST['duration'],
			'phone' => $_POST['phone'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('job_bid', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			$this->session->set_flashdata('message', 'Add Bid Successfully !');
			redirect(base_url("postdetail/".base64_encode($_POST['postjob_id'])), "refresh");
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later.');
			redirect(base_url("postdetail/".base64_encode($_POST['postjob_id'])), "refresh");
		}

	}

	function changebiddingstatus() {
		$get_data = $this->Crud_model->get_single('job_bid', "id='" . $_POST['jobbid_id'] . "'");
		if ($get_data->bidding_status == 'Pending') {
			$data1 = array(
				'bidding_status' => 'Accept',
			);
			$this->Crud_model->SaveData('job_bid', $data1, "id='" . $_POST['jobbid_id'] . "'");
		}
		$updatepost = array(
			'is_delete' => 1,
		);
		$this->Crud_model->SaveData('postjob', $updatepost, "id='" . $get_data->postjob_id . "'");
		$binddingstatus = $this->Crud_model->GetData('job_bid', '', "postjob_id='" . $get_data->postjob_id . "' and bidding_status='Pending'");
		foreach ($binddingstatus as $row) {
			$data = array(
				'bidding_status' => 'Reject',
			);
			$this->Crud_model->SaveData('job_bid', $data, "id='" . $row->id . "'");
		}
		echo "1";
		exit;
	}

	/////////////////////////////////////////  End job bidding////////////////////
	function calender() {
		$this->load->view('header');
		$this->load->view('user_dashboard/calender');
		$this->load->view('footer');
	}

	////////////////////////////////// start chat functionality////////////////
	function chat() {
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['afrebay']['userId'] . "'");
		$cond = "job_bid.bidding_status='Accept'";
		$data['get_jobbid'] = $this->Users_model->get_jobbidding($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/chat', $data);
		$this->load->view('footer');
	}

	function showmessage_list() {
		$user_id = $this->input->post('user_id');
		$get_data = $this->Users_model->getChat();
		//print_r($get_data);
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['user_id'] . "'");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}
		$html_data = '<div class="contact-profile">' . $userpic . '<p>' . ucfirst($name) . '</p><div class="social-media"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><a href="javascript:void(0);" onclick="openVideoCallWindow('.$user_id.');"><i class="fa fa-video-camera" aria-hidden="true"></i></a><a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a></div></div><div class="messages"><ul>';
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
				if ($key->userfrom_id == $_SESSION['afrebay']['userId'] && $key->userto_id == $_POST['user_id']) {
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p></li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['afrebay']['userId'] && $key->userfrom_id == $_POST['user_id']) {
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p></li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}

	function sent_message() {
		if (!empty($this->input->post('userto_id'))) {
			$data = array(
				'userfrom_id' => $_SESSION['afrebay']['userId'],
				'userto_id' => $this->input->post('userto_id'),
				'message' => $this->input->post('message'),
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('chat', $data);
			$lastid = $this->db->insert_id();
			$con = "id='" . $lastid . "'";
			$getdata = $this->Users_model->getmessage($con);
			if (@$getdata->profilePic && file_exists('uploads/users/' . @$getdata->profilePic)) {
				$from_pic = '<img src="' . base_url('uploads/users/' . @$getdata->profilePic) . '" alt="" />';
			} else {
				$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
			}
			$data = array(
				'result' => 1,
				'userpic' => $from_pic,
			);
			echo json_encode($data);
			exit;
		}
	}
	///////////////////////////////////// end chat/////////////////////////////////
	function video_call() {
		$this->load->view('header');
		$this->load->view('user_dashboard/video_call');
		$this->load->view('footer');
	}

	public function save_event() {
		// $starttime=$_POST['starthours'].':'.$_POST['startminute'].' '.$_POST['starttype'];
		// $endtime=$_POST['endhours'].':'.$_POST['endminute'].' '.$_POST['endtype'];
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'event_name' => $_POST['event_name'],
			'event_date' => date('Y-m-d', strtotime($_POST['event_date'])),
			'start_time' => date('H:i', strtotime($_POST['start_time'])),
			'end_time' => date('H:i', strtotime($_POST['end_time'])),
			'description' => $_POST['description'],
			'event_color' => $_POST['event_color'],
			'event_icon' => $_POST['event_icon'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('appointment_scheduling', $data);
		$this->session->set_flashdata('message', 'Appointment Created Successfully !');
		redirect(base_url('calender'));
	}

	public function get_events() {
		$events = $this->db->query("select * from appointment_scheduling where user_id='" . $_SESSION['afrebay']['userId'] . "'")->result();
		$data_events = array();

		foreach ($events as $r) {
			$data_events[] = array(
				"id" => $r->id,
				"title" => $r->event_name,
				"start" => date('Y-m-d', strtotime($r->event_date)),
				"description" => $r->description,
				"className" => $r->event_color,
				"icon" => $r->event_icon,
			);
		}
		echo json_encode($data_events);
		exit();
	}

	function change_password() {
		$this->load->view('header');
		$this->load->view('user_dashboard/change_password');
		$this->load->view('footer');
	}

	function update_password() {
		$get_user = $this->Crud_model->get_single('users', "userId='" . $_SESSION['afrebay']['userId'] . "'");
		if ($get_user->password == md5($_POST['cur_password'])) {
			$data = array(
				'password' => md5($_POST['new_password']),
			);
			$this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['afrebay']['userId'] . "'");
			$this->session->set_flashdata('message', 'Password Reset Successfully !');
			echo "1";
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0";
		}
	}

	////////////////////////////////// start rating /////////////////////////////////////
	function save_employer_rating() {
		if (!empty($this->input->post('rating'))) {
			$data = array(
				'employer_id' => $_SESSION['afrebay']['userId'],
				'worker_id' => $_POST['user_id'],
				'rating' => $this->input->post('rating', TRUE),
				'subject' => $this->input->post('subject', TRUE),
				'review' => $this->input->post('review', TRUE),
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->Crud_model->SaveData('employer_rating', $data);
			$this->session->set_flashdata('message', 'Rating successfully');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
		}
		redirect(base_url('worker-detail/' . base64_encode($_POST['user_id'])));
	}
	////////////////////////////////// end rating /////////////////////////////////////

	//////////////////////////////// start education ///////////////////////////
	function education_list()
	{
		$data['education_list'] = $this->Crud_model->GetData('user_education', '', "user_id='".$_SESSION['afrebay']['userId']."' order by id DESC");
		$this->load->view('header');
		$this->load->view('user_dashboard/education/list', $data);
		$this->load->view('footer');
	}
	function add_education()
	{
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_education'),
			'education' => set_value('education'),
			'passing_of_year' => set_value('passing_of_year'),
			'college_name' => set_value('college_name'),
			'department' => set_value('department'),
			'description' => set_value('description'),

			'id' => set_value('id'),
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);

		$this->load->view('header');
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}

	public function save_education()
	{
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),

			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_education', $data);
		$this->session->set_flashdata('message', 'Education Created Successfully !');
		redirect(base_url('education-list'));
	}



	public function update_education($id)
	{
		$education_id = base64_decode($id);

		$update_education = $this->Crud_model->get_single('user_education', "id='" . $education_id . "'");
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(

			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_education'),
			'education' => $update_education->education,
			'passing_of_year' => $update_education->passing_of_year,
			'college_name' => $update_education->college_name,
			'department' => $update_education->department,
			'description' => $update_education->description,
			'id' => $update_education->id,
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);

		$this->load->view('header');
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}


	public function edit_education()
	{
		$id = $_POST['id'];
		$data = array(
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),

		);
		$this->Crud_model->SaveData('user_education', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Updated Successfully !');
		redirect(base_url('education-list'));
	}

	function delete_education($id)
	{

		$this->Crud_model->DeleteData('user_education', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Deleted successfully !');
		redirect(base_url('education-list'));
	}

	//////////////////////////////// end education ///////////////////////////


	///////////////// start work experience //////////////////////////

	function workexperience_list() {
		$data['workexperience_list'] = $this->Crud_model->GetData('user_workexperience', '', "user_id='".$_SESSION['afrebay']['userId']."' order by id DESC");
		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/list', $data);
		$this->load->view('footer');
	}

	function add_workexperience() {
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");

		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_workexperience'),
			'designation' => set_value('designation'),
			'company_name' => set_value('company_name'),
			//'duration' => set_value('duration'),
			'from_date' => set_value('from_date'),
			'to_date' => set_value('to_date'),
			'description' => set_value('description'),
			'id' => set_value('id'),
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,

		);

		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}

	public function save_workexperience() {
		$data = array(
			'user_id' => $_SESSION['afrebay']['userId'],
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			//'duration' => $this->input->post('duration', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_workexperience', $data);
		$this->session->set_flashdata('message', 'Work Experience Created Successfully !');
		redirect(base_url('workexperience-list'));
	}

	public function update_workexperience($id) {
		$work_id = base64_decode($id);
		$update_data = $this->Crud_model->get_single('user_workexperience', "id='" . $work_id . "'");
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_workexperience'),
			'designation' => $update_data->designation,
			'company_name' => $update_data->company_name,
			//'duration' => $update_data->duration,
			'from_date' => $update_data->from_date,
			'to_date' => $update_data->to_date,
			'description' => $update_data->description,
			'id' => $update_data->id,
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,

		);
		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}


	public function edit_workexperience() {
		$id = $_POST['id'];
		$data = array(
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			//'duration' => $this->input->post('duration', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
		);
		$this->Crud_model->SaveData('user_workexperience', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Work Updated Successfully !');
		redirect(base_url('workexperience-list'));
	}

	function delete_workexperience($id) {
		$this->Crud_model->DeleteData('user_workexperience', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Item deleted successfully !');
		redirect(base_url('workexperience-list'));
	}

	///////////////// end work experience //////////////////////////

	///////////////// User Subscription //////////////////////////
	function userSubscription(){
		$paymentDate = date('Y-m-d H:i:s');
		$n=24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		;
		$data = array(
			'employer_id' => $this->input->post('user_id'),
			'subscription_id' => $this->input->post('sub_id'),
			'name_of_card' => $this->input->post('sub_name'),
			'email' => $this->input->post('user_email'),
			'amount' => $this->input->post('sub_price'),
			'duration' => $this->input->post('sub_duration'),
			'transaction_id' => "sub_".$randomString,
			'payment_date' => $paymentDate,
			'created_date' => $paymentDate,
			'duration' => $this->input->post('sub_duration'),
			'payment_status' => 'paid',
			'expiry_date' => date("Y-m-d H:i:s", strtotime($this->input->post('sub_duration'), strtotime($paymentDate)))
		);
		//print_r($data); die();
		$this->Crud_model->SaveData('employer_subscription', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			echo '1';
		} else {
			echo '2';
		}
	}
	///////////////// End User Subscription //////////////////////////

	///////////////// User Product //////////////////////////

	function add_product() {
		//print_r($this->input->post()); die;
		if(!empty($this->input->post())){
			$data = array(
				'user_id' => $_SESSION['afrebay']['userId'],
				'prod_name' => $this->input->post('prod_name'),
				'prod_description' => $this->input->post('prod_description'),
				'created_date' => date("Y-m-d H:i:s"),
			);
			$this->Crud_model->SaveData('user_product', $data);
			$insert_id = $this->db->insert_id();
			if(!empty($insert_id)) {
				if ($_FILES['prod_image']['name'] != '') {
					$cpt = count($_FILES['prod_image']['name']);
					for($i=0; $i<$cpt; $i++) {
						$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
						$config2['image_library'] = 'gd2';
						$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];
						$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];
						$config2['upload_path'] =  getcwd() . '/uploads/products/';
						$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
						$config2['maintain_ratio'] = FALSE;
						$this->image_lib->initialize($config2);
						//$this->load->library('image_lib', $config2);
						if (!$this->image_lib->resize()) {
							echo ('<pre>');
							echo ($this->image_lib->display_errors());
							exit;
						} else {
							$image  = $_POST['prod_image'];
							@unlink('uploads/products/' . $_POST['old_image']);
						}
						$data_image = array(
							'prod_id' => $insert_id,
							'prod_image' => $image,
							'created_date' => date("Y-m-d H:i:s"),
						);
						$this->Crud_model->SaveData('user_product_image', $data_image);
						$this->session->set_flashdata('message', 'Product Created Successfully !');
					}
				}
			}
			redirect(base_url('product'));
		}

		$this->load->view('header');
		$this->load->view('user_dashboard/product/form', $data);
		$this->load->view('footer');
	}

	public function update_product($id) {
		$product_id = base64_decode($id);
		$update_product = $this->Crud_model->get_single('user_product', "id='" . $product_id . "'");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_product'),
			'product' => $update_product->prod_name,
			'description' => $update_product->prod_description,
			'id' => $update_product->id,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/product/form', $data);
		$this->load->view('footer');
	}


	public function edit_product() {
		$id = $_POST['id'];
		$data = array(
			'prod_name' => $this->input->post('prod_name', TRUE),
			'prod_description' => $this->input->post('prod_description', TRUE),
		);
		$updateQuery = $this->Crud_model->SaveData('user_product', $data, "id='".$id."'");
		//print_r($_FILES['prod_image']['name'][0]); die;
		if (!empty($_FILES['prod_image']['name'][0])) {
			$cpt = count($_FILES['prod_image']['name']);
			for($i=0; $i<$cpt; $i++) {
				$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
				$config2['image_library'] = 'gd2';
				$config2['source_image'] =  $_FILES['prod_image']['tmp_name'][$i];
				$config2['new_image'] =   getcwd() . '/uploads/products/'.$_POST['prod_image'];
				$config2['upload_path'] =  getcwd() . '/uploads/products/';
				$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
				$config2['maintain_ratio'] = FALSE;
				$this->image_lib->initialize($config2);
				//$this->load->library('image_lib', $config2);
				if (!$this->image_lib->resize()) {
					echo ('<pre>');
					echo ($this->image_lib->display_errors());
					exit;
				} else {
					$image  = $_POST['prod_image'];
					@unlink('uploads/products/' . $_POST['old_image']);
				}
				$data_image = array(
					'prod_id' => $_POST['id'],
					'prod_image' => $image,
					'created_date' => date("Y-m-d H:i:s"),
				);
				$this->Crud_model->SaveData('user_product_image', $data_image);
				//$this->session->set_flashdata('message', 'Product Created Successfully !');
			}
		}
		$this->session->set_flashdata('message', 'Product Updated Successfully !');
		redirect(base_url('product'));
	}

	function delete_product() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("UPDATE user_product SET is_delete = '2' WHERE id = '$p_id'");
		if($delete_prod > 0){
			echo '1';
		} else {
			echo '2';
		}

	}

	function delete_job() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("UPDATE postjob SET is_delete = '1' WHERE id = '$p_id'");
		if($delete_prod > 0){
			echo '1';
		} else {
			echo '2';
		}

	}

	function delete_product_image() {
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("DELETE FROM user_product_image WHERE id = '$p_id'");
	}

	///////////////// End User Product //////////////////////////
}
