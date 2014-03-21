<h2> My Shopping Cart</h2>


<style>
	input { display: block;}
	
</style>

<?php
	
	// assuming that you can only reach here if you're logged in
	if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {
		echo "<p> Hi " . $_SESSION["username"] . "! </p>";
	}
	echo "<table>";
	echo "<tr><th>Product</th><th>Quantity</th><th>Change Quantity</th></tr>";

	foreach ($_SESSION['order'] as $product_id => $quantity) {
		echo "<tr>";
		// get product name from database given $product_id
		$this->db->select('name');
		$this->db->where('id', $product_id);
		$query = $this->db->get('product');
		$name = $query->row(0, 'name');

		echo "<td>" . $name . "</td>";
		echo "<td>" . $quantity . "</td>";

		// field to change quantity
		echo "<td>" . anchor("candystore/change/$product->id",'Change') . "</td>";
		
// 		
	}

        echo "<table>";

	$this->load->model('order_model');
	$total = $this->order_model->total();

	echo "<p> Total cost: " . $total . "</p>";

	echo "<p>" . anchor('candystore/update_total','Update Total') . "</p>";

	echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
	echo "<p>" . anchor('checkout/index','Proceed to Checkout') . "</p>";
?>
