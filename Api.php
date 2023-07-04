<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
        @parent::__construct();
		$this->load->library('image_lib');
		$this->load->helper('cookie');
    }


	public function index()
	{}

	public function admin_details() {
      $data['details'] = $this->common_model->get_data_row(ADMIN,array('status' => 1));
      $data['status']     = "1";
	  echo json_encode($data);
	}

	public function home_lists() {
		$categories = $this->common_model->get_data_array(CATEGORY,array('status' => 1),'','','','','',CATEGORY.".id ASC");
		foreach ($categories as $key => $category) {
			$data['lists'][$key]['category_name'] = $category['category_name'];
			$data['lists'][$key]['subcategories'] = $this->common_model->get_data_array(SUBCATEGORY,array('category_id' => $category['id'],'status' => 1),'','','','','',SUBCATEGORY.".id ASC");
		}
		$data['banners'] = $this->common_model->get_data_array(BANNER,array('status' => 1),'','','','','',BANNER.".id DESC");
		$data['category_image_path'] = base_url('assets/images/subCategories/thumb/');
		$data['banner_image_path'] = base_url('assets/images/bannners/thumb/');
		$data['banquets'] = $this->common_model->get_data_array(BANQUET,array('status' => 1),'','','','','',BANQUET.".id DESC");
		foreach ($data['banquets'] as $key => $value) {
				$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'banquet', 'table_id' => $value['id'], 'is_default' => 1));
				$data['banquets'][$key]['cover_iamge'] = base_url('assets/images/banquets/thumb/'.$image_default['file_name']);
		}
		$data['makeups'] = $this->common_model->get_data_array(RESHAM,array('status' => 1, 'type' => 'makeup'),'','','','','',RESHAM.".id DESC");

		foreach ($data['makeups'] as $key => $value1) {
				$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'resham', 'table_id' => $value1['id'], 'is_default' => 1));
				$data['makeups'][$key]['cover_iamge'] = base_url('assets/images/reshams/thumb/'.$image_default['file_name']);
		}
		$data['status']     = "1";
		echo json_encode($data);
	}

	public function list_details($type,$user_id) {
		$type1 = $type;
		if($type == 'renovation') {
		  $data['lists'] = $this->common_model->get_data_array(RENOVATION,array('type' => 'renovation', 'status' => 1),'','','','','',RENOVATION.".id DESC");
		}
		if($type == 'furniture') {
		  $data['lists'] = $this->common_model->get_data_array(RENOVATION,array('type' => 'furniture', 'status' => 1),'','','','','',RENOVATION.".id DESC");
		  $type = 'renovation';
		}
		if($type == 'card') {
		  $data['lists'] = $this->common_model->get_data_array(CARDS,array('status' => 1),'','','','','',CARDS.".id DESC");
		}
		if($type == 'banquet') {
		  $data['lists'] = $this->common_model->get_data_array(BANQUET,array('status' => 1),'','','','','',BANQUET.".id DESC");
		}
		if($type == 'dj') {
		  $data['lists'] = $this->common_model->get_data_array(DJ,array('status' => 1),'','','','','',DJ.".id DESC");
		}
		if($type == 'band') {
		  $data['lists'] = $this->common_model->get_data_array(BAND,array('status' => 1),'','','','','',BAND.".id DESC");
		}
		if($type == 'dance') {
		  $data['lists'] = $this->common_model->get_data_array(DANCE,array('status' => 1),'','','','','',DANCE.".id DESC");
		}
		if($type == 'singer') {
		  $data['lists'] = $this->common_model->get_data_array(SINGER,array('status' => 1),'','','','','',SINGER.".id DESC");
		}
		if($type == 'pre-weeding') {
		  $data['lists'] = $this->common_model->get_data_array(SHOOT,array('status' => 1, 'type' => 'pre'),'','','','','',SHOOT.".id DESC");
		  $type  = 'shoot';
		  $type1 = 'pre-weeding';
		}
		if($type == 'on-weeding') {
		  $data['lists'] = $this->common_model->get_data_array(SHOOT,array('status' => 1, 'type' => 'on'),'','','','','',SHOOT.".id DESC");
		  $type  = 'shoot';
		  $type1 = 'on-weeding';
		}
		if($type == 'video') {
		  $data['lists'] = $this->common_model->get_data_array(VIDEOGRAPHY,array('status' => 1),'','','','','',VIDEOGRAPHY.".id DESC");
		}
		if($type == 'makeup') {
		  $data['lists'] = $this->common_model->get_data_array(RESHAM,array('status' => 1, 'type' => 'makeup'),'','','','','',RESHAM.".id DESC");
		  $type  = 'resham';
		  $type1 = 'makeup';
		}
		if($type == 'mehendi') {
		  $data['lists'] = $this->common_model->get_data_array(RESHAM,array('status' => 1, 'type' => 'mehendi'),'','','','','',RESHAM.".id DESC");
		  $type  = 'resham';
		  $type1 = 'mehendi';
		}
		if($type == 'tentwala') {
		  $data['lists'] = $this->common_model->get_data_array(TENTWALA,array('status' => 1),'','','','','',TENTWALA.".id DESC");
		}
		if($type == 'light') {
		  $data['lists'] = $this->common_model->get_data_array(LIGHT,array('status' => 1),'','','','','',LIGHT.".id DESC");
		}
		if($type == 'catering') {
		  $data['lists'] = $this->common_model->get_data_array(CATERING,array('status' => 1),'','','','','',CATERING.".id DESC");
		}
		if($type == 'car') {
		  $data['lists'] = $this->common_model->get_data_array(CAR,array('status' => 1),'','','','','',CAR.".id DESC");
		}
		if($type == 'ghodey') {
		  $data['lists'] = $this->common_model->get_data_array(GHODEY,array('status' => 1),'','','','','',GHODEY.".id DESC");
		}
		if($type == 'bridal_wear') {
		  $data['lists'] = $this->common_model->get_data_array(WEARING,array('status' => 1, 'wearing_for' => 'bridal'),'','','','','',WEARING.".id DESC");
		  $type  = 'wear';
		  $type1 = 'bridal-wear';
		}
		if($type == 'groom_wear') {
		  $data['lists'] = $this->common_model->get_data_array(WEARING,array('status' => 1, 'wearing_for' => 'groom'),'','','','','',WEARING.".id DESC");
		  $type  = 'wear';
		  $type1 = 'groom-wear';
		}
		if($type == 'jewellery') {
		  $data['lists'] = $this->common_model->get_data_array(JEWELLERY,array('status' => 1, 'type' => 'jewellery'),'','','','','',JEWELLERY.".id DESC");
		}
		if($type == 'artificial') {
		  $data['lists'] = $this->common_model->get_data_array(JEWELLERY,array('status' => 1, 'type' => 'artificial'),'','','','','',JEWELLERY.".id DESC");
		  $type  = 'jewellery';
		  $type1 = 'artificial';
		}
		foreach ($data['lists'] as $key => $value) {
			if(($type == 'renovation') || ($type == 'furniture') || ($type == 'catering')) {
				$data['lists'][$key]['cover_iamge'] = base_url('assets/images/'.$type.'s/thumb/'.$value['cover_image']);
				$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value['id'], 'user_id' => $user_id, 'type' => $type1));
				if(!empty($isrelfav)) {
					$data['lists'][$key]['is_fav'] = 1;
				}

			} else if($type == 'jewellery') {
				$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => $type, 'table_id' => $value['id'], 'is_default' => 1));
				$data['lists'][$key]['cover_iamge'] = base_url('assets/images/jewelleries/thumb/'.$image_default['file_name']);
				$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value['id'], 'user_id' => $user_id, 'type' => $type1));
				if(!empty($isrelfav)) {
					$data['lists'][$key]['is_fav'] = 1;
				}
			} else {
				$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => $type, 'table_id' => $value['id'], 'is_default' => 1));
				$data['lists'][$key]['cover_iamge'] = base_url('assets/images/'.$type.'s/thumb/'.$image_default['file_name']);
				$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value['id'], 'user_id' => $user_id, 'type' => $type1));
				if(!empty($isrelfav)) {
					$data['lists'][$key]['is_fav'] = 1;
				}
				if(($type1 == 'bridal-wear') || ($type1 == 'groom-wear')) {
					$price = $this->common_model->get_data_array(SIZE,array('wearing_id' => $value['id']),'','','','','',SIZE.".size ASC");
					$data['lists'][$key]['price'] = $price[0]['price'];
				}
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}
    
    public function food_lists($catering_id) {
	  $category = $this->common_model->get_data_array(FOOD_CATEGORY,array('status' => 1),'','','','','',FOOD_CATEGORY.".id ASC");
	  foreach ($category as $key => $value) {
	  	$category[$key]['items'] = $this->common_model->get_data_array(FOOD,array('category_id' => $value['id'], 'catering_id' => $catering_id, 'status' => 1),'','','','','',FOOD.".id ASC");
	  	if(!empty($category[$key]['items'])) {
	  		$data['lists'][$key] = $category[$key];
	  	}
	  }
	  $data['path'] = base_url('assets/images/foods/thumb/');
	  $data['status'] = "1";
	  echo json_encode($data);
    }

    public function getPincode($pincode)
	{
		$sql = "pincode like '".$pincode."'"; 
		$data['pincodes'] = $this->common_model->get_data_array(DIRECTORY_LISTS,$sql,'','','','','',DIRECTORY_LISTS.".officename ASC");
		$data['status'] = "1";
	    echo json_encode($data);
	}

    public function order()
	{
		$formdata = json_decode(file_get_contents('php://input'), true);
		$order_array                   = [];
		$order_Detail_array            = [];

		$order_array['user_id']        = $formdata['user_id'];
		$order_array['type']           = $formdata['type'];
		if(!empty($formdata['price'])) {
		  $order_array['price']        = $formdata['price'];
		}
		$order_array['qtt']            = $formdata['qtt'];
		if(!empty($formdata['table_id'])) {
		   $order_array['table_id']    = $formdata['table_id'];
		}
		if(!empty($formdata['size'])) {
		   $order_array['size']    = $formdata['size'];
		}
		if(($order_array['type'] != 'card') && ($order_array['type'] != 'groom-wear') && ($order_array['type'] != 'bridal-wear')) {
			$order_array['reception_date'] = date('Y-m-d',strtotime("+1 day",  strtotime($formdata['reception_date'])));
			$order_array['reception_time'] = date('h:i a',strtotime($formdata['time']));
	    }
	  	$order_array['address']        = $formdata['address'];
		if(!empty($formdata['landmark'])) {
			$order_array['landmark']   = $formdata['landmark'];
		}
		$order_array['pincode']        = $formdata['pincode'];
		$order_array['postoffice']     = $formdata['postoffice'];
		$order_array['city']           = $formdata['city'];
		$order_array['state']          = $formdata['state'];
        $order_history = $this->common_model->get_data_array(ORDER,'','','','','','',ORDER.".id DESC");
        if(!empty($order_history)) {
        	$product_code = $order_history[0]['order_no'];
            $exp = explode('#SW',$product_code);
            $product_code = $exp[1];
            $product_code = ltrim($product_code, '0');   
            $product_code ++;                   
            $order_array['order_no'] = '#SW'.sprintf("%04d", $product_code);
        } else {
           $order_array['order_no'] = '#SW0001';
        }
	       $table_id = $this->common_model->tbl_insert(ORDER,$order_array);
        
        if($order_array['type'] == 'food') {
			foreach ($formdata['orders'] as $value) {
	                 $order_Detail_array['order_id'] = $table_id;
	                 $order_Detail_array['table_id'] = $value['id'];
	                 $order_Detail_array['price']    = $value['price'];
	                 $this->common_model->tbl_insert(ORDER_DETAILS,$order_Detail_array);
			}	
        }
        if($order_array['type'] == 'card') {
	         $order_Detail_array['order_id']          = $table_id;
	         $order_Detail_array['table_id']          = $formdata['orders']['id'];
	         $order_Detail_array['price']             = $formdata['orders']['price'];
	         $order_Detail_array['marriage_type']     = $formdata['orders']['marriage_type'];
	         $order_Detail_array['groom_name']        = $formdata['orders']['groom_name'];
	         $order_Detail_array['groom_father_name'] = $formdata['orders']['groom_father_name'];
	         $order_Detail_array['groom_mother_name'] = $formdata['orders']['groom_mother_name'];
	         $order_Detail_array['bride_name']        = $formdata['orders']['bride_name'];
	         $order_Detail_array['bride_father_name'] = $formdata['orders']['bride_father_name'];
	         $order_Detail_array['bride_mother_name'] = $formdata['orders']['bride_mother_name'];
	         $order_Detail_array['date_of_weeding']   = date('Y-m-d',strtotime("+1 day",  strtotime($formdata['orders']['date_of_weeding'])));
	         $order_Detail_array['reception_date']    = date('Y-m-d',strtotime("+1 day",  strtotime($formdata['orders']['reception_date'])));
	         $order_Detail_array['reception_time']    = date('h:i a',strtotime($formdata['orders']['reception_time']));
	         $order_Detail_array['card_description']  = $formdata['orders']['card_description'];
	         $this->common_model->tbl_insert(ORDER_DETAILS,$order_Detail_array);
        }
		if($table_id)
		{
			$data['status']   = "1";
			$data['order_no'] = $order_array['order_no'];
			$data['msg']      = "Thank you for ordering.We received your order and will begin processing soon.Your Order number is : <strong>".$order_array['order_no'].'</strong>';
			echo json_encode($data);
		} else {
			$data['status']   = "0";
			$data['msg']      = "Sorry there's a problem. please try again later";
			echo json_encode($data);
		}
	}

	public function card_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(CARDS,array('id' => $id));
		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'card'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}
		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'card', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/cards/crop/'.$value['file_name']);
		}

		$data['related_cards'] = $this->common_model->get_data_array(CARDS,array('status' => 1, 'id !=' => $id),'','','','','',CARDS.".id DESC");

		foreach ($data['related_cards'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'card', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_cards'][$key]['cover_iamge'] = base_url('assets/images/cards/thumb/'.$image_default['file_name']);
			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'card'));
			if(!empty($isrelfav)) {
				$data['related_cards'][$key]['is_fav'] = 1;
			}
		}
		$data['serviceTypes'] = [];
		if(!empty($data['details']['description'])) {
			array_push($data['serviceTypes'],'DESCRIPTION');
		}
		if(!empty($data['details']['information'])) {
			array_push($data['serviceTypes'],'ADDITIONAL INFORMATION');
		}
		if(!empty($data['details']['work'])) {
			array_push($data['serviceTypes'],'HOW WE WORK?');
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function banquet_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(BANQUET,array('id' => $id));
        $isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'banquet'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}
		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'banquet', 'table_id' => $data['details']['id']));

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'banquet', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/banquets/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_banquets'] = $this->common_model->get_data_array(BANQUET,array('status' => 1, 'id !=' => $id),'','','','','',BANQUET.".id DESC");

		foreach ($data['related_banquets'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'banquet', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_banquets'][$key]['cover_iamge'] = base_url('assets/images/banquets/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'banquet'));
			if(!empty($isrelfav)) {
				$data['related_banquets'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function tentwala_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(TENTWALA,array('id' => $id));
        $isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'tentwala'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}
		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'tentwala', 'table_id' => $data['details']['id']));

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'tentwala', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/tentwalas/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_tentwalas'] = $this->common_model->get_data_array(TENTWALA,array('status' => 1, 'id !=' => $id),'','','','','',TENTWALA.".id DESC");

		foreach ($data['related_tentwalas'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'tentwala', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_tentwalas'][$key]['cover_iamge'] = base_url('assets/images/tentwalas/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'tentwala'));
			if(!empty($isrelfav)) {
				$data['related_tentwalas'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function light_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(LIGHT,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'light', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'light'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'light', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/lights/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_lights'] = $this->common_model->get_data_array(LIGHT,array('status' => 1, 'id !=' => $id),'','','','','',LIGHT.".id DESC");

		foreach ($data['related_lights'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'light', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_lights'][$key]['cover_iamge'] = base_url('assets/images/lights/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'light'));
			if(!empty($isrelfav)) {
				$data['related_lights'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function dj_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(DJ,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'dj', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'dj'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'dj', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/djs/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_djs'] = $this->common_model->get_data_array(DJ,array('status' => 1, 'id !=' => $id),'','','','','',DJ.".id DESC");

		foreach ($data['related_djs'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'dj', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_djs'][$key]['cover_iamge'] = base_url('assets/images/djs/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'dj'));
			if(!empty($isrelfav)) {
				$data['related_djs'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}


	public function band_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(BAND,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'band', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'band'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'band', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/bands/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_bands'] = $this->common_model->get_data_array(BAND,array('status' => 1, 'id !=' => $id),'','','','','',BAND.".id DESC");

		foreach ($data['related_bands'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'band', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_bands'][$key]['cover_iamge'] = base_url('assets/images/bands/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'band'));
			if(!empty($isrelfav)) {
				$data['related_bands'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function dance_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(DANCE,array('id' => $id));
		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'dance'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'dance', 'table_id' => $data['details']['id']));

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'dance', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/dances/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_dances'] = $this->common_model->get_data_array(DANCE,array('status' => 1, 'id !=' => $id),'','','','','',DANCE.".id DESC");

		foreach ($data['related_dances'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'dance', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_dances'][$key]['cover_iamge'] = base_url('assets/images/dances/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'dance'));
			if(!empty($isrelfav)) {
				$data['related_dances'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}


	public function singer_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(SINGER,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'singer', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'singer'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'singer', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/singers/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_singers'] = $this->common_model->get_data_array(SINGER,array('status' => 1, 'id !=' => $id),'','','','','',SINGER.".id DESC");

		foreach ($data['related_singers'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'singer', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_singers'][$key]['cover_iamge'] = base_url('assets/images/singers/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'singer'));
			if(!empty($isrelfav)) {
				$data['related_singers'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function pre_weeding_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(SHOOT,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'shoot', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'pre-weeding'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/shoots/crop/'.$value['file_name']);
		}

		$data['related_shoots'] = $this->common_model->get_data_array(SHOOT,array('status' => 1, 'id !=' => $id, 'type' => 'pre'),'','','','','',SHOOT.".id DESC");

		foreach ($data['related_shoots'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'shoot', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_shoots'][$key]['cover_iamge'] = base_url('assets/images/shoots/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'pre-weeding'));
			if(!empty($isrelfav)) {
				$data['related_shoots'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

    
    public function on_weeding_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(SHOOT,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'shoot', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'on-weeding'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/shoots/crop/'.$value['file_name']);
		}

		$data['related_shoots'] = $this->common_model->get_data_array(SHOOT,array('status' => 1, 'id !=' => $id, 'type' => 'on'),'','','','','',SHOOT.".id DESC");

		foreach ($data['related_shoots'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'shoot', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_singers'][$key]['cover_iamge'] = base_url('assets/images/shoots/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'on-weeding'));
			if(!empty($isrelfav)) {
				$data['related_shoots'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function video_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(VIDEOGRAPHY,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'video', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'video'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'video', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/videos/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_videos'] = $this->common_model->get_data_array(VIDEOGRAPHY,array('status' => 1, 'id !=' => $id),'','','','','',VIDEOGRAPHY.".id DESC");

		foreach ($data['related_videos'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'video', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_videos'][$key]['cover_iamge'] = base_url('assets/images/videos/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'video'));
			if(!empty($isrelfav)) {
				$data['related_videos'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function makeup_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(RESHAM,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'resham', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'makeup'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'resham', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/reshams/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_reshams'] = $this->common_model->get_data_array(RESHAM,array('status' => 1, 'id !=' => $id, 'type' => 'makeup'),'','','','','',RESHAM.".id DESC");

		foreach ($data['related_reshams'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'resham', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_reshams'][$key]['cover_iamge'] = base_url('assets/images/reshams/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'makeup'));
			if(!empty($isrelfav)) {
				$data['related_reshams'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function mehendi_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(RESHAM,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'resham', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'mehendi'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'resham', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/reshams/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_reshams'] = $this->common_model->get_data_array(RESHAM,array('status' => 1, 'id !=' => $id, 'type' => 'mehendi'),'','','','','',RESHAM.".id DESC");

		foreach ($data['related_reshams'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'resham', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_reshams'][$key]['cover_iamge'] = base_url('assets/images/reshams/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'mehendi'));
			if(!empty($isrelfav)) {
				$data['related_reshams'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}
	

	public function car_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(CAR,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'car', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'car'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'car', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/cars/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_cars'] = $this->common_model->get_data_array(CAR,array('status' => 1, 'id !=' => $id, 'type' => $data['details']['type']),'','','','','',CAR.".id DESC");

		if($data['details']['type'] == 1) {
          $data['showTitle'] = 'Hatchback';
		} else if($data['details']['type'] == 2) {
          $data['showTitle'] = 'Sedan';
		} else {
          $data['showTitle'] = 'Suv';
		}

		foreach ($data['related_cars'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'car', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_cars'][$key]['cover_iamge'] = base_url('assets/images/cars/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'car'));
			if(!empty($isrelfav)) {
				$data['related_cars'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}


	public function ghodey_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(GHODEY,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'ghodey', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'ghodey'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$videos = $this->common_model->get_data_array(VIDEO,array('type' => 'ghodey', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/ghodeys/crop/'.$value['file_name']);
		}

		foreach ($videos as $key => $value) {
		   $data['details']['videos'][] = 'https://www.youtube.com/embed/'.$value['video_link'];
		}

		$data['related_ghodeys'] = $this->common_model->get_data_array(GHODEY,array('status' => 1, 'id !=' => $id),'','','','','',GHODEY.".id DESC");

		foreach ($data['related_ghodeys'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'ghodey', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_ghodeys'][$key]['cover_iamge'] = base_url('assets/images/ghodeys/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'ghodey'));
			if(!empty($isrelfav)) {
				$data['related_cars'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function bridal_wear_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(WEARING,array('id' => $id));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'bridal-wear'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

        $data['sizes'] = $this->common_model->get_data_array(SIZE,array('wearing_id' => $id),'','','','','',SIZE.".size ASC");
		$data['details']['price'] = $data['sizes'][0]['price'];

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'wear', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/wears/crop/'.$value['file_name']);
		}

		$data['related_bridal_wears'] = $this->common_model->get_data_array(WEARING,array('status' => 1, 'id !=' => $id, 'type' => $data['details']['type']),'','','','','',WEARING.".id DESC");

		if($data['details']['type'] == 'lengha') {
          $data['showTitle'] = 'Lengha';
		} else {
          $data['showTitle'] = 'Saree';
		}

		foreach ($data['related_bridal_wears'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'wear', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_bridal_wears'][$key]['cover_iamge'] = base_url('assets/images/wears/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'bridal-wear'));
			if(!empty($isrelfav)) {
				$data['related_bridal_wears'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function groom_wear_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(WEARING,array('id' => $id));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'groom-wear'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		$data['sizes'] = $this->common_model->get_data_array(SIZE,array('wearing_id' => $id),'','','','','',SIZE.".size ASC");
		$data['details']['price'] = $data['sizes'][0]['price'];

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'wear', 'table_id' => $data['details']['id']));

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/wears/crop/'.$value['file_name']);
		}

		$data['related_groom_wears'] = $this->common_model->get_data_array(WEARING,array('status' => 1, 'id !=' => $id, 'type' => $data['details']['type']),'','','','','',WEARING.".id DESC");

		if($data['details']['type'] == 'sherwani') {
          $data['showTitle'] = 'Sherwani';
		} else {
          $data['showTitle'] = 'Wedding Suits / Tuxes';
		}

		foreach ($data['related_groom_wears'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'wear', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_groom_wears'][$key]['cover_iamge'] = base_url('assets/images/wears/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'groom-wear'));
			if(!empty($isrelfav)) {
				$data['related_groom_wears'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}

	public function jewellery_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(JEWELLERY,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'jewellery', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'jewellery'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/jewelleries/crop/'.$value['file_name']);
		}

		$data['related_jewellery'] = $this->common_model->get_data_array(JEWELLERY,array('status' => 1, 'id !=' => $id, 'type' => 'jewellery'),'','','','','',JEWELLERY.".id DESC");

		foreach ($data['related_jewellery'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'jewellery', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_jewellery'][$key]['cover_iamge'] = base_url('assets/images/jewelleries/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'jewellery'));
			if(!empty($isrelfav)) {
				$data['related_jewellery'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}


	public function artificial_detail($id,$user_id) {
		$data['details'] = $this->common_model->get_data_row(JEWELLERY,array('id' => $id));

		$images = $this->common_model->get_data_array(STORAGE,array('status' => 1, 'type' => 'jewellery', 'table_id' => $data['details']['id']));

		$isfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $id, 'user_id' => $user_id, 'type' => 'artificial'));
		if(!empty($isfav)) {
			$data['details']['is_fav'] = 1;
		}

		foreach ($images as $key => $value) {
		   $data['details']['cover_iamges'][] = base_url('assets/images/jewelleries/crop/'.$value['file_name']);
		}

		$data['related_jewellery'] = $this->common_model->get_data_array(JEWELLERY,array('status' => 1, 'id !=' => $id, 'type' => 'artificial'),'','','','','',JEWELLERY.".id DESC");

		foreach ($data['related_jewellery'] as $key => $value1) {
			$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => 'jewellery', 'table_id' => $value1['id'], 'is_default' => 1));
			$data['related_jewellery'][$key]['cover_iamge'] = base_url('assets/images/jewelleries/thumb/'.$image_default['file_name']);

			$isrelfav = $this->common_model->get_data_row(FAVORITE,array('table_id' => $value1['id'], 'user_id' => $user_id, 'type' => 'artificial'));
			if(!empty($isrelfav)) {
				$data['related_jewellery'][$key]['is_fav'] = 1;
			}
		}
		$data['status'] = "1";
		echo json_encode($data);
	}
    

    public function register()
	{
		$formdata = json_decode(file_get_contents('php://input'), true);
		$member = $this->common_model->get_data_row(MEMBER,array('email'=>$formdata['email']));
        if(!empty($member)) {
		  $data['status'] = "0";
		  $data['msg'] = "Sorry this member already exist, try with another email.";
          echo json_encode($data);
        } else {
        	$insert_array                        = [];
	        	$insert_array['fname']           = $formdata['fname'];
	        	$insert_array['lname']           = $formdata['lname'];
				$insert_array['email']           = $formdata['email'];
				$insert_array['phone']           = $formdata['phone'];
				$insert_array['password']        = md5($formdata['password']);
				// $insert_array['vcode']           = rand(111111,999999);
				$insert_array['vcode']           = 123456;
				$insert_array['status']          = 0;
				$insert_array['created_at']      = date("y-m-d h:i:s");

				$user_id = $this->common_model->tbl_insert(MEMBER,$insert_array);

                $data['member'] = $this->common_model->get_data_row(MEMBER,array('id'=> $user_id));

				$to = $formdata['email'];
				$subject="Shadi Wala Account Verification";
			    $body='<p>Dear <strong>'.$formdata['fname'].' '.$formdata['lname'].'</strong>,</p>';
				$body.='<p>Your verification code is : <b>'.$data['member']['vcode'].'</b></p>'; 
				if($this->utilitylib->sendMail($to,$subject,$body))
				{
					$data['status'] = "1";
					$data['msg'] = "Congratulation!! Your account has been created.  An email has been sent to your resgistered email address. Kindly confim your email address in order to get started.";
			        echo json_encode($data);
			    } else {
			    	$data['status'] = "0";
		            $data['msg'] = "Sorry invalid email address, try with another email.";
                    echo json_encode($data);
			    }
        }
	}

	public function verify()
	{ 
		$formdata = json_decode(file_get_contents('php://input'), true);
		$userdata = $this->common_model->get_data_row(MEMBER,array('id'=> $formdata['user_id'],'vcode'=> $formdata['vcode']));
		if(!empty($userdata)){
			$update_array=array();
			$update_array['vcode'] = 0;
			$update_array['status'] = 1;
			$this->common_model->tbl_update(MEMBER,array('id' => $formdata['user_id']),$update_array);
			$data['status'] = "1";
			$data['msg'] = "Congratulation!! Your account has been succeesully verified.  You can now login into our system.";
		    echo json_encode($data);
		}
		else {
		     $data['status'] = "0";
		     $data['msg'] = "Invalid Link! Please try again letter.";
             echo json_encode($data);
		}
	}


	public function login()
	{
		$formdata = json_decode(file_get_contents('php://input'), true);
			$where=array();
			$where['email'] = $formdata['email'];
			$userdata       = $this->common_model->get_data_row(MEMBER,$where);
			$password       = md5($formdata['password']);
			if(!empty($userdata)){
				if($password==$userdata['password']){
					if($userdata['status']==0){
						 $data['status'] = "2";

						 $update_array = array();
						 $update_array['vcode'] = rand(111111,999999);
						 $this->common_model->tbl_update(MEMBER,$where,$update_array);
				         $data['member'] = $this->common_model->get_data_row(MEMBER,$where);

						$to = $data['member']['email'];
						$subject="Shadi Wala Account Verification";
					    $body='<p>Dear <strong>'.$data['member']['fname'].' '.$data['member']['lname'].'</strong>,</p>';
						$body.='<p>Your verification code is : <b>'.$data['member']['vcode'].'</b></p>'; 
						if($this->utilitylib->sendMail($to,$subject,$body))
						{
							$data['msg'] = "An email has been sent to your resgistered email address. Kindly confim your email address in order to get started.";
					        echo json_encode($data);
					    } else {
						   $data['msg'] = "Sorry there's a problem. please try again later";
					    }
					}
					else if($userdata['status']==2){
						 $data['status'] = "0";
						 $data['msg'] = "Your account is temporary blocked.";
	                     echo json_encode($data);
					}
					else if($userdata['status']==1){
						$data['user'] = array(
							'user_id'    => $userdata['id'],
							'fname'      => $userdata['fname'],
							'lname'      => $userdata['lname'],
							'email'      => $userdata['email'],
							'phone'      => $userdata['phone']
						);
						 $data['status'] = "1";
						 $data['msg'] = "Suceess.";
	                     echo json_encode($data);
					}
				}
				else{
					 $data['status'] = "0";
					 $data['msg'] = "Invalid email or password.";
	                 echo json_encode($data);
				}
			}
			else{
				 $data['status'] = "0";
				 $data['msg'] = "Invalid email or password.";
                 echo json_encode($data);
			}
	}

	public function forgot_password()
	{
	    $formdata = json_decode(file_get_contents('php://input'), true);
		$value['email'] = $formdata['email'];
		$result         = $this->common_model->get_data_row(MEMBER,$value);

		if(!empty($result)) {
			if($result['status'] == 1) {
				$data['member'] = $this->common_model->get_data_row(MEMBER,$value);
				$data['status'] = "1";
	            $data['msg'] = "Valid user.";
                echo json_encode($data);
			}
			else if ($result['status'] == 2) {
			    $data['status'] = "0";
	            $data['msg'] = "Sorry! You are a blocked user.";
                echo json_encode($data);
            }
            else {
			    $data['status'] = "0";
	            $data['msg'] = "Sorry! Your account is not verified yet.";
                echo json_encode($data);
            }
		}
		else{
			$data['status'] = "0";
	        $data['msg'] = "Sorry! You are not a valid user.";
            echo json_encode($data);
		}
	}

	public function reset_password() {
		$formdata = json_decode(file_get_contents('php://input'), true);
		$user_id  = $formdata['user_id'];
		$check = $this->common_model->get_data_row(MEMBER,array('id' => $user_id));
		if(!empty($check)) {
				$password = $formdata['password'];
				$arrData = array();
				$arrData['password'] = md5($password);
				$result=$this->common_model->tbl_update(MEMBER,array('id' => $user_id),$arrData);

				$data['status'] = "1";
	            $data['msg'] = "You have successfully reset your password. You can login with your new password now.";
                echo json_encode($data);
		}
		else{
			$data['status'] = "0";
	        $data['msg'] = "Sorry! You are not a valid user.";
            echo json_encode($data);
		}
	}



	public function add_favorite()
	{
		$formdata = json_decode(file_get_contents('php://input'), true);
		if($formdata[0]['is_fav'] == 0) {
			$insert_array['type']     = $formdata[0]['type'];
			$insert_array['table_id'] = $formdata[0]['id'];
			$insert_array['user_id']  = $formdata[0]['user_id'];
		   $this->common_model->tbl_insert(FAVORITE,$insert_array);
	       $data['msg'] = "Added to your favorite.";
		} else {
			$this->common_model->tbl_record_del(FAVORITE,array('table_id' => $formdata[0]['id'], 'type' => $formdata[0]['type'], 'user_id'=> $formdata[0]['user_id']));
			$data['msg'] = "Remove from your favorite.";
		}
		$data['status'] = "1";
        echo json_encode($data);
	}

	public function favorite_lists($user_id) {
		$categories = $this->common_model->get_data_array(CATEGORY,array('status' => 1),'','','','','',CATEGORY.".id ASC");
		foreach ($categories as $key => $category) {
			$details[$key]['category_name'] = $category['category_name'];
			$details[$key]['subcategories'] = $this->common_model->get_data_array(SUBCATEGORY,array('category_id' => $category['id'],'status' => 1),'','','','','',SUBCATEGORY.".id ASC");

			foreach ($details[$key]['subcategories'] as $key1 => $value1)
			{
				$exp  = explode("-list",$value1['url']);
				$type = $exp[0];
				$isfav = $this->common_model->get_data_array(FAVORITE,array('user_id' => $user_id, 'type' => $type));
				if(!empty($isfav)) {
					$details[$key]['subcategories'][$key1]['total'] = count($isfav);
					$data['lists'][] = $details[$key]['subcategories'][$key1];
				} else {
					$details[$key]['subcategories'][$key1]['total'] = 0;
				}
			}
		}
		$data['category_image_path'] = base_url('assets/images/subCategories/thumb/');
		$data['status']     = "1";
		echo json_encode($data);
	}

	public function order_lists($user_id) {
		$data['orders'] = $this->common_model->get_data_array(ORDER,array('user_id' => $user_id),'','','','','',ORDER.".id DESC");
		foreach ($data['orders'] as $key => $order) {
			$data['orders'][$key]['created_at'] = date('d M Y',strtotime($order['created_at']));
			$data['orders'][$key]['reception_date'] = date('d M Y',strtotime($order['reception_date']));
			$data['orders'][$key]['type1'] = $data['orders'][$key]['type'];
			if($data['orders'][$key]['type'] == 'card') {
				 $detail = $this->common_model->get_data_row(CARDS,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['card_name'];
				 $data['orders'][$key]['order_details'] = $this->common_model->get_data_row(ORDER_DETAILS,array('order_id' => $order['id']));
			}
			if($data['orders'][$key]['type'] == 'banquet') {
				 $detail = $this->common_model->get_data_row(BANQUET,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['hall_name'];
			}
			if($data['orders'][$key]['type'] == 'tentwala') {
				 $detail = $this->common_model->get_data_row(TENTWALA,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['tentwala_name'];
			}
			if($data['orders'][$key]['type'] == 'light') {
				 $detail = $this->common_model->get_data_row(LIGHT,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['decorator_name'];
			}
			if($data['orders'][$key]['type'] == 'dj') {
				 $detail = $this->common_model->get_data_row(DJ,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['dj_name'];
			}
			if($data['orders'][$key]['type'] == 'band') {
				 $detail = $this->common_model->get_data_row(BAND,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['band_name'];
			}
			if($data['orders'][$key]['type'] == 'dance') {
				 $detail = $this->common_model->get_data_row(DANCE,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['dance_name'];
			}
			if($data['orders'][$key]['type'] == 'singer') {
				 $detail = $this->common_model->get_data_row(SINGER,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['singer_name'];
			}
			if(($data['orders'][$key]['type'] == 'pre-weeding') ||  ($data['orders'][$key]['type'] == 'on-weeding')) {
				 $detail = $this->common_model->get_data_row(SHOOT,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['photographer_name'];
				 $data['orders'][$key]['type1'] = 'shoot';
			}
			if($data['orders'][$key]['type'] == 'video') {
				 $detail = $this->common_model->get_data_row(VIDEOGRAPHY,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['videography_name'];
			}
			if(($data['orders'][$key]['type'] == 'makeup') ||  ($data['orders'][$key]['type'] == 'mehendi')) {
				 $detail = $this->common_model->get_data_row(RESHAM,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['resham_name'];
				 $data['orders'][$key]['type1'] = 'resham';
			}
			if($data['orders'][$key]['type'] == 'video') {
				 $detail = $this->common_model->get_data_row(VIDEOGRAPHY,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['videography_name'];
			}
			if($data['orders'][$key]['type'] == 'car') {
				 $detail = $this->common_model->get_data_row(CAR,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['car_name'];
			}
			if($data['orders'][$key]['type'] == 'ghodey') {
				 $detail = $this->common_model->get_data_row(GHODEY,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['ghodey_name'];
			}
			if(($data['orders'][$key]['type'] == 'bridal-wear') ||  ($data['orders'][$key]['type'] == 'groom-wear')) {
				 $detail = $this->common_model->get_data_row(WEARING,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['wearing_name'];
				 $data['orders'][$key]['type1'] = 'wear';
			}
			$data['orders'][$key]['url'] = $data['orders'][$key]['type'].'-detail/'.$data['orders'][$key]['table_id'];
				$image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => $data['orders'][$key]['type1'], 'table_id' => $data['orders'][$key]['table_id'], 'is_default' => 1));

				$data['orders'][$key]['cover_iamge'] = base_url('assets/images/'.$data['orders'][$key]['type1'].'s/thumb/'.$image_default['file_name']);

			if($data['orders'][$key]['type'] == 'catering') {
				$detail = $this->common_model->get_data_row(CATERING,array('id' => $data['orders'][$key]['table_id']));
				$data['orders'][$key]['item_name'] = $detail['catering_name'];
				$data['orders'][$key]['cover_iamge'] = base_url('assets/images/'.$data['orders'][$key]['type1'].'s/thumb/'.$detail['cover_image']);
				$data['orders'][$key]['order_details'] = $this->common_model->get_data_array(ORDER_DETAILS,array('order_id' => $order['id']));
				foreach ($data['orders'][$key]['order_details'] as $key1 => $order_detail) {
				  $data['orders'][$key]['order_details'][$key1]['food'] = $this->common_model->get_data_row(FOOD,array('id' => $order_detail['table_id']));
				}
			}
			if(($data['orders'][$key]['type'] == 'jewellery') ||  ($data['orders'][$key]['type'] == 'artificial')) {
				 $detail = $this->common_model->get_data_row(JEWELLERY,array('id' => $data['orders'][$key]['table_id']));
				 $data['orders'][$key]['item_name'] = $detail['jewellery_name'];
				 $data['orders'][$key]['url'] = $data['orders'][$key]['type'].'-detail/'.$data['orders'][$key]['table_id'];
				 $data['orders'][$key]['type'] = 'jewellery';
				 $image_default = $this->common_model->get_data_row(STORAGE,array('status' => 1, 'type' => $data['orders'][$key]['type'], 'table_id' => $data['orders'][$key]['table_id'], 'is_default' => 1));
				 $data['orders'][$key]['cover_iamge'] = base_url('assets/images/jewelleries/thumb/'.$image_default['file_name']);
			}
			if($data['orders'][$key]['type'] != 'card') {
			  $data['orders'][$key]['location']  = $detail['location'];
		    }
			
		}
		$data['status']     = "1";
		echo json_encode($data);
	}
	
}

