<h2> New User</h2>
<style>
		input { display: block;}	
</style>
<?php

	echo "<p>" . anchor('candystore/index', 'Back') . "</p>";
	echo form_open('candystore/create');
		
	echo form_label('First Name');
	echo form_error('firstname');
	echo form_input('firstname',set_value('firstname'),"required");

	echo form_label('Last Name');
	echo form_error('lastname');
	echo form_input('lastname',set_value('lastname'),"required");
	
	echo form_label('User Name for Login'); 
	echo form_error('username');
	echo form_input('username',set_value('username'),"required");
	
	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");
	
	echo form_label('Email');
	echo form_error('email');
	echo form_input('email',set_value('email'),"required");

	echo form_submit('submit', 'Create');
	echo form_close();
?>