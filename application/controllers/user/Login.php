<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mymodel');
	}

	public function reg() {
	 	/*$validate=$this->Crud_model->get_single('users',"mobile='".$_POST['mobile']."'");
	    if(!empty($validate)) {
			$data=array('result'=>0,'data'=>'phone');
		} else {
			$validate=$this->Crud_model->get_single('users',"email='".$_POST['email']."'");
			if(!empty($validate)) {
				$data=array('result'=>0,'data'=>'email');
			}
		}*/

		$validate=$this->Crud_model->get_single('users',"email='".$_POST['email']."'");
		if(!empty($validate)) {
			$data=array('result'=>0,'data'=>'email');
		}

		if(empty($validate)) {
			$data=array(
				'userType' =>$_POST['user_type'],
				'firstname' =>$_POST['first_name'],
				'lastname' =>$_POST['last_name'],
				'companyname' =>$_POST['company_name'],
				'email' =>$_POST['email'],
				//'mobile' =>$_POST['mobile'],
				//'serviceType' => implode(", ", $_POST['service']),
				'address' =>$_POST['location'],
				'latitude' =>$_POST['latitude'],
				'longitude' =>$_POST['longitude'],
				'password' => md5($_POST['password']),
				'created'=>date('Y-m-d H:i:s'),
				'status'=>0
			);

			$result = $this->Mymodel->insert('users',$data);
			if($_POST['first_name']) {
					$fullname = $_POST['first_name']." ".$_POST['last_name'];
			} else {
				$fullname = $_POST['company_name'];
			}

			$insert_id = $this->db->insert_id();
			$get_setting=$this->Crud_model->get_single('setting');
			if(!empty($insert_id)) {
				//$subject = 'Verify Your Email Address From Afrebay';
				$data=array(
					'activationURL' => base_url() . "email-verification/" . urlencode(base64_encode($insert_id)),
					'imagePath' => base_url().'uploads/logo/'.$get_setting->flogo,
					'fullname' => $fullname,
				);
				$message = $this->load->view('email_template/signup',$data,TRUE);
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('no-reply@goigi.com', 'Afrebay');
					$mail->AddAddress($_POST['email']);
					$mail->IsHTML(true);
					$mail->Subject = 'Verify Your Email Address From Afrebay';
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
				$data=array('result'=>1,'data'=>1);
			} else {
				$data=array('result'=>2,'data'=>2);
			}
		}
		echo json_encode($data); exit;
    }

    public function emailVerification($otp=null) {
		if(empty($otp)) {
			$this->session->set_flashdata('message', 'You have not permission to access this page!');
			redirect(base_url('register'), 'refresh');
		}
        $givenotp = base64_decode(urldecode($otp));
        $sql = "SELECT * FROM `users` WHERE userId = '".$givenotp."' AND status = '0' AND `email_verified` = '0'";
        $check = $this->db->query($sql)->num_rows();
        $data = array(
            'title' => 'Account Activation',
        );
        if ($check > 0) {
            $usr = $this->db->query($sql)->row();
            $result = $this->db->query("UPDATE `users` SET `email_verified` = 1, `status` = 1 where `userId` = $usr->userId");
            if ($result) {
                $this->session->set_flashdata('message', 'Your Email Address is verified successfully and your account is active. Please login.');
				redirect(base_url('login'), 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Sorry! There is error verifying your Email Address!');
                redirect(base_url('login'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', 'Sorry! Activation link is expired!');
            redirect(base_url('login'), 'refresh');
        }
    }

	public function validate_user($pId = null) {
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == false) {
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		} else {
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			if($this->Mymodel->check_record($email, $password)) {
				$this->session->set_flashdata('message', 'Logged in successfully !');
				if($_SESSION['afrebay']['userType'] == '1') {
					redirect('jobbid');
				} else if($_SESSION['afrebay']['userType'] == '2') {
					$check_sub = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$_SESSION['afrebay']['userId']."'");
					if(!empty($check_sub)) {
						redirect('profile');
					} else {
						redirect('subscription');
					}
				}
			} else {
				$this->session->set_flashdata('message', 'Invalid Email Address or Password !');
				redirect('login');
			}
		}
	}

	public function logout() {
	    unset($_SESSION['afrebay']);
			$this->session->set_flashdata('message', 'You have logged out.');
			redirect('login');
	}

    function forgot_password() {
   	   	$this->load->view('header');
		$this->load->view('forgot_password');
		$this->load->view('footer');
   	}

	function send_forget_password() {
    	if(!empty($this->input->post('email',TRUE))) {
     		$get_email = $this->Crud_model->get_single('users',"email='".$_POST['email']."'");
         	if(!empty($get_email)) {
             	$data=array(
					'email'=>$get_email->email
				);
				$htmlContent = $this->load->view('email_template/forgot_password',$data,TRUE);
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('no-reply@goigi.com', 'Afrebay');
					$mail->AddAddress($_POST['email']);
					$mail->IsHTML(true);
					$mail->Subject = "Forgot Password Confirmation message from AFREBAY";
					$mail->Body = $htmlContent;
					//Send email via SMTP
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 587; //587 465
					$mail->Username   = "no-reply@goigi.com";
					$mail->Password   = "wj8jeml3eu0z";
					$mail->send();
					//echo $msg = '1';
					$this->session->set_flashdata('message', 'Please check your inbox. We have sent you an email to reset your password.');
				} catch (Exception $e) {
					//echo $msg = '2';
					$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
				}
         	} else {
   				//echo $msg = '3';
				$this->session->set_flashdata('error', 'invalid Email Id!');
   			}
			redirect(base_url('forgot-password'));
		}
	}

	function new_password() {
	    $data['title']='Forget Password';
		$this->load->view('header',$data);
		$this->load->view('new_password');
		$this->load->view('footer');
	}

	public function setnew_password() {
		if($this->input->post('email',TRUE)){
		 	$get_email = $this->Crud_model->GetData('users','',"email='".$_POST['email']."'",'','','','1');
			if(!empty($get_email)) {
				$data = array('password' =>md5($_POST['password']));
			 	$con="userId='".$get_email->userId."'";
			 	$this->Crud_model->SaveData('users',$data, $con);
			 	$this->session->set_flashdata('message', 'You have reset your password successfully. Please try to login.');
	           	echo "1";
            } else {
            	$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            }
        }
	}

}//end controller
