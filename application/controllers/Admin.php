<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->library('session');
		$this->load->view('adminDashboard');
	}
        
       function checklogin() {
	//echo ' <div class="loader"></div>';
	 $this->load->helper('form');
	 $this->load->library('session');
	 $userid= $this->input->post('username');
	 $pass=$this->input->post('password');
	
      $this->load->model('login_model');
	  $query=$this->login_model->verify($userid,$pass);
	    if($query) {
			if($query['status']=='active' && $query['roleID']==1)
			{
				$this->session->set_userdata('name',$query['firstname'].'_'.$query['lastname']);
				$this->session->set_userdata('uid',$query['userid']);
				$this->load->helper('url');$f['message']=0;
                               $this->load->view('adminUserDashboard',$f);
				//$name=$query['name'];
			}
			else {
                              
				$this->load->helper('url');
                                
				echo "<script>alert('Invalid username or password');</script>";
				$f['message']=1;
				//$this->session->set_flashdata('message1', 'Userid or Password wrong');
				$this->load->view('adminDashboard',$f);
			}


    } else {
         
			$this->load->helper('url');
			echo "<script>alert('Invalid username or password');</script>";
			$f['message']=1;
			//$this->session->set_flashdata('message1', 'Userid or Password wrong');
			$this->load->view('adminDashboard',$f);
    }
   
  }
}
