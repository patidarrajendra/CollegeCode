<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b> Stream List</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <a href="<?php echo base_url();?>stream/add_stream"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Stream</button></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Stream List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Stream Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($stream_data))
                                    {
                                        $i=1;
                                     
                                        foreach($stream_data as $level_value_data)
                                        {

 
                                            if($level_value_data['stream_status']==1)
                                            {
                                                $level_status="Active";
                                            }
                                            else if($level_value_data['stream_status']==0)
                                            {
                                                $level_status="Inactive";
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <?php /*<td><?php $category = $this->common_model->getSingleRecordById('college_master', array('college_id' => $level_value_data['college_id'])); echo $category['college_name']; ?></td>*/?>
                                                <td><?php echo $level_value_data['stream_name'];?></td>
                                                <td><?php echo $level_status;?></td>
                                                <td>
                                                    
                                                    <a href="<?php echo base_url();?>stream/add_stream/<?php echo $level_value_data['stream_id'];?>"> <i class="material-icons">create</i></a>&nbsp;
                                                    <a href="<?php echo base_url();?>stream/delete_stream/<?php echo $level_value_data['stream_id'];?>">
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
                                        echo '<tr><td colspan="10">No Record Found</td></tr>';
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
