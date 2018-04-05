<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class College extends CI_Controller 
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
           $this->data['title']="College";
           
    }
    public function college_list()
    {   $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar');    
        $data['college_data'] = $this->common_model->getAll('college_master');
        $this->load->view('admin/college_list',$data);
    }


    public function add_college()
    {  

        $data=array(); 
        $data['header']=$this->load->view('admin/include/header',$this->data); 
           $data['side_bar']=$this->load->view('admin/include/sidebar');   

        if($this->input->post()) 
        {
            $this->form_validation->set_rules('college_name', 'College Name', 'trim|required|xss_clean');

            //$this->form_validation->set_rules('category_level', 'Category Name', 'trim|required|xss_clean');
             
            //print_r($_POST); die;
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_college',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                  
                if($perform_array['college_id']=='')
                {
                      
                      $perform_array['college_status']=1;
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
                      unset($perform_array['save_category']);
                      $result = $this->common_model->insertData('college_master',$perform_array);
                      $this->session->set_flashdata('msg', 'College Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="college/add_college/";
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
                      // if(!empty($_FILES['image']['name'])) 
                      // {  
                      //   print_r($_FILES); die;
                      //     if($_FILES['image']['size'] > 0)                         
                      //     {
                      //       print_r($_FILES); die;
                      //       $image_name=rand(1000,9999).$_FILES['image']['name'];
                      //       $path='uploads/'.$image_name;
                      //       move_uploaded_file($_FILES['image']['tmp_name'],$path);
                      //       $perform_array['image'] = $image_name;
                      //     }
                      // }
                      $college_id=$perform_array['college_id'];
                      $where=array("college_id"=>$perform_array['college_id']);
                      //print_r($perform_array);die;
                      unset($perform_array['save_category']);
                      $result = $this->common_model->updateFields('college_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'College Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="college/add_college/".$perform_array["college_id"];
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
                 $college_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("college_id"=>$college_id);
                 $data['edit_college_data'] = $this->common_model->getAllwherenew_objet('college_master',$where,$select);
                 $data['category_master'] = $this->common_model->getAlldata('category_master','');
                 $data['course_master'] = $this->common_model->getAlldata('level_master','');  
                 $data['country_master'] = $this->common_model->getAlldata('countries','');
                 //$where=array("country_id"=>$country_id);
                 $data['state_master'] = $this->common_model->getAlldata('states','');                
                 $this->load->view('admin/add_college',$data);
              }
              else
              {   
                $data['category_master'] = $this->common_model->getAlldata('category_master','');
                $data['course_master'] = $this->common_model->getAlldata('level_master','');  
                $data['country_master'] = $this->common_model->getAlldata('countries','');
                //$where=array("country_id"=>$country_id);
                $data['state_master'] = $this->common_model->getAlldata('states','');
                $this->load->view('admin/add_college',$data);
              }
        }
        
    }
    
    

    
    public function inactive_status_change($college_id)
    {
        $status_data=array("college_status"=>0);
        $where=array("college_id"=>$college_id);
        $this->common_model->updateFields('college_master',$status_data,$where);
        redirect('college/college_list', 'refresh');
    }
    public function active_status_change($college_id)
    {
        $status_data=array("college_status"=>1);
        $where=array("college_id"=>$college_id);
        $this->common_model->updateFields('college_master',$status_data,$where);
        redirect('college/college_list', 'refresh');
    }
    public function delete_college($college_id)
    {
        
        $where=array("college_id"=>$college_id);
        $this->common_model->delete('college_master',$where);
        redirect('college/college_list', 'refresh');
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

    // public function getstate(){
    //     $country_id = $this->input->post('country_id');
    //     $stateInfo= $this->common_model->getAllwhere('states', array('country_id' => $country_id));
    //     echo json_encode($stateInfo);
        
    // }

  // public function state($country_id)
  //  {
  //    $where=array("country_id"=>$country_id);
  //    $state=$this->$this->common_model->getAllwherenew_objet('states',$where,$select);
  //    print_r($state);
  //    echo "<option>-State-</option>";
  //    foreach($state as $row)
  //    {
  //     echo"<option value='".$row['id']."'>".$row['state_name']."</option>";  
  //    }
  // }
}