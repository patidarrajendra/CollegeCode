<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
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
          $this->data['title']="Admin Dashboard";
          $this->data['header']=$this->load->view('admin/include/header',$this->data); 
          $this->data['side_bar']=$this->load->view('admin/include/sidebar'); 
          $this->load->helper('fcm_helper');
    }

    public function index()
    {


        $customers_data=$this->common_model->make_query("select count(student_id) as total_users from student_master ");
        if(count($customers_data)>0)
        {
            $data['total_users']=$customers_data[0]['total_users'];
        }
        else
        {
            $data['total_users']=0;
        }
        /*
        $reseller_data=$this->common_model->make_query("select count(user_id) as total_users from users_master where user_role='3' ");
        if(count($reseller_data)>0)
        {
            $data['total_reseller']=$reseller_data[0]['total_users'];
        }
        else
        {
            $data['total_reseller']=0;
        }
        $supplier_data=$this->common_model->make_query("select count(user_id) as total_users from users_master where user_role='4' ");
        if(count($reseller_data)>0)
        {
            $data['total_supplier']=$supplier_data[0]['total_users'];
        }
        else
        {
            $data['total_supplier']=0;
        }
        $category_data=$this->common_model->make_query("select count(category_id) as total_category from category_master ");
        if(count($reseller_data)>0)
        {
            $data['total_category']=$category_data[0]['total_category'];
        }
        else
        {
            $data['total_category']=0;
        }
        $product_data=$this->common_model->make_query("select count(product_id) as total_product from product_master ");
        if(count($reseller_data)>0)
        {
            $data['total_product']=$product_data[0]['total_product'];
        }
        else
        {
            $data['total_product']=0;
        }
        
        $sale_data=$this->common_model->make_query("select sum(payment_amount) as total_sale from sales_order_master ");
        if(count($reseller_data)>0)
        {
            $data['total_sale']=$sale_data[0]['total_sale'];
        }
        else
        {
            $data['total_sale']=0;
        }
        
        $data['resaller_data']=$this->common_model->make_query("select users_master.user_fullname,users_master.user_mobile,users_master.user_email,sales_order_master.user_id,sum(sales_order_master.payment_amount) as total_sale_amount from users_master join sales_order_master on users_master.user_id=sales_order_master.user_id where users_master.user_role='3' group by  sales_order_master.user_id");
       */   
        $this->load->view('admin/index',$data);
       
    }
     /*
    ** Shows List of All Suppliers
    */
    

     /*
    ** Shows List of All Customers
    */
    public function Customers_list()
    {       
        $data['customers_data'] = $this->common_model->getAllwherenew('users_master',array('user_role'=>2));
        $this->load->view('admin/customers_list',$data);
    }
    public function edit_user()
    {
        if($this->uri->segment(3))
        {
            $user_id=$this->uri->segment(3);
            $data['account_edit_data'] = $this->common_model->getAllwherenew('admin_master',array('id'=>$user_id));
            $this->load->view('admin/customers_list',$data);
        }
    }

    
    
}