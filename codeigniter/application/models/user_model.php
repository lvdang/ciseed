<?php

class User_model extends CI_Model
{

    public function __construct ()
    {
        parent::__construct();
    }

    public function getUserByID ($id)
    {
        $user = array(
                'id' => 11,
                "name" => "John",
                "surname" => "Doe",
                "age" => 41
        );
        
        return $user;
    }

    public function getAllStudents() {
        $query = $this->db->query("SELECT * FROM Student");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function updateStudents($data) {
        $success = 0;
        if (is_array($data) && ! empty($data)) {
           $this->db->update_batch('Student', $data, 'id');
           $success = $this->db->affected_rows();
        }

       return array('success' => $success);
    }
}

?>
