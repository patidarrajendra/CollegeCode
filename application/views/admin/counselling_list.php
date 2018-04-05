<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Counselling List</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <!-- <a href="<?php echo base_url();?>Counselling/add_college"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Counselling</button></a> -->
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Counselling List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Student Name</th>
                                        <th>Parent Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // echo "<pre>";
                                    // print_r($counselling_master); 

                                    // die;
                                    if(!empty($counselling_master))
                                    {
                                        $i=1;
                                     
                                        foreach($counselling_master as $college_value_data)
                                        {

 
                                            if($college_value_data['status']==1)
                                            {
                                                $level_status="Active";
                                            }
                                            else if($college_value_data['status']==0)
                                            {
                                                $level_status="Inactive";
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $college_value_data['student_name']; ?></td>
                                                <td><?php echo $college_value_data['parent_name']; ?></td>
                                                <td><?php echo $college_value_data['email']; ?></td>
                                                <td><?php echo $college_value_data['age']; ?></td>
                                                <td><?php echo $college_value_data['mobile']; ?></td>
                                                <td><?php echo $college_value_data['address']; ?></td>
                                                <td><?php echo $level_status;?></td>
                                                <td>
                                                    <!-- <a href="<?php echo base_url();?>counselling/add_college/<?php echo $college_value_data['id'];?>"> <i class="material-icons">create</i></a>&nbsp; -->
                                                    <a href="<?php echo base_url() ?>counselling/view/<?php echo $college_value_data['id']; ?>">
                                                        <i class="material-icons">pageview</i></a>&nbsp;
                                                    <a href="<?php echo base_url();?>counselling/delete_counselling/<?php echo $college_value_data['id'];?>">
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
