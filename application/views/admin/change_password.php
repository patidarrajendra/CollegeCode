<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1> <b>Change Password</b> </h1>
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
                        <form id="form_changepassword" name="form_discount" action="<?php echo base_url();?>users/change_password" method="post">
          
                            <div class="form-group form-float">
                                <label class="form-label">Old Password</label>
                                <div class="form-line <?php if(form_error('oldpassword') != false) { echo 'error focused'; }?>">
                                    <input type="hidden" name="id" id="id" class="form-control" value="<?php  echo '1'; //echo $this->session->userdata('id');?>">
                                    <input type="text" name="oldpassword" id="oldpassword" class="form-control" value="">                                 
                                </div>
                                <label id="date-error" class="error" for="oldpassword"><?php echo form_error('oldpassword'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <label class="form-label">New Password</label>
                                <div class="form-line <?php if(form_error('password') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="password" id="password" class="form-control" value="">                                 
                                </div>
                                <label id="date-error" class="error" for="password"><?php echo form_error('password'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <label class="form-label">Confirm Password</label>
                                <div class="form-line <?php if(form_error('user_confirmpassword') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="user_confirmpassword" id="user_confirmpassword" class="form-control" value="">                                 
                                </div>
                                <label id="date-error" class="error" for="user_confirmpassword"><?php echo form_error('user_confirmpassword'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("include/footer.php");?>
