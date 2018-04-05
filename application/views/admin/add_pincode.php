<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 
                if(!empty($edit_pincode_data[0]->pin_id))
                {?>
                   <h1> <b>Modify Pincode</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Pincode</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>/pincode/pincode_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Pincode List</button></a>
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
                        <form id="form_pincode" name="form_pincode" action="<?php echo base_url();?>pincode/add_pincode" method="post" enctype="multipart/form-data" >
                            <div class="form-group form-float">
                                <label class="form-label">Pincode Number</label>
                                <div class="form-line <?php if(form_error('pin_code') != false) { echo 'error focused'; }?>">
                                    
                                    <input type="hidden" name="pin_id" id="pin_id" class="form-control" value="<?php if(!empty($edit_pincode_data[0]->pin_id)){ echo $edit_pincode_data[0]->pin_id;}?>">
                                    <input type="text" name="pin_code" id="pin_code" class="form-control" value="<?php if(!empty($edit_pincode_data[0]->pin_code)){ echo $edit_pincode_data[0]->pin_code;}else { echo set_value('pin_code'); }?>">
                                </div>
                                <label id="pin_code-error" class="error" for="pin_code"><?php echo form_error('pin_code'); ?></label>
                            </div>
                            
                            
                            <div class="form-group form-float">
                                <label class="form-label">Pincode Delevery Charage</label>
                                <div class="form-line <?php if(form_error('pin_charge') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="pin_charge" id="pin_charge" class="form-control" value="<?php if(!empty($edit_pincode_data[0]->pin_charge)){ echo $edit_pincode_data[0]->pin_charge;}else { echo set_value('pin_charge'); }?>" >
                                </div>
                                <label id="pin_charge-error" class="error" for="pin_charge"><?php echo form_error('pin_charge'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_pincode_data[0]->pin_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_pincode" id="save_pincode">Update Pincode</button>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_pincode" id="save_pincode">Save Pincode</button>
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
    
</script>
