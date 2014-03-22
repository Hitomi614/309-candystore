<?php

$g_login;
$g_month;
$g_year;

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
			session_start();
	    	parent::__construct();
	    	
	    	
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

    // remove item from cart
    function delete_item($product_id) {
    	$this->load->model('order_item_model');
    	$this->order_item_model->delete($product_id);
    	$this->load->model('order_model');
    	$this->order_model->total();
    	
		redirect('candystore/cart', 'refresh');
    }
    
    function update_total() {
	$this->load->model('order_model');
	$this->order_model->total();
	redirect('candystore/cart', 'refresh');
    }
    
    function cart() {
    	$this->load->view('users/cart.php');
    }

    function change($id) {
    	$this->load->model('order_item_model');
    	//$order = $this->order_item_model->get($id);
    	$data['id']=$id;
    	$this->load->view('users/change.php',$data);
    }
    
    function update_quantity($id) {
    	$this->load->model('order_item_model');
    	//$id = $this->input->get_post('product_id');
    	$new = $this->input->get_post('quantity');
    	
    	// only set if new quantity is > 0 
    	if ($new > 0) {
    		$this->order_item_model->set_quantity($id, $new);
    	} else { // remove from cart 
    		$this->order_item_model->delete($id);
    	}
    	
    	// update total
    	$this->load->model('order_model');
    	$this->order_model->total();
    	// echo "<script type='text/javascript'>alert('here');</script>";
		redirect('candystore/cart', 'refresh');
    }

    function orders() {
    	// orders
    	$this->load->model('order_model');
    	$orders = $this->order_model->getAll();
    	$data['orders']=$orders;
    	$this->load->view('orders/orders.php',$data);
    }

    function delete_orders() {
	$this->load->model('order_model');
	$this->order_model->deleteAll();
	redirect('candystore/orders', 'refresh');
	return;
    }

    function customers() {
    	// customers
    	$this->load->model('customer_model');
    	$customers = $this->customer_model->getAll();
    	$data['customers']=$customers;
		$this->load->view('users/users.php',$data);
    }

    function delete_users() {
	$this->load->model('customer_model');
        $this->customer_model->deleteAll();
	redirect('candystore/customers', 'refresh');
	return;
    }

    function logout() {
	$_SESSION = array();
	redirect('candystore/index', 'refresh');
    } 
    
	function newUser() {
		$this->load->view('users/newUser.php');
	}
	
	function add($product_id) {
		$this->load->model('order_item_model');
		$this->order_item_model->add_item($product_id);

		// echo "<script type='text/javascript'>alert('{$product_id}');</script>";
				
		$this->load->model('order_model');
		$this->order_model->total();
		redirect('candystore/index', 'refresh');
	}
	
	function restart() {
		$_SESSION["total"] = 0;
		$_SESSION["order"] = array();
		redirect('candystore/index', 'refresh');
		
	}
	///////////////// CHECKOUT STUFF ///////////////////////
	function checkout1() {
		$this->load->library('form_validation');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('users/checkout.php');
		} else {
			$ccard = $this->input->get_post('ccard');
			$month = $this->input->get_post('month');
			$year = $this->input->get_post('year');
	
			// insert order into database
			$this->load->model('order_model');
			$order_id = $this->order_model->finalize($ccard, $month, $year);
			
			// insert order_items into database
			$this->load->model('order_item_model');
			$this->order_item_model->finalize($order_id);

			// get customer email
			$this->load->model('customer_model');
			$email = $this->customer_model->email();
			
			//email receipt to customer
			$this->load->library('email');
			$this->email->from('candystore@gmail.com', 'CandyStore');

			// make message
			$content = "You ordered a total of $" . $_SESSION["total"] . " from CandyStore." .  
			" You purchased:" ;
			
			foreach ($_SESSION["order"] as $product_id => $quantity) {

				// get product name
				$query = $this->db->get_where('product', array('id'=>$product_id));
				if ($query->num_rows() == 1) {
					$row = $query->row(0, 'product');
					$name = $row->name;
				}
				$content .= " " . $quantity . " of " . $name . ", " ;
			}
			rtrim($content, ", ");
			
			// send email 
			$this->email->to($email);
			$this->email->subject('Your CandyStore Receipt');
			$this->email->message('$content');
			$this->email->send();
	
			$this->load->view('users/receipt.php');
		}
	}
	

	// checks that the credit card has 16 digits
	function card_number($ccard) {
		if (preg_match("/^\d{16}$/", $ccard) == 0) {
			$this->form_validation->set_message('card_number', 'Credit card must have 16 digits.');
			return false;
		}
		return true;
	}
	
	
	
	// check that month has valid input
	function card_month($month) {
		if (preg_match("/^(0[1-9]|1[0-2])$/", $month) == 0) {
			$this->form_validation->set_message('card_month', 'Month format must be two digits.');
			return false;
		}
		global $g_month;
		$g_month = $month;
		return true;
	}
	
	
	// check that year has valid input
	function card_year($year) {
		if (preg_match("/^[0-9]{2}$/", $year) == 0) {
			$this->form_validation->set_message('card_year', 'Year format must be the last two digits of the year.');
			return false;
		}
		global $g_year;
		$g_year = $year;
		return true;
	}
	
	
	// checks that the credit card has not expired
	function card_exp($year) {
		global $g_month;
		global $g_year;
	
		// get current month and year
		$cmonth = date('m');
		$cyear = date('y');
	
		// false if provided year is smaller than current year, or
		// if provided month is smaller than current month AND
		// provided year is smaller or equal to current year
		if ( ($g_year < $cyear) || (($g_month < $cmonth) && ($g_year <= $cyear))) {
			$this->form_validation->set_message('card_exp', 'Credit card has expired!');
			return false;
		}
		return true;
	}
	///////////////// CHECKOUT STUFF ///////////////////////
	
	
	///////////////// LOGIN STUFF ///////////////////////
	function loginuser() {
		$this->load->library('form_validation');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('users/login.php');
		} else {
			$_SESSION["loggedIn"] = "true";
			$_SESSION["username"] = $this->input->get_post("login");
			$_SESSION["total"] = 0;
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
		if ($query->num_rows() == 1) {
			$row = $query->row(0, 'customer');
			$c_password = $row->password;
			if ($c_password == $password) {
				return true;
			}
		}
		$this->form_validation->set_message('valid_password', 'Invalid login-password combination');
		return false;
	}
	
	///////////////// LOGIN STUFF ///////////////////////
}

