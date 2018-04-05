<label class="form-label">Select State</label>
   <div class="form-line <?php if(form_error('state_id') != false) { echo 'error focused'; }?>" >
        <select class="form-control show-tick" name="<?php echo $name_select_box;?>" id="<?php echo $name_select_box;?>" >
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
<label id="state_id-error" class="error" for="state_id"><?php echo form_error('state_id'); ?></label> 