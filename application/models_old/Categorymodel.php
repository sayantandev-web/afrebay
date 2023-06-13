<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categorymodel extends My_Model {
var $column_order = array(null,null,'category.category_name','category.status',null); //set column field database for datatable orderable
 
    var $order = array('category.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($cond)
	{
		$this->db->select('category.*');
        $this->db->from('category');
       $this->db->where($cond);
		$i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  category.category_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  category.status LIKE '%".trim($show_string)."%') ";
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

	function get_datatables($cond)
    {
        $this->_get_datatables_query($cond);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        $this->db->where($cond);
        return $query->result();
    }

	 public function count_all($cond)
    {    
        $this->_get_datatables_query($cond);
        return $this->db->count_all_results();
    }


	function count_filtered($cond)
    {
        $this->_get_datatables_query($cond);
        $query = $this->db->get();
        return $query->num_rows();
    }
}