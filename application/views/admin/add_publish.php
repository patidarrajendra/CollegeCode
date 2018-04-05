
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 

                //print_r($category_master); die;
                if(!empty($edit_publish_data[0]->course_id))
                {?>
                   <h1> <b>Modify Coorse</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Publish College</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>Publish/publish_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Publish List</button></a>
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
                        <form id="form_course" name="form_course" action="<?php echo base_url();?>Publish/add_publish" method="post" onsubmit="return check_validation();" enctype="multipart/form-data">
                        <!--
                            <div class="form-group form-float">
                                <label class="form-label">Course Name</label>
                                <div class="form-line < ?php if(form_error('course_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="course_id" id="course_id" class="form-control" value="< ?php if(!empty($edit_publish_data[0]->course_id)){ echo $edit_publish_data[0]->course_id;}?>">
                                    <input type="text" name="course_name" id="course_name" class="form-control" value="< ?php if(!empty($edit_publish_data[0]->course_name)){ echo $edit_publish_data[0]->course_name;}else { echo set_value('course_name'); }?>">                                 
                                </div>
                                <label id="course_name-error" class="error" for="course_name">< ?php echo form_error('course_name'); ?></label>
                            </div>
                        -->

                            <div class="form-group form-float">
                                    <label class="form-label">Category </label>
                                    <div class="form-line <?php if(form_error('category_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="publish_id" id="publish_id" class="form-control" value="<?php if(!empty($edit_level_data[0]->publish_id)){ echo $edit_level_data[0]->publish_id;}?>">
                                        <input type="hidden" name="category_id" id="category_id" value="0" >
                                        <select class="form-control show-tick" onchange="get_levels(this.value,'level_id')" name="category_id" id="category_level">
                                            <option value="">Select Category</option>
                                            <?php  
                                            if(!empty($category_master))
                                            {
                                                foreach ($category_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_publish_data[0]->category_id)){ if($key['category_id']==$edit_publish_data[0]->category_id){ echo "selected";}}else if(set_value('parent_id')==$key['category_id']){ echo "selected";}?> ><?php echo ucfirst($key['category_name']);?></option>
                                                <?php 
                                                } 
                                            }?>
                                        </select>                                   
                                    </div>
                                    <label id="category_level-error" class="error" for="category_level"><?php echo form_error('category_level'); ?></label>
                            </div> 
                            <div class="form-group form-float" id="level_list">
                                    <label class="form-label">Level </label>
                                    <div class="form-line <?php if(form_error('category_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="level_id" id="level_id" value="0" >
                                        <select class="form-control show-tick" name="level_id" >
                                            <option value="">Select Level</option>
                                            <?php /*  
                                            if(!empty($level_master))
                                            {
                                                foreach ($level_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_publish_data[0]->category_id)){ if($key['level_id']==$edit_publish_data[0]->level_id){ echo "selected";}}else if(set_value('parent_id')==$key['level_id']){ echo "selected";}?> ><?php echo ucfirst($key['level_name']);?></option>
                                                <?php 
                                                } 
                                            }  */?>
                                        </select>                                   
                                    </div>
                                    <label id="category_level-error" class="error" for="category_level"><?php echo form_error('category_level'); ?></label>
                            </div>    
                             <!--  
                            <div class="form-group form-float">
                                <label class="form-label">Course Description</label>
                                <div class="form-line < ?php if(form_error('course_description') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="course_description" id="course_description" class="form-control" value="< ?php if(!empty($edit_publish_data[0]->course_description)){ echo $edit_publish_data[0]->course_description;}?>">
                                    <input type="text" name="course_description" id="course_description" class="form-control" value="< ?php if(!empty($edit_publish_data[0]->course_description)){ echo $edit_publish_data[0]->course_description;}else { echo set_value('course_description'); }?>">                                 
                                </div>
                                <label id="course_description-error" class="error" for="course_description">< ?php echo form_error('course_description'); ?></label>
                            </div>
                             -->
                            
                            <div class="form-group form-float" id="stream_list">
                                    <label class="form-label">Stream</label>
                                    <div class="form-line <?php if(form_error('stream_id') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="stream_id" id="stream_id" value="0" >
                                        <select class="form-control show-tick" name="stream_id" id="stream_id">
                                            <option value="">Select Stream</option>
                                            <?php /* 
                                            if(!empty($stream_master))
                                            {
                                                foreach ($stream_master as $key ) 
                                                {?>
                                                  <option value="<?php echo $key['stream_id'];?>" <?php if(!empty($edit_publish_data[0]->stream_id)){ if($key['stream_id']==$edit_publish_data[0]->stream_id){ echo "selected";}}else if(set_value('stream_id')==$key['stream_id']){ echo "selected";}?> ><?php echo ucfirst($key['stream_name']);?></option>
                                                <?php 
                                                } 
                                            }*/?>
                                        </select>                                   
                                    </div>
                                    <label id="stream_level-error" class="error" for="stream_level"><?php echo form_error('stream_level'); ?></label>
                            </div>                               
                             
                             <div class="form-group form-float">
                                <label class="form-label">Select College</label>
                                <div class="form-line <?php if(form_error('college') != false) { echo 'error focused'; }?>">
                                    <select class="form-control show-tick" name="college_id" id="college_id" >
                                        <option style="color: purple" value="">College </option>
                                        <?php 
                                        if(!empty($college_master))
                                        {
                                            foreach ($college_master as $key ) 
                                            {?>
                                            <option value="<?php echo $key['college_id'];?>" <?php if(!empty($edit_publish_data[0]->college_id)){ if($key['college_id']==$edit_publish_data[0]->college_id){ echo "selected";}}else if(set_value('college_id')==$key['college_id']){ echo "selected";}?> ><?php echo ucfirst($key['college_name']).'---'. ucfirst($key['college_description']);?></option>
                                            <?php 
                                            } 
                                        }  ?>
                                    </select>                                 
                                </div>
                                 <label id="college-error" class="error" for="college"><?php echo form_error('college'); ?></label>
                            </div>
                            <?php /*

                            if(!empty($edit_publish_data[0]->state_id))
                            {
                                $where=array("country_id"=>$edit_publish_data[0]->country_id);
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
                                                <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_publish_data[0]->state_id)){ if($key['id']==$edit_publish_data[0]->state_id){ echo "selected";}}else if(set_value('state_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
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
                                                <option value="<?php echo $key['id'];?>" <?php if(!empty($edit_publish_data[0]->state_id)){ if($key['id']==$edit_publish_data[0]->state_id){ echo "selected";}}else if(set_value('state_id')==$key['id']){ echo "selected";}?> ><?php echo ucfirst($key['name']);?></option>
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
                                        <input type="hidden" name="city_name" id="city_name" class="form-control" value="<?php if(!empty($edit_publish_data[0]->city_name)){ echo $edit_publish_data[0]->city_name;}?>">
                                    <input type="text" name="city_name" id="city_name" class="form-control" value="<?php if(!empty($edit_publish_data[0]->city_name)){ echo $edit_publish_data[0]->city_name;}else { echo set_value('city_name'); }?>">                                   
                                    </div>
                            <label id="city_name-error" class="error" for="city_name"><?php echo form_error('city_name'); ?></label>
                            </div> 
                            <div class="form-group form-float">
                                    <label class="form-label">Icon</label>
                                    <div class="form-line <?php if(form_error('course_icon') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="course_icon" id="course_icon" value="0" >
                                        <select class="form-control show-tick" name="course_icon" id="course_icon">
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
                                        </select>                                   
                                    </div>
                                    <label id="level_icon-error" class="error" for="course_icon"><?php echo form_error('course_icon'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Image</label>
                                    <div class="form-line <?php if(form_error('image') != false) { echo 'error focused'; }?>">
                                        <input type="file" name="image" id="image" class="form-control">                                   
                                    </div>
                                    <label id="image-error" class="error" for="image"><?php echo form_error('image'); ?></label>
                            </div>    

                           

                            <div class="form-group form-float">
                                <label class="form-line"> Course Amount </label>
                                    <div class="form-line <?php if(form_error('course_amount') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="course_amount" id="course_amount" class="form-control" value="<?php if(!empty($edit_publish_data[0]->course_amount)){ echo $edit_publish_data[0]->course_amount;}?>">
                                    <input type="text" name="course_amount" id="course_amount" class="form-control" value="<?php if(!empty($edit_publish_data[0]->course_amount)){ echo $edit_publish_data[0]->course_amount;}else { echo set_value('course_amount'); }?>">                                   
                                    </div>
                                    <label id="course_amount-error" name="course_amount" id="course_amount" class="form-control"></label>
                            </div> 
                            */?>   
                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_publish_data[0]->college_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="publish_college" id="publish_college">Update </button>
                                <?php
                                }
                                else
                                {
                                ?>
                                <button class="btn btn-primary waves-effect" type="submit" name="publish_college" id="publish_college">Publish College</button>
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
        $.ajax
            ({
                type: "post",
                url: "<?php echo base_url('Course/get_state_data');?>",
                data: {'country_id':country_id,'field_name':'state_id'},
                success: function(responseData) 
                {
                    $("#get_state_section").html(responseData);
                }
            });
    }
</script>    
<script type="text/javascript">

 function get_levels(category_id,name)
    {
                $.ajax
                ({
                        type: "post",
                        url: "<?php echo base_url('publish/get_level_list');?>",
                        data: {'category_id':category_id,field_name:name},
                        success: function(responseData) 
                        {
                            $("#level_list").html(responseData);
                        }   
                });
             
    }
 
  function get_stream(level_id,name)
  {
              $.ajax
                ({
                        type: "post",
                        url: "<?php echo base_url('publish/get_stream_list');?>",
                        data: {'level_id':level_id,field_name:name},
                        success: function(responseData) 
                        {
                            $("#stream_list").html(responseData);
                        }
                });
  } 
  

   
</script>
