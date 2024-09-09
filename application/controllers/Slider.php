<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

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
public function allslider()
{
	
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/allsliderapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	
	$data['alldatasliderapi']=json_decode($result);
	
   $this->load->view('admin/slider/All_slider',$data);
		
}
	
public function addslider()
{
		
		if(isset($_POST['submit']))
		{
			
			 date_default_timezone_set('Asia/Kolkata');
			
			$filename=$_FILES['image']['name'];
			$tempname=$_FILES['image']['tmp_name'];
			
			move_uploaded_file($tempname,'medai/uploads/'.$filename);

			$data['image']=$filename;
			
			$data['subheading']=$this->input->post('subheading');
			$data['heading']=$this->input->post('heading');
			$data['btnlink']=$this->input->post('btnlink');
			$data['status']=$this->input->post('status');
			$data['created_at']=date('Y-m-d H:i:s');	
			$data['updated_at']=date('d-m-Y h:i:s');
			 
			$ch=curl_init();
	        curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/addsliderapi");
	        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	        $result=curl_exec($ch);
			 
           //print_r($result);
			 
			 
			
			redirect('slider/allslider');
		}
		
		 $this->load->view('admin/slider/Add_slider');
}
	
public function edit()
{
	
	$args=func_get_args();
	
	$data['delid']=$args[0];
	
	if(isset($_POST['submit']))
	{
		
		
		if($_FILES['image']['name']!='')
		{
		$filename=$_FILES['image']['name'];
        $tempname=$_FILES['image']['tmp_name'];
		
		move_uploaded_file($tempname,'medai/uploads/'.$filename);
	    } 
        
		else
	    {
      	$filename=$this->input->post('oldimg');
		
		}
		
		$data['image']=$filename;
			
		$data['subheading']=$this->input->post('subheading');
		$data['heading']=$this->input->post('heading');
		$data['btnlink']=$this->input->post('btnlink');
		$data['status']=$this->input->post('status');	
		$data['updated_at']=date('d-m-Y h:i:s');
	    
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/updatesliderapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
		
		redirect('slider/allslider');
	}
	
	
		
		$ch=curl_init();
	    curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/editsliderapi");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    $result=curl_exec($ch);
			
		 
		$data['editdataapi']=json_decode($result);
		
		$this->load->view('admin/slider/editslider',$data);
}
	
public function delete()
{
	
	$args=func_get_args();
	
	$data['delid']=$args[0];
	
    $ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-project-api/index.php/api/deletesliderapi");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	
	
	redirect('slider/allslider');
	

		
}
	

}
