<h2> Orders </h2>



<?php

		echo "<table>";
		echo "<tr><th>Customer ID</th><th>Order Date</th><th>Order Time</th><th>Photo</th></tr>";
		
		//need to fix
		//just place holder for now
		foreach ($orders as $order) {
			echo "<tr>";
			echo "<td>" . $order->customer_id . "</td>";
			echo "<td>" . $order->order_date . "</td>";
			echo "<td>" . $order->order_time . "</td>";
			echo "<td>" . $order->total . "</td>";
			echo "<td><img src='" . base_url() . "images/order/" . $order->photo_url . "' width='100px' /></td>";
			echo "<td>" . anchor("candystore/delete/$order->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "<td>" . anchor("candystore/read/$order->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "<table>";
?>