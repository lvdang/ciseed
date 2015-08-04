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
        return $query->result();
    }
}

?>
