<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 
              
                if(!empty($edit_category_data))
                {?>
                   <h1> <b>Modify Course Category</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Course Category</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>category/category_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Category List</button></a>
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
                        <form id="form_advanced_validation" method="POST" action="<?php echo base_url() ?>category/add_category" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">Course Category</label>
                                <div class="form-line <?php if(form_error('category_name') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" class="form-control" name="category_id" id="category_id" value="<?php if(!empty($edit_category_data[0]->category_id)){ echo $edit_category_data[0]->category_id;}?>">
                                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?php if(!empty($edit_category_data[0]->category_name)){ echo $edit_category_data[0]->category_name;}else { echo set_value('category_name'); }?>">
                                </div>
                                <label id="category_name-error" class="error" for="category_name"><?php echo form_error('category_name'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                    <label class="form-label">Icon</label>
                                    <div class="form-line <?php if(form_error('category_icon') != false) { echo 'error focused'; }?>">
                                        <input type="hidden" name="category_icon" id="category_icon" value="0" >
                                        <select class="form-control show-tick" name="category_icon" id="category_icon">
                                            <option value=""> Select Category Icon</option>
                                            <option value="fa fa-book"> Book Icon</option>
                                            <option value="fa fa-graduation-cap"> Graducation Cap Icon</option>
                                            <option value="fa fa-laptop">Laptop Icon</option>
                                            <option value="fa fa-user"> User Icon</option>
                                            <option value="fa fa-user-md"> Medical Icon</option>
                                            <option value="fa fa-flask">Lab Flask Icon</option>
                                            <option value="fa fa-deviantart"> Art Design Icon</option>
                                            <option value="fa fa-viacoin">Cryptocurrency Coin</option>
                                            <option value="fa fa-gavel">Gavel Icon </option>
                                            <option value="fa fa-certificate"> Certificate Icon</option>
                                        </select>                                   
                                    </div>
                                    <label id="category_icon-error" class="error" for="category_icon"><?php echo form_error('category_icon'); ?></label>
                            </div>
							<?php /* ?>
                            <div class="form-group form-float">
                                <label class="form-label">Select Parent Category</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" name="parent_id" id="parent_id" >
                                        <option style="color: purple" value="">Select Category </option>
                                        <?php 
                                        if(!empty($category_master_data))
                                        {
                                            foreach ($category_master_data as $key ) 
                                            {?>
                                            <option value="<?php echo $key['category_id'];?>" <?php if(!empty($edit_category_data[0]->category_id)){ if($key['category_id']==$edit_category_data[0]->category_id){ echo "selected";}}else if(set_value('parent_id')==$key['category_id']){ echo "selected";}?> ><?php echo ucfirst($key['category_name']);?></option>
                                            <?php 
                                            } 
                                        }?>
                                    </select>                                 
                                </div>
                            </div>
							
                            <div class="form-group form-float">
                                <label class="form-label">Category Image</label>
                                <div class="form-line <?php if(form_error('category_image') != false) { echo 'error focused'; }?>">
                                    <input type="file" class="form-control" name="category_image" id="category_image" accept="image/*" >
                                    <div class="help-info">Image only</div>
                                    <label id="category_image-error" class="error" for="category_image"><?php echo form_error('category_image'); ?></label>
                                </div>
                                <?php
                                if(!empty($edit_category_data[0]->category_image))
                                { 
                                    ?>
                                    <img src="<?php echo base_url().'uploads/category_images/'.$edit_category_data[0]->category_image; ?>" width="50" height="50" id="image_id_show">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo base_url().'uploads/no_abilable.jpg'; ?>" width="50" height="50" id="image_id_show">
                                    <?php
                                }
                                ?>
                            </div>
                            <?php */ ?>
                            <?php 
                            if(!empty($edit_category_data))
                            {?>
                               <button class="btn btn-primary waves-effect" type="submit" name="save_category" >Update Category</button>
                            <?php
                            }
                            else
                            {
                                ?>
                               <button class="btn btn-primary waves-effect" type="submit" name="save_category">Save Category</button>
                                <?php
                            }
                            ?>
                            
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- #END# Advanced Validation -->
    </div>
</section>
<?php include("include/footer.php");?>
<script>
    function readURL(input) 
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_id_show').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#category_image").change(function(){
        readURL(this);
    });
    </script>