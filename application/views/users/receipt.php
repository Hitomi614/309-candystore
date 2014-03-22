<h2> Receipt</h2>


<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php
	echo "<div id='menu'>";
	echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
	echo "<p> Receipt </p>";
	echo "</div>";

	echo '<div id="toEmail">';
	//TODO 
	// echo "<p> Total cost: " . $total . "</p>";
	// echo a list of items ordered  
	echo "</div>";
	
?>