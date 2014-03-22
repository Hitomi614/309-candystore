<h2> New User</h2>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>
<?php
	echo "<div id='menu'>";
	echo "<p>" . anchor('candystore/index', 'Back') . "</p>";
	echo "</div>";
	
	echo form_open('newuser/register');
		
	echo form_label('First Name');
	echo form_error('first');
	echo form_input('first', set_value('first'),"required");

	echo form_label('Last Name');
	echo form_error('last');
	echo form_input('last', set_value('last'),"required");
	
	echo form_label('User Name for Login'); 
	echo form_error('login');
	echo form_input('login', set_value('login'),"required");
	
	echo form_label('Password');
	echo form_error('password');
	echo form_input('password', set_value('password'),"required");
	
	echo form_label('Email');
	echo form_error('email');
	echo form_input('email', set_value('email'),"required");

	echo form_submit('submit', 'Create');
	echo form_close();
?>