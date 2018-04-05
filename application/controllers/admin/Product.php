<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller 
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
          $this->data['title']="Resaller Product";
          
    }
    
    public function product_list()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $data['product_list_data'] = $this->common_model->getAlldata('product_master','');  
        $this->load->view('admin/product_list',$data);
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
    public function get_discount_value()
    {
        $discount_id=$_POST['discount_id'];
        $price=$_POST['price'];
        $where=array("discount_id"=>$discount_id);
        $result = $this->common_model->getAllwhere('discount_master',$where);
        if($result[0]->discount_type=='percentage')
        {
            $amount=(($price*$result[0]->discount_value)/100);
            $amount = number_format($amount, 2, '.', ' ');
        }
        else if($result[0]->discount_type=='fixed')
        {
            $amount=$result[0]->discount_value;
            $amount = number_format($amount, 2, '.', ' ');
        }
        else
        {
           $amount=0.00;
        }
        echo $amount;
       
    }
    public function get_offer_value()
    {
        $offer_id=$_POST['offer_id'];
        $price=$_POST['price'];
        $where=array("offer_id"=>$offer_id);
        $result = $this->common_model->getAllwhere('offer_master',$where);
        if($result[0]->offer_type=='percentage')
        {
            $amount=(($price*$result[0]->offer_value)/100);
            $amount = number_format($amount, 2, '.', ' ');
        }
        else if($result[0]->offer_type=='fixed')
        {
            $amount=$result[0]->offer_value;
            $amount = number_format($amount, 2, '.', ' ');
        }
        else
        {
           $amount=0.00;
        }
        echo $amount;
      
    }
    public function product_images()
    {
      $data=array();
       $this->load->view('admin/product_list',$data);
    }
    public function add_product()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $where = $this->db->where('parent_id = ',0);
        $data['category_data'] = $this->common_model->getAlldata('category_master',$where);
        $data['discount_data'] = $this->common_model->getAlldata('discount_master','');
        $data['offer_data'] = $this->common_model->getAlldata('offer_master','');    
        if($this->input->post()) 
        {
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('sale_price', 'Product Sale Price', 'trim|required|numeric|xss_clean');
            if ($this->form_validation->run() == FALSE) 
            {
               $this->load->view('admin/add_product',$data);
            } 
            else 
            {
                  $Product_images=array();
                  $filesCount = count($_FILES['product_image']['name']);
                  $image_upload_staus=0;
                  for($i = 0; $i < $filesCount; $i++)
                  {
                      if($_FILES['product_image']['name'][$i]!='')
                      {
                        $image_upload_staus=1;
                        $image_name=rand(1000,9999).$_FILES['product_image']['name'][$i];
                        $path='uploads/product_images/'.$image_name;
                        move_uploaded_file($_FILES['product_image']['tmp_name'][$i],$path);
                        $uploadData[$i]['image_name'] = $image_name;
                        $uploadData[$i]['image_path'] = $path;
                      }
                  }
                  $current_date=date('Y-m-d H:i:s');
                  $current_ip= $_SERVER['REMOTE_ADDR'];
                  $current_login=$this->session->userdata('id');
                  $perform_array=$_POST;                 
                  unset($perform_array['save_category']);
                  if($perform_array['product_id']=='')
                  {
                      for($i=0;$i<$perform_array['level'];$i++)
                      {
                            $str="category_level_".$i;
                            unset($perform_array[$str]);
                      }
                      $str="category_level_".$i;
                      $perform_array['category_id']=$perform_array[$str];
                      unset($perform_array[$str]);
                      unset($perform_array['level']);
                      $perform_array['product_status']=1;
                      $perform_array['added_by']=$current_login;
                      $perform_array['added_date']=$current_date;
                      $perform_array['added_ip']=$current_ip;
                      $result = $this->common_model->insertData('product_master',$perform_array);
                      for($i=0;$i<count($uploadData);$i++)
                      {
                          $image_array=array("product_id"=>$result,"image_name"=>$uploadData[$i]['image_name'],"image_path"=>$uploadData[$i]['image_path'],"image_status"=>1,"added_by"=>$perform_array['added_by'],"added_date"=>$perform_array['added_date'],"added_ip"=>$perform_array['added_ip']);
                          $result_image = $this->common_model->insertData('product_images',$image_array);
                      }
                      $this->session->set_flashdata('msg', 'Product Added Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $this->load->view('admin/add_product',$data);
                  }
                  else
                  {
                      for($i=0;$i<$perform_array['level'];$i++)
                      {
                            $str="category_level_".$i;
                            unset($perform_array[$str]);
                      }
                      $str="category_level_".$i;
                      $perform_array['category_id']=$perform_array[$str];
                      unset($perform_array[$str]);
                      unset($perform_array['level']);
                      $perform_array['edited_by']=$current_login;
                      $perform_array['edited_date']=$current_date;
                      $perform_array['edited_ip']=$current_ip;
                      $product_id=$perform_array['product_id'];
                      $where=array("product_id"=>$perform_array['product_id']);
                      $result = $this->common_model->updateFields('product_master',$perform_array,$where);

                      if($image_upload_staus==1)
                      {
                          
                          for($i=0;$i<count($uploadData);$i++)
                          {
                            $image_array=array("product_id"=>$product_id,"image_name"=>$uploadData[$i]['image_name'],"image_path"=>$uploadData[$i]['image_path'],"image_status"=>1,"edited_by"=>$perform_array['edited_by'],"edited_date"=>$perform_array['edited_date'],"edited_ip"=>$perform_array['edited_ip']);
                            $result_image = $this->common_model->insertData('product_images',$image_array);
                          }
                      }
                      $this->session->set_flashdata('msg', 'Product Updated Successfully');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $this->session->set_flashdata('class_msg', 'bg-green');
                      $url_path="product/add_product/".$perform_array["product_id"];
                      redirect($url_path, 'refresh');
                  }
            }
        }
        else
        {
              if($this->uri->segment(3))
              {
                 $product_id=$this->uri->segment(3);
                 $select="all";
                 $where=array("product_id"=>$product_id);
                 $data['edit_product_data'] = $this->common_model->getAllwherenew_objet('product_master',$where,$select);
                 $this->load->view('admin/add_product',$data);
              }
              else
              {
                  $this->load->view('admin/add_product',$data);
              }
        }
        
    }   
    public function inactive_status_change($pro_id)
    {
        $status_data=array("product_status"=>0);
        $where=array("product_id"=>$pro_id);
        $this->common_model->updateFields('product_master',$status_data,$where);
        $redirect='product/product_list';
        redirect($redirect, 'refresh');
    }
    public function active_status_change($pro_id)
    {
        $status_data=array("product_status"=>1);
        $where=array("product_id"=>$pro_id);
        $this->common_model->updateFields('product_master',$status_data,$where);
        $redirect='product/product_list';
        redirect($redirect, 'refresh');
    } 
    public function delete_product($pro_id)
    {
        
        $where=array("product_id"=>$pro_id);
        $this->common_model->delete('product_master',$where);
        $redirect='product/product_list';
        redirect($redirect, 'refresh');
    }
    public function add_excel_file()
    {
        $data['header']=$this->load->view('admin/include/header',$this->data); 
        $data['side_bar']=$this->load->view('admin/include/sidebar'); 
        $data['head']="Product Excel File"; 
        $data['button_name']="Product List"; 
        $data['action']=base_url()."product/import_excel_file";
        $this->load->view('admin/add_excel_file',$data);
    }
    // import excel data
    public function import_excel_file() 
    {
        $this->load->library('excel');
        if ($_FILES['userfile']) 
        {
            $path = "C:/xampp/htdocs/reseller/uploads/product_excel/"; 
            $config['upload_path'] = 'uploads/product_excel/';
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
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('category_name', 'product_name', 'product_description', 'discount_name', 'offer_name','discount_amount','offer_amount', 'tax_amount', 'product_price','product_image1','product_image2','product_image3');
            $makeArray = array('category_name' => 'category_name','product_name' => 'product_name', 'product_description' => 'product_description', 'discount_name' => 'discount_name', 'offer_name' => 'offer_name',  'discount_amount' => 'discount_amount','offer_amount' => 'offer_amount', 'tax_amount' => 'tax_amount', 'product_price' => 'product_price', 'product_image1' => 'product_image1', 'product_image2' => 'product_image2', 'product_image3' => 'product_image3');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) 
            {
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
                    $category_name = $SheetDataKey['category_name'];
                    $product_name = $SheetDataKey['product_name'];
                    $product_description = $SheetDataKey['product_description'];
                    $discount_name = $SheetDataKey['discount_name'];
                    $offer_name = $SheetDataKey['offer_name'];
                    $discount_amount = $SheetDataKey['discount_amount'];
                    $offer_amount = $SheetDataKey['offer_amount'];
                    $tax_amount = $SheetDataKey['tax_amount'];
                    $product_price = $SheetDataKey['product_price'];
                    $product_image1 = $SheetDataKey['product_image1'];
                    $product_image2 = $SheetDataKey['product_image2'];
                    $product_image3 = $SheetDataKey['product_image3'];
                    $category_name = filter_var(trim($allDataInSheet[$i][$category_name]), FILTER_SANITIZE_STRING);
                    $product_name = filter_var(trim($allDataInSheet[$i][$product_name]), FILTER_SANITIZE_STRING);
                    $product_description = filter_var(trim($allDataInSheet[$i][$product_description]), FILTER_SANITIZE_EMAIL);
                    $discount_name = filter_var(trim($allDataInSheet[$i][$discount_name]), FILTER_SANITIZE_STRING);
                    $offer_name = filter_var(trim($allDataInSheet[$i][$offer_name]), FILTER_SANITIZE_STRING);
                    $discount_amount = filter_var(trim($allDataInSheet[$i][$discount_amount]), FILTER_SANITIZE_STRING);

                    $offer_amount = filter_var(trim($allDataInSheet[$i][$offer_amount]), FILTER_SANITIZE_STRING);
                    $tax_amount = filter_var(trim($allDataInSheet[$i][$tax_amount]), FILTER_SANITIZE_STRING);
                    $product_price = filter_var(trim($allDataInSheet[$i][$product_price]), FILTER_SANITIZE_EMAIL);
                    $product_image1 = filter_var(trim($allDataInSheet[$i][$product_image1]), FILTER_SANITIZE_STRING);
                    $product_image2 = filter_var(trim($allDataInSheet[$i][$product_image2]), FILTER_SANITIZE_STRING);
                    $product_image3 = filter_var(trim($allDataInSheet[$i][$product_image3]), FILTER_SANITIZE_STRING);

                    $fetchData[] = array('category_name' => $category_name, 'product_name' => $product_name, 'product_description' => $product_description, 'discount_name' => $discount_name, 'offer_name' => $offer_name,'discount_amount' => $discount_amount,'offer_amount' => $offer_amount, 'tax_amount' => $tax_amount, 'product_price' => $product_price, 'product_image1' => $product_image1, 'product_image2' => $product_image2,'product_image3' => $product_image3);
                }              
                $data['employeeInfo'] = $fetchData;
                $all_excel_data=$data['employeeInfo'];
                ///$excel_file_data=$data['employeeInfo'][0];
               
                $error_message="";
                $insert_array=array();
                $image_datils_array=array();
                for($i=0;$i<2;$i++)
                {
                        $excel_file_data=array();
                        $uploaded_image_array=array();
                        $excel_file_data=$all_excel_data[$i];
                        if($excel_file_data['category_name']!='')
                        {
                              $category_id=$this->get_category_id($excel_file_data['category_name']);
                              if($category_id!='')
                              {
                                $insert_array[$i]['category_id']=$category_id;
                              }
                              else
                              {
                                  $error_message.='Category name not found in row no'.$i.'<br/>';
                              }
                        }
                        else
                        {
                              $error_message.='Blank category in row no'.$i.'<br/>';
                        }
                        if($excel_file_data['product_name']!='')
                        {
                              $insert_array[$i]['product_name']=$excel_file_data['product_name'];
                        }
                        else
                        {
                            $error_message.='Product name not found in row no'.$i.'<br/>';
                        }
                        if($excel_file_data['product_description']!='')
                        {
                              $insert_array[$i]['product_description']=$excel_file_data['product_description'];
                        }
                        else
                        {
                            $error_message.='Product description not found in row no'.$i.'<br/>';
                        }
                        if($excel_file_data['product_price']!='')
                        {
                              $insert_array[$i]['product_price']=$excel_file_data['product_price'];
                        }
                        else
                        {
                            $error_message.='Product price not found in row no'.$i.'<br/>';
                        }
                        if($excel_file_data['discount_name']!='')
                        {
                              $discount_array=$this->get_discount_amount($insert_array[$i]['product_price'],$excel_file_data['discount_name']);
                              if(count($discount_array)>0)
                              {
                                  $insert_array[$i]['discount_id']=$discount_array['id'];
                              }
                              else
                              {
                                  $insert_array[$i]['discount_id']='';
                              }
                        }
                        else
                        {
                             $insert_array[$i]['discount_id']='';
                        }
                        if($excel_file_data['offer_name']!='')
                        {
                              $offer_array=$this->get_offer_amount($insert_array[$i]['product_price'],$excel_file_data['offer_name']);
                              if(count($offer_array)>0)
                              {
                                  $insert_array[$i]['offer_id']=$offer_array['id'];
                              }
                              else
                              {
                                  $insert_array[$i]['offer_id']='';
                              }
                        }
                        else
                        {
                               $insert_array[$i]['offer_id']='';
                        }
                        if($excel_file_data['tax_amount']!='')
                        {
                            if($insert_array[$i]['product_price']!='')
                            {
                                $insert_array[$i]['tax_id']=$excel_file_data['tax_amount'];
                                $insert_array[$i]['tax_amount']=((($insert_array[$i]['product_price'])*($insert_array[$i]['tax_id']))/100);
                            }
                            else
                            {
                                 $error_message.='Product price not found in row no'.$i.'<br/>';
                            }
                              
                        }
                        else
                        {
                                $error_message.='Product tax not found in row no'.$i.'<br/>';
                        }
                        if($excel_file_data['discount_amount']!='')
                        {
                              if(count($discount_array)>0)
                              {
                                  $insert_array[$i]['discount_amount']=$discount_array['amount'];
                              }
                              else
                              {
                                   $insert_array[$i]['discount_amount']=$excel_file_data['discount_amount'];
                              }
                              
                        }
                        else
                        {       
                                if($excel_file_data['discount_amount']=='')
                                {
                                  $insert_array[$i]['discount_amount']=0.00;
                                }
                                else
                                {
                                  $insert_array[$i]['discount_amount']=$excel_file_data['discount_amount'];
                                }
                        }
                        if($excel_file_data['offer_amount']!='')
                        {
                              if(count($offer_array)>0)
                              {
                                  $insert_array[$i]['offer_amount']=$offer_array['amount'];
                              }
                              else
                              {
                                  $insert_array[$i]['offer_amount']=$excel_file_data['offer_amount'];
                              }
                              
                        }
                        else
                        {
                                if($excel_file_data['discount_amount']=='')
                                {
                                  $insert_array[$i]['offer_amount']=0.00;
                                }
                                else
                                {
                                  $insert_array[$i]['offer_amount']=$excel_file_data['offer_amount'];
                                }
                                
                        }
                        if($excel_file_data['product_image1']!='')
                        {
                            $image_url=$excel_file_data['product_image1'];
                            $image_path_array=explode("/",$image_url);
                            $image_name=end($image_path_array);
                            $image_name=rand(100000,999999).$image_name;
                            $data = file_get_contents($image_url);
                            $new = '././uploads/product_images/'.$image_name;
                            $path=base_url()."uploads/product_images/".$image_name;
                            $upload =file_put_contents($new, $data);
                            if($upload) 
                            {
                                $uploaded_image_array[0]['image_name']=$image_name;
                                $uploaded_image_array[0]['image_path']=$path;
                            }
                            else
                            {
                                $uploaded_image_array[0]['image_name']="";
                                $uploaded_image_array[0]['image_path']="";
                            } 
                        }
                        else
                        {
                            $uploaded_image_array[0]['image_name']="";
                            $uploaded_image_array[0]['image_path']="";
                        }
                        if($excel_file_data['product_image2']!='')
                        {
                            $image_url=$excel_file_data['product_image2'];
                            $image_path_array=explode("/",$image_url);
                            $image_name=end($image_path_array);
                            $image_name=rand(100000,999999).$image_name;
                            $data = file_get_contents($image_url);
                            $new = '././uploads/product_images/'.$image_name;
                            $path="uploads/product_images/".$image_name;
                            $upload =file_put_contents($new, $data);
                            if($upload) 
                            {
                                $uploaded_image_array[1]['image_name']=$image_name;
                                $uploaded_image_array[1]['image_path']=$path;
                            }
                            else
                            {
                                $uploaded_image_array[1]['image_name']="";
                                $uploaded_image_array[1]['image_path']="";
                            } 
                        }
                        else
                        {
                            $uploaded_image_array[1]['image_name']="";
                            $uploaded_image_array[1]['image_path']="";
                        }
                        if($excel_file_data['product_image3']!='')
                        {
                            $image_url=$excel_file_data['product_image3'];
                            $image_path_array=explode("/",$image_url);
                            $image_name=end($image_path_array);
                            $image_name=rand(100000,999999).$image_name;
                            $data = file_get_contents($image_url);
                            $new = '././uploads/product_images/'.$image_name;
                            $path=base_url()."uploads/product_images/".$image_name;
                            $upload =file_put_contents($new, $data);
                            if($upload) 
                            {
                                $uploaded_image_array[2]['image_name']=$image_name;
                                $uploaded_image_array[2]['image_path']=$path;
                            }
                            else
                            {
                                $uploaded_image_array[2]['image_name']="";
                                $uploaded_image_array[2]['image_path']="";
                            } 
                        }
                        else
                        {
                            $uploaded_image_array[2]['image_name']="";
                            $uploaded_image_array[2]['image_path']="";
                        }

                        $sale_price=$insert_array[$i]['product_price']+$insert_array[$i]['tax_amount']-$insert_array[$i]['offer_amount']-$insert_array[$i]['discount_amount'];
                        $insert_array[$i]['sale_price']=$sale_price;
                        $insert_array[$i]['product_status ']=1;
                        $insert_array[$i]['added_date']=date('Y-m-d H:i:s');
                        $insert_array[$i]['added_ip']= $_SERVER['REMOTE_ADDR'];
                        $insert_array[$i]['added_by']=$this->session->userdata('id');
                        if($error_message!='')
                        {
                            break;
                        }
                        else
                        {
                              $result_id = $this->common_model->insertData('product_master',$insert_array[$i]);
                              for($j=0;$j<count($uploaded_image_array);$j++) 
                              {
                                  if($uploaded_image_array[$j]['image_name']!='' && $uploaded_image_array[$j]['image_path']!='')
                                  {
                                      $image_array=array("product_id"=>$result_id,"image_name"=>$uploaded_image_array[$j]['image_name'],"image_path"=>$uploaded_image_array[$j]['image_path'],"image_status"=>1,"added_by"=>$insert_array[$i]['added_by'],"added_date"=>$insert_array[$i]['added_date'],"added_ip"=>$insert_array[$i]['added_ip']);
                                      $result_image_id = $this->common_model->insertData('product_images',$image_array);
                                  }
                              }
                        }
                        
                }
                if($error_message!='')
                {
                    $this->session->set_flashdata('msg', $error_message);
                    $this->session->set_flashdata('class_msg', 'bg-red');
                }
                else
                {
                    $msg="File Successfully uploaded";
                    $this->session->set_flashdata('msg', $msg);
                    $this->session->set_flashdata('class_msg', 'bg-green');
                }
            } 
            else 
            {
                $msg="Please import correct file";
                $this->session->set_flashdata('msg', $msg);
                $this->session->set_flashdata('class_msg', 'bg-red');
            }
        }
        else
        {
              $msg="Please import correct file";
              $this->session->set_flashdata('msg', $msg);
              $this->session->set_flashdata('class_msg', 'bg-red');
        }
        $url_path="product/add_excel_file/";
        redirect($url_path, 'refresh');
        
    }
    public function get_discount_amount($price,$discount_name)
    {
        $where=array("discount_name"=>$discount_name);
        $result = $this->common_model->getAllwhere('discount_master',$where);
        $discount_return_array=array();
        if(!empty($result)>0)
        {
            $discount_id=$result[0]->discount_id;
            if($result[0]->discount_type=='percentage')
            {
                $amount=(($price*$result[0]->discount_value)/100);
                $amount = number_format($amount, 2, '.', ' ');
            }
            else if($result[0]->discount_type=='fixed')
            {
                $amount=$result[0]->discount_value;
                $amount = number_format($amount, 2, '.', ' ');
            }
            $discount_return_array['id']=$discount_id;
            $discount_return_array['amount']=$amount;
        }
        else
        {
           return $discount_return_array;
        }
    }
    public function get_offer_amount($price,$offer_name)
    {
        
        $where=array("offer_name"=>$offer_name);
        $result = $this->common_model->getAllwhere('offer_master',$where);
        $offer_return_array=array();
        if(!empty($result)>0)
        {
            $offer_id=$result[0]->offer_id;
            if($result[0]->offer_type=='percentage')
            {
                $amount=(($price*$result[0]->offer_value)/100);
                $amount = number_format($amount, 2, '.', ' ');
            }
            else if($result[0]->offer_type=='fixed')
            {
                $amount=$result[0]->offer_value;
                $amount = number_format($amount, 2, '.', ' ');
            }
            $offer_return_array['id']=$offer_id;
            $offer_return_array['amount']=$amount;
        }
        else
        {
           return $offer_return_array;
        }
    }
    public function get_category_id($category_name)
    {
       
        $where=array("category_name"=>$category_name);
        $result = $this->common_model->getAllwhere('category_master',$where);
        if(!empty($result))
        {
            $category_id=$result[0]->category_id;
        }
        else
        {
          $category_id=0;
        }
        return $category_id;
    }
    public function get_remove_image()
    {
        $pro_id=$_POST['pro_id'];
        $img_id=$_POST['img_id'];
        $where=array("product_id"=>$pro_id,"product_image_id"=>$img_id);
        $result = $this->common_model->getAllwhere('product_images',$where);
        if(!empty($result))
        {
            $image_path=$result[0]->image_path;
            $image_path='././'.$image_path;
            unlink($image_path);
        }
        $where=array("product_id"=>$pro_id,"product_image_id"=>$img_id);
        $this->common_model->delete('product_images',$where);
    }
}