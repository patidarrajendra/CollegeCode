
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Student List</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <!-- <a href="<?php echo base_url();?>level/add_level"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Student</button></a> -->
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Student List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>student Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Parents</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php 
                                    // echo "<pre>";
                                    // print_r($student_master); die;
                                    if(!empty($student_master))
                                    {
                                        $i=1;
                                     
                                        foreach($student_master as $student_value_data)
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $student_value_data['student_fullname'];?></td>
                                                <td><?php echo $student_value_data['student_email'];?></td>
                                                <td><?php echo $student_value_data['student_mobile'];?></td>
                                                <td><?php echo $student_value_data['parent_name'];?></td>
                                                <td><?php echo $student_value_data['student_address'];?></td>
                                                <td><?php echo $student_value_data['student_gender'];?></td>
                                                <td>
                                                    
                                                    <!-- <a href="<?php echo base_url();?>student/add_student/<?php echo $student_value_data['student_id'];?>"> <i class="material-icons">create</i></a>&nbsp; -->
                                                    <a href="<?php echo base_url();?>student/delete_student/<?php echo $student_value_data['student_id'];?>">
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
