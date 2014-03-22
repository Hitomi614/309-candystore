<h2>Change Quantity</h2>
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

echo form_open("candystore/update_quantity/$id");

echo form_label('New Quantity');
echo form_error('quantity');
echo form_input('quantity', "required");

echo form_submit('submit', 'Change');
echo form_close();

?>