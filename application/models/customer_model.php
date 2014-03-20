<?php
class Customer_model extends CI_Model {

        function getAll()
        {
                $query = $this->db->get('customer');
                return $query->result('Customer');
        }

	// admin: delete all customers
        function deleteAll() {
                return $this->db->empty_table('customer');
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

