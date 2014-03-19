<?php
class Order_model extends CI_Model { // shopping cart
	// admin: display all finalized orders
	function getAll()
	{  
		$query = $this->db->get('order');
		return $query->result('Order');
	}

	// admin: delete all finalized orders
	function deleteAll() {
		return $this->db->empty_table('order');
	}
	
	// TODO: customer: store unfinalized order in PHP session
	// an order can be an associative array of (product_id => quantity)
	// when the first item is added to the cart, instantiate the array.
	
	// show all items
	// modify item quantity
	// delete items
	
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
	
	// customer: finalize order: insert customer info into database
	function finalize($order) {
		return $this->db->insert_id("order", array(
				'customer_id' => $order->customer_id,
				'order_date' => $order->order_date,
				'order_time' => $order->order_time,
				'total' => $order->total,
				'creditcard_number' => $order->creditcard_number,
				'creditcard_month' => $order->creditcard_month,
				'creditcard_year' => $order->creditcard_year));
	}
}
?>