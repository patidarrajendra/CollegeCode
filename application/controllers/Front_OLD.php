<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	function __construct() {

            parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));

  
    }
	public function index()
	{
	    $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
	}
	public function news()
	{
	    $this->load->view('header');
        $this->load->view('news');
        $this->load->view('footer');
	}
	public function about()
	{
	    $this->load->view('header');
        $this->load->view('about');
        $this->load->view('footer');
	}
	public function contact()
	{
	    $this->load->view('header');
        $this->load->view('contact');
        $this->load->view('footer');
	}
}
?>