<h2>Product Table</h2>
<?php 
		
		$admin = false;
		
		// check if logged in and say hi to user and display links to extra functions 
		if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {
			
			echo "<p> Hi " . $_SESSION["username"] . "! </p>";

			// logged in as regular customer 
			if ($_SESSION["username"] != "admin") {
				//links to shopping cart and checkout
				echo "<p>" . anchor('candystore/cart','My Shopping Cart') . "</p>";
				// echo "<p>" . anchor('candystore/checkout','Checkout') . "</p>";
			} 
			// logged in as admin
			else if ($_SESSION["username"] == "admin") {
				// show Edit Order and Add New options if user is an admin
				$admin = true;
				echo "<p>" . anchor('candystore/newForm','Add New') . "</p>";
				echo "<p>" . anchor('candystore/orders','View all finalized orders') . "</p>";
				echo "<p>" . anchor('candystore/customers','View all registered customers') . "</p>";
			}

			// log out user
			echo "<p>" . anchor('candystore/logout','Log out') . "</p>";
		}

		else if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] == "false") {
			//links to user login and create new user
			echo "<p>" . anchor('candystore/login','Login') . "</p>";
			echo "<p>" . anchor('candystore/newUser','Create New user Account') . "</p>";
		}
		
		echo "<table>";
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>" . $product->price . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
			
			// TODO: only admin will see Delete and Edit; ADMINS DELETE ALL!!
			if ($admin == "true") {
				echo "<td>" . anchor("candystore/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
				echo "<td>" . anchor("candystore/editForm/$product->id",'Edit') . "</td>";
			}
			echo "<td>" . anchor("candystore/read/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
		echo "<table>";
?>	

