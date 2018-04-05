<label class="form-label">Stream</label>
<div class="form-line <?php if(form_error('stream_id') != false) { echo 'error focused'; }?>">
    <input type="hidden" name="stream_id" id="stream_id" value="0" >
    <select class="form-control show-tick" name="stream_id" id="stream_id">
        <option value="">Select Stream</option>
        <?php  
        if(!empty($stream_master))
        {
            foreach ($stream_master as $key ) 
            {?>
              <option value="<?php echo $key['stream_id'];?>" <?php if(!empty($edit_publish_data[0]->stream_id)){ if($key['stream_id']==$edit_publish_data[0]->stream_id){ echo "selected";}}else if(set_value('stream_id')==$key['stream_id']){ echo "selected";}?> ><?php echo ucfirst($key['stream_name']);?></option>
            <?php 
            } 
        }?>
    </select>                                   
</div>
<label id="stream_level-error" class="error" for="stream_level"><?php echo form_error('stream_level'); ?></label>
 