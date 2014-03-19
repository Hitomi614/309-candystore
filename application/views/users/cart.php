<h2> My Shopping Cart</h2>


<style>
	input { display: block;}
	
</style>

<?php
	echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
	echo "<p>" . anchor('candystore/checkout','Proceed to Checkout') . "</p>";
	echo "<p> Total cost:" . "</p>";
?>