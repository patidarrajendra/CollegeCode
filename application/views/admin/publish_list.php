<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Published Course and College</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <a href="<?php echo base_url();?>Publish/add_publish/"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Course</button></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Published College
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>College Name</th>
                                        <th>Category Name</th>
                                        <th>Level Name</th>
                                        <th>Stream Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     
                                    if(!empty($publish_data))
                                    {
                                        $i=1;
                                     
                                        foreach($publish_data as $course_value_data)
                                        {

                                              $level_status=1;
                                               
                                            if($course_value_data['publish_status']==1) 
                                            {
                                                $level_status="Active";
                                            }
                                            else if($course_value_data['publish_status']==0)
                                            {
                                                $level_status="Inactive";
                                            }
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <!--<td><img src="<?php //echo base_url().'uploads/'.$course_value_data['image']; ?>" width="100" height="100"></td>-->
                                                <td><?php $college = $this->common_model->getSingleRecordById('college_master', array('college_id' => $course_value_data['college_id'])); echo $college['college_name']; ?></td>
                                                <td><?php $category = $this->common_model->getSingleRecordById('category_master', array('category_id' => $course_value_data['category_id'])); echo $category['category_name']; ?></td>
                                                <td><?php $level = $this->common_model->getSingleRecordById('level_master', array('level_id' => $course_value_data['level_id'])); echo $level['level_name']; ?></td>
                                               <td><?php $stream = $this->common_model->getSingleRecordById('stream_master', array('stream_id' => $course_value_data['stream_id'])); echo $stream['stream_name']; ?></td>
                                                <td>
                                                    
                                                    <!--<a href="< ?php echo base_url();?>course/add_course/< ?php echo $course_value_data['course_id'];?>"> <i class="material-icons">create</i></a>&nbsp;-->
                                                    <a href="<?php echo base_url();?>Publish/delete_publish/<?php echo $course_value_data['publish_id'];?>">
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
