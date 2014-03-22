<h2> Customers </h2>

<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>/css/template.css">
<style>
body{
	background-image:url('<?php  echo base_url(); ?>/images/back1.jpg');
}
</style>

<?php
        // only admins should be here

        echo "<table>";
        echo "<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Login</th><th>Password</th><th>email</th></tr>";

        foreach ($customers as $customer) {
                echo "<tr>";
                echo "<td>" . $customer->id . "</td>";
                echo "<td>" . $customer->first . "</td>";
                echo "<td>" . $customer->last . "</td>";
                echo "<td>" . $customer->login . "</td>";
                echo "<td>" . $customer->password . "</td>";
                echo "<td>" . $customer->email . "</td>";
                echo "</tr>";
        }
        echo "<table>";
        
        echo "<div id='menu'>";
        echo "<p>" . anchor('candystore/delete_users', 'Delete all customers') . "</p>";
        echo "<p>" . anchor('candystore/index','Back to Candy Store') . "</p>";
        echo "</div>";
?>
