<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_job extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Post_job_model');
	}

	function index() {
		//$get_category=$this->Crud_model->GetData('category');
		$header = array('title' => 'Job Posts');
		$data = array(
			'heading' => 'Job Posts',
            //'get_category' => $get_category
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/post_job/list',$data);
        $this->load->view('admin/footer');
	}

	function ajax_manage_page() {
		$GetData = $this->Post_job_model->get_datatables();
        if(empty($_POST['start'])) {
    		$no=0;
       	} else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
			$string = strip_tags($row->post_title);
			if (strlen($string) > 100) {
				$stringCut = substr($string, 0, 50);
				$endPoint = strrpos($stringCut, ' ');
				$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				$string .= '...';
			}
			if($row->status=="Active"){
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->id.'\'" class="check" type="checkbox" checked onClick="status('.$row->id.');">
                <label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
            else
            {
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->id.'\'" class="check" type="checkbox" onClick="status('.$row->id.');">
                <label for="rating_\''.$row->id.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
			$btn = ''.anchor(base_url('update-postjob/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>Edit</span>');
			$btn .= ''.anchor(base_url('postdetail/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>Delete</span>');
			$btn .= ''.anchor(base_url('postdetail/'.base64_encode($row->id)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucwords($string);
			$nestedData[] = ucwords($row->category_name);
			$nestedData[] = $row->duration;
			$nestedData[] = "USD"." ".$row->charges;
			$nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
			$nestedData[] = $btn;
			$data[] = $nestedData;
        }

    	$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Post_job_model->count_all(),
            "recordsFiltered" => $this->Post_job_model->count_filtered(),
            "data" => $data,
        );
    	echo json_encode($output);
	}



	function view($id) {
	 	$con="postjob.id='".base64_decode($id)."'";
	 	$get_post_job=$this->Post_job_model->viewdata($con);
		//print_r($get_post_job); die();
		$header = array('title' => 'Job Details');
		$data = array(
			'heading' => 'Job Details',
			'get_post_job' => $get_post_job,
		);
		$this->load->view('admin/header', $header);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/post_job/view',$data);
		$this->load->view('admin/footer');
	 }
}
?>
