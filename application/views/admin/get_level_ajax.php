 

<label class="form-label">Select Level</label>
   <div class="form-line <?php if(form_error('state_id') != false) { echo 'error focused'; }?>" >
        <select class="form-control show-tick" name="<?php echo $name_select_box;?>" onchange="get_stream(this.value,'stream_id')" id="<?php echo $name_select_box;?>" >
            <option style="color: purple" value="">Select Level </option>
            <?php 
            //print_r($state_master); 
            if(!empty($level_master))
            {
                foreach ($level_master as $key ) 
                {?>
                <option value="<?php echo $key['level_id'];?>" <?php if(!empty($edit_publish_data[0]->level_id)){ if($key['level_id']==$edit_publish_data[0]->level_id){ echo "selected";}}else if(set_value('level_id')==$key['level_id']){ echo "selected";}?> ><?php echo ucfirst($key['level_name']);?></option>
                <?php 
                } 
            }?>  
        </select>
    </div>
<label id="level_id-error" class="error" for="level_id"><?php echo form_error('level_id'); ?></label> 
 