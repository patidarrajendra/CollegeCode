<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Level extends CI_Controller 
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
           $this->data['title']="Course Level";
           
    }
    public function level_list()
    {   $data['header']=$this->load->view('admin/include/header',$this->data); 
           $data['side_bar']=$this->load->view('admin/include/sidebar');    
        $data['level_data'] = $this->common_model->getAll('level_master');
        $this->load->view('admin/level_list',$data);
    }
    public function add_level()
    {  

        $data=array(); 
        $data['header']=$this->load->view('admin/include/header',$this->data); 
           $data['side_bar']=$this->load->view('admin/include/sidebar');   

        if($this->input->post()) 
        {
            $this->form_validation->set_rules('level_name', 'Level Name', 'trim|required|xss_clean');
             
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_level',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                  
                if($perform_array['level_id']=='')
                {
                      
                      $perform_array['level_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      unset($perform_array['save_category']);
                      //echo "<pre>";
                     // print_r($perform_array);
                     // die;
                      $result = $this->common_model->insertData('level_master',$perform_array);
                      $this->session->set_flashdata('msg', 'level Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="level/add_level/";
                      redirect($url_path, 'refresh');
                }
                else
                {
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $level_id=$perform_array['level_id'];
                      $where=array("level_id"=>$perform_array['level_id']);
                      //print_r($perform_array);die;
                       unset($perform_array['save_category']);
                      $result = $this->common_model->updateFields('level_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'level Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="level/add_level/".$perform_array["level_id"];
                      redirect($url_path, 'refresh');
                }
            }
        }
        else
        {
          
         // $where = $this->db->where('parent_id = ',0);
          //$data['category_data'] = $this->common_model->getAlldata('category_master',$where);
          //$data['product_data'] = $this->common_model->getAlldata('product_master','');
              if($this->uri->segment(3))
              {
                 $level_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("level_id"=>$level_id);
                 $data['edit_level_data'] = $this->common_model->getAllwherenew_objet('level_master',$where,$select);
                 $this->load->view('admin/add_level',$data);
              }
              else
              {
                  $this->load->view('admin/add_level',$data);
              }
        }
        
    }
    
    

    
    public function inactive_status_change($level_id)
    {
        $status_data=array("level_status"=>0);
        $where=array("level_id"=>$level_id);
        $this->common_model->updateFields('level_master',$status_data,$where);
        redirect('level/level_list', 'refresh');
    }
    public function active_status_change($level_id)
    {
        $status_data=array("level_status"=>1);
        $where=array("level_id"=>$level_id);
        $this->common_model->updateFields('level_master',$status_data,$where);
        redirect('level/level_list', 'refresh');
    }
    public function delete_level($level_id)
    {
        
        $where=array("level_id"=>$level_id);
        $this->common_model->delete('level_master',$where);
        redirect('level/level_list', 'refresh');
    }
    public function product_sub_type()
    {
        $selected_value = $this->input->post('selected_value');
        $level          = $this->input->post('level');
        
        if($selected_value=='' || $selected_value==0)
        {
            echo "blank";
        }
        else
        {
            $where          = array('parent_id' =>$selected_value);
            $data['result'] = $this->common_model->getAllwhere('category_master',$where);
            $data['level'] = $level+1;
            
            $this->load->view('admin/multiple_select_ajax',$data);
        }
        
        
    }
}