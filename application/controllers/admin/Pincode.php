<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pincode extends CI_Controller 
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
          $this->data['title']="Resaller Pincode";
          
    }
    public function pincode_list()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $data['pincode_list_data'] = $this->common_model->getAlldata('pincode_master','');  
        $this->load->view('admin/pincode_list',$data);
    }
    
    public function add_pincode()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        if($this->input->post()) 
        {
            $this->form_validation->set_rules('pin_code', 'Pincode Number', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('pin_charge', 'Pincode Delevery Charage', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_pincode',$data);
            } 
            else 
            {
                  
                  $current_date=date('Y-m-d H:i:s');
                  $current_ip= $_SERVER['REMOTE_ADDR'];
                  $current_login=$this->session->userdata('id');
                  $perform_array=$_POST;                 
                  unset($perform_array['save_pincode']);
                  if($perform_array['pin_id']=='')
                  {
                      $perform_array['pin_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      $result = $this->common_model->insertData('pincode_master',$perform_array);
                      $this->session->set_flashdata('msg', 'Pincode Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $redirect='pincode/add_pincode';
                      redirect($redirect, 'refresh');
                  }
                  else
                  {
                     
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $pin_id=$perform_array['pin_id'];
                      $where=array("pin_id"=>$perform_array['pin_id']);
                      $result = $this->common_model->updateFields('pincode_master',$perform_array,$where);
                      $this->session->set_flashdata('msg', 'Pincode Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="pincode/add_pincode/".$perform_array["pin_id"];
                      redirect($url_path, 'refresh');
                      
                  }
            }
        }
        else
        {
              if($this->uri->segment(3))
              {
                 $pin_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("pin_id"=>$pin_id);
                 $data['edit_pincode_data'] = $this->common_model->getAllwherenew_objet('pincode_master',$where,$select);
                 $this->load->view('admin/add_pincode',$data);
              }
              else
              {
                  $this->load->view('admin/add_pincode',$data);
              }
        }
        
    }   
    public function inactive_status_change($pro_id)
    {
        $status_data=array("pin_status"=>0);
        $where=array("pin_id"=>$pro_id);
        $this->common_model->updateFields('pincode_master',$status_data,$where);
        $redirect='pincode/pincode_list';
        redirect($redirect, 'refresh');
    }
    public function active_status_change($pro_id)
    {
        $status_data=array("pin_status"=>1);
        $where=array("pin_id"=>$pro_id);
        $this->common_model->updateFields('pincode_master',$status_data,$where);
        $redirect='pincode/pincode_list';
        redirect($redirect, 'refresh');
    } 
    public function delete_pincode($pro_id)
    {
        
        $where=array("pin_id"=>$pro_id);
        $this->common_model->delete('pincode_master',$where);
        $redirect='pincode/pincode_list';
        redirect($redirect, 'refresh');
    }
    public function add_excel_file()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $data['head']="Pincode Excel File"; 
        $data['button_name']="Pincode List"; 
        $data['action']=base_url()."pincode/import_excel_file"; 
        $this->load->view('admin/add_excel_file',$data);
    }
    // upload xlsx|xls file
    
    // import excel data
    public function import_excel_file() 
    {
        $this->load->library('excel');
        if ($_FILES['userfile']) 
        {
            $path = "C:/xampp/htdocs/reseller/uploads/pincode_excel/"; 
            $config['upload_path'] = 'uploads/pincode_excel/';
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) 
            {
                $error = array('error' => $this->upload->display_errors());
            } 
            else 
            {
                $data = array('upload_data' => $this->upload->data());
            }
            if (!empty($data['upload_data']['file_name'])) 
            {
                $import_xls_file = $data['upload_data']['file_name'];
            } 
            else 
            {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try 
            {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } 
            catch (Exception $e) 
            {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('srno','pincode', 'pincode_amount');
            $makeArray = array('srno'=>'srno','pincode' => 'pincode','pincode_amount' => 'pincode_amount');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
            if (empty($data)) 
            {
                $flag = 1;
            }
            if ($flag == 1) 
            {
                for ($i = 2; $i <= $arrayCount; $i++) 
                {
                    $addresses = array();
                    $pin_code = $SheetDataKey['pincode'];
                    $pin_charge = $SheetDataKey['pincode_amount'];
                    $pin_code = filter_var(trim($allDataInSheet[$i][$pin_code]), FILTER_SANITIZE_STRING);
                    $pin_charge = filter_var(trim($allDataInSheet[$i][$pin_charge]), FILTER_SANITIZE_STRING);
                    $fetchData[] = array('pin_code' => $pin_code, 'pin_charge' => $pin_charge);
                }   

                $data['employeeInfo'] = $fetchData;
                $current_date=date('Y-m-d H:i:s');
                $current_ip= $_SERVER['REMOTE_ADDR'];
                $current_login=$this->session->userdata('id');  
                for($i=0;$i<count($data['employeeInfo']);$i++)  
                { 
                    $excel_file_data=$data['employeeInfo'][$i];
                    $excel_file_data['pin_status']=1;
                    $excel_file_data['added_by']=$current_login;
                    $excel_file_data['added_date']=$current_date;
                    $excel_file_data['added_ip']=$current_ip;
                    $where=array("pin_code"=>$excel_file_data['pin_code']);
                    $select="all";
                    $check_pincode_data = $this->common_model->getAllwherenew_objet('pincode_master',$where,$select);
                    if($check_pincode_data=='no')
                    {
                      $data['product_list_data'] = $this->common_model->insertData('pincode_master',$excel_file_data); 
                    }

                }
                $msg="File Successfully Uploaded" ;
            } 
            else 
            {
                $msg1="Please import correct file" ;
            }
        }
        else
        {
            $msg1="Please import correct file" ;
        }
        if($msg1)
        {
            $this->session->set_flashdata('msg', $msg1);
            $this->session->set_flashdata('class_msg', 'bg-red');
        }
        else if($msg)
        {
            $this->session->set_flashdata('msg', $msg);
            $this->session->set_flashdata('class_msg', 'bg-green');
        }
        $url_path="pincode/add_excel_file/";
        redirect($url_path, 'refresh');
    }
}