<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 

                //print_r($category_master); die;
                if(!empty($edit_level_data[0]->level_id))
                {?>
                   <h1> <b>Modify Course Level</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Course Level</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>level/level_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Level List</button></a>
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
                        <form id="form_level" name="form_level" action="<?php echo base_url();?>level/add_level" method="post" onsubmit="return check_validation();">

                            <div class="form-group form-float">
                                <label class="form-label">Course Level</label>
                                <div class="form-line <?php if(form_error('level_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="level_id" id="level_id" class="form-control" value="<?php if(!empty($edit_level_data[0]->level_id)){ echo $edit_level_data[0]->level_id;}?>">
                                    <input type="text" name="level_name" id="level_name" class="form-control" value="<?php if(!empty($edit_level_data[0]->level_name)){ echo $edit_level_data[0]->level_name;}else { echo set_value('level_name'); }?>">                                 
                                </div>
                                <label id="level_name-error" class="error" for="level_name"><?php echo form_error('level_name'); ?></label>
                            </div>

                              
                           
                            <div class="form-group form-float">
                                    <label class="form-label">Courses</label>
                                    <div class="form-line <?php if(form_error('category_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="category_id" id="category_id" value="0" >
                                        <select class="form-control show-tick" name="category_id" id="category_level">
                                            <option value="">Select Courses</option>
                                            <?php  
                                            if(!empty($category_master))
                                            {
                                                foreach ($category_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_level_data[0]->category_id)){ if($key['category_id']==$edit_level_data[0]->category_id){ echo "selected";}}else if(set_value('parent_id')==$key['category_id']){ echo "selected";}?> ><?php echo ucfirst($key['category_name']);?></option>
                                                <?php 
                                                } 
                                            }?>
                                        </select>                                   
                                    </div>
                                    <label id="category_level-error" class="error" for="category_level"><?php echo form_error('category_level'); ?></label>
                            </div>                                
                                    
                            
                             <div class="form-group form-float">
                                    <label class="form-label">Icon</label>
                                    <div class="form-line <?php if(form_error('level_icon') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="level_icon" id="level_icon" value="0" >
                                        <select class="form-control show-tick" name="level_icon" id="level_icon">
                                            <option value=""> Select Icon</option>
                                            <option value="fa fa-book"> fa fa-book</option>
                                            <option value="fa fa-graduation-cap"> fa fa-graduation-cap</option>
                                            <option value="fa fa-laptop">fa fa-laptop</option>
                                            <option value="fa fa-user"> fa fa-user</option>
                                            <option value="fa fa-user-md"> fa fa-user-md</option>
                                            <option value="fa fa-flask">fa fa-flask</option>
                                            <option value="fa fa-deviantart"> fa fa-deviantart</option>
                                            <option value="fa fa-viacoin">fa fa-viacoin</option>
                                            <option value="fa fa-gavel"> fa fa-gavel</option>
                                            <option value="fa fa-gavel"> fa fa-certificate</option>
                                        </select>                                   
                                    </div>
                                    <label id="level_icon-error" class="error" for="level_icon"><?php echo form_error('level_icon'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_level_data[0]->level_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Update Level</button>
                                <?php
                                }
                                else
                                {
                                ?>
                                <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Save Level</button>
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

                    var total_level=$("#level").val();
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
                                    if(responseData.trim()=='<div class="form-group form-float"></div>')
                                    {
                                        var updated_level=total_level;
                                        level=parseInt(level)+1;
                                        for(var i=level;i<=total_level;i++)
                                        {
                                            updated_level=parseInt(updated_level)-1;
                                            var str="category_level_div_"+i;
                                            $("#"+str).remove();
                                        }
                                        $("#level").val(updated_level);
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
    function check_validation()
    {
        var discount_name=$("#discount_name").val();
        var discount_type=$("#discount_type").val();
        var discount_apply_type=$("#discount_apply_type").val();
        var category_level_0=$("#category_level_0").val();
        var product_data=$("#product_data").val();
        var discount_start_from=$("#discount_start_from").val();
        var discount_end_to=$("#discount_end_to").val();
        var discount_value=$("#discount_value").val();
        var error_status=0;
        if(discount_name=='')
        {
            $("#discount_name-error").html("Please Enter Discount Name");
            if(error_status==0)
            {
                $("#discount_name").focus();
            }
            error_status=1;
        }
        else
        {
            $("#discount_name-error").html("");
        }
        if(discount_type=='')
        {
            $("#discount_type-error").html("Please Select Discount Type");
            if(error_status==0)
            {
                $("#discount_type").focus();
            }
            error_status=1;
        }
        else
        {
            $("#discount_type-error").html("");
        }
        if(discount_apply_type=='')
        {
            $("#discount_apply_type-error").html("Please Select Discount Apply Type");
            if(error_status==0)
            {
                $("#discount_apply_type").focus();
            }
            error_status=1;
        }
        else
        {
                    $("#discount_apply_type-error").html("");
                    if(discount_apply_type=='category')
                    {
                        if(category_level_0=='')
                        {
                            $("#category_level_0-error").html("Please Enter Category Name");
                            if(error_status==0)
                            {
                                $("#category_level_0").focus();
                            }
                            error_status=1;
                        }
                        else
                        {
                            $("#category_level_0-error").html("");
                        }
                    }
                    if(discount_apply_type=='product')
                    {
                        if(product_data=='')
                        {
                            $("#product_data-error").html("Please Enter Product Name");
                            if(error_status==0)
                            {
                                $("#product_data").focus();
                            }
                            error_status=1;
                        }
                        else
                        {
                            $("#product_data-error").html("");
                        }
                    }
                    
        }
        if(discount_start_from=='')
        {
            $("#discount_start_from-error").html("Please Enter Discount Start Date");
            if(error_status==0)
            {
                $("#discount_start_from").focus();
            }
            error_status=1;
        }
        else
        {
            $("#discount_start_from-error").html("");
        }
        if(discount_end_to=='')
        {
            $("#discount_end_to-error").html("Please Enter Discount End Date");
            if(error_status==0)
            {
                $("#discount_start_from").focus();
            }
            error_status=1;
        }
        else
        {
            $("#discount_end_to--error").html("");
        }
        if(discount_value=='')
        {
            $("#discount_value-error").html("Please Enter Discount Value");
            if(error_status==0)
            {
                $("#discount_value").focus();
            }
            error_status=1;
        }
        else
        {
            $("#discount_value-error").html("");
        }
        if(error_status==1)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
