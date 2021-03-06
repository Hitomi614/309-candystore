<?php
class Customer_model extends CI_Model {

        function getAll()
        {
                $query = $this->db->get('customer');
                return $query->result('Customer');
        }

	// admin: delete all customers
        function deleteAll() {
        	// admin lives on, all alone in the candy world
        	$this->db->where('login !=', 'admin');
        	$this->db->delete('customer');
        }

		// get email of current logged in customer
        function email() {
        	$query = $this->db->get_where('customer', array('login'=>$_SESSION["username"]));
        	$row = $query->row(0, 'customer');
        	return $row->email;
        }
        
        
        function insert($customer) {
		$this->db->insert("customer", array(
                        'first' => $customer->first,
                        'last' => $customer->last,
                        'login' => $customer->login,
                        'password' => $customer->password,
			'email' => $customer->email));
		return $this->db->insert_id();
        }
}
?>

