<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Counselling Form Deatils</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Counselling Form Deatils
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                               <?php 
                                    if(!empty($counselling_data))
                                    {?>
                                    <tr>
                                        <th>Sr No.</th>
                                        <td><?php echo $counselling_data['id']; ?></td>
                                    </tr> 
                                    <tr>
                                       <th>Student Name</th> 
                                       <td><?php echo $counselling_data['student_name']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Age</th>
                                       <td><?php echo $counselling_data['age']; ?></td> 
                                    </tr>
                                    <tr>
                                       <th>Student mobile</th> 
                                       <td><?php echo $counselling_data['mobile']; ?></td>
                                    </tr> 
                                    <tr>
                                       <th>Parent Name</th> 
                                       <td><?php echo $counselling_data['parent_name']; ?></td>
                                    </tr>

                                    <tr>
                                       <th>Parent Mobile</th> 
                                       <td><?php echo $counselling_data['parent_mobile']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Address</th> 
                                       <td><?php echo $counselling_data['address']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Email Address</th> 
                                       <td><?php echo $counselling_data['email']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Xth Board</th>
                                       <td><?php echo $counselling_data['Xth_board']; ?></td> 
                                    </tr>
                                    <tr>
                                       <th>Xth Roll No.</th> 
                                       <td><?php echo $counselling_data['Xth_roll_no']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Xth Passing Year</th> 
                                       <td><?php echo $counselling_data['Xth_year']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Xth Percentage</th> 
                                       <td><?php echo $counselling_data['Xth_percentage']; ?></td>
                                    </tr>
                                    <tr>
                                       <th>XII Board</th> 
                                       <td><?php echo $counselling_data['XII_board']; ?></td>
                                    </tr>

                                        <th>XII Roll No.</th>
                                        <td><?php echo $counselling_data['XII_roll_no']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>XII Passing Year</th>
                                        <td><?php echo $counselling_data['XII_year']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>XII Percentage</th>
                                        <td><?php echo $counselling_data['XII_percentage']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>XII Subject</th>
                                        <td><?php echo $counselling_data['XII_subject']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>Competition Exam.</th>
                                        <td><?php echo $counselling_data['competition_exam']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>Competition Exam Year</th>
                                        <td><?php echo $counselling_data['competition_exam_year']; ?></td>
                                    </tr>
                                    </tr>

                                        <th>Score</th>
                                        <td><?php echo $counselling_data['score']; ?></td>
                                    </tr>

                                     <?php
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("include/footer.php");?>
