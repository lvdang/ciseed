<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        public function index() {		  
		$this->load->view('welcome_message');
	}

       /**
       * Retrieve all the students from table: Student
       */
       public function getStudents() {
		$this->load->model('user_model','', TRUE);
		$students = $this->user_model->getAllStudents();
		$this->printHeaders();
                echo json_encode($students);
	}

      /**
      * Update table : Student
      */
	public function updateStudents() {
		$this->load->model('user_model','', TRUE);
		$this->printHeaders();
		 
		$students = $this->user_model->updateStudents($_POST['students']);
                echo json_encode($students);
	}

     /**
      * Need to allow origin since I am testing on my localhost
     */
     public function printHeaders() {
   	  header('Access-Control-Allow-Origin: *');
	  header('Content-Type: application/json');
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
