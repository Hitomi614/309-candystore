<h2> Check Out </h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back to Store') . "</p>";
	echo "<p>" . anchor('candystore/cart','Edit Shopping Cart') . "</p>";
	
	echo form_open('checkout/checkout1');
		
	echo form_label('Credit Card Number', 'cardno'); 
	echo form_error('cardno');
	echo form_input('cardno', set_value('cardno'),"required");

	echo form_label('Expiration Date: Month (MM)', 'month');
	echo form_error('month');
	echo form_input('month', set_value('month'),"required");

	echo form_label('Expiration Date: Year (YY)', 'year');
	echo form_error('year');
	echo form_input('year', set_value('year'),"required");
	
	echo form_submit('submit', 'Confirm');
	echo form_close();
	//if successful print receipt
?>	