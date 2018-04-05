<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stream extends CI_Controller 
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
           $this->data['title']="Stream";
           
    }
    public function stream_list()
    {  
        //$data['header']=$this->load->view('admin/include/header'); 
        //$data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $this->load->view('admin/include/header');
        $this->load->view('admin/include/sidebar');   
        $data['stream_data'] = $this->common_model->getAll('stream_master');
       

        $this->load->view('admin/stream_list',$data);
    }


    public function add_stream()
    {  

        $data=array(); 
        $data['header']=$this->load->view('admin/include/header',$this->data); 
           $data['side_bar']=$this->load->view('admin/include/sidebar');   

        if($this->input->post()) 
        {
            $this->form_validation->set_rules('stream_name', 'Stream Name', 'trim|required|xss_clean');

            //$this->form_validation->set_rules('category_level', 'Category Name', 'trim|required|xss_clean');
             
            //print_r($_POST); die;
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_stream',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                  
                if($perform_array['stream_id']=='')
                {
                      
                      $perform_array['stream_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      unset($perform_array['save_category']);
                      $result = $this->common_model->insertData('stream_master',$perform_array);
                      $this->session->set_flashdata('msg', 'Stream Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="stream/add_stream/";
                      redirect($url_path, 'refresh');
                }
                else
                {
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $stream_id=$perform_array['stream_id'];
                      $where=array("stream_id"=>$perform_array['stream_id']);
                      //print_r($perform_array);die;
                      unset($perform_array['save_category']);
                      $result = $this->common_model->updateFields('stream_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Stream Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="stream/add_stream/".$perform_array["stream_id"];
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
                 $stream_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("stream_id"=>$stream_id);
                 $data['edit_stream_data'] = $this->common_model->getAllwherenew_objet('stream_master',$where,$select);
                 $data['level_master'] = $this->common_model->getAlldata('level_master','');
                 $this->load->view('admin/add_stream',$data);
              }
              else
              {   
                $data['category_master'] = $this->common_model->getAlldata('category_master','');  
                $data['level_master'] = $this->common_model->getAlldata('level_master','');
                $this->load->view('admin/add_stream',$data);
              }
        }
        
    }
    
    

    
    public function inactive_status_change($stream_id)
    {
        $status_data=array("stream_status"=>0);
        $where=array("stream_id"=>$stream_id);
        $this->common_model->updateFields('stream_master',$status_data,$where);
        redirect('stream/stream_list', 'refresh');
    }
    public function active_status_change($stream_id)
    {
        $status_data=array("college_status"=>1);
        $where=array("stream_id"=>$stream_id);
        $this->common_model->updateFields('stream_master',$status_data,$where);
        redirect('stream/stream_list', 'refresh');
    }
    public function delete_stream($stream_id)
    {
        
        $where=array("stream_id"=>$stream_id);
        $this->common_model->delete('stream_master',$where);
        redirect('stream/stream_list', 'refresh');
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
    public function getstreamlist()
    {  
        $id= $_POST['key'];
        $array = array('stream_id'=>$id);
        $datas = $this->common_model->getAllRecords('stream_master',$array);
        $return ='';
        foreach($datas as $data)
        {
          $return .='<div class="col-md-4"><div class="coursebox"><a href="#" class="acoursetag" name="'.$data['stream_master'] .'" id=""><i class="'.$data['stream_icon'].'" style="font-size:60px;margin-top: 10px;"></i> <br>'.$data['stream_name'] .'</a></div></div>';// $data['level_id'];
        }
        echo  $return;      
    }
   
}