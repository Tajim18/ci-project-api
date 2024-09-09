<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

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
	public function allteam()
	{
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/allteamapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		$data['alldatateamapi']=json_decode($result);
		
		$this->load->view('admin/team/All_team',$data);
	}
	
public function addteam()
{
		
	if(isset($_POST['submit']))
	{
		date_default_timezone_set('Asia/Kolkata');
			
		$filename=$_FILES['image']['name'];
		$tempname=$_FILES['image']['tmp_name'];
			
		move_uploaded_file($tempname,'uploads/'.$filename);

		$data['image']=$filename;
			
		$data['name']=$this->input->post('name');
		$data['desingnation']=$this->input->post('desingnation');
		$data['status']=$this->input->post('status');
		$data['created_at']=date('Y-m-d H:i:s');	
		$data['updated_at']=date('d-m-Y h:i:s');
			
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/addteamapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
			
		redirect('team/allteam');
	}
		
		$this->load->view('admin/team/Add_team');
}
	
	public function edit()
	{
		$args=func_get_args();
		
		$data['delid']=$args[0];
		
		if(isset($_POST['submit']))
		{
			date_default_timezone_set('Asia/Kolkata');
			
		    if($_FILES['image']['name']!="")
			{
			$filename=$_FILES['image']['name'];
			$tapm=$_FILES['image']['tmp_name'];
			
			move_uploaded_file($tapm,'uploads/'.$filename);
			}
			
			else
			{
				$filename=$this->input->post('oldimg');
			}
				
			$data['image']=$filename;
			$data['name']=$this->input->post('name');
			$data['desingnation']=$this->input->post('desingnation');
			$data['status']=$this->input->post('status');	
			$data['updated_at']=date('d-m-Y h:i:s');
			
			$ch=curl_init();
	        curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/updateteamapi");
	        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	        $result=curl_exec($ch);
			
			//print_r($result);
			
			redirect('team/allteam');
		}
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/editteamapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		$data['editdatateamapi']=json_decode($result);
		
		$this->load->view('admin/team/editteam',$data);
	}
	
	public function delete()
	{
		$args=func_get_args();
		
		$data['delid']=$args[0];
		
	   $ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/deletedatateamapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		redirect('team/allteam');
	}
	

}
