<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ModelLists/Payment_model');
    }

    function index() {
        $header = array('title' => 'payment');
        $data = array(
            'heading' => 'Payment List',
        );
        $this->load->view('admin/header', $header);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/table_list/payment_list',$data);
        $this->load->view('admin/footer');
    }

    function ajax_manage_page() {
        $GetData = $this->Payment_model->get_datatables();
        if(empty($_POST['start'])) {
            $no=0;
        } else {
            $no =$_POST['start'];
        }
        $data = array();
        foreach ($GetData as $row) {
            if(!empty($row->firstname)) {
                $fullname = $row->firstname.' '.$row->lastname;
            } else {
                $fullname = $row->companyname;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->name_of_card);
            $nestedData[] = ucwords($fullname);
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
}
//end controller
