<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Offer extends CI_Controller 
{
    
    function __construct() 
    {
          parent::__construct();
          $this->load->model('common_model');      
          $this->load->library('upload');
          if(!$this->session->userdata('id'))
          {
              redirect('admin/');
          }
          $this->data['title']="Resaller Offers";
        
    }
    public function offer_list()
    {
       
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $data['offers']= $this->common_model->getAll('offer_master');
        $this->load->view('admin/offer_list',$data);
    }
   public function add_offer()
   {
    
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 

        if($this->input->post()) 
        {
         
            $this->form_validation->set_rules('offer_name', 'Offer Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('offer_type', 'Offer Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('offer_apply_type', 'Offer Applied Type', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('offer_apply_id', 'Offer Applied Value', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('discount_start_from', 'Discount Start From', 'required|date_valid');
            //$this->form_validation->set_rules('discount_end_to', 'Discount End To', 'required|date_valid');
            $this->form_validation->set_rules('offer_value', 'Offer Value', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('offer_value', 'Offer Value', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() == FALSE) 
            {
               
               $this->load->view('admin/add_offer',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                $perform_array['offer_start_from']=date('Y-m-d',strtotime($perform_array['offer_start_from']));
                $perform_array['offer_end_to']=date('Y-m-d',strtotime($perform_array['offer_end_to']));
                unset($perform_array['save_category']);
                 $last_selected_data="";
                if($perform_array['offer_apply_type']=='category')
                {
                    for($i=0;$i<$perform_array['level'];$i++)
                    {
                          $str="category_level_".$i;
                          if($i==($perform_array['level']-1))
                          {
                              $last_selected_data=$perform_array[$str];
                          }
                          unset($perform_array[$str]);
                    }
                    $str="category_level_".$i;
                    if($perform_array[$str]=='')
                    {
                        $perform_array['offer_apply_id']=$last_selected_data;
                    }
                    else
                    {
                         $perform_array['offer_apply_id']=$perform_array[$str];
                    }
                    unset($perform_array[$str]);
                    unset($perform_array['level']);
                    unset($perform_array['product_data']);
                }
                else
                {
                    
                    for($i=0;$i<=$perform_array['level'];$i++)
                    {
                          $str="category_level_".$i;
                          unset($perform_array[$str]);
                    }
                    unset($perform_array['level']);
                    $perform_array['offer_apply_id']=$perform_array['product_data'];
                    unset($perform_array['product_data']);
                }  
                if($this->input->post('offer_id')=='')
                {
                        
                      $perform_array['offer_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                     
                      $result = $this->common_model->insertData('offer_master',$perform_array);
                      $this->session->set_flashdata('msg', 'Offer Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                     // $this->session->set_flashdata('class_msg', 'bg-red');
                       $url_path="offer/add_offer/";
                      redirect($url_path, 'refresh');
                }
                else
                {
                      
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $offer_id=$perform_array['offer_id'];
                      $where=array("offer_id"=>$perform_array['offer_id']);
                      $result = $this->common_model->updateFields('offer_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Offer Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="offer/add_offer/".$perform_array["offer_id"];
                      redirect($url_path, 'refresh');

                }
            }

        }
        else
        {
          //echo $this->uri->segment(3);die;
              $where = $this->db->where('parent_id = ',0);
          $data['category_data'] = $this->common_model->getAlldata('category_master',$where);
          $data['product_data'] = $this->common_model->getAlldata('product_master','');
              if($this->uri->segment(3))
              {
                 $offer_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("offer_id"=>$offer_id);
                 $data['edit_offer_data'] = $this->common_model->getAllwherenew_objet('offer_master',$where,$select);

                  
                 $this->load->view('admin/add_offer',$data);
              }
              else
              {
                  $this->load->view('admin/add_offer',$data);
              }

        }

   }

    public function inactive_status_change($offer_id)
    {
        $status_data=array("offer_status"=>0);
        $where=array("offer_id"=>$offer_id);
        $this->common_model->updateFields('offer_master',$status_data,$where);
        redirect('offer/offer_list', 'refresh');
    }
    public function active_status_change($offer_id)
    {
        $status_data=array("offer_status"=>1);
        $where=array("offer_id"=>$offer_id);
        $this->common_model->updateFields('offer_master',$status_data,$where);
        redirect('offer/offer_list', 'refresh');
    }
    public function delete_offer($offer_id)
    {
        
        $where=array("offer_id"=>$offer_id);
        $this->common_model->delete('offer_master',$where);
        redirect('offer/offer_list', 'refresh');
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