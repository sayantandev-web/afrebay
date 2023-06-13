<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Mymodel');
		$this->load->model('post_job_model');
		$this->load->model('Users_model');
	}

	public function index() {
		$data['get_post'] = $this->Crud_model->GetData('postjob', 'id,post_title,description,user_id', "is_delete='0'", '', '(id)desc', '6');
		$data['countries']=$this->Crud_model->GetData('countries',"","");
		$data['get_freelancerspost'] = $this->Crud_model->GetData('postjob', '', "is_delete='0'", '', '', '8');
		$data['get_career'] = $this->Crud_model->GetData('career_tips', '', "status='Active'", '', '', '3');
		$data['get_company'] = $this->Crud_model->GetData('company_logo', '', "status='Active'", '', '', '');
		$data['get_users'] = $this->Users_model->get_users();
		$data['get_ourservice'] = $this->Crud_model->GetData('our_service', '', "status='Active'", '', '', '');
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='1'");
		$this->load->view('header');
		$this->load->view('home', $data);
		$this->load->view('footer');
	}

	public function signup() {
		$data['get_category'] = $this->Crud_model->GetData('category');
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='10'");
		$this->load->view('header');
		$this->load->view('register', $data);
		$this->load->view('footer');
	}

	public function login_page() {
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='9'");
		$this->load->view('header');
		$this->load->view('login', $data);
		$this->load->view('footer');
	}

	public function about() {
		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='2'");
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='3'");
		$data['get_employer'] = $this->Crud_model->GetData('users', '', "userType='2'", '', '(userId)desc', '4');
		$this->load->view('header');
		$this->load->view('frontend/about_us', $data);
		$this->load->view('footer');
	}

	public function contact() {
		$data['get_data'] = $this->Crud_model->get_single('setting');
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='4'");
		$this->load->view('header');
		$this->load->view('frontend/contact_us', $data);
		$this->load->view('footer');
	}

	function save_contact() {
		$data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'subject' => $_POST['subject'],
			'message' => $_POST['message'],
		);
		$this->Mymodel->insert('contact_us', $data);
		$insert_id = $this->db->insert_id();
		$get_setting=$this->Crud_model->get_single('setting');
		if(!empty($insert_id)) {
			$subject = $_POST['subject'];
			$imagePath = base_url().'uploads/logo/'.$get_setting->flogo;
			$message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tbody> <tr><td align='center'><table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='" . $imagePath . "' style='width: 250px'/></td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello Team,</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'> Please find the below contact form details. </td> </tr> </tbody> </table> </td> </tr> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-bottom:2px solid #232323'> <tbody> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Name : ".$_POST['name'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Email : ".$_POST['email'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>".$_POST['message'].",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'> Sincerely, </td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>".$_POST['name']."</td> </tr> <tr> <td height='30'></td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
			require 'vendor/autoload.php';
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->CharSet = 'UTF-8';
				$mail->SetFrom($_POST['email']);
				//$mail->AddAddress('no-reply@goigi.com', 'Afrebay');
				$mail->AddAddress('sayantan@goigi.in', 'sayantan bhakta');
				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				//Send email via SMTP
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Host       = "smtp.gmail.com";
				$mail->Port       = 587; //587 465
				$mail->Username   = "no-reply@goigi.com";
				$mail->Password   = "wj8jeml3eu0z";
				$mail->send();
				// echo 'Message has been sent';
			} catch (Exception $e) {
				$this->session->set_flashdata('message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
			}
			//$msg = "An email has been sent to your email address containing an activation link. Please click on the link to activate your account. If you do not click the link your account will remain inactive and you will not receive further emails. If you do not receive the email within a few minutes, please check your spam folder.";
			$this->session->set_flashdata('message', 'Thank you for your message. Our team will connect you soon!');
			redirect('contact-us');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			redirect('contact-us');
		}
	}

	public function privacy() {
		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='3'");
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='12'");
		$this->load->view('header');
		$this->load->view('frontend/privacy_policy', $data);
		$this->load->view('footer');
	}

	public function term_and_conditions() {
		$data['get_cms'] = $this->Crud_model->get_single('manage_cms', "id='1'");
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='13'");
		$this->load->view('header');
		$this->load->view('frontend/term_and_conditions', $data);
		$this->load->view('footer');
	}

	function pricing() {
		$data['get_subscription'] = $this->Crud_model->GetData('subscription');
		$data['subcriber_pack'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . @$_SESSION['afrebay']['userId'] . "'");
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='11'");
		$this->load->view('header');
		$this->load->view('frontend/pricing', $data);
		$this->load->view('footer');
	}

	function our_jobs() {
		$data['getcategory']=$this->Crud_model->GetData('category');
		$data['getcountry']=$this->Crud_model->GetData('countries');
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='7'");
		$this->load->view('header');
		$this->load->view('frontend/post_jobslist', $data);
		$this->load->view('footer');
	}

	function ourjob_fetchdata() {

		sleep(1);

		$this->load->library('pagination');

		$config = array();

		$config['base_url'] = '#';

		$config['total_rows'] = count($this->post_job_model->getcount());

		$config['per_page'] = 10;

		$config['uri_segment'] = 3;

		$config['use_page_numbers'] = TRUE;

		$config['full_tag_open'] = '<ul class="pagination">';

		$config['full_tag_close'] = '</ul>';

		$config['first_tag_open'] = '<li>';

		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';

		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&gt;';

		$config['next_tag_open'] = '<li>';

		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&lt;';

		$config['prev_tag_open'] = '<li>';

		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='active'><a href='#'>";

		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';

		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$page = $this->uri->segment(3);

		$start = ($page - 1) * $config['per_page'];

		$output = array(

			'pagination_link'  => $this->pagination->create_links(),

			'product_list'   => $this->post_job_model->fetchdata($config["per_page"], $start)

		);

		echo json_encode($output);

	}



	function post_bidding($postid) {
		$con = "postjob.id='" . base64_decode($postid) . "'";
		$data['post_data'] = $this->post_job_model->viewdata($con);
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='14'");
		$this->load->view('header');
		$this->load->view('frontend/post_detail', $data);
		$this->load->view('footer');
	}



	function workers_list() {
		$data['get_specialist'] = $this->Crud_model->GetData('specialist');
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='6'");
		$this->load->view('header');
		$this->load->view('frontend/workers_list', $data);
		$this->load->view('footer');
	}



	function workerlist_fetchdata() {
		sleep(1);
		$title = $this->input->post('title_keyword');
		$search_location = $this->input->post('location');
		$specialist = $this->input->post('specialist');
		if($specialist) {
			$specialist = implode(',', $specialist);
		}
		$userType = 1;
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = count($this->Users_model->getcount());
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='#'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];

		if(isset($title) || isset($search_location) || isset($specialist) || isset($userType)) {
			$getdata=$this->Users_model->workers_fetchdata($config["per_page"], $start, $title, $search_location, $specialist, $userType);
		} else {
			$getdata=$this->Users_model->workers_fetchdata($config["per_page"], $start, $title, $search_location, $specialist, $userType);
		}

		$output = array(
			'pagination_link'  => $this->pagination->create_links(),
			'product_list'   => $getdata
		);
		echo json_encode($output);
	}



	public function worker_detail($user_id) {

		$cond = "users.userType='1' and users.userId='" . base64_decode($user_id) . "'";

		$data['user_detail'] = $this->Users_model->users_detail($cond);

		$data['user_education'] = $this->Crud_model->GetData('user_education', '', "user_id='" . base64_decode($user_id) . "'", '', '(id)desc');

		$data['user_work'] = $this->Crud_model->GetData('user_workexperience', '', "user_id='" . base64_decode($user_id) . "'", '', '(id)desc');

		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='16'");

		$this->load->view('header');

		$this->load->view('frontend/worker_profile', $data);

		$this->load->view('footer');

	}

	function employer_list() {
		$data['get_banner'] = $this->Crud_model->get_single('banner', "id='5'");
		$data['getcategory']=$this->Crud_model->GetData('category');
		$this->load->view('header');
		$this->load->view('frontend/employer_list', $data);
		$this->load->view('footer');
	}

	function employerlist_fetchdata() {
		sleep(1);
		$title = $this->input->post('title_keyword');
		$category_id = $this->input->post('category');
		$subcategory_id = $this->input->post('subcategory');
		$search_location = $this->input->post('location');
		$days = $this->input->post('days');
		$userType = 2;
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = count($this->Users_model->get_employercount());
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='#'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];

		if(isset($title) || isset($category_id) || isset($subcategory_id) || isset($search_location) || isset($days) || isset($userType)) {
			$getdata=$this->Users_model->employer_fetchdata($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);
		} else {
			$getdata=$this->Users_model->employer_fetchdata($config["per_page"], $start, $title, $category_id, $subcategory_id, $search_location, $days, $userType);
		}

		$output = array(
			'pagination_link'  => $this->pagination->create_links(),
			'employer_list'   => $getdata
		);
		echo json_encode($output);
	}



	function career_tip($id) {

		$data['get_career'] = $this->Crud_model->get_single('career_tips', "id='".base64_decode($id)."'");

		$this->load->view('header');

		$this->load->view('frontend/career_tip', $data);

		$this->load->view('footer');

	}



	function product_contact() {

		$data=array(

			'product_id' => $this->input->post('p_id'),

			'product_name' => $this->input->post('p_name'),

			'c_name' => $this->input->post('name'),

			'c_email' => $this->input->post('email'),

			'c_description' => $this->input->post('details'),

			'created_date'=> date('Y-m-d H:i:s')

		);



		$result = $this->Mymodel->insert('product_contact', $data);



		$insert_id = $this->db->insert_id();

		$get_setting=$this->Crud_model->get_single('setting');

		if(!empty($insert_id)) {

			$subject = 'Product Query Form';

			$imagePath = base_url().'uploads/logo/'.$get_setting->flogo;

			$message = "

			<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>

   				<tbody>

					<tr>

					 	<td align='center'>

						    <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'>

						       	<tbody>

									<tr>

									 	<td height='35'></td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='".$imagePath."' style='width: 250px'/></td>

									</tr>

									<tr>

									 	<td height='35'></td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello Admin,</td>

									</tr>

							</tbody>

						    </table>

					 	</td>

					</tr>

					<tr>

					 	<td align='center'>

					    	<table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-bottom:2px solid #232323'>

					       		<tbody>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'> Please find the below details for product related queries</td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> Product Name: ".$this->input->post('p_name')."<br/> </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> Customer Name: ".$this->input->post('name')."<br/> </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> Customer Email: ".$this->input->post('email')."<br/> </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> Message: ".$this->input->post('details')."<br/> </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'> Thank you! </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'> Sincerely </td>

									</tr>

									<tr>

									 	<td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>".$this->input->post('name')."</td>

									</tr>

					       		</tbody>

					    	</table>

					 	</td>

					</tr>

   				</tbody>

			</table>";

			require 'vendor/autoload.php';

			$mail = new PHPMailer(true);

			try {

				//Server settings

				$mail->CharSet = 'UTF-8';

				$mail->SetFrom('no-reply@goigi.com', 'Afrebay');

				$mail->AddAddress($_POST['email']);

				$mail->IsHTML(true);

				$mail->Subject = $subject;

				$mail->Body = $message;

				//Send email via SMTP

				$mail->IsSMTP();

				$mail->SMTPAuth   = true;

				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

				$mail->Host       = "smtp.gmail.com";

				$mail->Port       = 587; //587 465

				$mail->Username   = "no-reply@goigi.com";

				$mail->Password   = "wj8jeml3eu0z";

				$mail->send();

				// echo 'Message has been sent';

			} catch (Exception $e) {

				$this->session->set_flashdata('message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");

			}

			//$msg = "An email has been sent to your email address containing an activation link. Please click on the link to activate your account. If you do not click the link your account will remain inactive and you will not receive further emails. If you do not receive the email within a few minutes, please check your spam folder.";

			$res = 1;

		} else {

			$res = 2;

		}

		echo $res; exit;

	}

}
