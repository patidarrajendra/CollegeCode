<style>
.button_postion1 {
    margin-top: 17px !important;
    font-size: 15px !important;
    
     margin-left: 22px !important; 
}
</style>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-8 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Pincode List</b> </h1>
            </div>
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                <a href="<?php echo base_url();?>uploads/pincode_excel/demo_pincode_import_excel.xlsx)" download><button class="btn btn-primary waves-effect button_postion1" type="button">Demo Excel</button></a>&nbsp;
                <a href="<?php echo base_url();?>pincode/add_excel_file"><button class="btn btn-primary waves-effect button_postion1" type="button">Import Excel File</button></a>&nbsp;
                <a href="<?php echo base_url();?>pincode/add_pincode"><button class="btn btn-primary waves-effect button_postion1" type="button">Add New Pincode</button></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Pincode List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Pincode</th>
                                        <th>Pincode Charge</th>
                                        <th>Status</th>
                                        <th>Added Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($pincode_list_data)>0)
                                    {
                                        $i=0;
                                        foreach ($pincode_list_data as $pincode_data) 
                                        {
                                           
                                            if($pincode_data['pin_status']==1)
                                            {
                                                $pincode_status="Active";
                                            }
                                            else if($pincode_data['pin_status']==0)
                                            {
                                                $pincode_status="Inactive";
                                            }
                                            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $pincode_data['pin_code']; ?></td>
                                            <td><?php echo $pincode_data['pin_charge']; ?></td>
                                            <td><?php echo $pincode_status; ?></td>
                                            <td><?php echo date('m/d/Y',strtotime($pincode_data['added_date'])); ?></td>
                                            <td>
                                                    <?php 
                                                    if($pincode_data['pin_status']==1)
                                                    {
                                                        ?>
                                                        <a href="<?php echo base_url();?>pincode/inactive_status_change/<?php echo $pincode_data['pin_id'];?>"><i class="material-icons">move_to_inbox</i></a>&nbsp;
                                                        <?php
                                                    }
                                                    else if($pincode_data['pin_status']==0)
                                                    {
                                                        ?>
                                                        <a href="<?php echo base_url();?>pincode/active_status_change/<?php echo $pincode_data['pin_id'];?>"><i class="material-icons">unarchive</i></a>&nbsp;
                                                       
                                                        <?php
                                                    }
                                                ?>
                                                    <a href="<?php echo base_url();?>pincode/add_pincode/<?php echo $pincode_data['pin_id'];?>"> <i class="material-icons">create</i></a>&nbsp;
                                                    <a href="<?php echo base_url();?>pincode/delete_pincode/<?php echo $pincode_data['pin_id'];?>">
                                                       <i class="material-icons">delete_sweep</i></i>
                                                    </a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $i++;
                                        } 
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="7">No Record Found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("include/footer.php");?>