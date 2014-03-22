<h2> Orders </h2>

<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php
	// only admins should be here

	echo "<table>";
	echo "<tr><th>Order ID</th><th>Customer ID</th><th>Order Date</th><th>Order Time</th><th>Total</th><th>CC Number</th><th>CC Month</th><th>CC Year</th></tr>";
		
	foreach ($orders as $order) {
		echo "<tr>";
                echo "<td>" . $order->id . "</td>";
		echo "<td>" . $order->customer_id . "</td>";
		echo "<td>" . $order->order_date . "</td>";
		echo "<td>" . $order->order_time . "</td>";
		echo "<td>" . $order->total . "</td>";
		echo "<td>" . $order->creditcard_number. "</td>";
        echo "<td>" . $order->creditcard_month . "</td>";	
		echo "<td>" . $order->creditcard_year . "</td>";
		echo "</tr>";
	}
	echo "<table>";
	
	echo "<div id='menu'>";
	echo "<p>" . anchor('candystore/delete_orders', 'Delete all orders') . "</p>";
	echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
	echo "</div>";
	
?>
