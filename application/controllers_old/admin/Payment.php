<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelLists/Payment_model');
    }

    function index()
    {

        $header = array('title' => 'payment');
        $data = array(
            'heading' => 'Payment List',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/table_list/payment_list',$data);
        $this->load->view('admin/footer');
    }

    function ajax_manage_page()
    {
        $GetData = $this->Payment_model->get_datatables();
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

            //  $btn = ''.anchor(admin_url('users/view/'.base64_encode($row->userId)),'<span class="btn btn-sm bg-success-light mr-2"><i class="far fa-eye mr-1"></i>view</span>');
            // $btn .= ' | '.'<span data-placement="right" class="btn btn-sm btn-danger mr-2"  onclick="Delete(this,'.$row->userId.')">Delete</span>';
            // if($row->payment_status=='pending')
            // {
            //     $status='<label class="badge badge-dark">Pending</label>';
            // }
            // else if($row->payment_status=='succeeded')
            // {
            //     $status='<label class="badge badge-success">Complete Request to User</label>';
            // }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->name_of_card);
            $nestedData[] = ucfirst($row->companyname);
            $nestedData[] = $row->email;
            $nestedData[] = $row->transaction_id;
            $nestedData[] = '$'.' '.$row->amount;
            $nestedData[] = date('d-M-Y',strtotime($row->payment_date));
            $nestedData[] = date('d-M-Y',strtotime($row->expiry_date));
            $nestedData[] = $row->payment_status;
            //$nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Payment_model->count_all(),
            "recordsFiltered" => $this->Payment_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }



}//end controller

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
