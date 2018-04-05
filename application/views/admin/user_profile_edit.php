<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 
                if(!empty($account_edit_data[0]->id))
                {?>
                   <h1> <b>Modify Account Details</b> </h1> 
                <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>/home/" ><button class="btn btn-primary waves-effect button_postion" type="button">Dashborad</button></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?php 
                        if($this->session->flashdata('msg'))
                        { ?>
                            <div class="alert <?php echo $this->session->flashdata('class_msg');?>">
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <br/>
                        <?php
                        }
                        ?>
                        <form id="form_discount" name="form_discount" action="<?php echo base_url();?>discount/add_discount" method="post">

                            <div class="form-group form-float">
                                <label class="form-label">Discount Name</label>
                                <div class="form-line <?php if(form_error('discount_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="discount_id" id="discount_id" class="form-control" value="<?php if(!empty($edit_discount_data[0]->discount_id)){ echo $edit_discount_data[0]->discount_id;}?>">
                                    <input type="text" name="discount_name" id="discount_name" class="form-control" value="<?php if(!empty($edit_discount_data[0]->discount_apply_type)){ echo $edit_discount_data[0]->discount_name;}else { echo set_value('discount_name'); }?>">                                 
                                </div>
                                <label id="date-error" class="error" for="discount_name"><?php echo form_error('discount_name'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <label class="form-label">Discount Type</label>
                                <div class="form-line <?php if(form_error('discount_type') != false) { echo 'error focused'; }?>">
                                    <select class="form-control show-tick" name="discount_type" id="discount_type">
                                        <option value="">Select</option>
                                        <option value="fixed" <?php if(!empty($edit_discount_data[0]->discount_type)){ if($edit_discount_data[0]->discount_type=='fixed'){ echo "selected";}}else if(set_value('discount_type')=='fixed'){ echo "selected";}?>>Fixed</option>
                                        <option value="percentage" <?php if(!empty($edit_discount_data[0]->discount_type)){ if($edit_discount_data[0]->discount_type=='percentage'){ echo "selected";}}else if(set_value('discount_type')=='percentage'){ echo "selected";}?>>Percentage</option>
                                    </select>                                   
                                </div>
                                <label id="date-error" class="error" for="discount_type"><?php echo form_error('discount_type'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Discount Applied Type</label>
                                <div class="form-line <?php if(form_error('discount_apply_type') != false) { echo 'error focused'; }?>">
                                    
                                    <select class="form-control show-tick" name="discount_apply_type" id="discount_apply_type" onchange="get_selected_data1()">
                                        <option value="">Select</option>
                                        <option value="category" <?php if(!empty($edit_discount_data[0]->discount_apply_type)){ if($edit_discount_data[0]->discount_apply_type=='category'){ echo "selected";}}else if(set_value('discount_apply_type')=='category'){ echo "selected";}?>>Category</option>
                                        
                                        <option value="product" 
                                        <?php if(!empty($edit_discount_data[0]->discount_apply_type)){ if($edit_discount_data[0]->discount_apply_type=='product'){ echo "selected";}}else if(set_value('discount_apply_type')=='product'){ echo "selected";}?> >Product</option>
                                    </select>                                   
                                </div>
                                <label id="date-error" class="error" for="discount_apply_type"><?php echo form_error('discount_apply_type'); ?></label>
                            </div>
                            <?php
                            if(!empty($edit_discount_data))
                            {
                                if($edit_discount_data[0]->discount_apply_type=='category')
                                {
                                        $category_parent_id=array();
                                        $cat_id=$edit_discount_data[0]->discount_applied_id;
                                        array_push($category_parent_id,$cat_id);
                                        $where=array("category_id"=>$edit_discount_data[0]->discount_applied_id);
                                        $cate_result = $this->common_model->getAllwherenew_objet('category_master',$where);
                                        $parent_id=$cate_result[0]->parent_id;
                                        if($parent_id!=0)
                                        {
                                            for($m=0;$m<100;$m++)
                                            {
                                                $where=array("category_id"=>$parent_id);
                                                $cate_result = $this->common_model->getAllwherenew_objet('category_master',$where);
                                                $parent_id=$cate_result[0]->parent_id;
                                                $cat_id=$cate_result[0]->category_id;
                                                if($parent_id!=0)
                                                {
                                                    array_push($category_parent_id,$cat_id);
                                                }
                                                else
                                                {
                                                    array_push($category_parent_id,$cat_id);
                                                    break;
                                                }
                                            }

                                        }
                                        $category_parent_id=array_reverse($category_parent_id);
                                        echo '<div  id="all_category_data"> ';
                                        for($k=0;$k<count($category_parent_id);$k++)
                                        {
                                            echo '<input type="hidden" name="level" id="level" value="'.$k.'">';
                                            if($k==0)
                                            {
                                                ?>
                                                <div class="form-group form-float">
                                                    <label class="form-label">Discount Type Value</label>
                                                    <div class="form-line <?php if(form_error('category_level_0') != false) { echo 'error focused'; }?>">
                                                       
                                                        <select class="form-control show-tick" name="category_level_0" id="category_level_0" onchange="get_selected_data(this.value,'0')">
                                                            <option value="">Select Category</option>
                                                            <?php  
                                                            if(count($category_data)>0)
                                                            {
                                                                for($i=0;$i<count($category_data);$i++)
                                                                {?>
                                                                    <option value="<?php echo $category_data[$i]['category_id'];?>" <?php if(!empty($edit_discount_data[0]->discount_applied_id)){ if($category_data[$i]['category_id']==$category_parent_id[$k]){ echo "selected";} else {echo "ok";}}else if(set_value('category_level_0')==$category_parent_id[$k]){ echo "selected";}?> ><?php echo ucfirst($category_data[$i]['category_name']);?></option>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>                                   
                                                    </div>
                                                    <label id="category_level_0-error" class="error" for="category_level_0"><?php echo form_error('category_level_0'); ?></label>
                                                </div>
                                                <?php
                                            }
                                            else
                                            {
                                                $l=$k-1;
                                                ?>
                                                <div id="category_level_<?php echo $k;?>">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Category Level-<?php echo $k;?> </label>
                                                        <?php $cat_var ='category_level_'.$k;?>
                                                        <div class="form-line <?php if(form_error($cat_var) != false) { echo 'error focused'; }?>">
                                                            <select class="form-control show-tick" name="category_level_<?php echo $k;?>" id="category_level_<?php echo $k;?>" onchange="get_selected_data(this.value,'<?php echo $k;?>')">
                                                                <option value="">Select Level-<?php echo $k;?></option>
                                                                <?php 
                                                                $where          = array('parent_id' =>$category_parent_id[$l]);
                                                                $result = $this->common_model->getAllwherenew_objet('category_master',$where);
                                                                if(!empty($result)>0)
                                                                {
                                                                    
                                                                    for($i=0;$i<count($result);$i++)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $result[$i]->category_id;?>" <?php if(!empty($edit_discount_data[0]->discount_applied_id)){ if($result[$i]->category_id==$category_parent_id[$k]){ echo "selected";}else{echo "ok";}}else if(set_value($cat_var)==$category_parent_id[$k]){ echo "selected";}?> ><?php echo ucfirst($result[$i]->category_name);?></option>
                                                                        
                                                                    <?php
                                                                   
                                                                    }
                                                                }
                                                                ?>
                                                            </select>                                   
                                                        </div>
                                                        <label id="category_level_<?php echo $i;?>-error" class="error" for="category_level_<?php echo $i;?>"><?php echo form_error($cat_var); ?></label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        echo '</div>';
                                }
                                else
                                {
                                    ?>
                                    <div class="form-group form-float" id="product_section_id">
                                        <label class="form-label">Discount Type Value</label>
                                        <div class="form-line <?php if(form_error('product_data') != false) { echo 'error focused'; }?>">
                                            <input type="hidden" name="level" id="level" value="0" >
                                            <select class="form-control show-tick" name="product_data" id="product_data" >
                                                <option value="">Select Product</option>
                                                <?php  
                                                if(count($product_data)>0)
                                                {
                                                    for($i=0;$i<count($product_data);$i++)
                                                    {?>
                                                        <option value="<?php echo $product_data[$i]['product_id'];?>" <?php if(!empty($edit_discount_data[0]->discount_applied_id)){ if($edit_discount_data[0]->discount_applied_id==$product_data[$i]['product_id']){ echo "selected";}}else if(set_value('category_level_0')==$product_data[$i]['product_id']){ echo "selected";}?> ><?php echo ucfirst($product_data[$i]['product_name']);?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>      
                                                                          
                                        </div>
                                        <label id="product_data-error" class="error" for="product_data"><?php echo form_error('category_level_0'); ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                            ?>
                                <div  id="all_category_data" >
                                    <div class="form-group form-float" >
                                            <label class="form-label">Discount Type Value</label>
                                            <div class="form-line <?php if(form_error('category_level_0') != false) { echo 'error focused'; }?>">
                                                <input type="hidden" name="level" id="level" value="0" >
                                                <select class="form-control show-tick" name="category_level_0" id="category_level_0" onchange="get_selected_data(this.value,'0')">
                                                    <option value="">Select Category</option>
                                                    <?php  
                                                    if(count($category_data)>0)
                                                    {
                                                        for($i=0;$i<count($category_data);$i++)
                                                        {?>
                                                            <option value="<?php echo $category_data[$i]['category_id'];?>" <?php if(!empty($edit_product_data[0]->category_id)){ if($edit_product_data[0]->category_id==$category_data[$i]['category_id']){ echo "selected";}}else if(set_value('category_level_0')==$category_data[$i]['category_id']){ echo "selected";}?> ><?php echo ucfirst($category_data[$i]['category_name']);?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>      
                                                                              
                                            </div>
                                            <label id="category_level_0-error" class="error" for="category_level_0"><?php echo form_error('category_level_0'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group form-float" id="product_section_id" style="display: none;">
                                    <label class="form-label">Discount Type Value</label>
                                    <div class="form-line <?php if(form_error('category_level_0') != false) { echo 'error focused'; }?>">
                                        <select class="form-control show-tick" name="product_data" id="product_data" >
                                            <option value="">Select Product</option>
                                            <?php  
                                            if(count($product_data)>0)
                                            {
                                                for($i=0;$i<count($product_data);$i++)
                                                {?>
                                                    <option value="<?php echo $product_data[$i]['product_id'];?>" <?php if(!empty($edit_discount_data[0]->category_id)){ if($edit_product_data[0]->discount_applied_id==$product_data[$i]['product_id']){ echo "selected";}}else if(set_value('category_level_0')==$product_data[$i]['product_id']){ echo "selected";}?> ><?php echo ucfirst($product_data[$i]['product_name']);?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>      
                                                                      
                                    </div>
                                    <label id="category_level_0-error" class="error" for="category_level_0"><?php echo form_error('category_level_0'); ?></label>
                                </div>
                            <?php
                            }
                            ?>
                                
                                    
                            <div class="form-group form-float">
                                <div class="col-md-6 <?php if(form_error('discount_start_from') != false) { echo 'error focused'; }?>">
                                    <label class="form-label">Discount Start From</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" placeholder="Ex: 30/07/2016" name="discount_start_from" id="discount_start_from" value="<?php if(!empty($edit_discount_data[0]->discount_start_from)){ echo date('d/m/Y',strtotime($edit_discount_data[0]->discount_start_from));}else { echo set_value('discount_start_from'); }?>">
                                        </div>
                                        <label id="date-error" class="error" for="discount_start_from"><?php echo form_error('discount_start_from'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount End To</label>
                                    <div class="input-group <?php if(form_error('discount_end_to') != false) { echo 'error focused'; }?>">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" placeholder="Ex: 30/07/2016" name="discount_end_to" id="discount_end_to" value="<?php if(!empty($edit_discount_data[0]->discount_end_to)){  echo date('d/m/Y',strtotime($edit_discount_data[0]->discount_end_to));}else { echo set_value('discount_end_to'); }?>">
                                        </div>
                                        <label id="date-error" class="error" for="discount_start_from"><?php echo form_error('discount_end_to'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Discount Value</label>
                                <div class="form-line <?php if(form_error('discount_value') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="discount_value" id="discount_value" class="form-control" value="<?php if(!empty($edit_discount_data[0]->discount_value)){ echo $edit_discount_data[0]->discount_value;}else { echo set_value('discount_value'); }?>" >                                 
                                </div>
                                <label id="date-error" class="error" for="discount_value"><?php echo form_error('discount_value'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_discount_data[0]->discount_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Update Discount</button>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Save Discount</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("include/footer.php");?>
<script type="text/javascript">
      var global_level_array=[];
    function get_selected_data(selected_value,level)
    {
        
                    $.ajax
                        ({
                            type: "post",
                            url: "<?php echo base_url('discount/product_sub_type');?>",
                            data: {'selected_value':selected_value,'level':level},
                            success: function(responseData) 
                            {
                               

                                if(responseData.trim()=='blank')
                                {
                                    return
                                }
                                else
                                {
                                    
                                            var status=0;
                                            level=parseInt(level)+1;
                                            for(var i=0;i<global_level_array.length;i++)
                                            {
                                                if(global_level_array[i]==level)
                                                {
                                                   
                                                    status=1;
                                                    break;
                                                }
                                            }
                                            if(status==0)
                                            {
                                                global_level_array.push(level);
                                                var str="category_level_"+level;
                                                var append_div='<div id="'+str+'" ></div>';
                                                $("#all_category_data").append(append_div);
                                                $("#"+str).append(responseData);
                                                $("#level").val(level);
                                            }
                                            else
                                            {
                                                var str="category_level_"+level;
                                                $("#"+str).html(responseData);
                                            }
                                }
                            }
                        });
    }
    function get_selected_data1()
    {
        var discount_apply_type=$("#discount_apply_type").val();
         var level=$("#level").val();
        if(discount_apply_type=='category')
        {
            $("#all_category_data").show();
            $("#product_section_id").hide();
        }
        else
        {

            $("#all_category_data").hide();
            $("#product_section_id").show();
        }
    }
</script>
