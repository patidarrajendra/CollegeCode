<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 

                //print_r($category_master); die;
                if(!empty($edit_college_data[0]->college_id))
                {?>
                   <h1> <b>Modify College</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add College</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>College/college_list" ><button class="btn btn-primary waves-effect button_postion" type="button">College List</button></a>
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
                        <form id="form_college" name="form_college" action="<?php echo base_url();?>College/add_college" method="post" onsubmit="return check_validation();" enctype="multipart/form-data">

                            <div class="form-group form-float">
                                <label class="form-label">College Name</label>
                                <div class="form-line <?php if(form_error('college_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="college_id" id="college_id" class="form-control" value="<?php if(!empty($edit_college_data[0]->college_id)){ echo $edit_college_data[0]->college_id;}?>">
                                    <input type="text" name="college_name" id="college_name" class="form-control" value="<?php if(!empty($edit_college_data[0]->college_name)){ echo $edit_college_data[0]->college_name;}else { echo set_value('college_name'); }?>">                                 
                                </div>
                                <label id="college_name-error" class="error" for="college_name"><?php echo form_error('college_name'); ?></label>
                            </div>

                              
                            <div class="form-group form-float">
                                <label class="form-label">College Description</label>
                                <div class="form-line <?php if(form_error('college_description') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="college_description" id="college_description" class="form-control" value="<?php if(!empty($edit_college_data[0]->college_description)){ echo $edit_college_data[0]->college_description;}?>">
                                    <input type="text" name="college_description" id="college_description" class="form-control" value="<?php if(!empty($edit_college_data[0]->college_description)){ echo $edit_college_data[0]->college_description;}else { echo set_value('college_description'); }?>">                                 
                                </div>
                                <label id="college_description-error" class="error" for="college_description"><?php echo form_error('college_description'); ?></label>
                            </div>
 <?php /*                           
                            <div class="form-group form-float">
                                    <label class="form-label">Category </label>
                                    <div class="form-line <?php if(form_error('category_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="category_id" id="category_id" value="0" >
                                        <select class="form-control show-tick" name="category_id" id="category_level">
                                            <option value="">Select Category</option>
                                            <?php  
                                            if(!empty($category_master))
                                            {
                                                foreach ($category_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_college_data[0]->category_id)){ if($key['category_id']==$edit_college_data[0]->category_id){ echo "selected";}}else if(set_value('parent_id')==$key['category_id']){ echo "selected";}?> ><?php echo ucfirst($key['category_name']);?></option>
                                                <?php 
                                                } 
                                            }?>
                                        </select>                                   
                                    </div>
                                    <label id="category_level-error" class="error" for="category_level"><?php echo form_error('category_level'); ?></label>
                            </div> 
                            <div class="form-group form-float">
                                    <label class="form-label">Courses</label>
                                    <div class="form-line <?php if(form_error('level_id') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="level_id" id="level_id" value="0" >
                                        <select class="form-control show-tick" name="level_id" id="level_id">
                                            <option value="">Select Courses</option>
                                            <?php  
                                            if(!empty($course_master))
                                            {
                                                foreach ($course_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['level_id'];?>" <?php if(!empty($edit_college_data[0]->level_id)){ if($key['level_id']==$edit_college_data[0]->level_id){ echo "selected";}}else if(set_value('parent_id')==$key['level_id']){ echo "selected";}?> ><?php echo ucfirst($key['level_name']);?></option>
                                                <?php 
                                                } 
                                            }?>
                                        </select>                                   
                                    </div>
                                    <label id="category_level-error" class="error" for="category_level"><?php echo form_error('category_level'); ?></label>
                            </div>  
*/?>

                            <!-- <div class="form-group form-float">
                                <label class="form-label">Country</label>
                                <select name="country_id" id="country_id" required="">
                                  <option style="color: purple" value="">Select Country</option>
                                    <?php  
                                        if(!empty($country_master))
                                        {
                                            foreach ($country_master as $key ) 
                                            {?>
                                            <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_college_data[0]->country_id)){ if($key['id']==$edit_college_data[0]->country_id){ echo "selected";}}else if(set_value('parent_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
                                            <?php 
                                            } 
                                    }?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">State</label>
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">Select State</option>
                                </select>
                            </div>  --> 
                             <div class="form-group form-float">
                                <label class="form-label">Select Country</label>
                                <div class="form-line <?php if(form_error('country') != false) { echo 'error focused'; }?>">
                                    <select class="form-control show-tick" name="country_id" id="country_id" onchange="get_state_data(this.value);">
                                        <option style="color: purple" value="">Select Country </option>
                                        <?php 
                                        if(!empty($country_master))
                                        {
                                            foreach ($country_master as $key ) 
                                            {?>
                                            <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_college_data[0]->country_id)){ if($key['id']==$edit_college_data[0]->country_id){ echo "selected";}}else if(set_value('country_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
                                            <?php 
                                            } 
                                        }?>
                                    </select>                                 
                                </div>
                                 <label id="country-error" class="error" for="country"><?php echo form_error('country'); ?></label>
                            </div>
                            <?php 
                            if(!empty($edit_college_data[0]->state_id))
                            {
                                $where=array("country_id"=>$edit_college_data[0]->country_id);
                                $state_master = $this->common_model->getAlldata('states',$where); 
                                ?>
                                <div class="form-group form-float" id="get_state_section">
                                    <label class="form-label">Select State</label>
                                    <div class="form-line <?php if(form_error('state') != false) { echo 'error focused'; }?>" >
                                        <select class="form-control show-tick" name="state_id" id="state_id" >
                                            <option style="color: purple" value="">Select State </option>
                                            <?php 
                                            if(!empty($state_master))
                                            {
                                                foreach ($state_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_college_data[0]->state_id)){ if($key['id']==$edit_college_data[0]->state_id){ echo "selected";}}else if(set_value('state_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
                                                <?php 
                                                } 
                                            }?>  
                                        </select>
                                    </div>
                                    <label id="state-error" class="error" for="state"><?php echo form_error('state'); ?></label>
                                </div>
                                <?php
                            }
                            else
                            {?>
                                <div class="form-group form-float" id="get_state_section">
                                    <label class="form-label">Select State</label>
                                    <div class="form-line <?php if(form_error('state') != false) { echo 'error focused'; }?>" >
                                        <select class="form-control show-tick" name="state_id" id="state_id" >
                                            <option style="color: purple" value="">Select State </option>
                                            <?php 
                                            if(!empty($state_master))
                                            {
                                                foreach ($state_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_college_data[0]->state_id)){ if($key['id']==$edit_college_data[0]->state_id){ echo "selected";}}else if(set_value('state_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
                                                <?php 
                                                } 
                                            }?>  
                                        </select>
                                    </div>
                                    <label id="state-error" class="error" for="state"><?php echo form_error('state'); ?></label>
                                </div>
                            <?php
                            }
                            ?>             
                            <div class="form-group form-float">
                                <label class="form-label">City</label>
                                    <div class="form-line <?php if(form_error('city_name') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="city_name" id="city_name" class="form-control" value="<?php if(!empty($edit_college_data[0]->city_name)){ echo $edit_college_data[0]->city_name;}?>">
                                    <input type="text" name="city_name" id="city_name" class="form-control" value="<?php if(!empty($edit_college_data[0]->city_name)){ echo $edit_college_data[0]->city_name;}else { echo set_value('city_name'); }?>">                                   
                                    </div>
                            <label id="city_name-error" class="error" for="city_name"><?php echo form_error('city_name'); ?></label>
                            </div> 
                        


                            <div class="form-group form-float">
                                <label class="form-label">Image</label>
                                    <div class="form-line <?php if(form_error('image') != false) { echo 'error focused'; }?>">
                                        <input type="file" name="image" id="image" class="form-control">                                   
                                    </div>
                                    <label id="image-error" class="error" for="image"><?php echo form_error('image'); ?></label>
                            </div>    

                            <div class="form-group form-float">
                                <label class="form-label">Amount</label>
                                    <div class="form-line <?php if(form_error('college_amount') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="city_name" id="college_amount" class="form-control" value="<?php if(!empty($edit_college_data[0]->college_amount)){ echo $edit_college_data[0]->college_amount;}?>">
                                    <input type="text" name="college_amount" id="college_amount" class="form-control" value="<?php if(!empty($edit_college_data[0]->city_name)){ echo $edit_college_data[0]->college_amount;}else { echo set_value('college_amount'); }?>">                                   
                                    </div>
                            <label id="city_name-error" class="error" for="college_amount"><?php echo form_error('college_amount'); ?></label>
                            </div> 
   
                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_college_data[0]->college_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Update College</button>
                                <?php
                                }
                                else
                                {
                                ?>
                                <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Save College</button>
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
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    --> 
<script type="text/javascript">
    function get_state_data(country_id)
    {

        //alert(country_id);
        $.ajax
            ({
                type: "post",
                url: "<?php echo base_url('College/get_state_data');?>",
                data: {'country_id':country_id,'field_name':'state_id'},
                success: function(responseData) 
                {
                    $("#get_state_section").html(responseData);
                }
            });
    }
</script>    
<script type="text/javascript">

// $('#country_id').on('change', function() {
//   country_id = this.value;
//   $.ajax({
//     type:"POST",
//     url:"<?php echo base_url();?>College/getstate",
//     //dataType:'json',
//     data:{country_id: country_id},
//     success: function(res) {
//         result = JSON.parse(res);
//         var option = '<option value=""></option>';
//        for(i=0;i<result.length;i++){
//            option += '<option value="'+result[i].id+'">'+result[i].name+'</option>';
//        }
//        $('#state_id').html('');
//        $('#state_id').html(option);
//        console.log(option);

//     }
//   });
// });
</script>
