<h2>Change Quantity</h2>

<style>
input { display: block;}

</style>

<?php
echo "<p>" . anchor('candystore/cart','Back') . "</p>";

echo form_open("candystore/update_quantity/$order->id/");

echo form_label('New Quantity');
echo form_error('quantity');
echo form_input('quantity', "required");

echo form_submit('submit', 'Change');
echo form_close();

?>