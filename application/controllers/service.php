<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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
public function allservice()
{
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/allserviceapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);

    $data['alldataapi']=json_decode($result);		
	
    $this->load->view('admin/service/All_service',$data);
}
	
public function addservice()
{
	
	if(isset($_POST['submit']))
	{
		date_default_timezone_set('Asia/Kolkata');
		
		$filename=$_FILES['image']['name'];
		$tapm=$_FILES['image']['tmp_name'];
		
		move_uploaded_file($tapm,'uploads/'.$filename);

		$data['image']=$filename; 
		$data['name']=$this->input->post('name');
		$data['description']=$this->input->post('description');
		$data['url']=$this->input->post('url');
		$data['status']=$this->input->post('status');
		$data['created_at']=date('d-m-Y h:i:s');

	    $ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/addserviceapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		//print_r($result);

        redirect('service/allservice');
	}
		
		$this->load->view('admin/service/Add_service');
}
	
public function edit()
{
	$args=func_get_args();
	
	$data['delid']=$args[0];
		
	if(isset($_POST['submit']))
	{
		date_default_timezone_set("Asia/Kolkata");
			
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
		$data['description']=$this->input->post('description');
		$data['url']=$this->input->post('url');
		$data['status']=$this->input->post('status');
		$data['updated_at']=date('d-m-Y h:i:s');
			
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/updatedataapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
			
			print_r($result);
			
	    redirect('service/allservice');
	}
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/editserviceapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		$data['editdataapi']=json_decode($result);
		
				
		$this->load->view('admin/service/editservice',$data);
}
	
	public function delete()
	{	
		$args=func_get_args();
		
		$data['delid']=$args[0];
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/deletedataapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		redirect('service/allservice');
	}
	

}
