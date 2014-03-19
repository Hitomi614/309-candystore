<h2>Login</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back') . "</p>";
	
	echo form_open('candystore/login');
		
	echo form_label('Name'); 
	echo form_error('name');
	echo form_input('name',set_value('name'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");

	echo form_submit('submit', 'login');
	echo form_close();
?>	

