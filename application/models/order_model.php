<?php
class Order_model extends CI_Model { // shopping cart

	function getAll()
	{  
		$query = $this->db->get('order');
		return $query->result('Order');
	}

	// admin: delete all finalized orders
	function deleteAll() {
		return $this->db->empty_table('order');
	}
	
	
	// updates and returns total of shopping cart
	// no input since there's only one active session
	// can handle no available shopping cart session
	function total() {
		$total = 0;
		//if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
		// for all items in the $_SESSION['order'] array,
		if (isset($_SESSION['order'])) {
		foreach ($_SESSION['order'] as $product_id => $quantity) {
 			//echo "<script type='text/javascript'>alert('{$product_id}');</script>";
 			//echo "<script type='text/javascript'>alert('{$quantity}');</script>";
			
			// get price of this item
			$query = $this->db->get_where('product', array('id'=>$product_id));
			if ($query->num_rows() == 1) {
				//echo "<script type='text/javascript'>alert('{$query->num_rows()}');</script>";
				$row = $query->row(0, 'product');
				$price = $row->price;
				
				$total += $quantity * $price;
			}
		}
		}
		$_SESSION["total"] = $total;
	}
	
	// customer: insert order info into database
	function finalize($ccard, $month, $year) {
		session_start();
		// get customer id with username
// 		$this->db->select('id');
// 		$this->db->where('username', $_SESSION["username"]);
// 		$query = $this->db->get('customer');
// 		$row = $query->row(0, 'id');
// 		$customer_id = $row->id;

		$query = $this->db->get_where('customer', array('login'=>$_SESSION["username"]));
		$row = $query->row(0, 'customer');
		$customer_id = $row->id;
		
		$total = floatval($this->total());
		
		$myquery = 'INSERT INTO `candystore`.`order`(`customer_id`, `order_date`, `order_time`, `total`, `creditcard_number`, `creditcard_month`, `creditcard_year`)
			VALUES($customer_id, CURRENT_DATE(), CURRENT_TIME(), $total, $ccard, $month, $year)';

		$this->db->query($myquery);
		return $this->db->insert_id();
	}
}
?>
