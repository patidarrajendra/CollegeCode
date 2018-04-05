<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Controller 
{
    public $data;
    function __construct() 
    {
          parent::__construct();
          $this->load->model('common_model');      
          $this->load->library('upload');
          if(!$this->session->userdata('id'))
          {
              redirect('admin/');
          }
          $this->data['title']="Student Details";
          $this->data['header']=$this->load->view('admin/include/header',$this->data); 
          $this->data['side_bar']=$this->load->view('admin/include/sidebar'); 
    }
    /*Category List*/
    public function student_list()
    {
       
        $data['header']=$this->load->view('admin/include/header'); 
        $data['side_bar']=$this->load->view('admin/include/sidebar');
        $data['student_master'] = $this->common_model->getAll('student_master',''); 
        $this->load->view('admin/student_list',$data);
    }
    public function add_student()
    {
        $data=array();      
        if($this->input->post()) 
        {
            $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('category_image', '', 'callback_file_check');
            if ($this->form_validation->run() == FALSE) 
            {
                $this->load->view('admin/add_category',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                unset($perform_array['save_category']);
                if(!empty($_FILES['category_image']['name'])) 
                {  
                    if($_FILES['category_image']['name']!='')
                    {
                      $image_name=rand(1000,9999).$_FILES['category_image']['name'];
                      $path='uploads/category_images/'.$image_name;
                      move_uploaded_file($_FILES['category_image']['tmp_name'],$path);
                      $perform_array['category_image'] = $image_name;
                    }
                }
                if($perform_array['category_id']=='')
                {
                    $perform_array['category_status']=1;
                    $perform_array['added_by']=$current_login;
                    $perform_array['added_date']=$current_date;
                    $perform_array['added_ip']=$current_ip;
                    $result = $this->common_model->insertData('student_master',$perform_array);
                    $this->session->set_flashdata('msg', 'Category Added Successfully');
                    $this->session->set_flashdata('class_msg', 'bg-green');
                    redirect("category/add_category","refresh");
                }
                else
                {
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $category_id=$perform_array['category_id'];
                      $where=array("category_id"=>$perform_array['category_id']);
                      $result = $this->common_model->updateFields('student_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Category Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="category/add_category/".$perform_array["category_id"];
                      redirect($url_path, 'refresh');
                }
           }
        }
        else
        {
            $data['category_master_data'] = $this->common_model->getAlldata('student_master','');
            if($this->uri->segment(3))
            {
               $discount_id=$this->uri->segment(3);
               $select="all";
               $where=array("category_id"=>$discount_id);
               $data['edit_category_data'] = $this->common_model->getAllwherenew_objet('student_master',$where,$select);
               $this->load->view('admin/add_category',$data);
            }
            else
            {
                $this->load->view('admin/add_category',$data);
            }
        }
    }
    public function inactive_status_change($cat_id)
    {
        $status_data=array("category_status"=>0);
        $where=array("category_id"=>$cat_id);
        $this->common_model->updateFields('student_master',$status_data,$where);
        $redirect='category/category_list';
        redirect($redirect, 'refresh');
    }
    public function active_status_change($cat_id)
    {
        $status_data=array("category_status"=>1);
        $where=array("category_id"=>$cat_id);
        $this->common_model->updateFields('student_master',$status_data,$where);
        $redirect='category/category_list';
        redirect($redirect, 'refresh');
    } 
    public function delete_category($cat_id)
    {
        
        $where=array("category_id"=>$cat_id);
        $this->common_model->delete('student_master',$where);
        $redirect='category/category_list';
        redirect($redirect, 'refresh');
    }
    public function file_check($str)
    {
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['category_image']['name']);
        if(isset($_FILES['category_image']['name']) && $_FILES['category_image']['name']!="")
        {
            if(in_array($mime, $allowed_mime_type_arr))
            {
                return true;
            }
            else
            {
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }
        else
        {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
}