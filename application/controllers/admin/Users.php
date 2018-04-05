<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller 

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

           $this->data['title']="User Discount";

           $this->data['header']=$this->load->view('admin/include/header',$this->data); 

           $this->data['side_bar']=$this->load->view('admin/include/sidebar'); 

    }

    public function Customers_list()

    {       

        $data['customers_data'] = $this->common_model->getAllwherenew('users_master',array('user_role'=>2));

        $this->load->view('admin/customers_list',$data);

    }

    public function signout()

    {

          $this->session->unset_userdata('id');

          $this->session->unset_userdata('username');

          $this->session->unset_userdata('userrole');

          $this->session->unset_userdata('email');

          redirect("admin/","refresh");

    }

    public function change_password()

    {  

        $data=array();      

        if($this->input->post()) 

        {

            $this->form_validation->set_rules('oldpassword', 'Old Password', "trim|required|callback_password_matches");

            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            $this->form_validation->set_rules('user_confirmpassword', 'Confirm Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() == FALSE) 

            {

               $this->load->view('admin/change_password',$data);

            } 

            else 

            {

                $session_id=$this->session->all_userdata();

                $current_date=date('Y-m-d H:i:s');

                $current_ip= $_SERVER['REMOTE_ADDR'];

                $current_login=$this->session->userdata('id');

                $perform_array=$_POST;

                unset($perform_array['save_category']);

                unset($perform_array['oldpassword']);

                unset($perform_array['user_confirmpassword']);                 

                if($perform_array['id']!='')

                {

                      $perform_array['edited_by']=$current_login;

                      $perform_array['edited_date']=$current_date;

                      $perform_array['edited_ip']=$current_ip;

                      $perform_array['password']=md5($perform_array['password']);

                      $where=array("id"=>$perform_array['id']);

                      $result = $this->common_model->updateFields('admin_master',$perform_array,$where);

                      $this->session->set_flashdata('msg', 'Password Updated Successfully');

                      $this->session->set_flashdata('class_msg', 'bg-green');

                      $url_path="users/change_password/";

                      redirect($url_path, 'refresh');

                }

            }

        }

        else

        {

            $this->load->view('admin/change_password',$data);

        }

    }

    public function password_matches($password)

    {

        $user_id = 1;         

        $result  = $this->common_model->check_oldpassword($password, $user_id);

        if ($result == 0) 

        {

            $this->form_validation->set_message('oldpassword', "%s does not match.");

            return FALSE;

        } 

        else 

        {

            $this->session->set_flashdata('success_msg', 'Password successfully updated!!!');

            return TRUE;

        }



    }

   

}