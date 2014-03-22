<h2>Edit Product</h2>

<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php 
	echo "<div id='menu'>";
	echo "<p>" . anchor('candystore/index','Back') . "</p>";
	echo "</div>";
	
	echo form_open("candystore/update/$product->id");
	
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',$product->name,"required");

	echo form_label('Description');
	echo form_error('description');
	echo form_input('description',$product->description,"required");
	
	echo form_label('Price');
	echo form_error('price');
	echo form_input('price',$product->price,"required");
	
	echo form_submit('submit', 'Save');
	echo form_close();
?>	

