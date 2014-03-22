<h2>Checkout</h2>

<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php
		echo "<div id='menu'>";
        echo "<p>" . anchor('candystore/cart','Back') . "</p>";
        echo "</div>";
        
        echo form_open_multipart('checkout/checkout');

        echo form_label('Credit Card');
        echo form_error('ccard');
        echo form_input('ccard',set_value('ccard'),"required");

        echo form_label('MM');
        echo form_error('month');
        echo form_input('month',set_value('month'),"required");

        echo form_label('YY');
        echo form_error('year');
        echo form_input('year',set_value('year'),"required");

        echo form_submit('submit', 'Submit');
        echo form_close();
?>

