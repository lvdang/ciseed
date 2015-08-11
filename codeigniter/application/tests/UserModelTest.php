<?php

class UserModelTest extends CIUnit_Framework_TestCase
{
    private $user;
    
    protected function setUp()
    {
        $this->get_instance()->load->model('User_model', 'user');
        $this->user = $this->get_instance()->user;
    }
    
    public function testGetUserById()
    {
        $expectedUser = array(
                'id' => 11,
                "name" => "John",
                "surname" => "Doe",
                "age" => 41
        );
        
        $this->assertEquals($expectedUser, $this->user->getUserById(1));
    }
    
     public function testGetAllStudents() {
        $result = $this->user->getAllStudents();
        $resultArray = (array) $result[0]; 
        $this->assertArrayHasKey('password', $resultArray);
        $this->assertArrayHasKey('id', $resultArray);
        $this->assertArrayHasKey('user_name', $resultArray);
    }
}

?>
