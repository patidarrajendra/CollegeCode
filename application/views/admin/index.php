    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Administrator DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Student <span style="margin-left: 160px;font-size: 25px;"><?php echo $total_users;?></span></div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Total College <span style="margin-left: 160px;font-size: 25px;"><?php //echo $total_reseller;?></span></div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Branch <span style="margin-left: 160px;font-size: 25px;"><?php //echo $total_supplier;?></span></div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Sale <span style="margin-left: 160px;font-size: 25px;"><?php //echo $total_sale;?></span></div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Products<span style="margin-left: 160px;font-size: 25px;"><?php //echo $total_product;?></span></div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Category<span style="margin-left: 160px;font-size: 25px;"><?php //echo $total_category;?></span></div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            -->
            </div>
            <div class="row clearfix">
            </div>

            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Progess</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Student Name</th>
                                            <th>Course</th>
                                            <th>Branch</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($resaller_data))
                                        if(count($resaller_data)>0)
                                        {
                                            $j=1;
                                            for($i=0;$i<count($resaller_data);$i++)
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $j;?></td>
                                                    <td><?php echo $resaller_data[$i]['user_fullname'];?></td>
                                                    <td><?php echo $resaller_data[$i]['total_sale_amount'];?></span></td>
                                                    <td><?php echo $resaller_data[$i]['user_mobile'];?></td>
                                                    <td>
                                                        <?php

                                                            $resaller_data[$i]['total_sale_amount']
                                                            
                                                        ?>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                            <!-- <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            $j++;
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr><td colspan="5">No Record Found</td></tr>
                                            <?php
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