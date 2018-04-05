<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Front extends CI_Controller { 
       public $data; 
	function __construct() 
	{
        parent::__construct();
        $this->load->model('common_model'); 
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        $this->data['category']=$this->common_model->getAll('category_master');  
	$this->data['level']=$this->common_model->getAll('level_master');
	//$data['level']=$this->common_model->getAll('level_master');
	$this->data['stream']=$this->common_model->getAll('stream_master');
    }
	public function index()    
	{
	
		 
	$this->load->view('header',$this->data); 
        $this->load->view('home');
        $this->load->view('footer');
	}
	public function news()
	{
        $this->load->view('header',$this->data);  
        $this->load->view('news');
        $this->load->view('footer');
	}
	public function news_detail()
	{
        $this->load->view('header',$this->data); 
        $this->load->view('news-detail');
        $this->load->view('footer');
	}
	public function college_degree()
	{
        $this->load->view('header',$this->data); 
        $this->load->view('college_degree');
        $this->load->view('footer');
	}
	public function about()
	{
	$this->load->view('header',$this->data);
        $this->load->view('about');
        $this->load->view('footer');
	}
	public function contact()
	{
	$this->load->view('header',$this->data);
        $this->load->view('contact');
        $this->load->view('footer');
	}
	public function login()
	{
	$this->load->view('header',$this->data);
        $this->load->view('login');
        $this->load->view('footer');
	}
	public function collegesearch()
	{
	$this->load->view('header',$this->data);
        $this->load->view('collegesearch');
        $this->load->view('footer');
	}
	public function college_details()
	{
	$this->load->view('header',$this->data);
        $this->load->view('college_details');
        $this->load->view('footer');
	}
	public function ecounselling()
	{
	    $this->load->view('header',$this->data);
	    $this->load->view('counselling_form');
        $this->load->view('footer');
	}

	public function add_counsellingform()
	{
			if(!empty($_POST["submit"])) 
			{
			$data = array(
			'student_name' => $this->input->post('student_name'),	
			'age' => $this->input->post('age'),
			'gender' => $this->input->post('optradio'),
			'parent_name' => $this->input->post('parent_name'),
			'mobile' => $this->input->post('mobile'),
			'parent_mobile' => $this->input->post('parent_mobile'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'),
			'Xth_broad' => $this->input->post('Xth_board'),
			'Xth_roll_no' => $this->input->post('Xth_roll_no'),
			'Xth_year' => $this->input->post('Xth_year'),
			'Xth_percentage' => $this->input->post('Xth_percentage'),
			'XII_broad' => $this->input->post('XII_baord'),
			'XII_roll_no' => $this->input->post('XII_roll_no'),
			'XII_year' => $this->input->post('XII_year'),
			'XII_percentage' => $this->input->post('XII_percentage'),
			'XII_subject' => $this->input->post('XII_subject'),
			'competition_exam' => $this->input->post('competition_exam'),
			'competition_exam_year' => $this->input->post('competition_exam_year'),
			'enrollment_no' => $this->input->post('competition_exam_enroll'),
			'score' => $this->input->post('competition_exam_score'),
			'declare' => 'declare',
			'status' => 1,
			'ip_address' => $this->input->ip_address(),
			'create_date' => date('Y-m-d H:i:s')
			);	

			$result = $this->common_model->insertData('counselling_form',$data);
           	       $this->session->set_flashdata('msg', 'Counselling Form Added Successfully');
                       $this->session->set_flashdata('class_msg', 'bg-green');
                       redirect('front/ecounselling');
		}
	}

	public function categorycollegelist($id)
	{
		 
		 $this->load->view('header',$this->data);
         $where=array(
          	           'publish_master.category_id'=> $id
         	         );
		 $data['colleges'] = $this->common_model->GetJoinRecord('publish_master','college_id','college_master','college_id','',$where,'college_id');
		 $this->load->view('collegesearch',$data);
		 $this->load->view('footer');
	}
	public function collegedetails($id)
	{
	       $this->load->view('header',$this->data);
	       $where=array('college_id'=> $id);
	       $data['details'] = $this->common_model->getAllwherenew('college_master',$where);

		   $where=array(' publish_master.college_id'=> $id);
	       $data['courses'] = $this->common_model->GetJoinRecord('publish_master','stream_id','stream_master','stream_id','',$where,'college_id');
	        
	       $this->load->view('college_details',$data); 
	       $this->load->view('footer');
	}
}
?>