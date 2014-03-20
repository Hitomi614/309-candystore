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
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
			// for all items in the $_SESSION['order'] array,
			foreach ($_SESSION['order'] as $product_id => $quantity) {
				
				// get price of this item
				$this->db->select('price');
				$this->db->where('id', $product_id);
				$query = $this->db->get('product');
				$price = $query->row(0, 'price');
				
				$total += $quantity * $price;
			}
		}
		return $total;
	}
	
	// customer: insert order info into database
	function finalize($ccard, $month, $year) {
		// get customer id with email
		$this->db->select('id');
		$this->db->where('email', $_SESSION["email"]);
		$query = $this->db->get('customer');
		$customer_id = $query->row(0, 'id');

		$total = floatval($this->total());
		
		$myquery = 'INSERT INTO `candystore`.`order`(`customer_id`, `order_date`, `order_time`, `total`, `creditcard_number`, `creditcard_month`, `creditcard_year`)
			VALUES($customer_id, CURRENT_DATE(), CURRENT_TIME(), $total, '$ccard', $month, $year)';

		$this->db->query($myquery);
		return $this->db->insert_id();
	}
}
?>
