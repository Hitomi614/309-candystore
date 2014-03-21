<?php

$g_login;

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
			session_start();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    	
    }

    function index() {
		// products
    		$this->load->model('product_model');
    		$products = $this->product_model->getAll();
    		$data['products']=$products;

                // orders
                $this->load->model('order_model');
                $orders = $this->order_model->getAll();
                $data['orders']=$orders;

                // customers
                $this->load->model('customer_model');
                $customers = $this->customer_model->getAll();
                $data['customers']=$customers;

    		$this->load->view('product/list.php',$data);
    }
    
    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('candystore/index', 'refresh');
	}
      
	function login() {
	    $this->load->view('users/login.php');
    }


    function update_total() {
	$this->load->model('order_model');
	$this->order_model->total();
	redirect('users/cart.php', 'refresh');
    }

    
    function update_quantity() {
    	$this->load->model('order_item_model');
    	$id = $this->input->get_post('product_id');
    	$new = $this->input->get_post('quantity');
    	$this->order_model->set_quantity($id, $new);
    	redirect('users/cart.php', 'refresh');
    }

    function orders() {
    	$this->load->view('orders/orders.php');
    }

    function delete_orders() {
	$this->load->model('order_model');
	$this->order_model->deleteAll();
	redirect('candystore/orders', 'refresh');
	return;
    }

    function customers() {
	$this->load->view('users/users.php');
    }

    function delete_users() {
	$this->load->model('customer_model');
        $this->customer_model->deleteAll();
	redirect('candystore/customers', 'refresh');
	return;
    }
    
    function cart() {
    	$this->load->view('users/cart.php');
    }

    function logout() {
	$_SESSION = array();
	redirect('candystore/index', 'refresh');
    } 
    
    function change($id) {
    	$this->load->model('order_item_model');
    	$order = $this->order_item_model->get($id);
    	$data['order']=$order;
    	$this->load->view('users/change.php',$data);
    }
    
	function newUser() {
		$this->load->view('users/newUser.php');
	}
	
	function add($product_id) {
		$this->load->model('order_item_model');
		$this->order_item_model->add_item($product_id);
		redirect('candystore/index', 'refresh');
	}
	function loginuser() {
		$this->load->library('form_validation');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('users/login.php');
		} else {
			$_SESSION["loggedIn"] = "true";
			$_SESSION["username"] = $this->input->get_post("login");
			redirect('candystore/index', 'refresh');
		}
	}

	// checks that login exists in database
	function valid_login($login) {
		global $g_login;
		$this->db->where('login', $login);
		$query = $this->db->get('customer');
		// login exists
		if ($query->num_rows() == 1) {

			$g_login = $login;
			return true;
		}
		$this->form_validation->set_message('valid_login', 'Login doesn\'t exist!');
		return false;
	
	}
	
	
	// checks that password matches login
	function valid_password($password) {
		global $g_login;

		$query = $this->db->get_where('customer',array('login'=>$g_login));
	
		$row = $query->row(0, 'customer');
		$c_password = $row->password;
	
		if ($c_password == $password) {
			return true;
		}
		$this->form_validation->set_message('valid_password', 'Invalid login-password combination');
		return false;
	}
}

