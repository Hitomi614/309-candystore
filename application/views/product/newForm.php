<h2>New Product</h2>

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
	
	echo form_open_multipart('candystore/create');
		
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',set_value('name'),"required");

	echo form_label('Description');
	echo form_error('description');
	echo form_input('description',set_value('description'),"required");
	
	echo form_label('Price');
	echo form_error('price');
	echo form_input('price',set_value('price'),"required");
	
	echo form_label('Photo');
	
	if(isset($fileerror))
		echo $fileerror;	
?>	
	<input type="file" name="userfile" size="20" />
	
<?php 	
	
	echo form_submit('submit', 'Create');
	echo form_close();
?>	

