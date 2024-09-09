<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
	
	
	////********* Slider Start *************///
	
	public function allsliderapi()
	{
		$data=$this->crud->fetchalldata('slider_api');
		
		echo json_encode($data);
	}
	
	public function addsliderapi()
	{
		date_default_timezone_set('Asia/Kolkata');
	    
	
		$data['image']=$this->input->post('image');
		$data['subheading']=$this->input->post('subheading');
		$data['heading']=$this->input->post('heading');
		$data['btnlink']=$this->input->post('btnlink');
		$data['status']=$this->input->post('status');
		$data['created_at']=date('Y-m-d H:i:s');	
		$data['updated_at']=date('d-m-Y h:i:s');
		
		
		//print_r($data);
		
		$this->crud->insert('slider_api',$data);
	}
	
	public function editsliderapi()
	{
		$id=$this->input->post('delid');
		
		$data=$this->crud->selectbycolumn('slider_api','id',$id);
		
		//print_r($data);2
		
		echo json_encode($data);
		
	}
	
	public function updatesliderapi()
	{
		$id=$this->input->post('delid');
		
		$data['image']=$this->input->post('image');
		$data['subheading']=$this->input->post('subheading');
		$data['heading']=$this->input->post('heading');
		$data['btnlink']=$this->input->post('btnlink');
		$data['status']=$this->input->post('status');
		$data['updated_at']=date('d-m-Y h:i:s');
		
		//print_r($data);
		
		
		$this->crud->updatedata('slider_api',$data,$id);
	}
	
	public function deletesliderapi()
	{
	    $id=$this->input->post('delid');
		
		$this->crud->deletedata('slider_api',$id);
	}
	
	
	////********* Slider End *************///
	
	
	///*********** service start ************///////////
	
	public function allserviceapi()
	{
		$data=$this->crud->fetchalldata('service_api');
		
		echo json_encode($data);
	}
	
	public function addserviceapi()
	{
		$data['image']=$this->input->post('image');
		$data['name']=$this->input->post('name');
		$data['description']=$this->input->post('description');
		$data['url']=$this->input->post('url');
		$data['status']=$this->input->post('status');
		$data['created_at']=date('d-m-Y h:i:s');
		
		$this->crud->insert('service_api',$data);
	}
	
	
	public function editserviceapi()
	{
		$id=$this->input->post('delid');
		
		$data=$this->crud->selectbycolumn('service_api','id',$id);
		
		echo json_encode($data);
	}
	
	public function updatedataapi()
	{
		$id=$this->input->post('delid');
		
		$data['image']=$this->input->post('image');
		$data['name']=$this->input->post('name');
		$data['description']=$this->input->post('description');
		$data['url']=$this->input->post('url');
		$data['status']=$this->input->post('status');
		$data['updated_at']=date('d-m-Y h:i:s');
		
		//print_r($data);
		$this->crud->updatedata('service_api',$data,$id);
		
	}
	
	public function deletedataapi()
	{
		$id=$this->input->post('delid');
		
		$this->crud->deletedata('service_api',$id);
	}
	
	
	
	///*********** service end ************///////////



////*********** Project Start ******///////


public function addprojectapi()
{
	$data['image']=$this->input->post('image');
    $data['heading']=$this->input->post('heading');
	$data['description']=$this->input->post('description');
	$data['link']=$this->input->post('link');
	$data['status']=$this->input->post('status');
	$data['created_at']=date('Y-m-d H:i:s');
	
	//print_r($data);
	
	$this->crud->insert('projects_api',$data);
}

public function allprojectapi()
{
	$data=$this->crud->fetchalldata('projects_api');
	
	echo json_encode($data);
}

public function editprojectapi()
{
	$id=$this->input->post('delid');
	
	$data=$this->crud->selectbycolumn('projects_api','id',$id);
	
    echo json_encode($data);
}

public function updateprojectapi()
{
	
	$id=$this->input->post('delid');
	
	$data['image']=$this->input->post('image');
    $data['heading']=$this->input->post('heading');
	$data['description']=$this->input->post('description');
	$data['link']=$this->input->post('link');
	$data['status']=$this->input->post('status');
	$data['created_at']=date('Y-m-d H:i:s');
	//print_r($data);
	
	$this->crud->updatedata('projects_api',$data,$id);
	
}

public function deleteprojectapi()
{
	$id=$this->input->post('delid');
	
	$this->crud->deletedata('projects_api',$id);
}



////*********** Project End ******///////


/////*********** Team Start *****////////


public function allteamapi()
{
	$data=$this->crud->fetchalldata('team_api');
	
	echo json_encode($data);
	
}

public function addteamapi()
{
	$data['image']=$this->input->post('image');	
	$data['name']=$this->input->post('name');
	$data['desingnation']=$this->input->post('desingnation');
	$data['status']=$this->input->post('status');
	$data['created_at']=date('Y-m-d H:i:s');	
	
	
	$this->crud->insert('team_api',$data);
}

public function editteamapi()
{
	$id=$this->input->post('delid');
	
     $data=$this->crud->selectbycolumn('team_api','id',$id);
	
	echo json_encode($data);
	
}

public function updateteamapi()
{
	$id=$this->input->post('delid');
	
	$data['image']=$this->input->post('image');
    $data['name']=$this->input->post('name');
	$data['desingnation']=$this->input->post('desingnation');
	$data['status']=$this->input->post('status');	
	$data['updates_at']=date('d-m-Y h:i:s');
	
	//print_r($data);
	
	$this->crud->updatedata('team_api',$data,$id);
}

public function deletedatateamapi()
{
	$id=$this->input->post('delid');
	
	$this->crud->deletedata('team_api',$id);
	
}

/////***********  Team End *****////////

/////*********** Teastimonials Start *****////////


public function alldatatesapi()
{
	$data=$this->crud->fetchalldata('testimonials_api');
	
	echo json_encode($data);
}


public function addtesapi()
{
	$data['image']=$this->input->post('image');
	$data['name']=$this->input->post('name');	
	$data['profession']=$this->input->post('profession');	
	$data['description']=$this->input->post('description');	
	$data['status']=$this->input->post('status');
	$data['created_at']=date('Y-m-d H:i:s');
	
	$this->crud->insert('testimonials_api',$data);
}


public function editdatateaapi()
{
	$id=$this->input->post('delid');
	
    $data=$this->crud->selectbycolumn('testimonials_api','id',$id);	
	
	echo json_encode($data);
}

public function updatedatateaapi()
{
	$id=$this->input->post('delid');
	
	$data['image']=$this->input->post('image');	
	$data['name']=$this->input->post('name');	
	$data['profession']=$this->input->post('profession');	
	$data['description']=$this->input->post('description');	
	$data['status']=$this->input->post('status');
	$data['updates_at']=date('d-m-Y h:i:s');
	
	$this->crud->updatedata('testimonials_api',$data,$id);
}


public function deletedatateaapi()
{
	$id=$this->input->post('delid');
	
	$this->crud->deletedata('testimonials_api',$id);
}

/////*********** Teastimonials End *****////////

///////********** enquriy_api Start ********/////////


public function dataenquriyapi()
{
$data['name']=$this->input->post('name');
$data['email']=$this->input->post('email');
$data['subject']=$this->input->post('subject');
$data['message']=$this->input->post('message');
$data['created_at']=$this->input->post('created_at');

$this->crud->insert('enquriy_api',$data);

}

public function alldataenquriyaapi()
{
	$data=$this->crud->fetchalldata('enquriy_api');
	
	echo json_encode($data);
}

public function deleteenquarydataapi()
{
	$id=$this->input->post('delid');
	
	
	
	$this->crud->deletedata('enquriy_api',$id);
}

///////********** enquriy_api End ********/////////


}
