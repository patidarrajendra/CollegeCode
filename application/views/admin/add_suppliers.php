

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 
                if(!empty($edit_pincode_data[0]->pin_id))
                {?>
                   <h1> <b>Modify Suppliers</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Suppliers</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>/suppliers/suppliers_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Suppliers List</button></a>
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
                        <form id="form_supply" name="form_supply" action="<?php echo base_url();?>suppliers/add_suppliers" method="post">
          
                            <div class="form-group form-float">
                                <label class="form-label">First Name</label>
                                <div class="form-line <?php if(form_error('user_fname') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php if(!empty($edit_user_data[0]->user_id)){ echo $edit_user_data[0]->user_id;}?>">
                                    <input type="text" name="user_fname" id="user_fname" class="form-control" value="<?php if(!empty($edit_user_data[0]->user_fname)){ echo $edit_user_data[0]->user_fname;}else { echo set_value('user_fname'); }?>">                                 
                                </div>
                                <label id="date-error" class="error" for="offer_name"><?php echo form_error('user_fname'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <label class="form-label">Last Name</label>
                                <div class="form-line <?php if(form_error('user_lname') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php if(!empty($edit_user_data[0]->user_lname)){ echo $edit_user_data[0]->user_lname;}else { echo set_value('user_lname'); }?>">                                 
                                </div>
                                <label id="date-error" class="error" for="user_lname"><?php echo form_error('user_lname'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <label class="form-label">Email</label>
                                <div class="form-line <?php if(form_error('user_email') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="user_email" id="user_email" class="form-control" value="<?php if(!empty($edit_user_data[0]->user_email)){ echo $edit_user_data[0]->user_email;}else { echo set_value('user_email'); }?>">                                 
                                </div>
                                <label id="date-error" class="error" for="user_email"><?php echo form_error('user_email'); ?></label>
                            </div>
                            
                            <div class="form-group form-float">
                                <label class="form-label">Mobile Number</label>
                                <div class="form-line <?php if(form_error('user_mobile') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="user_mobile" id="user_mobile" class="form-control" value="<?php if(!empty($edit_user_data[0]->user_mobile)){ echo $edit_user_data[0]->user_mobile;}else { echo set_value('user_mobile'); }?>">                                 
                                </div>
                                <label id="date-error" class="error" for="user_mobile"><?php echo form_error('user_mobile'); ?></label>
                            </div>

                            
                            <div class="form-group form-float">
                                <button class="btn btn-primary waves-effect" type="submit" name="save_supplier" id="save_supplier">Save Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("include/footer.php");?>
