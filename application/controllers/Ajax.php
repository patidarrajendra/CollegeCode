<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller 
{
  public $data;
    function __construct() 
    {
           parent::__construct();
           $this->load->model('common_model');      
           $this->load->library('upload');
          
           $this->data['title']="Course Level";
           
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
          $onclick=' ';
          $return .='<div class="col-md-4"><div class="coursebox"><a href="#" onclick=ajax_func('.$data["level_id"].',"'.base_url().'ajax/getcollegelist","gridcollege","level",'.$data["category_id"].')    class="acoursetag levelhyperlink" name="'.$data['level_name'] .'"  ><i class="'.$data['level_icon'].'" style="font-size:60px;margin-top: 10px;"></i> <br>'.$data['level_name'] .'</a></div></div>';// $data['level_id'];
        }
        echo  $return;
        die;       
    }

    public function getcollegelist()
    {
      $id= $_POST['key'];
      $category_id=$_POST['category_id'];
      $array = array('level_id'=>$id,'category_id'=>$category_id);
      //$datas = $this->common_model->getAllRecords('publish_master',$array);
       $datas = $this->common_model->getDistinctRecordsById('publish_master',$category_id);
      $return="";
       
 
      foreach($datas as $data)
      {
        $url="";
        

        $college=$this->common_model->getSingleRecordById('college_master', array('college_id' => $data['college_id']));
        if(isset($college['image']))
           $url = base_url().'uploads/'.$college['image'];
        if(isset($college['college_amount']))
          $amount = $college['college_amount'];
        $return.='<div class="col-md-4 news-item">
                            <div class="coursebox">
                                <h5 class="title">
                                    <a href="#">'. $college['college_name'].'</a>
                                </h5>
                                <img class="thumb" style="height: 160px;width: 230px;" src="'.$url.'" alt="College Image">
                                <p>Rs:- '. $amount.'</p>
                                <div >
                                    <input type="checkbox" id="'.$data['college_id'].'" data-level="'.$data['level_id'].'"  data-controller="'.base_url().'ajax/getstreamlist" data-price="'.$amount.'" class="checkbox_check"  name="chk10">
                                </div> 
                                <input type="hidden" id="tamount" name="tamount" value='. $college['college_amount'].'>
                            </div>
                    </div>';
        

      }
       echo  $return;
       die;
    }


    public function getstreamlist()
    {  
        $collegeid= $_POST['key']; 
        $array = array('college_id'=>$collegeid);
        $datas = $this->common_model->getAllRecords('publish_master',$array);
        $return ='';
         
        foreach($datas as $data)
        {
          $stream=$this->common_model->getSingleRecordById('stream_master', array('stream_id' => $data['stream_id'])); 
          $return .='<option value='.$data['stream_id'].'>'.$stream['stream_name'].'</option>';

        }
        echo  $return;
        die;       
    }
 


}