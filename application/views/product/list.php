<h2>Product Table</h2>
<?php 
		//link to add new candy
		//add if block around the following echos
		//i.e iff logged in as admin echo lines below
		//echo "<p>" . anchor('candystore/newForm','Add New') . "</p>";
		//echo "<p>" . anchor('candystore/order','Edit Order') . "</p>";
		
		//links to user login and create new user
		echo "<p>" . anchor('candystore/login','Login') . "</p>";
		echo "<p>" . anchor('candystore/newUser','Create New user Account') . "</p>";
		
		//links to shopping cart and checkout
		//pop up "you must log in first" if not already logged in with a valid user account
		echo "<p>" . anchor('candystore/cart','My Shopping Cart') . "</p>";
		echo "<p>" . anchor('candystore/checkout','Checkout') . "</p>";
		
		echo "<table>";
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>" . $product->price . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
			//iff login-ed as admin then echo the two following lines
			//echo "<td>" . anchor("candystore/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			//echo "<td>" . anchor("candystore/editForm/$product->id",'Edit') . "</td>";
			echo "<td>" . anchor("candystore/read/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "<table>";
?>	

