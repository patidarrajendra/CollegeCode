<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Stream List</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <a href="<?php echo base_url();?>offer/add_offer"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Stream</button></a>
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
                                        <th>Stream Name</th>
                                        <th>Stream Type</th>
                                        <th>Stream Apply Type</th>
                                        <th>Stream Apply Id</th>
                                        <th>Stream Start From</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   if(!empty($offers))
                                   {
                                       foreach($offers as $offer)
                                       {
                                            if($offer['stream_status']==1)
                                            {
                                                $status="Active";
                                            }
                                            else
                                            {
                                                $status="Inactive";
                                            }
                                       ?>
                                        <tr>
                                            <td><?php echo $offer['stream_name'];?></td>
                                            <td><?php echo $offer['stream_type'];?></td>
                                            <td><?php echo $offer['stream_apply_type'];?></td>
                                            <td><?php echo $offer['stream_applied_id'];?></td>
                                            <td><?php echo $offer['stream_start_from'];?></td>
                                            <td><?php echo $status;?></td>
                                            <td>
                                                <?php
                                                if($offer['stream_status']==1)
                                                {
                                                    ?>
                                                    <a href="<?php echo base_url();?>offer/inactive_status_change/<?php echo $offer['stream_id'];?>"><i class="material-icons">move_to_inbox</i></a>&nbsp;
                                                    <?php
                                                }
                                                else if($offer['stream_status']==0)
                                                {
                                                    ?>
                                                    <a href="<?php echo base_url();?>offer/active_status_change/<?php echo $offer['stream_id'];?>"><i class="material-icons">unarchive</i></a>&nbsp;
                                                    <?php
                                                }
                                                ?>
                                                <a href="<?php echo base_url();?>offer/add_offer/<?php echo $offer['stream_id'];?>"> <i class="material-icons">create</i></a>&nbsp;
                                                <a href="<?php echo base_url();?>offer/delete_offer/<?php echo $offer['stream_id'];?>">
                                                   <i class="material-icons">delete_sweep</i></i>
                                                </a>
                                            </td>
                                        </tr>
                                       <?php 
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
