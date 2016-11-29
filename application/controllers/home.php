<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


  function __construct()
  {
      parent::__construct();
      if(empty($this->session->userdata('user_id'))){
         redirect(base_url() . 'index.php?login', 'refresh');
      }
  }


	public function index()
	{
		$this->load->template('page');
	}


  //MANAGE SENDING SINGLE MESSAGE
  public function single_message($param1='',$param2='')
  {
     if ($param1 == 'send_sms')
     {
     $phone =  $this->input->post('phonenumber');
      if ($phone !== "") {
        $recipients = substr($phone, 2, strlen($phone) - 4);
         $r = str_replace('","', ',', $recipients);
         $message = $this->input->post('message');
         $results = $this->smsmodel->send_sms($message , $r);
         //echo $results;
         redirect(base_url() . 'index.php?home/single_message/', 'refresh');
       }
     }
      $this->load->template('single_message');
}
//*****************************************************************************************//
//DRAFT MESSAGES
public function draft_message()
{
    $this->load->template('draft_message');

}


//*****************************************************************************************//

  //MANAGE SENDING FROM FLE MESSAGE
  public function sms_file($param1='' , $param2 = '')
  {
    if ($param1 == "send_sms") {
      $sections = $this->db->get_where('filecontacts' , array(
          'file_id' => $this->input->post('file_id')
      ))->result_array();
      foreach ($sections as $row) {
        $phone =$this->smsmodel->standardizePhoneNumber($row['phonenumber']);
        $results = $this->smsmodel->send_sms("Dear " . $row['names'] . "," .$this->input->post('message') , $phone);
      }
      redirect(base_url() . 'index.php?home/sms_file/', 'refresh');
    }
    if ($param1 == "upload_file") {
      $this->upload_file();
     redirect(base_url() . 'index.php?home/sms_file/', 'refresh');
    }
    if ($param1 == "delete") {
      if ($param2 !== '') {
        $this->db->where('file_id', $param2);
        $this->db->delete('file');
        $this->db->where('file_id', $param2);
        $this->db->delete('filecontacts');
      }
      redirect(base_url() . 'index.php?home/sms_file/', 'refresh');
    }
    $this->load->template('sms_file');
  }

//upload contacts by file
public function upload_file()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types']     = 'csv';
		$this->load->library('upload', $config);
	if (!$this->upload->do_upload('fileToUpload'))
		{
			 $error = array('error' => $this->upload->display_errors());
			 $data['error'] = $this->upload->display_errors();
			 $this->session->set_flashdata('error', $this->upload->display_errors());
		redirect(base_url() . 'index.php?home/sms_file/', 'refresh');
	 }
		else
		{
			 $upload_data = $this->upload->data();
			 $data['filename'] = $upload_data['file_name'];
       $data['description'] = $this->input->post('description');
			 $data['account_id'] = $this->session->userdata('user_id');
			 $this->db->insert('file',$data);
			 $insert_id = $this->db->insert_id();

			  $fileContent = $_FILES["fileToUpload"]["tmp_name"];
        $fileContent = $_FILES["fileToUpload"]["tmp_name"];
        $fp = fopen($fileContent,"r");
     fgetcsv($fp, "", ",");
    while(($row = fgetcsv($fp,"",",")) != FALSE)
    {
       $datafile['names'] = $row[0];
       $datafile['phonenumber'] = $this->smsmodel->standardizePhoneNumber($row[1]);
       $datafile['account_id'] = $this->session->userdata('user_id');
       $datafile['file_id'] = $insert_id;
			 $this->db->insert('filecontacts',$datafile);
      }
    fclose($fp);
    $this->session->set_flashdata('message', 'CSV data Successfully Saved');
	}
redirect(base_url() . 'index.php?home/sms_file/', 'refresh');
}

public function get_file_contacts($id)
{
      $sections = $this->db->get_where('filecontacts' , array(
          'file_id' => $id , 'account_id' => $this->session->userdata('user_id')
      ))->result_array();
      if ($sections !== '') {
        echo "<h5>Contacts From File</h5>";
        $html = "<table id='example1' class='table table-bordered table-striped'>";
        $html .="<tr>";
        $html .="<th>Sn</th>";
        $html .="<th>Names</th>";
        $html .="<th>Phone Number</th>";
        $html .="</tr>";
          $i = 1; foreach ($sections as $row) {
            $html .="<tr>";
            $html .="<td>" . $i++ . "</td>";
            $html .="<td>" . $row['names'] . "</td>";
            $html .="<td>" . $row['phonenumber'] . "</td>";
            $html .="</tr>";
          }
       echo   $html .="</table>";
      } else {
        echo "No Contact Found ";
      }
}

//************************************************************************************************//
///MANAGE CONTACT LIST=======================================================================-->
  public function contactlist($param1='',$param2='')
  {
    if ($param1 == "create") {
      $group_id = $this->input->post('group_id');
      $account_id = $this->session->userdata('user_id');
      $phonenumber = $this->input->post('phonenumber');
      $names = $this->input->post('names');

       $contact_entries = sizeof($names);
       for($i = 0; $i < $contact_entries; $i++) {
         $data['group_id'] = $group_id;
         $data['account_id'] = $this->session->userdata('user_id');
         $data['phonenumber'] = $phonenumber[$i];
         $data['names'] = $names[$i];

         if($data['phonenumber'] == '' || $data['names'] == '' || $data['group_id'] == '')
               continue;
            $this->db->insert('contactlist' , $data);
        }
    $this->session->set_flashdata('message' , 'Data_added_Successfully');
    }
    if ($param1 == 'delete') {
        $this->db->where('user_id', $param2);
        $this->db->delete('admin');
        $this->session->set_flashdata('flash_message' , 'data_deleted');
      }
    $page_data['page_heading']  = 'Contact List';
    $this->load->template('contactlist', $page_data);
  }

  public function contact_groups($param1='',$param2='')
  {
    if ($param1 == "create") {
      $data['groupname'] = $this->input->post('groupname');
      $data['account_id'] =  $this->session->userdata('user_id');
      $this->db->insert('groups' , $data);
      $this->session->set_flashdata('message' , 'Data_added_Successfully');
    }
    if ($param1 == 'edit') {
        $this->db->where('group_id', $param2);
        $this->db->update('groups',$data);
        $this->session->set_flashdata('flash_message' , 'data_deleted');
    }
    if ($param1 == 'delete') {
        $this->db->where('group_id', $param2);
        $this->db->delete('groups');
        $this->session->set_flashdata('flash_message' , 'data_deleted');
    }
    $page_data['page_heading']  = 'Contact List';
    $this->load->template('contactlist', $page_data);
  }

public function get_group_contacts($group_id)
   {
     $sections = $this->db->get_where('contactlist' , array(
         'group_id' => $group_id , 'account_id' => $this->session->userdata('user_id')
     ))->result_array();
     if ($sections !== '') {
       echo "<h5>Contacts In Address Book</h5>";
       $html = "<table id='example1' class='table table-bordered table-striped'>";
       $html .="<tr>";
       $html .="<th>Conatct Names</th>";
       $html .="<th>Phone Number</th>";
      // $html .="<th>Edit</th>";
       //$html .="<th>Delete</th>";
       $html .="</tr>";
         $i = 1; foreach ($sections as $row) {
$link = base_url()."index.php?home/groups/delete/2";
           $html .="<tr>";
           $html .="<td>" . $row['names'] . "</td>";
           $html .="<td>" . $row['phonenumber'] . "</td>";
          // $html .='<td><a href="#" class="editContact" data-id="'.$row['contact_id'].'" >	<i class="entypo-pencil"></i>Edit	</a></td>';
          // $html .='<td><button href="" class="delete"  onclick="confirm_delete('.base_url(). 'index.php?home/contactlist/delete/2)" >	<i class="fa entypo-trash"></i></button></td>';
           $html .="</tr>";
         }
      echo   $html .="</table>";
     } else {
       echo "No Contact Saved within the group selected";
     }

   }

///End  CONTACT LIST=======================================================================-->
//MANAGE Groups
public function groups($param1='',$param2='')
{
  if ($param1 == "create" && $this->input->post('group_id') == '') {
    $data['groupname'] = $this->input->post('groupname');
    $data['account_id'] = $this->session->userdata('user_id');
    $this->db->insert('groups' , $data);
    $this->session->set_flashdata('message' , 'Data_added_Successfully');
    redirect(base_url() . 'index.php?home/groups/', 'refresh');
  }
  if ($param1 == "create" && $this->input->post('group_id') !== '') {
      $data['groupname'] = $this->input->post('groupname');
      $data['account_id'] = $this->session->userdata('user_id');
      $this->db->where('group_id', $this->input->post('group_id') );
      $this->db->update('groups',$data);
      $this->session->set_flashdata('flash_message' , 'data_deleted');
      redirect(base_url() . 'index.php?home/groups/', 'refresh');
  }
  if ($param1 == 'delete') {
      $this->db->where('group_id', $param2);
      $this->db->delete('groups');
      $this->db->where('group_id', $param2);
      $this->db->delete('contactlist');
      $this->session->set_flashdata('flash_message' , 'data_deleted');
      redirect(base_url() . 'index.php?home/groups/', 'refresh');
  }
  $page_data['page_heading']  = 'Contact List';
  $this->load->template('groups', $page_data);
}

public function getGroupById($id)
{
	foreach ($this->groupmodel->getGroupById($id) as $row) {
					echo json_encode(array('success' => true,
					    'group_id' => $row['group_id'],
							'groupname' => $row['groupname']
					));
			}
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*MANAGE GROUP DATA*******************************************/
public function group_data()
{
  $this->load->template('group_data');
}




//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //MANAGE SENDING CONTACT LIST
  public function sms_contact()
  {
    $this->load->template('sms_contact');
  }


//Sent messages
public function sent_message($param1 ='')
{
  if ($param1 == 'search') {
    $results = $this->smsmodel->get_sent_message($this->input->post('searchdate'));
    $results_admin = $this->smsmodel->get_sent_message_admin($this->input->post('searchdate'));
    $data['results'] = $results;
    $data['results_admin'] = $results_admin;
    $this->load->template('sms_sent',$data);
  }
  $this->load->template('sms_sent');
}

//Inbox messages
public function sms_inbox()
{
  $this->load->template('sms_inbox');
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
