<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Payumoney extends CI_Controller {
public function __construct() {
        parent::__construct();
        $this->load->helper('url');       
    }
 public function index(){
    $this->load->view('form1');
 }
 public function checkpayumoney(){
     
     // all values are required
    $amount = $this->input->post('payble_amount');
    $product_info = 'college';//$this->input->post('product_info');
    $customer_name = $this->input->post('payuname');
    $customer_email = $this->input->post('payuemail');
    $customer_mobile = $this->input->post('payuphone');
    $amount = $this->input->post('payupamount');
    $student_master = $this->input->post('student_master');
    $student_detail = $this->input->post('student_detail');
    $school_detail  = $this->input->post('school_detail');
    //payumoney details
    
    
        $MERCHANT_KEY = "YMm0H9BB"; //change  merchant with yours
        $SALT = "WKQIZb2Mj7";  //change salt with yours 
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //optional udf values 
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';
        
         $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
         $hash = strtolower(hash('sha512', $hashstring));
         
         $success = base_url() . 'Status';  
         $fail = base_url() . 'Status';
         $cancel = base_url() . 'Status';
        
        
         $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,           
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_email,
            'phoneno' => $customer_mobile,
            'student_master' => $student_master,
            'student_detail' => $student_detail,
            'school_detail' => $school_detail,
            'action' => "https://secure.payu.in/_payment",//"https://test.payu.in", //for live change action  https://secure.payu.in
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel            
        );
        $this->load->view('header');
        $this->load->view('confirmation', $data);   
     }


   
    
   }