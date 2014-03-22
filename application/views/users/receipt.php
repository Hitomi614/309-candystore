<h2> Receipt</h2>


<style>
	input { display: block;}
	
</style>

<?php
	echo "<p>" . anchor('candystore/restart','Back to Candy Store') . "</p>";

	echo '<div id="toEmail">';
	
	// show products and respective quantities
	echo "<table>";
	echo "<tr><th>Product</th><th>Quantity</th></tr>";
	
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
		echo "</tr>";
	}
	
	echo "<table>";
	echo "<p> Total amount: $" . $_SESSION["total"] . "</p>";
	echo '<input type="button" onclick="window.print();" value="Print This Page">';
		
	echo "</div>";
	
?>