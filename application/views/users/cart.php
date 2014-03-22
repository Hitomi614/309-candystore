<h2> My Shopping Cart</h2>


<style>
	input { display: block;}
	
</style>
<?php
	
	// assuming that you can only reach here if you're logged in
	if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {
		echo "<p> Hi " . $_SESSION["username"] . "! </p>";
	}
	
	// echo "<p>" . anchor('candystore/update_total','Update Total') . "</p>";
	
	echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
	echo "<p>" . anchor('checkout/index','Proceed to Checkout') . "</p>";
	
	echo "<table>";
	echo "<tr><th>Product</th><th>Quantity</th><th>Change Quantity</th></tr>";

	if (isset($_SESSION["order"])) {
		foreach ($_SESSION["order"] as $product_id => $quantity) {
			echo "<tr>";
			// get product name from database given $product_id
			$query = $this->db->get_where('product', array('id'=>$product_id));
			if ($query->num_rows() == 1) {
				$row = $query->row(0, 'product');
				$name = $row->name;
			}
	
			echo "<td>" . $name . "</td>";
			echo "<td>" . $quantity . "</td>";
	
			// field to change quantity
			echo "<td>" . anchor("candystore/change/$product_id",'Change') . "</td>";
			echo "<td>" . anchor("candystore/delete_item/$product_id",'Delete') . "</td>";
			echo "</tr>";
		}
	}

    echo "<table>";
    

    if (isset($_SESSION["total"])) {
    	echo "<p> Total amount: $" . $_SESSION["total"] . "</p>";
    } else {
    	echo "<p> Total amount: $0.00 </p>";
    }

?>
