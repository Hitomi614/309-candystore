<h2> Check Out </h2>

<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php 
	echo "<div id='menu'>";
	echo "<p>" . anchor('candystore/index','Back to Store') . "</p>";
	echo "<p>" . anchor('candystore/cart','Edit Shopping Cart') . "</p>";
	echo "</div>";
	
	echo form_open('candystore/checkout1');
		
	echo form_label('Credit Card Number'); 
	echo form_error('ccard');
	echo form_input('ccard', set_value('ccard'),"required");

	echo form_label('Expiration Date: Month (MM)');
	echo form_error('month');
	echo form_input('month', set_value('month'),"required");

	echo form_label('Expiration Date: Year (YY)');
	echo form_error('year');
	echo form_input('year', set_value('year'),"required");
	
	echo form_submit('submit', 'Confirm');
	echo form_close();
	//if successful print receipt
?>	