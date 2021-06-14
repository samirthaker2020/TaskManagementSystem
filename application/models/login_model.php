  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class Login_model extends CI_Model
  {
	  public function verify($userid,$pass)

		{
			$passe=md5($pass);
		
			
$q=$this->db->where(['email'=>$userid,'password'=>$passe])->get('users');





		if($q->num_rows())
		{
			if($q->row()->status=='active' )
			{
				$data['name']= $q->row()->firstname.' '.$q->row()->lastname;

				$this->session->set_userdata('uname',$data);

				// return $q1->result();
				// return $data;
				return $row = $q->row_array();
				//  }
			}
			else
			{return false;
			}

		}
			else
			{
				return FALSE;
				}
		}

	 



  }