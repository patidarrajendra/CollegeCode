<div class="col-lg-10 col-md-10 col-sm-6 col-xs-12" id="image_input_section_<?php echo $id_no;?>">
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
        <div class="form-line ">
            <input type="file" class="form-control" name="product_image[]" id="product_image_<?php echo $id_no;?>" accept="image/*" onchange="change_image_show('<?php echo $id_no;?>')">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <img src="<?php echo base_url();?>/uploads/no_abilable.jpg" height="70" width="70" id="image_show_0">
    </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" id="image_remove_section_<?php echo $id_no;?>">
    <a href="javascript:void(0)" onclick="get_remove_images('<?php echo $id_no;?>')" >
        <button class="btn btn-danger waves-effect button_postion" type="button">Remove</button>
    </a>
</div>