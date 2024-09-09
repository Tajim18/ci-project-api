<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

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
	
public function addproject()
{

        if(isset($_POST['submit']))
		{
		    date_default_timezone_set('Asia/Kolkata');
			
		    $filename=$_FILES['image']['name'];
            $tempname=$_FILES['image']['tmp_name'];

		    move_uploaded_file($tempname,'uploads/'.$filename);

		    $data['image']=$filename;
			$data['heading']=$this->input->post('heading');
			$data['description']=$this->input->post('description');
			$data['link']=$this->input->post('link');
			$data['status']=$this->input->post('status');
			$data['created_at']=date('Y-m-d H:i:s');
			
		    $ch=curl_init();
	        curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/addprojectapi");
	        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	        $result=curl_exec($ch);
			
			//print_r($result);
		
	        redirect('project/allproject');
		
		}



    $this->load->view('admin/projects/Add_project');
}
	
public function allproject()
{
	
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/allprojectapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	
	$data['alldataapi']=json_decode($result);
    
	$this->load->view('admin/projects/All_project',$data);
}
	
public function edit()
{
     $args=func_get_args();
	 
	 $data['delid']=$args[0];
	
	if(isset($_POST['submit']))
	{
		date_default_timezone_set('Asia/Kolkata');
			
	    if($_FILES['image']['name']!='')
		{
			
		$filename=$_FILES['image']['name'];
        $tempname=$_FILES['image']['tmp_name'];

		move_uploaded_file($tempname,'uploads/'.$filename);
	    } 
			
	    else
		{
			$filename=$this->input->post('oldimg');
		}
			
		$data['image']=$filename;
		$data['heading']=$this->input->post('heading');
	    $data['description']=$this->input->post('description');
		$data['url']=$this->input->post('url');
		$data['status']=$this->input->post('status');
		$data['updates_at']=date('Y-m-d H:i:s');
		
        $ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/updateprojectapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		$data['editdataapi']=json_decode($result);
		
		print_r($result);
		
	        redirect('project/allproject');
		
	}
      $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/editprojectapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	
	$data['allprojectapi']=json_decode($result);

     
            
     $this->load->view('admin/projects/editproject',$data);
}
	
public function delete()
{
	
	$args=func_get_args();
	
	$data['delid']=$args[0];
	
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/deleteprojectapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	
	redirect('project/allproject');
	
}


}
