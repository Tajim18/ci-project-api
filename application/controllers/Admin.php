<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
 {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if(isset($_POST['submit']))
		{
			$username=$this->input->post('uname');
			$password=$this->input->post('password');
			
			$result=$this->crud->selectbymultiplecolumn('login',array('username'=>$uname,'password'=>$password));
			//print_r($result);
			 
		
			
			if(count($result)>0)
			{
			
			    $this->session->set_userdata('uname',$result[0]->username);
				
			  redirect('admin/deshbord');
			}
		}
		
		$this->load->view('admin/index');
		
	}
	
	public function deshbord()
	{
		
		// $ch=curl_init();
	    // curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/alldataenquriyaapi");
	    // curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    // $result=curl_exec($ch);
	  
	  // $data['alldata']=json_decode($result);
		
		
		$this->checkadminlogin();
		$this->load->view('admin/deshbord',$data);
	}
	
	public function deletedatas()
	{
		$args=func_get_args();
		$data['delid']=$args[0];
		
	    $ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/deleteenquarydataapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		print_r($result);
		
		redirect('admin/deshbord');
	}
	
	// public function loguot()
	// {
		// $this->session->sess_destroy();
		
			// echo"<script>
			// window.location.href='admin/index';
			// </script>";
	// }
	
	// public function checkadminlogin()
	// {
		 // $data=$this->session->userdata('uname');
		
		// if(empty($data))
		// {
			// echo"<script>
			 // window.location.href='/index';
		 // </script>";
	     // }
	// }
	
public function sitesetting()
{
if(isset($_POST['submit']))
{
	$id=$this->input->post('rowid');

		
if($_FILES['logo']['name']!='')
{
	$filename=$_FILES['logo']['name'];
	$tempname=$_FILES['logo']['tmp_name'];
	
	print_r($_FILES['logo']['name']);
	
	move_uploaded_file($tempname,'uploads/'.$filename);
}
		
else
{
	$filename=$this->input->post('oldlogo');
}	
	
	
if($_FILES['favicon']['name']!='')
{
	$filenamef=$_FILES['favicon']['name'];
	$tempnamef=$_FILES['favicon']['tmp_name'];
	
	move_uploaded_file($tempnamef,'uploads/'.$filenamef);
	
	
}
		
else
{
	$filename=$this->input->post('oldfavicon');
}

$data['logo']=$filename;
$data['favicon']=$filenamef;
$data['fb']=$this->input->post('fb');
$data['tw']=$this->input->post('x');
$data['insta']=$this->input->post('insta');
$data['youtube']=$this->input->post('youtube');
$data['telegram']=$this->input->post('telegram');
$data['linkedin']=$this->input->post('linkedin');
$data['phone1']=$this->input->post('phone');
$data['phone2']=$this->input->post('whatsapp');
$data['email']=$this->input->post('email');
$data['address']=$this->input->post('address');
	
	
$this->crud->update('site_setting',$data,$id);

}


$data['editdata']=$this->crud->fetchalldata('site_setting');

$this->load->view('admin/site_setting/Edit_setting',$data);


}
 }