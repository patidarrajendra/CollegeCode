<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suppliers extends CI_Controller 
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
           $this->data['title']="Reseller Suppliers";
           $this->data['header']=$this->load->view('admin/include/header',$this->data); 
           $this->data['side_bar']=$this->load->view('admin/include/sidebar'); 
    }
    public function Suppliers_list()
    {      
        $data['suppliers_data'] = $this->common_model->getAllwherenew('users_master',array('user_role'=>4));

        $this->load->view('admin/suppliers_list',$data);
    }
    public function add_suppliers()
    {  

        $data=array();      
        if($this->input->post()) 
        {
            $this->form_validation->set_rules('user_fname', 'User First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('user_lname', 'User Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('user_mobile', 'User Mobile', 'trim|required|xss_clean|numeric|min_length[10]|max_length[10]');
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_suppliers',$data);
            } 
            else 
            {
                $session_id=$this->session->all_userdata();
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');
                $perform_array=$_POST;
                unset($perform_array['save_supplier']);
                
                if($perform_array['user_id']=='')
                {
                      $perform_array['user_fullname']= $perform_array['user_fname'].' '.$perform_array['user_lname'];
                      $perform_array['user_role']= 4;
                      $perform_array['user_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      $result = $this->common_model->insertData('users_master',$perform_array);
                      $this->session->set_flashdata('msg', 'Supplier Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $this->load->view('admin/add_suppliers',$data);
                }
                else
                {
                 
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $discount_id=$perform_array['user_id'];
                      $where=array("user_id"=>$perform_array['user_id']);
                      $result = $this->common_model->updateFields('users_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Supplier Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="suppliers/add_suppliers/".$perform_array["user_id"];
                      redirect($url_path, 'refresh');
                }
            }
        }
        else
        {
              if($this->uri->segment(3))
              {
                 $discount_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("user_id"=>$discount_id);
                 $data['edit_user_data'] = $this->common_model->getAllwherenew_objet('users_master',$where,$select);
                 $this->load->view('admin/add_suppliers',$data);
              }
              else
              {
                  $this->load->view('admin/add_suppliers',$data);
              }
        }
        
    }
    function discount_selected_type()
    {
        $select_value=$_POST['selected_value'];
        $str="";
        if($select_value=='product')
        {       
            $result = $this->common_model->getAll('product_master');
            print_r($result);
        }
        else
        {
            $where=array("level"=>$select_value);            
            $result = $this->common_model->getAllwhere('category_master',$where);          
            for($i=0;$i<count($result);$i++)
            {
                $id=$result[$i]->category_id;
                $str.='<option value="'.$id.'" >'.ucfirst($result[$i]->category_name).'</option>';
               
            }
        }
        echo $str;

    }
    function valid_date( $str )
    {
        $stamp = strtotime( $str );
          
        if (!is_numeric($stamp)) 
        { 
            return FALSE;
        } 
          $day   = date( 'd', $stamp );
         $month = date( 'm', $stamp );
         
         $year  = date( 'Y', $stamp );
          
         if (checkdate($day,$month,  $year)) 
         {
            return $year.'/'.$month.'/'.$day;
         }
          

         return FALSE;
    }

    public function checkDateFormat($date) 
    {
        echo $date.'<br/>';
        echo substr($date, 3, 2).'<br/>';
        echo substr($date, 0, 2).'<br/>';
        echo substr($date, 6, 4).'<br/>';
        

      
        if (preg_match("/[0-31]{2}\/[0-12]{2}\/[0-9]{4}/", $date)) 
        {

                if(checkdate(substr($date, 0, 2),substr($date, 3, 2),  substr($date, 6, 4)))
                {
                 //return true;
                    echo 'hi';die;
                }           
                else
                {
                    echo 'hi1';die;
                    //return false;
                }
                
      } 
      else 
      {
        echo 'hi2';die;
            return false;
      }
    } 
    public function inactive_status_change($user_id)
    {
        $status_data=array("user_status"=>0);
        $where=array("user_id"=>$user_id);
        $this->common_model->updateFields('users_master',$status_data,$where);
        redirect('suppliers/suppliers_list', 'refresh');
    }
    public function active_status_change($user_id)
    {
        $status_data=array("user_status"=>1);
        $where=array("user_id"=>$user_id);
        $this->common_model->updateFields('users_master',$status_data,$where);
        redirect('suppliers/suppliers_list', 'refresh');
    }
    public function delete_suppliers($user_id)
    {
        
        $where=array("user_id"=>$user_id);
        $this->common_model->delete('users_master',$where);
        redirect('suppliers/suppliers_list', 'refresh');
    }
}