<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                <h1> <b>Suppliers List</b> </h1>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" >
                <a href="<?php echo base_url();?>/suppliers/add_suppliers"><button class="btn btn-primary waves-effect button_postion" type="button">Add New Supplier</button></a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Suppliers
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Email</th>
                                        <th>Mobile</th>                                      
                                        <th>Status</th>
                                         
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                   $modaldata="";           
                                   if($suppliers_data!='no')
                                   {
                                       
                                       foreach($suppliers_data as $supplier)
                                       {

                                           if($supplier['user_status']==1)
                                            {
                                                $supplier_status="Active";
                                            }
                                            else if($supplier['user_status']==0)
                                            {
                                                $supplier_status="Inactive";
                                            }
                                       ?>
                                        <tr>
                                            <td><?php echo $supplier['user_fname'].' '. $supplier['user_lname']?></td>
                                            <td><?php echo $supplier['user_email']?></td>
                                            <td><?php echo $supplier['user_mobile']?></td>
                                            <td><?php echo $supplier_status; ?></td>
                                        
                                            <td>
                                              <?php
                                                    if($supplier['user_status']==1)
                                                    {
                                                        ?>
                                                        <a href="<?php echo base_url();?>suppliers/inactive_status_change/<?php echo $supplier['user_id'];?>"><i class="material-icons">move_to_inbox</i></a>&nbsp;
                                                        <?php
                                                    }
                                                    else if($supplier['user_status']==0)
                                                    {
                                                        ?>
                                                        <a href="<?php echo base_url();?>suppliers/active_status_change/<?php echo $supplier['user_id'];?>"><i class="material-icons">unarchive</i></a>&nbsp;
                                                        <?php
                                                    }
                                               ?>
                                              <a href="<?php echo base_url();?>suppliers/add_suppliers/<?php echo $supplier['user_id'];?>"> <i class="material-icons">create</i></a>&nbsp;
                                               <a href="<?php echo base_url();?>suppliers/delete_suppliers/<?php echo $supplier['user_id'];?>"><i class="material-icons">delete_sweep</i></i></a>
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

                   <!-- For Material Design Colors -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="card">
                                 <div class="header">
                                  <h2>
                                    Sales Detail
                                     
                                  </h2>
                            </div>
                            <div class="body">
                                    <table id="mainTable" class="table table-striped table-responsive" style="cursor: pointer;">
                                      <?php   echo $modaldata;  ?>    
                                    </table>
                                    <input style="position: absolute; display: none;"></div>
                                </div>
                            </div>
                        </div>
                     </div>

                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>-->
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php include("include/footer.php");?>
