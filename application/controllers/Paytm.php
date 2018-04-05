<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Paytm extends CI_Controller {
public function __construct() {
        parent::__construct();
        $this->load->model('common_model');    
        $this->load->helper('url');  
        $PAYTM_STATUS_QUERY_NEW_URL='https://pguat.paytm.com/oltp/HANDLER_INTERNAL/getTxnStatus';
            $PAYTM_TXN_URL='https://pguat.paytm.com/oltp-web/processTransaction ';
            if ($this->config->item('PAYTM_ENVIRONMENT') == 'PROD') {
                $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/theia/getTxnStatus';
                $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
            }
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL); 
        define('PAYTM_ENVIRONMENT','TEST');
        define('PAYTM_MERCHANT_KEY','9Fjtw8teTLvAE9@!');
        define('PAYTM_MERCHANT_MID','AgileS14890987119591');
        define('PAYTM_MERCHANT_WEBSITE','WEB_STAGING'); 
    }
 
 public function checkpaytm(){
    $checkSum = "";
    $paramList = array();
    $product_info = 'college';//$this->input->post('product_info');
    
    if($this->input->post('screen')=='conselling')
    {
        unset($_POST['screen']);
        unset($_POST['submit']);
       
        $customer_name = $this->input->post('student_name');
        $customer_email = $this->input->post('email');
        $customer_mobile = $this->input->post('mobile');
        $amount = $this->input->post('agree');
        $studentemail=$customer_email;
        $studentphone =$customer_mobile;
        unset($_POST['agree']);
        $conselling_data=$_POST; 
       
        $studentid = $this->common_model->insertData('counselling_form',$conselling_data);
       
    }
    else
    {
    $customer_name = $this->input->post('payuname');
    $customer_email = $this->input->post('payuemail');
    $customer_mobile = $this->input->post('payuphone');
    $amount = $this->input->post('payupamount');
    $student_college =   json_decode($this->input->post('student_master'),true);
    $student_master =   json_decode($this->input->post('student_detail'),true);
    $school_detail  = json_decode($this->input->post('school_detail'),true);

    /* Insert Student Master Details */

    $select="all";
    $where=array("student_email"=>$customer_email,"student_mobile"=>$customer_mobile);
    $datacheck = $this->common_model->getAllwhere('student_master',$where);
   
    
    foreach($student_master as   $data)
         $insertdata[key($data)]= $data[key($data)];
         
    
    $insertdata['added_date']=date('Y-m-d H:i:s');
    $insertdata['added_ip']=$_SERVER['REMOTE_ADDR'];

    if(count($datacheck)==0)
       $studentid = $this->common_model->insertData('student_master',$insertdata);
    else
       $studentid =  $datacheck[0]->student_id;
       $studentemail = $datacheck[0]->student_email;
       $studentphone = $datacheck[0]->student_mobile;
    /* Insert Student College Details */ 
      
        $data=null;$insertdata=array();
      
         foreach($student_college as  $insertdata)
         {
             
             $insertdata['student_id']=  $studentid;
             $insertdata['added_date']=date('Y-m-d H:i:s');
             $insertdata['added_ip']=$_SERVER['REMOTE_ADDR'];
             $record_college_id=$this->common_model->insertData('student_college',$insertdata);
              

         }

    
        $data=null;$insertdata=array();
        /* Insert School Details */ 
        foreach($school_detail as  $insertdata) 
        {
            $insertdata['student_id']=  $studentid;
            $this->common_model->insertData('school_detail',$insertdata);
        }

    }

         $success = base_url() . 'Status';  
         $fail = base_url() . 'Status';
         $cancel = base_url() . 'Status';
         $orderid='ORDS'.substr(hash('sha256', mt_rand() . microtime()), 0,5);
         $transid=substr(hash('sha256', mt_rand() . microtime()), 0,5);
        
         $data = array('data'=>
             array(
            'MID' => PAYTM_MERCHANT_MID,
            'ORDER_ID' =>$orderid ,
            'CUST_ID'=>'CUST001',
            'INDUSTRY_TYPE_ID'=>'Retail',
            'CHANNEL_ID'=> 'WEB',
            'TXN_AMOUNT' =>  $amount,  
            'WEBSITE'=>'WEB_STAGING',
            'CALLBACK_URL'=>base_url().'paytm/response',//'https://www.paytm.com',
            'MERC_UNQ_REF'=> 'student_id'.'-'.$studentid.'-'.'email'.'-'.$studentemail.'-'.'phone'.'-'.$studentphone ,
            )
        );
         $paramList = array(
            'MID' => PAYTM_MERCHANT_MID,
            'ORDER_ID' => $orderid ,
            'CUST_ID'=> 'CUST001',
            'INDUSTRY_TYPE_ID'=> 'Retail',
            'CHANNEL_ID'=> 'WEB',
            'TXN_AMOUNT' => $amount, 
            'WEBSITE'=> 'WEB_STAGING',
            'CALLBACK_URL'=> base_url().'paytm/response',//https://www.paytm.com',
            'MERC_UNQ_REF'=> 'student_id'.'-'.$studentid.'-'.'email'.'-'.$studentemail.'-'.'phone'.'-'.$studentphone ,
        );
         
        $checkSum =  $this->getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
        $data['checkSum']=$checkSum;
        $this->load->view('header');
        $this->load->view('confirmationpaytm', $data);   
     }

   public function response()
   {
            $paytmChecksum = "";
            $paramList = array();
            $isValidChecksum = "FALSE";
            $paramList = $_POST;
            $ORDER_ID = "";
            $requestParamList = array();
            $responseParamList = array();
            $requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => "bef18d79b5e543bd9f7d9fad0e9d3f84");  
            $checkSum = $this->getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
            $requestParamList['CHECKSUMHASH'] = urlencode($checkSum);
            $data_string = "JsonData=".json_encode($requestParamList);
            $ch = curl_init();                    // initiate curl
            $url = PAYTM_STATUS_QUERY_URL; //Live server where you want to post data
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $output = curl_exec($ch); // execute
            //$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
            //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
            //$isValidChecksum = $this->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


            if($output = curl_exec($ch)) 
            {
                $info = curl_getinfo($ch);
                $data = json_decode($output, true);
                $insertdata=null;
                // echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
                if ($_POST["STATUS"] == "TXN_SUCCESS") 
                {
                    //echo "<b>Transaction status is success</b>" . "<br/>";
                   $record_ids = explode('-',$_POST['MERC_UNQ_REF']);
                   $insertdata=array(
                                   'student_id'=>$record_ids[1],
                                   'transcation_id'=>$_POST['TXNID'],
                                   'transcation_amt'=>$_POST['TXNAMOUNT'],            
                                   'currency'=>$_POST['CURRENCY'],
                                   'transcation_date'=>$_POST['TXNDATE'],
                          ) ;
                    $this->common_model->insertData('payment_detail',$insertdata);
                    $select="all";
		            $where=array("student_email"=>$record_ids[3],"student_mobile"=>$record_ids[5]);
		            $datacheck = $this->common_model->getAllwhere(' student_login',$where);
		            $original_password= rand(1000,9999);            
                    if(count($datacheck)==0)
                    {
                      $insert=array(
                                     'student_id'=>$record_ids[1],
                                     'student_email'=>$record_ids[3],
                                     'student_mobile'=>$record_ids[5],           
                                     'student_password'=>md5($original_password),
                                    ) ;
                        
                      if($this->common_model->insertData('student_login',$insert))
                      {
                              $from_email = 'abc@gmail.com';
                              $to_email = $record_ids[3];
                              $this->email->from($from_email, 'Your Name'); 
                              $this->email->to($to_email);
                              $this->email->subject('College CheckIns Login Details'); 
                              $this->email->message('College CheckIns Login Details as follows  loginid= '.$to_email.' password='.$original_password); 
                              //Send mail 
                             if($this->email->send()) 
                               $this->session->set_flashdata("email_sent","Email sent successfully."); 
                             else 
                               $this->session->set_flashdata("email_sent","Error in sending Email.");   
                      } 
                    
                    $data['category']=$this->common_model->getAll('category_master'); 
                    $data['level']=$this->common_model->getAll('level_master'); 
                    $data['stream']=$this->common_model->getAll('stream_master'); 
                    $data['status']='Success';
                    $data['amount']=$_POST['TXNAMOUNT'];
                    $data['txnid']= $_POST['TXNID'];
                    $this->load->view('header');
                    $this->load->view('success',$data);
                    $this->load->view('footer'); 
                    //Process your transaction here as success transaction.
                    //Verify amount & order id received from Payment gateway with your application's order id and amount.
                }
                else 
                {
                    echo "<b>Transaction status is failure</b>" . "<br/>";
                    $this->load->view('header');
                    $this->load->view('success',$data);
                    $this->load->view('footer');
                }
            }
            else {
                echo "<b>Checksum mismatched.</b>";
                //Process transaction as suspicious.
            }
   }  
  
}
   public function encrypt_e($input, $ky) {
    $key   = html_entity_decode($ky);
    $iv = "@@@@&&&&####$$$$";
    $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
    return $data;
    }

    public function decrypt_e($crypt, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }

    public function pkcs5_pad_e($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function pkcs5_unpad_e($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }

    public function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }

    public function checkString_e($value) {
        if ($value == 'null')
            $value = '';
        return $value;
    }

    public function getChecksumFromArray($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = $this->getArray2Str($arrayList);
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }
    public function getChecksumFromString($str, $key) {
        
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }

    public function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = $this->removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str = $this->getArray2StrForVerify($arrayList);
        $paytm_hash = $this->decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }

    public function verifychecksum_eFromStr($str, $key, $checksumvalue) {
        $paytm_hash = $this->decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }

    public function getArray2Str($arrayList) {
        $findme   = 'REFUND';
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;  
        foreach ($arrayList as $key => $value) {
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if ($pos !== false || $pospipe !== false) 
            {
                continue;
            }
            
            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    public function getArray2StrForVerify($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    public function redirect2PG($paramList, $key) {
        $hashString = $this->getchecksumFromArray($paramList);
        $checksum = $this->encrypt_e($hashString, $key);
    }

    public function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }

    public function getTxnStatus($requestParamList) {
        return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }

    public function getTxnStatusNew($requestParamList) {
        return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
    }

    public function initiateTxnRefund($requestParamList) {
        $CHECKSUM = $this->getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return $this->callAPI(PAYTM_REFUND_URL, $requestParamList);
    }

    public function callAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
        'Content-Type: application/json', 
        'Content-Length: ' . strlen($postData))                                                                       
        );  
        $jsonResponse = curl_exec($ch);   
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }

    public function callNewAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
        'Content-Type: application/json', 
        'Content-Length: ' . strlen($postData))                                                                       
        );  
        $jsonResponse = curl_exec($ch);   
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
    public function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = $this->getRefundArray2Str($arrayList);
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = encrypt_e($hashString, $key);
        return $checksum;
    }
    public function getRefundArray2Str($arrayList) {   
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;  
        foreach ($arrayList as $key => $value) {        
            $pospipe = strpos($value, $findmepipe);
            if ($pospipe !== false) 
            {
                continue;
            }
            
            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }
    public function callRefundAPI($refundApiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);   
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $refundApiURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
        $jsonResponse = curl_exec($ch);   
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }

   
    
   }