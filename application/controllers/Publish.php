<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Publish extends CI_Controller 
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
           $this->data['title']="College List";
           
    }
    public function publish_list()
    {  
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar');    
        $data['publish_data'] = $this->common_model->getAll('publish_master');
        
        $this->load->view('admin/publish_list',$data);
    }
   public function delete_publish($publish_id)
    {
        
        $where=array("publish_id"=>$publish_id);
        $this->common_model->delete('publish_master',$where);
        redirect('publish/publish_list', 'refresh');
    }

    public function add_publish()
    {  

        $data=array(); 
        $data['header']=$this->load->view('admin/include/header',$this->data); 
           $data['side_bar']=$this->load->view('admin/include/sidebar');   

        if($this->input->post()) 
        {
            $this->form_validation->set_rules('category_id', 'Category Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('college_id', 'College Name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_publish',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                  
                if($perform_array['publish_id']=='')
                {
                      
                      $perform_array['publish_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      if(!empty($_FILES['image']['name'])) 
                      {  
                          if($_FILES['image']['size'] > 0)
                          {
                            $image_name=rand(1000,9999).$_FILES['image']['name'];
                            $path='uploads/'.$image_name;
                            move_uploaded_file($_FILES['image']['tmp_name'],$path);
                            $perform_array['image'] = $image_name;
                          }
                      }
                      unset($perform_array['publish_college']);
                      // echo "<pre>";
                      // print_r($perform_array);
                      // die;

                      $result = $this->common_model->insertData('publish_master',$perform_array);
                      $this->session->set_flashdata('msg', 'College Published Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="publish/add_publish";
                      redirect($url_path, 'refresh');
                }
                else
                {
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      if(!empty($_FILES['image']['name']))
                      {
                          $config['file_name']     = $_FILES['image']['name'];
                          $config['upload_path']   = 'uploads/';
                          $config['allowed_types'] = 'gif|jpg|png|pdf';
                          $config['max_size']      = '10000';
                          $config['max_size']      = '';
                          $config['max_width']     = '';
                          $config['max_height']    = '';
                          $config['remove_spaces'] = true;
                          $this->load->library('upload', $config);
                          $this->upload->initialize($config);
                          if (!$this->upload->do_upload('image'))
                          {
                               $error = array('error' => $this->upload->display_errors());
                          }
                          else
                          {
                              $imageName = $this->upload->data();
                              $img = array('upload_data' => $this->upload->data());
                              $perform_array['image'] = $img['upload_data']['file_name'];
                              //http://espsofttech.com/hotelapp/
                          }
                      }
                       
                      $publish_id=$perform_array['publish_id'];
                      $where=array("publish_id"=>$perform_array['publish_id']);
                       
                      unset($perform_array['publish_college']);
                      $result = $this->common_model->updateFields('publish_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Publish Status Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="admin/add_publish".$perform_array["publish_id"];
                      redirect($url_path, 'refresh');
                }
            }
        }
        else
        {

              if($this->uri->segment(3))
              {
                 $course_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("course_id"=>$course_id);
                 $data['edit_course_data'] = $this->common_model->getAllwherenew_objet('publish_master',$where,$select);
                 $data['category_master'] = $this->common_model->getAlldata('category_master','');
                 $data['course_master'] = $this->common_model->getAlldata('level_master','');  
                 $data['country_master'] = $this->common_model->getAlldata('countries','');
                 //$where=array("country_id"=>$country_id);
                 $data['state_master'] = $this->common_model->getAlldata('states','');   
                  $data['college_master'] = $this->common_model->getAlldata('college_master','');             
                 $this->load->view('admin/add_publish',$data);
              }
              else
              {   
  
                $data['category_master'] = $this->common_model->getAlldata('category_master','');
                //$data['level_master'] = $this->common_model->getAlldata('level_master','');  
                //$data['stream_master'] = $this->common_model->getAlldata('stream_master','');  
                $data['country_master'] = $this->common_model->getAlldata('countries','');
                //$where=array("country_id"=>$country_id);
                $data['state_master'] = $this->common_model->getAlldata('states','');
                $data['college_master'] = $this->common_model->getAlldata('college_master','');
                   
                $this->load->view('admin/add_publish',$data); 
              }
        }
    }
    
    public function inactive_status_change($course_id)
    {
        $status_data=array("course_status"=>0);
        $where=array("course_id"=>$course_id);
        $this->common_model->updateFields('course_master',$status_data,$where);
        redirect('course/course_list', 'refresh');
    }
    public function active_status_change($course_id)
    {
        $status_data=array("course_status"=>1);
        $where=array("course_id"=>$course_id);
        $this->common_model->updateFields('course_master',$status_data,$where);
        redirect('course/course_list', 'refresh');
    }
    public function delete_course($course_id)
    {
        
        $where=array("course_id"=>$course_id);
        $this->common_model->delete('course_master',$where);
        redirect('course/course_list', 'refresh');
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
   
     

    /* Ajax Call to get level list */
    public function getlevellist()
    {  
        $id= $_POST['key'];
        $array = array('category_id'=>$id);
        $datas = $this->common_model->getAllRecords('level_master',$array);
        $return ='';
        foreach($datas as $data)
        {
          $return .='<div class="col-md-4"><div class="coursebox"><a href="#" class="acoursetag" name="'.$data['level_id'] .'" id=""><i class="'.$data['level_icon'].'" style="font-size:60px;margin-top: 10px;"></i> <br>'.$data['level_name'] .'</a></div></div>';// $data['level_id'];
        }
        echo  $return;      
    }
    public function get_state_data()
    {


        $country_id=$this->input->post('country_id');
        $where=array("country_id"=>$country_id);
        $data['name_select_box']=$this->input->post('field_name');
        $data['state_master'] = $this->common_model->getAllRecords('states',$where); 
        //print_r($data); die;
        $this->load->view('admin/get_state_ajax',$data);
        //$this->load->view('admin/get_state_ajaxg',$data);
    }

    public function get_level_list()
    {
         $data['name_select_box']=$this->input->post('field_name');
         $where=array("category_id"=>$_POST['category_id']);
         $data['level_master'] = $this->common_model->getAllRecords('level_master',$where); 
         $this->load->view('admin/get_level_ajax',$data);
    }

    public function get_stream_list()
    {
         $data['name_select_box']=$this->input->post('field_name');
         $where=array("level_id"=>$_POST['level_id']);
         $data['stream_master'] = $this->common_model->getAllRecords('stream_master',$where); 
         $this->load->view('admin/get_stream_ajax',$data);
    } 

}