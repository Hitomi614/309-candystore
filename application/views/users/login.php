<h2>Login</h2>

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
	
	echo form_open('candystore/loginuser');
		
	echo form_label('Login'); 
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");

	echo form_submit('submit', 'Login');
	echo form_close();
?>	

