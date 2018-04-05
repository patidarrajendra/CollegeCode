<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <?php 
                if(!empty($edit_product_data[0]->product_id))
                {?>
                   <h1> <b>Modify Product</b> </h1> 
                <?php
                }
                else
                {
                    ?>
                    <h1> <b>Add Product</b> </h1>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                <a href="<?php echo base_url();?>/product/product_list" ><button class="btn btn-primary waves-effect button_postion" type="button">Product List</button></a>
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
                        <form id="form_product" name="form_product" action="<?php echo base_url();?>product/add_product" method="post" enctype="multipart/form-data" onsubmit="return validate_error();">

                            <div class="form-group form-float">
                                <label class="form-label">Product Name</label>
                                <div class="form-line <?php if(form_error('product_name') != false) { echo 'error focused'; }?>">
                                    
                                    <input type="hidden" name="product_id" id="product_id" class="form-control" value="<?php if(!empty($edit_product_data[0]->product_id)){ echo $edit_product_data[0]->product_id;}?>">
                                    <input type="text" name="product_name" id="product_name" class="form-control" value="<?php if(!empty($edit_product_data[0]->product_name)){ echo $edit_product_data[0]->product_name;}else { echo set_value('product_name'); }?>">
                                </div>
                                <label id="product_name-error" class="error" for="product_name"><?php echo form_error('product_name'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                    <label class="form-label">Product Description</label>
                                    <div class="form-line <?php if(form_error('product_description') != false) { echo 'error focused'; }?>">
                                        <textarea name="product_description" id="product_description" cols="30" rows="5" class="form-control no-resize">
                                            <?php if(!empty($edit_product_data[0]->product_description)){ echo $edit_product_data[0]->product_description;}else { echo trim(set_value('product_description')); }?>
                                        </textarea>                     
                                    </div>
                                    <label id="product_description-error" class="error" for="product_description"><?php echo form_error('product_description'); ?></label>
                            </div>
                            <?php
                            if(!empty($edit_product_data))
                            {
                                $category_parent_id=array();
                                $cat_id=$edit_product_data[0]->category_id;
                                array_push($category_parent_id,$cat_id);
                                $where=array("category_id"=>$edit_product_data[0]->category_id);
                                $cate_result = $this->common_model->getAllwherenew_objet('category_master',$where);
                                $parent_id=$cate_result[0]->parent_id;
                                if($parent_id!=0)
                                {
                                    for($m=0;$m<100;$m++)
                                    {
                                        $where=array("category_id"=>$parent_id);
                                        $cate_result = $this->common_model->getAllwherenew_objet('category_master',$where);
                                        $parent_id=$cate_result[0]->parent_id;
                                        $cat_id=$cate_result[0]->category_id;
                                        if($parent_id!=0)
                                        {
                                            array_push($category_parent_id,$cat_id);
                                        }
                                        else
                                        {
                                            array_push($category_parent_id,$cat_id);
                                            break;
                                        }
                                    }
                                }
                                $category_parent_id=array_reverse($category_parent_id);
                                echo '<div  id="all_category_data"> ';
                                for($k=0;$k<count($category_parent_id);$k++)
                                {
                                    echo '<input type="hidden" name="level" id="level" value="'.$k.'">';
                                    if($k==0)
                                    {
                                        ?>
                                        <div class="form-group form-float">
                                            <label class="form-label">Product Category</label>
                                            <div class="form-line <?php if(form_error('category_level_0') != false) { echo 'error focused'; }?>">
                                               
                                                <select class="form-control show-tick" name="category_level_0" id="category_level_0" onchange="get_selected_data(this.value,'0')">
                                                    <option value="">Select Category</option>
                                                    <?php  
                                                    if(count($category_data)>0)
                                                    {
                                                        for($i=0;$i<count($category_data);$i++)
                                                        {?>
                                                            <option value="<?php echo $category_data[$i]['category_id'];?>" <?php if(!empty($edit_product_data[0]->category_id)){ if($category_data[$i]['category_id']==$category_parent_id[$k]){ echo "selected";}}else if(set_value('category_level_0')==$category_parent_id[$k]){ echo "selected";}?> ><?php echo ucfirst($category_data[$i]['category_name']);?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>                                   
                                            </div>
                                            <label id="category_level_0-error" class="error" for="category_level_0"><?php echo form_error('category_level_0'); ?></label>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        $l=$k-1;
                                        ?>
                                        <div id="category_level_div_<?php echo $k;?>">
                                            <div class="form-group form-float">
                                                <label class="form-label">Category Level-<?php echo $k;?> </label>
                                                <?php $cat_var ='category_level_'.$k;?>
                                                <div class="form-line <?php if(form_error($cat_var) != false) { echo 'error focused'; }?>">
                                                    <select class="form-control show-tick" name="category_level_<?php echo $k;?>" id="category_level_<?php echo $k;?>" onchange="get_selected_data(this.value,'<?php echo $k;?>')">
                                                        <option value="">Select Level-<?php echo $k;?></option>
                                                        <?php 
                                                        $where          = array('parent_id' =>$category_parent_id[$l]);
                                                        $result = $this->common_model->getAllwhere('category_master',$where);
                                                        if(!empty($result)>0)
                                                        {
                                                            
                                                            for($i=0;$i<count($result);$i++)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $result[$i]->category_id;?>" <?php if(!empty($edit_product_data[0]->category_id)){ if($result[$i]->category_id==$category_parent_id[$k]){ echo "selected";}else{echo "ok";}}else if(set_value($cat_var)==$category_parent_id[$k]){ echo "selected";}?> ><?php echo ucfirst($result[$i]->category_name);?></option>
                                                                
                                                            <?php
                                                           
                                                            }
                                                        }
                                                        ?>
                                                    </select>                                   
                                                </div>
                                                <label id="category_level_<?php echo $i;?>-error" class="error" for="category_level_<?php echo $i;?>"><?php echo form_error($cat_var); ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                echo '</div>';
                            }
                            else
                            {
                            ?>
                                <div  id="all_category_data">
                                    <div class="form-group form-float">
                                            <label class="form-label">Product Category</label>
                                            <div class="form-line <?php if(form_error('category_level_0') != false) { echo 'error focused'; }?>">
                                                <input type="hidden" name="level" id="level" value="0" >
                                                <select class="form-control show-tick" name="category_level_0" id="category_level_0" onchange="get_selected_data(this.value,'0')">
                                                    <option value="">Select Category</option>
                                                    <?php  
                                                    if(count($category_data)>0)
                                                    {
                                                        for($i=0;$i<count($category_data);$i++)
                                                        {?>
                                                            <option value="<?php echo $category_data[$i]['category_id'];?>" <?php if(!empty($edit_product_data[0]->category_id)){ if($edit_product_data[0]->category_id==$category_data[$i]['category_id']){ echo "selected";}}else if(set_value('category_level_0')==$category_data[$i]['category_id']){ echo "selected";}?> ><?php echo ucfirst($category_data[$i]['category_name']);?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>                                   
                                            </div>
                                            <label id="category_level_0-error" class="error" for="category_level_0"><?php echo form_error('category_level_0'); ?></label>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group form-float">
                                <label class="form-label">Product Price</label>
                                <div class="form-line <?php if(form_error('product_price') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="product_price" id="product_price" class="form-control" value="<?php if(!empty($edit_product_data[0]->product_price)){ echo $edit_product_data[0]->product_price;}else { echo set_value('product_price'); }?>" onchange="get_all_calclution()">
                                </div>
                                <label id="product_price-error" class="error" for="product_price"><?php echo form_error('product_price'); ?></label>
                            </div>

                            <div class="form-group form-float">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Discount</label>
                                    <div class="form-line <?php if(form_error('discount_id') != false) { echo 'error focused'; }?>">
                                        <select class="form-control show-tick" name="discount_id" id="discount_id" onchange="get_discount_value(this.value),get_all_calclution()">
                                            <option value="">Select Discount</option>
                                            <?php  
                                            if(count($discount_data)>0)
                                            {
                                                for($i=0;$i<count($discount_data);$i++)
                                                {?>
                                                    <option value="<?php echo $discount_data[$i]['discount_id'];?>" <?php if(!empty($edit_product_data[0]->category_id)){ if($edit_product_data[0]->discount_id==$discount_data[$i]['discount_id']){ echo "selected";}}else if(set_value('discount_id')==$discount_data[$i]['discount_id']){ echo "selected";}?> ><?php echo ucfirst($discount_data[$i]['discount_name']);?>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>                                   
                                    </div>
                                    <label id="discount_id-error" class="error" for="discount_id"><?php echo form_error('discount_id'); ?></label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Discount Amount</label>
                                    <div class="form-line <?php if(form_error('discount_amount') != false) { echo 'error focused'; }?>">
                                        <input type="text" name="discount_amount" id="discount_amount" class="form-control" value="<?php if(!empty($edit_product_data[0]->discount_amount)){ echo $edit_product_data[0]->discount_amount;}else { echo set_value('discount_amount'); }?>" readonly>                      
                                    </div>
                                    <label id="discount_amount-error" class="error" for="discount_amount"><?php echo form_error('discount_amount'); ?></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Offer</label>
                                    <div class="form-line <?php if(form_error('offer_id') != false) { echo 'error focused'; }?>">
                                        <select class="form-control show-tick" name="offer_id" id="offer_id" onchange="get_offer_value(this.value),get_all_calclution()">
                                            <option value="">Select Offer</option>
                                            <?php  
                                            if(count($offer_data)>0)
                                            {
                                                for($i=0;$i<count($offer_data);$i++)
                                                {?>
                                                    <option value="<?php echo $offer_data[$i]['offer_id'];?>" <?php if(!empty($edit_product_data[0]->offer_id)){ if($edit_product_data[0]->offer_id==$offer_data[$i]['offer_id']){ echo "selected";}}else if(set_value('offer_id')==$offer_data[$i]['offer_id']){ echo "selected";}?> ><?php echo ucfirst($offer_data[$i]['offer_name']);?>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>                                   
                                    </div>
                                    <label id="offer_id-error" class="error" for="offer_id"><?php echo form_error('offer_id'); ?></label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Offer Amount</label>
                                    <div class="form-line <?php if(form_error('offer_amount') != false) { echo 'error focused'; }?>">
                                       <input type="text" name="offer_amount" id="offer_amount" class="form-control" value="<?php if(!empty($edit_product_data[0]->offer_amount)){ echo $edit_product_data[0]->offer_amount;}else { echo set_value('offer_amount'); }?>" readonly>
                                    </div>
                                    <label id="offer_amount-error" class="error" for="offer_amount"><?php echo form_error('offer_amount'); ?></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Tax(In Percentage)</label>
                                    <div class="form-line <?php if(form_error('tax_id') != false) { echo 'error focused'; }?>">
                                        <input type="text" name="tax_id" id="tax_id" class="form-control" value="<?php if(!empty($edit_product_data[0]->tax_id)){ echo $edit_product_data[0]->tax_id;}else { echo set_value('tax_id'); }?>" onkeyup="get_tax_value(this.value),get_all_calclution()">                              
                                    </div>
                                    <label id="tax_id-error" class="error" for="tax_id"><?php echo form_error('tax_id'); ?></label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label class="form-label">Product Tax Amount</label>
                                    <div class="form-line <?php if(form_error('tax_amount') != false) { echo 'error focused'; }?>">
                                       <input type="text" name="tax_amount" id="tax_amount" class="form-control" value="<?php if(!empty($edit_product_data[0]->tax_amount)){ echo $edit_product_data[0]->tax_amount;}else { echo set_value('tax_amount'); }?>" readonly>
                                    </div>
                                    <label id="tax_amount-error" class="error" for="tax_amount"><?php echo form_error('tax_amount'); ?></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Product Sale Price</label>
                                <div class="form-line <?php if(form_error('sale_price') != false) { echo 'error focused'; }?>">
                                    <input type="text" name="sale_price" id="sale_price" class="form-control" value="<?php if(!empty($edit_product_data[0]->sale_price)){ echo $edit_product_data[0]->sale_price;}else { echo set_value('sale_price'); }?>" readonly>
                                </div>
                                <label id="sale_price-error" class="error" for="sale_price"><?php echo form_error('sale_price'); ?></label>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Product Images</label>
                                    <div class="form-line <?php if(form_error('product_image') != false) { echo 'error focused'; }?>">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image" accept="image/*" multiple="multiple">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php 
                                        if(!empty($edit_product_data[0]->product_id))
                                        {
                                            $product_id=$edit_product_data[0]->product_id;
                                            $select="all";
                                            $where=array("product_id"=>$product_id);
                                            $edit_image_data= $this->common_model->getAllwherenew_objet('product_images',$where,$select);
                                            $i=0;
                                            if($edit_image_data!='no')
                                            {
                                                foreach($edit_image_data as $image_data)
                                                {

                                                  ?>
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" id="image_display_section_<?php echo $edit_image_data[$i]->product_image_id;;?>">
                                                        <?php
                                                        if($edit_image_data[$i]->image_path!='')
                                                        {
                                                            ?>
                                                            <img src="<?php echo base_url().$edit_image_data[$i]->image_path;?>" height="100" width="200">
                                                            <a href="javascript:void(0)" onclick="get_remove_image('<?php echo $product_id;?>','<?php echo $edit_image_data[$i]->product_image_id;;?>')">Remove Image</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                  <?php 
                                                  $i++; 
                                                }
                                            }
                                        }                                    
                                        ?>
                                    </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group form-float">
                                <?php 
                                if(!empty($edit_product_data[0]->product_id))
                                {?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Update Product</button>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="save_category" id="save_category">Save Product</button>
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
    var global_level_array=[];
    function get_discount_value(discount_id)
    {
            var price=$("#product_price").val();
            if(price=='' || price==0)
            {
                alert("please enter product price first");
                $("#discount_id").val("");
                return;
            }
            else
            {
                $.ajax
                ({
                        type: "post",
                        url: "<?php echo base_url('product/get_discount_value');?>",
                        data: {'discount_id':discount_id,'price':price},
                        success: function(responseData) 
                        {
                            $("#discount_amount").val(responseData);
                            return responseData;
                        }
                });
            }
    }
    function get_offer_value(offer_id)
    {
            var price=$("#product_price").val();
            if(price=='' || price==0)
            {
                alert("please enter product price first");
                $("#offer_id").val("");
                return;
            }
            else
            {
                $.ajax
                ({
                        type: "post",
                        url: "<?php echo base_url('product/get_offer_value');?>",
                        data: {'offer_id':offer_id,'price':price},
                        success: function(responseData) 
                        {
                            $("#offer_amount").val(responseData);
                            return responseData;
                        }
                });
            }
    }
    function get_tax_value(tax_id)
    {
            var price=$("#product_price").val();
            if(price=='' || price==0)
            {
                alert("please enter product price first");
                $("#tax_id").val("");
                return;
            }
            else
            {
                var amount=((parseFloat(tax_id)*parseFloat(price))/100);
                $("#tax_amount").val(amount);
                return amount;
            }
    }
    function get_all_calclution()
    {
            var price=$("#product_price").val();
            if(price=='' || price==0)
            {
                alert("please enter product price first");
            }
            else
            {
                var offer_id=$("#offer_id").val();
                if(offer_id=='')
                {
                    var offer_amount=0.00;
                }
                else
                {
                    var offer_amount=get_offer_value(offer_id);
                }
                $("#offer_amount").val(offer_amount);

                var discount_id=$("#discount_id").val();
                if(discount_id=='')
                {
                    var discount_amount=0.00;
                }
                else
                {
                    var discount_amount=get_discount_value(discount_id);
                }
                $("#discount_amount").val(offer_amount);

                var tax_assign=$("#tax_id").val();
                if(tax_assign=='' || tax_assign==0)
                {
                    tax_amount=0.00;
                }
                else
                {
                    var tax_amount= get_tax_value(tax_assign);
                }
                $("#tax_amount").val(tax_amount);
                var sale_price=parseFloat(price)+parseFloat(tax_amount)-parseFloat(discount_amount)-parseFloat(offer_amount);
                $("#sale_price").val(parseFloat(sale_price));
            }
    }
    
    function get_selected_data(selected_value,level)
    {

                    var total_level=$("#level").val();
                    $.ajax
                        ({
                            type: "post",
                            url: "<?php echo base_url('discount/product_sub_type');?>",
                            data: {'selected_value':selected_value,'level':level},
                            success: function(responseData) 
                            {
                               

                                if(responseData.trim()=='blank')
                                {
                                    return
                                }
                                else
                                {
                                    if(responseData.trim()=='<div class="form-group form-float"></div>')
                                    {
                                        var updated_level=total_level;
                                        level=parseInt(level)+1;
                                        for(var i=level;i<=total_level;i++)
                                        {
                                            updated_level=parseInt(updated_level)-1;
                                            var str="category_level_div_"+i;
                                            $("#"+str).remove();
                                        }
                                        $("#level").val(updated_level);
                                    }
                                    else
                                    {
                                    
                                            var status=0;
                                            level=parseInt(level)+1;
                                            for(var i=0;i<global_level_array.length;i++)
                                            {
                                                if(global_level_array[i]==level)
                                                {
                                                    status=1;
                                                    break;
                                                }
                                            }
                                            if(status==0)
                                            {
                                                global_level_array.push(level);
                                                var str="category_level_"+level;
                                                var append_div='<div id="'+str+'" ></div>';
                                                $("#all_category_data").append(append_div);
                                                $("#"+str).append(responseData);
                                                $("#level").val(level);
                                            }
                                            else
                                            {
                                                var str="category_level_"+level;
                                                $("#"+str).html(responseData);
                                            }
                                    }
                                }
                            }
                        });
    }
    function validate_error()
    {
        var product_name=$("#product_name").val();
        var product_description=$("#product_description").val();
        var category_level_0=$("#category_level_0").val();
        var product_price=$("#product_price").val();
        var discount_id=$("#discount_id").val();
        var discount_amount=$("#discount_amount").val();
        var offer_id=$("#offer_id").val();
        var offer_amount=$("#offer_amount").val();
        var tax_id=$("#tax_id").val();
        var tax_amount=$("#tax_amount").val();
        var sale_price=$("#sale_price").val();
        var level=$("#level").val();
        var error_status=0;
        if(product_name=='')
        {
            $("#product_name-error").html("Please Enter Product Name");
            if(error_status==0)
            {
                $("#product_name").focus();
            }
            error_status=1;
        }
        else
        {
            $("#product_name-error").html("");
        }
        if(product_description.trim()=='')
        {
            $("#product_description-error").html("Please Enter Product Description");
            if(error_status==0)
            {
                $("#product_description").focus();
            }
            error_status=1;
        }
        else
        {
            $("#product_description-error").html("");
        }
        if(category_level_0=='')
        {
            $("#category_level_0-error").html("Please Select Product Category");
            if(error_status==0)
            {
                $("#category_level_0").focus();
            }
            error_status=1;
        }
        else
        {
            $("#category_level_0-error").html("");
        }
        // var str="";
        // if(level>0)
        // {
        //     for(var i=1;i<=level;i++)
        //     {
        //         var str="category_level_"+i;
               
        //         if($("#"+str).val()=='')
        //         {
        //             $("#"+str+"-error").html("Please Select Product Category");
        //             if(error_status==0)
        //             {
        //                 $("#"+str).focus();
        //             }
        //             error_status=1;
        //         }
        //         else
        //         {
        //             $("#"+str+"-error").html("");
        //         }
        //     }
        // }

        if(product_price=='')
        {
            $("#product_price-error").html("Please Enter Product Price");
            if(error_status==0)
            {
                $("#product_price").focus();
            }
            error_status=1;
        }
        else
        {
            $("#product_price-error").html("");
        }
        // if(discount_id=='')
        // {
        //     $("#discount_id-error").html("Please Select Discount ");
        //     if(error_status==0)
        //     {
        //         $("#discount_id").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#discount_id-error").html("");
        // }
        // if(discount_amount=='')
        // {
        //     $("#discount_amount-error").html("Please Enter Discount Amount");
        //     if(error_status==0)
        //     {
        //         $("#discount_amount").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#discount_amount-error").html("");
        // }
        // if(offer_id=='')
        // {
        //     $("#offer_id-error").html("Please Enter Offer");
        //     if(error_status==0)
        //     {
        //         $("#offer_id").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#offer_id-error").html("");
        // }
        // if(offer_amount=='')
        // {
        //     $("#offer_amount-error").html("Please Enter Offer Amount");
        //     if(error_status==0)
        //     {
        //         $("#offer_amount").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#offer_amount-error").html("");
        // }
        // if(tax_id=='')
        // {
        //     $("#tax_id-error").html("Please Enter Tax");
        //     if(error_status==0)
        //     {
        //         $("#tax_id").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#tax_id-error").html("");
        // }
        // if(tax_amount=='')
        // {
        //     $("#tax_amount-error").html("Please Enter Tax Amount");
        //     if(error_status==0)
        //     {
        //         $("#tax_amount").focus();
        //     }
        //     error_status=1;
        // }
        // else
        // {
        //     $("#tax_amount-error").html("");
        // }
        if(sale_price=='')
        {
            $("#sale_price-error").html("Please Enter Sale Price");
            if(error_status==0)
            {
                $("#sale_price").focus();
            }
            error_status=1;
        }
        else
        {
            $("#sale_price-error").html("");
        }
        if(error_status==1)
        {
            return false;
        }
        else
        {
             return true;
        }
    }
    function get_remove_image(pro_id,img_id)
    {
        $.ajax
        ({
                type: "post",
                url: "<?php echo base_url('product/get_remove_image');?>",
                data: {'pro_id':pro_id,'img_id':img_id},
                success: function(responseData) 
                {
                    $("#image_display_section_"+img_id).remove();
                  
                }
        });
    }
    
    
</script>
