<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 

                //print_r($category_master); die;
                if(!empty($edit_stream_data[0]->stream_id))
                {?>
                   <h1> <b>Modify Stream</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Stream</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>stream/stream_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Stream List</button></a>
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
                        <form id="form_college" name="form_college" action="<?php echo base_url();?>stream/add_stream" method="post" onsubmit="return check_validation();" enctype="multipart/form-data">
                           <div class="form-group form-float">
                                    <label class="form-label">Category</label>
                                    <div class="form-line <?php if(form_error('college_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="level_id" id="level_id" value="0" >
                                        <select class="form-control show-tick" onchange="get_levels(this.value,'level_id')" name="level_id" id="college_level">
                                            <option value="">Select Category</option>
                                            <?php  
                                            if(!empty($category_master))
                                            {
                                                foreach ($category_master as $key ) 
                                                {?>
                                                <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_stream_data[0]->category_id)){ if($key['category_id_id']==$edit_stream_data[0]->level_id    ){ echo "selected";}}else if(set_value('category_id')==$key['category_id']){ echo "selected";}?>>
                                                    <?php echo ucfirst($key['category_name']);?>
                                                  
                                                </option>
                                                <?php 
                                                } 
                                            }?>
                                        </select>                                   
                                    </div>
                                    <label id="college_level-error" class="error" for="college_level"><?php echo form_error('college_level'); ?></label>
                            </div>
                            <div class="form-group form-float" id="level_list">
                                    <label class="form-label">College level</label>
                                    <div class="form-line <?php if(form_error('college_level') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="level_id" id="level_id" value="0" >
                                        <select class="form-control show-tick" name="level_id" id="college_level">
                                            <option value="">Select Level</option>
                                     
                                        </select>                                   
                                    </div>
                                    <label id="college_level-error" class="error" for="college_level"><?php echo form_error('college_level'); ?></label>
                            </div>  
                            <div class="form-group form-float">
                                <label class="form-label">Stream Name</label>
                                <div class="form-line <?php if(form_error('stream_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="stream_id" id="stream_id" class="form-control" value="<?php if(!empty($edit_stream_data[0]->stream_id)){ echo $edit_stream_data[0]->stream_id;}?>">
                                    <input type="text" name="stream_name" id="stream_name" class="form-control" value="<?php if(!empty($edit_stream_data[0]->stream_name)){ echo $edit_stream_data[0]->stream_name;}else { echo set_value('stream_name'); }?>">                                 
                                </div>
                                <label id="stream_name-error" class="error" for="stream_name"><?php echo form_error('stream_name'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_stream_data[0]->stream_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Update Stream</button>
                                <?php
                                }
                                else
                                {
                                ?>
                                <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Save Stream</button>
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
</script>
