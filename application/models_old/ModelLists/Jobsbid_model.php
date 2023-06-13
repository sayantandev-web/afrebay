<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobsbid_model extends My_Model {
var $column_order = array(null,'job_bid.user_id','job_bid.postjob_id','job_bid.duration','job_bid.cost','job_bid.created_date',null); //set column field database for datatable orderable

    var $order = array('job_bid.id' => 'DESC');

    function __construct()
    {
        parent::__construct();
    }

	private function _get_datatables_query()
	{
		$this->db->select('job_bid.*,postjob.post_title,users.username,CONCAT(users.firstname,"",users.lastname) as fullname');
        $this->db->from('job_bid');
       $this->db->join('postjob',"postjob.id=job_bid.postjob_id",'left');
       $this->db->join('users',"users.userId=job_bid.user_id",'left');
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string)
                {
                    $cond  = " ";
                    $cond.=" ( postjob.post_title LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  job_bid.duration LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  users.username LIKE '%".trim($show_string)."%') ";
                    $this->db->where($cond);
                }
            }
        $i++;

        if(isset($_POST['order'])) // here order processing
        {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        //$this->db->where($cond);
        return $query->result();
    }

	 public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }


	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
}
