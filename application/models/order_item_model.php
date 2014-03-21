<?php

session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

class Order_Item_model extends CI_Model { // shopping cart

	// add product to SESSION's associative array of (product=>quantity)
	function add_item($product_id) {
		if (!isset($_SESSION['order'])) {
			$_SESSION['order'] = array();
		}
		// $_SESSION['order'] is set at this point
		$_SESSION['order']['$product_id'] = 1;
	}
	
	// assumes that the item is in the shopping cart
	function set_quantity($product_id, $quantity) {
		$_SESSION['order']['$product_id'] = $quantity;
	}

	// assumes that the item is in the shopping cart
	function delete($product_id) {
		unset($_SESSION['order']['$product_id']);
	}
	
	// insert all order items from this session
	function finalize($order_id) {
		foreach ($_SESSION['order'] as $product_id => $quantity) {
			$this->db->insert("order_item", array(
					'order_id' => $order_id,
					'product_id' => $product_id,
					'quantity' => $quantity));
		}
		return;
	}
}
