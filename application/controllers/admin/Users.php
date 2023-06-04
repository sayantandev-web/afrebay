<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    function index()
    {

        $header = array('title' => 'users');
        $data = array(
            'heading' => 'Users',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/list',$data);
        $this->load->view('admin/footer');
    }

    function ajax_manage_page()
    {
        $GetData = $this->Users_model->get_datatables();
        if(empty($_POST['start']))
        {

            $no=0;
        }
        else{
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row)
        {
            if($row->userType == 1) {
                $btn = ''.anchor(base_url('worker-detail/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
            } else {
                $btn = ''.anchor(base_url('employerdetail/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>View</span>');
            }
            $btn .= ' | '.anchor(base_url('profile/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>Edit</span>','target=_blank');

            // $btn .= ' | '.anchor(base_url('profile/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>Edit</span>');

            $btn .= ' |  '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')" style="margin-left: 8px;">Delete</span>';
            if($row->userType==1)
            {
                $type='Freelancer';
            }
            elseif($row->userType==2){
                $type='Vendor';
            }
            if($row->status=="1"){
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->userId.'\'" class="check" type="checkbox" checked onClick="status('.$row->userId.');">
                <label for="rating_\''.$row->userId.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
            else
            {
                $status='<div class="status-toggle">
                <input id="rating_\''.$row->userId.'\'" class="check" type="checkbox" onClick="status('.$row->userId.');">
                <label for="rating_\''.$row->userId.'\'" class="checktoggle">checkbox</label>
                </div>';
            }
            if(!empty($row->firstname)){
                $name = $row->firstname.' '.$row->lastname;
            } else {
                $name = $row->companyname;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $type;
            $nestedData[] = $name;
            $nestedData[] = $row->email;
            $nestedData[] = $row->mobile;
            $nestedData[] = date('d-m-Y',strtotime($row->created));
            $nestedData[] = $status."<input type='hidden' id='status".$row->userId."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Users_model->count_all(),
            "recordsFiltered" => $this->Users_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    function view($id)
    {
        $con="userId ='".base64_decode($id)."'";
        $get_userdata=$this->Crud_model->get_single('users',$con);

        $header = array('title' => 'user view');
        $data = array(
            'heading' => 'User',
            'get_userdata' => $get_userdata,
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/users/view',$data);
        $this->load->view('admin/footer');
    }

    public function change_status()
    {
        if($_POST['status']=='1')
        {
            $statuss='0';

        }
        else if($_POST['status']=='0'){
            $statuss='1';

        }
        $data=array(
            'status'=>$statuss,
        );
        $this->Crud_model->SaveData("users",$data,"userId='".$_POST['id']."'");

    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
            $this->Crud_model->DeleteData('users',"userId='".$_POST['cid']."'");
        }
    }

}//end controller

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
