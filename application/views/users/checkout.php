<h2> Check Out </h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back to Store') . "</p>";
	echo "<p>" . anchor('candystore/cart','Edit Shopping Cart') . "</p>";
	
	echo form_open('checkout/checkout');
		
	echo form_label('Credit Card Number', 'cardno'); 
	echo form_error('cardno');
	echo form_input('cardno',set_value('cardno'),"required");

	echo form_label('Expiration Date (MM/YY)', 'carddate');
	echo form_error('carddate');
	echo form_input('carddate',set_value('carddate'),"required");
	
	echo form_submit('submit', 'login');
	echo form_close();
	//if successful print receipt
?>	