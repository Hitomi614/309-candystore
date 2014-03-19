<?php
class Customer_model extends CI_Model {

	// admin: delete all customers
        function deleteAll() {
                return $this->db->empty_table('customer');
        }


        function insert($customer) {
                return $this->db->insert("product", array(
                        'first' => $customer->first,
                        'last' => $customer->last,
                        'login' => $customer->login,
                        'password' => $customer->password,
			'email' => $customer->email));
        }
}
?>

