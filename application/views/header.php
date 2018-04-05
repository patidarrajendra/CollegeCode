<!DOCTYPE html> 
<html>

<head>

    <title>College Check In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico.png">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/flexslider/flexslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/pretty-photo/css/prettyPhoto.css">
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url();?>assets/css/myself.css">
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url();?>assets/css/multistep.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/additional-methods.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

</head>

<body class="home-page">

    <div class="">
    
        <header class="header">
            <div class="header-main container">
                <h1 class="logo col-md-4 col-sm-4">
                    <a href="<?php echo base_url();?>"><img id="logo" src="<?php echo base_url();?>assets/images/logo.png" alt="Logo"></a>
                </h1>
                <!--//logo-->
                <div class="info col-md-8 col-sm-8 sideinfo">
                    <ul class="menu-top navbar-right hidden-xs">
                        <li class="divider"><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="divider"><a href="faq.html">FAQ</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                    <!--//menu-top-->
                    <br />
                    <div class="contact pull-right">
                        <p class="phone"><i class="fa fa-phone"></i><a href="tel:7691087850">8503812819</a></p>
                        <p class="phone" style="margin-top: 3px;"><i class="fa fa-whatsapp"></i><a href="tel:7691087850">7691087850</a></p>
                        <p class="email"><i class="fa fa-envelope"></i><a href="#">help@collegecheckin.com</a></p>
                    </div>
                    <!--//contact-->
                </div>
            </div>
        </header>

        <nav class="main-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapse"> 
                    <ul class="nav navbar-nav">
                        <li class="active nav-item"><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="nav-item"><a href="#" id="applynowmenu" data-toggle="modal" data-target="#myModal">Apply Now</a></li>
                        <li class=" nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Courses <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                 <?php 
                                  if(!empty($category))
                                   foreach($category as $cat)
                                   { 
                                    ?>
                                      <li><a href="<?php echo base_url();?>front/categorycollegelist/<?php echo $cat['category_id']; ?>"><i class="<?php echo $cat['category_icon']; ?>"></i><?php echo " ".$cat['category_name']; ?></a></li>     
                                    <?php
                                   }
                                ?>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="<?php echo base_url();?>front/news">News</a></li> 
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Colleges <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>front/college_degree"><i class="fa fa-graduation-cap"></i> By Degree</a></li>
                                <li><a href="<?php echo base_url();?>front/college_degree"><i class="fa fa-steam"></i> By Stream</a></li>
                                <li><a href="<?php echo base_url();?>front/college_degree"><i class="fa fa-globe"></i> By Country</a></li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="<?php echo base_url();?>front/about">About Us</a></li>
                        <li class=" nav-item"><a href="<?php echo base_url();?>front/contact">Contact</a></li>
                         <li class=" nav-item"><a href="<?php echo base_url();?>front/ecounselling">Counselling</a></li>

                    </ul>
                    <ul class="nav navbar-nav" style="float: right;">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Log In <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" style="left: -133px;">
                                <!-- <li><a href="#"><i class="fa fa-share-square"></i> College</a></li> -->
                                <li><a href="<?php echo base_url();?>front/login""><i class="fa fa-lock"></i> Student</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Apply Now</h4>
                    </div>
                    <div class="modal-body">

                        <div class="tab">
                            <h3> Select Course </h3>
                            
                            
                                <div class="col-md-12" style="margin: 0 0 30px 0;">

                                    <?php 
                                     
                     foreach($category as $cat)
                       {
                         
                        ?>
                                        <div class="col-md-4">
                                            <div class="coursebox categorybox"><a href="#" onclick="ajax_func('<?php echo $cat['category_id'];?>','<?php echo base_url('ajax/getlevellist');?>','levelsection','category')" class="acoursetag"><i class="<?php echo $cat['category_icon']; ?>" style="font-size:60px;margin-top: 10px;"></i><br><?php echo $cat['category_name'];?></a></div>
                                        </div>
                                        <?php
                       $icon= '';
                     }
                    ?>
                    <!-- 
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Engineering"><i class="fa fa-laptop" style="font-size:60px;margin-top: 10px;"></i> <br>Engineering</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Management"><i class="fa fa-user" style="font-size:60px;margin-top: 10px;"></i> <br> Management</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Medical"><i class="fa fa-user-md" style="font-size:60px;margin-top: 10px;"></i> <br> Medical</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Science"><i class="fa fa-flask" style="font-size:60px;margin-top: 10px;"></i> <br> Science</a> </div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Art"><i class="fa fa-deviantart" style="font-size:60px;margin-top: 10px;"></i> <br> Art</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Commerce"><i class="fa fa-viacoin" style="font-size:60px;margin-top: 10px;"></i> <br> Commerce</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" id="Law"><i class="fa fa-gavel" style="font-size:60px;margin-top: 10px;"></i> <br> Law</a></div>
                     </div>  
                     -->
                    </div>

                        </div>
                        <div class="tab">
                            <h3 id="selectedcousreheading"> Select Course </h3>
                            <div class="col-md-12 " id="levelsection" style="margin: 0 0 30px 0;">
                                <!--
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" name="Under Graduate Colleges" id="graduate"><i class="fa fa-book" style="font-size:60px;margin-top: 10px;"></i> <br>Under Graduate Colleges</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" name="Post Graduate Colleges" id="pgraduate"><i class="fa fa-graduation-cap" style="font-size:60px;margin-top: 10px;"></i> <br> Post Graduate Colleges</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" name="Ph.D Colleges" id="phd"><i class="fa fa-graduation-cap" style="font-size:60px;margin-top: 10px;"></i> <br> Ph.D Colleges</a></div>
                     </div>
                     <div class="col-md-4">
                         <div class="coursebox"><a href="#" class="acoursetag" name="Certificate Colleges" id="cirtificate"><i class="fa fa-certificate" style="font-size:60px;margin-top: 10px;"></i> <br> Certificate Colleges</a> </div>
                     </div> -->

                            </div>

                        </div>
                        <!--   
		                <div class="tab">
		                  <h3 id="selectedcousreheading"> Fill Your Contact Information </h3> 
		                  <div class="col-md-12" style="margin: 0 0 30px 0;">
		                      <article class="contact-form col-md-12 col-sm-12  page-row" style="text-align: left;">                            
		                            <form id="basiccontactform" name="basiccontactform" method="POST">
		                                <div class="form-group name">
		                                    <label for="name">Name</label>
		                                    <input id="name" name="name" type="text" class="form-control" placeholder="Enter your name" required="required">
		                                </div> 
		                                <div class="form-group email">
		                                    <label for="email">Email<span class="required">*</span></label>
		                                    <input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" required="required">
		                                </div>
		                                <div class="form-group phone">
		                                    <label for="phone">Phone</label>
		                                    <input id="phone" name="phone" type="phone" class="form-control" placeholder="Enter your contact number" required="required">
		                                </div>
		                                <div class="form-group message">
		                                    <div id="response" style="background-color: #eaeaea;"></div>
		                                </div>
		                                <input type="hidden" name="action" id="action" value="basicinfo">
		                                <input id="selectedclass" name="selectedclass" type="hidden" >
		                                <input id="selectedcourse" name="selectedcourse" type="hidden" >
		                                <button type="button" name="submit" id="submit" class="btn btn-theme">Save Info & Next</button>
		                             </form>                  
		                        </article>
		                  </div>
		                </div>
           		-->

                        <div class="tab">
                            <h3> Select Colleges </h3>
                            <div id="resposecollege"></div>
                            <div class="col-md-12" style="margin: 0 0 30px 0;" id="gridcollege">
                                <div class="col-md-4 news-item">
                                    <div class="coursebox">
                                        <h5 class="title">
                                    <a href="#">Arya College of Engineering &amp; I.T.</a>
                                </h5>
                                        <img class="thumb" style="height: 160px;width: 230px;" src="assets/images/college.jpg" alt="">
                                        <p>Rs:- 500</p>
                                        <div>
                                            <input type="checkbox" id="chk10" name="chk10">
                                        </div>
                                        <input type="hidden" id="tamount" name="tamount" value="500">
                                    </div>
                                </div>
                                <div class="col-md-4 -item">
                                    <div class="coursebox">
                                        <h5 class="title">
                                <a href="#">Apex Institute of Engineering and Technology-Sitapura11111</a>
                            </h5>
                                        <img class="thumb" style="height: 160px;width: 230px;" src="assets/images/college1.jpg" alt="">
                                        <p>Rs:- 500</p>
                                        <div>
                                            <input type="checkbox" id="chk13" name="chk13">
                                        </div>
                                        <input type="hidden" id="tamount" name="tamount" value="500">
                                    </div>
                                </div>
                            </div>
                            <button style="margin: 0 0 15px 0;" type="button" name="collegelistapply" id="collegelistapply" class="btn btn-theme collegelistapply">Apply Now</button>
                        </div>

                        <div class="tab">
                            <h3> College Application Form </h3>
                            <form id="applicationform" name="applicationform" method="POST">

                                <input type="hidden" id="from_category" name="category" value="">
                                <input type="hidden" id="from_level" name="level" value="">
                                <input type="hidden" id="from_college" name="college" value="">

                                <div class="col-md-12" style="margin: 0 0 30px 0; text-align: left;" id="scrollforvalidate">
                                    <input type="hidden" name="action" id="action" value="applicationApply">
                                    <input id="appselectedclass" name="appselectedclass" type="hidden">
                                    <input id="appselectedcourse" name="appselectedcourse" type="hidden">
                                    <div class="panel-group ecounciling-form">
                                        <div class="panel panel-default">


                                    <div class="panel panel-default">

                                        <div class="panel-heading panel-heading-bg">
                                            <h4 class="panel-title">
                                                 <a href="#" class="next-submit">1. Stream(branch) Information</a>                                                     
                                           </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div></div>
                                                <div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="applicant_name">Applicant Subject Branch</label>
                                                            <select class="form-control" id="course_stream" name="course_stream">
                                                                    <option value="" selected="selected">---------</option>
                                                                    <?php 
                                                                     if(isset($stream))
                                                                       foreach($stream as $val)
                                                                       {
                                                                    ?>
                                                                        <option value="<?php echo $val['stream_id']; ?>"><?php echo $val['stream_name']; ?></option>
                                                                    <?php 
                                                                       } 
                                                                    ?>
                                                                    <option value="Government">Government</option>
                                                                    <option value="Self-Employed">Self-Employed</option>
                                                                    <option value="Other">Other</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-1"></div>

                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        



                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                                                 <a href="#" class="next-submit">2. Personal Information</a>                                                     
                                               </h4>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div></div>
                                                    <div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Applicant Name<sup>*</sup></label>
                                                                <input type="text" name="student_fullname" class="form-control" id="student_fullname" placeholder="Max 100 characters, do not enter numbers" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile">Mobile Number<sup>*</sup></label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">+91</div>
                                                                    <input type="number" id="student_mobile" name="student_mobile" class="form-control" required="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile">Alternate Mobile Number</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">+91</div>
                                                                    <input type="number" id="alternate_phone" name="alternate_phone" required="" class="form-control" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile_number">Gender</label>

                                                                <label>
                                                                    <input type="radio" id="gender_male" value="1" name="student_gender" checked="checked"> Male
                                                                </label>
                                                                <label style="margin-left: 26px;">
                                                                    <input type="radio" id="gender_female" value="2" name="student_gender"> Female
                                                                </label>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mobile_number">Marital Status</label>

                                                                <label>
                                                                    <input type="radio" id="radio_married" name="marital_status" value="1" class="maritalStatusRadio" checked="checked"> Single
                                                                </label>
                                                                <label style="margin-left: 20px;">
                                                                    <input type="radio" id="radio_unmarried" name="marital_status" value="2" class="maritalStatusRadio"> Married
                                                                </label>

                                                            </div>

                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email<sup>*</sup></label>
                                                                <input type="email" name="student_email" class="form-control" id="student_email" placeholder="" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile_number">Date of Birth</label>
                                                                <input class="form-control" id="student_dob" name="student_dob" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile_number">Social Category</label>
                                                                <select class="form-control" id="student_category" name="student_category">
                                                                    <option value="0" selected="selected">Not Available</option>
                                                                    <option value="1">General</option>
                                                                    <option value="2">OBC</option>
                                                                    <option value="3">SC</option>
                                                                    <option value="4">ST</option>
                                                                    <option value="5">OTHERS</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile_number">Mother Tongue</label>
                                                                <select class="form-control select2-hidden-accessible" id="mother_tongue" name="mother_tongue" tabindex="-1" aria-hidden="true">
                                                                    <option value="">---------</option>
                                                                    <option value="Hindi">Hindi</option>
                                                                    <option value="English">English</option>
                                                                    <option value="Other">Other</option>

                                                                </select>
                                                                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 554px;">
                            <span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-id_mother_tongue-container" style="height: 33px;"><span class="select2-selection__rendered" id="select2-id_mother_tongue-container" title="Hindi">Hindi</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                                                </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mobile_number">Physically challenged</label>

                                                                <label>
                                                                    <input type="radio" id="id_disability_yes" value="True" name="student_disability"> Yes
                                                                </label>
                                                                <label style="margin-left: 26px;">
                                                                    <input type="radio" id="id_disability_no" value="False" name="student_disability" checked="checked"> No
                                                                </label>

                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                        <a href="#" class="next-submit">3. Correspondence Address</a>
                        </h4>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Address">Address</label>
                                                            <textarea name="student_address" id="student_address" class="form-control" rows="2" required=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="city">Country</label>
                                                            <select name="student_country" id="student_country" class="form-control" required="required">
                                                                <option value="1">India</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="state">State</label>
                                                            <select name="student_state" id="student_state" class="form-control select2-hidden-accessible" required="required" tabindex="-1" aria-hidden="true">
                                                                <option value="">Select State</option>
                                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                <option value="Jharkhand">Jharkhand</option>
                                                                <option value="">Karnataka</option>
                                                                <option value="Karnataka">Kerala</option>
                                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                                <option value="Maharashtra">Maharashtra</option>
                                                                <option value="Manipur">Manipur</option>
                                                                <option value="Meghalaya">Meghalaya</option>
                                                                <option value="Mizoram">Mizoram</option>
                                                                <option value="Nagaland">Nagaland</option>
                                                                <option value="Odisha">Odisha</option>
                                                                <option value="Punjab">Punjab</option>
                                                                <option value="Rajasthan">Rajasthan</option>
                                                                <option value="Sikkim">Sikkim</option>
                                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                                <option value="Telangana">Telangana</option>
                                                                <option value="Tripura">Tripura</option>
                                                                <option value="Uttarakhand">Uttarakhand</option>
                                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                <option value="West Bengal">West Bengal</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadweep">Lakshadweep</option>
                                                                <option value="Puducherry">Puducherry</option>
                                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 462px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-state-container" style="height: 33px;"><span class="select2-selection__rendered" id="select2-state-container" title="Gujarat">Gujarat</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="city">City</label>
                                                            <input name="student_city" type="text" id="student_city" class="form-control select2-hidden-accessible" required="required" tabindex="-1" aria-hidden="true">
                                                            <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 554px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-inputCity-container" style="height: 33px;"><span class="select2-selection__rendered" id="select2-inputCity-container" title="Select City">Select City</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                                            </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postal_code">Postal Code</label>
                                                            <input type="number" min="1" step="1" id="student_postalcode" name="student_postalcode" maxlength="6" class="form-control" placeholder="Pin Code" value="">
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                        <a href="#" class="next-submit">4. Family Information</a>
                        </h4>
                                            </div>
                                            <div id="collapse3" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Annual Household Income</label>
                                                                <input class="form-control valid" id="annual_income" name="annual_income" step="1" min="1" type="number" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Parent / Guardian Name</label>
                                                                <input class="form-control" id="parent_name" maxlength="100" name="parent_name" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="postal_code">Parent / Guardian Occupation</label>
                                                                <select class="form-control" id="parent_occupation" name="parent_occupation">
                                                                    <option value="" selected="selected">---------</option>
                                                                    <option value="Private">Private</option>
                                                                    <option value="Government">Government</option>
                                                                    <option value="Self-Employed">Self-Employed</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                        <a href="#">5. Entrance Exam Details</a>
                        </h4>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="entrance_exam">Entrance Exam</label>
                                                                <input class="form-control select2-hidden-accessible" type="text" name="entrance_exam" id="entrance_exam" tabindex="-1" aria-hidden="true">
                                                                <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 369px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-exam_name-container" style="height: 33px;"><span class="select2-selection__rendered" id="select2-exam_name-container" title="Select Entrance Exam">Select Entrance Exam</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                                                </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="entrance_exam_year">Entrance Exam Date</label>
                                                                <input type="date" name="entrance_examdate" id="entrance_examdate" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Entrance Exam Marks</label>
                                                                <input type="number" class="form-control" name="entrance_exammarks" id="entrance_exammarks" placeholder="Marks in Numbers">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="next-submit">6. Schooling Information</a>
                        </h4>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <p class="edu_header">Class 10th</p>
                                                    <div class="form-group">
                                                        <div class="col-sm-2">
                                                            <input type="text" name="tenth_subjects" class="form-control" id="tenth_subjects" placeholder="Fill Main 3 Subjects">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="tenth_school" id="tenth_school" placeholder="School Name">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="tenth_board" name="tenth_board">
                                                                <option value="">Select Board</option>
                                                                <option value="ICSE">ICSE</option>
                                                                <option value="CBSE">CBSE</option>
                                                                <option value="State Board">State Board</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="tenth_passing_year" name="tenth_passing_year">
                                                                <option value="">Passing Year</option>
                                                                <option value="2020">2022</option>
                                                                <option value="2019">2021</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2019">2019</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2014">2014</option>
                                                                <option value="2013">2013</option>
                                                                <option value="2012">2012</option>
                                                                <option value="2011">2011</option>
                                                                <option value="2010">2010</option>
                                                                <option value="2009">2009</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2007">2007</option>
                                                                <option value="2006">2006</option>
                                                                <option value="2005">2005</option>
                                                                <option value="2004">2004</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2001">2001</option>
                                                                <option value="2000">2000</option>
                                                                <option value="1999">1999</option>
                                                                <option value="1998">1998</option>
                                                                <option value="1997">1997</option>
                                                                <option value="1996">1996</option>
                                                                <option value="1995">1995</option>
                                                                <option value="1994">1994</option>
                                                                <option value="1993">1993</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" name="tenth_marks" id="tenth_marks" placeholder="Marks(%)">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="tenth_mode" name="tenth_mode">
                                                                <option value="">Course Type</option>
                                                                <option value="Full Time - Class Room">Full Time - Class Room</option>
                                                                <option value="Part Time - Class Room">Part Time - Class Room</option>
                                                                <option value="Distance / Correspondence">Distance / Correspondence</option>
                                                                <option value="Executive">Executive</option>
                                                                <option value="Online / E-Learning">Online / E-Learning</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <p class="edu_header">Class 12th</p>
                                                    <div class="form-group">
                                                        <div class="col-sm-2">
                                                            <input type="text" name="twelth_subjects" class="form-control" id="twelth_subjects" placeholder="Fill Main 3 Subjects">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="twelth_school" id="twelth_school" placeholder="School Name">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="twelth_board" name="twelth_board">
                                                                <option value="">Select Board</option>
                                                                <option value="ICSE">ICSE</option>
                                                                <option value="CBSE">CBSE</option>
                                                                <option value="State Board">State Board</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="twelth_passing_year" name="twelth_passing_year">
                                                                <option value="">Passing Year</option>
                                                                <option value="2020">2020</option>
                                                                <option value="2019">2019</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2014">2014</option>
                                                                <option value="2013">2013</option>
                                                                <option value="2012">2012</option>
                                                                <option value="2011">2011</option>
                                                                <option value="2010">2010</option>
                                                                <option value="2009">2009</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2007">2007</option>
                                                                <option value="2006">2006</option>
                                                                <option value="2005">2005</option>
                                                                <option value="2004">2004</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2001">2001</option>
                                                                <option value="2000">2000</option>
                                                                <option value="1999">1999</option>
                                                                <option value="1998">1998</option>
                                                                <option value="1997">1997</option>
                                                                <option value="1996">1996</option>
                                                                <option value="1995">1995</option>
                                                                <option value="1994">1994</option>
                                                                <option value="1993">1993</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control" name="twelth_marks" id="twelth_marks" placeholder="Marks(%)">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select class="form-control" id="twelth_mode" name="twelth_mode">
                                                                <option value="">Course Type</option>
                                                                <option value="Full Time - Class Room">Full Time - Class Room</option>
                                                                <option value="Part Time - Class Room">Part Time - Class Room</option>
                                                                <option value="Distance / Correspondence">Distance / Correspondence</option>
                                                                <option value="Executive">Executive</option>
                                                                <option value="Online / E-Learning">Online / E-Learning</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="appresponse"></div>
                                    <button type="button" name="applicationsubmit" id="applicationsubmit" class="btn btn-theme">Apply & Next</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab">
                            <h3> Submit Payment </h3>
                            <div class="col-md-12" style="margin: 0 0 30px 0;">
                                <article class="contact-form col-md-8 col-sm-7  page-row" style="text-align: left;">
                                    <form id="paymentform" name="paymentform" action="payumoney/checkpayumoney" method="POST">
                                        <!--
                                <input type="hidden" name="key" id="merchant_key" value="YMm0H9BB" />
                                <input type="hidden" name="hash" id="merchant_hash" value="WKQIZb2Mj7"/>
                                <input type="hidden" name="txnid" id="txnid" value="451248547" />
                            -->
                                        <input type="hidden" name="student_master" id="student_master" value="" />
                                        <input type="hidden" name="student_detail" id="student_detail" value="" />
                                        <input type="hidden" name="school_detail" id="school_detail" value="" />

                                        <div class="form-group name">
                                            <label for="name">Name</label>
                                            <input id="payuname" name="payuname" type="text" class="form-control" placeholder="Enter your name" value="" required="required" readonly>
                                        </div>
                                        <!--//form-group-->
                                        <div class="form-group email">
                                            <label for="email">Email<span class="required">*</span></label>
                                            <input id="payuemail" name="payuemail" type="email" class="form-control" placeholder="Enter your email" value="" required="required" readonly>
                                        </div>
                                        <!--//form-group-->
                                        <div class="form-group phone">
                                            <label for="phone">Phone</label>
                                            <input id="payuphone" name="payuphone" type="phone" class="form-control" placeholder="Enter your contact number" value="" required="required" readonly>
                                        </div>
                                        <div class="form-group phone">
                                            <label for="phone">Total Amount</label>
                                            <input id="payupamount" type="text" name="payupamount" class="form-control" placeholder="Total Amount" value="" required="required" readonly>

                                        </div>
                                        <div class="form-group message">
                                            <div id="payuresponse" style="background-color: #eaeaea;"></div>
                                        </div>
                                        <!--//form-group-->
                                        <input type="hidden" name="action" id="action" value="paymentformsubmit">
                                        <input id="payselectedclass" name="payselectedclass" type="hidden">
                                        <input id="payselectedcourse" name="payselectedcourse" type="hidden">
                                        <div class="panel-body">
                                            <div class="col-md-2">
                                                <input type="radio" name="merchant" onclick="changepaymenturl('paytm/checkpaytm')" class="paymentoptionsRadios" value="2">
                                            </div>
                                            <div class="col-md-4">
                                                <img src="assets/images/paytm_logo.png" alt="Paytm" width="75" height="35" style="margin: -8px 0 0 -42px;">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="radio" onclick="changepaymenturl('payumoney/checkpayumoney')" name="merchant" class="paymentoptionsRadios" value="1" checked="">
                                            </div>
                                            <div class="col-md-4">
                                                <img src="assets/images/payu_logo.png" alt="" width="75" height="35" style="margin: -8px 0 0 -42px;">
                                            </div>

                                        </div>
                                        <input type="submit" name="submit" id="submit" class="btn btn-theme " value="Pay Now">
                                    </form>
                                </article>
                            </div>
                        </div>
                        <div>
                            <div style="float:right;margin: -16px 0 0 0;">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" style="display: none;">Previous</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)" style="display: none;">Next</button>
                            </div>
                        </div>

                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $(function() {
                $("#basiccontactform").validate({
                    rules: {
                        name: {
                            required: true
                        },
                        phone: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            digits: true
                        },
                        email: {
                            required: true,
                            email: true
                        }

                    },
                    messages: {
                        name: {
                            required: "Please enter your name."
                        },
                        phone: {
                            required: "Please enter your phone number."
                        },
                        email: {
                            required: "Please enter your email address."
                        }
                    },
                });
            });
            $(function() {
                $("#applicationform").validate({
                    rules: {
                        id_name: {
                            required: true
                        },
                        id_mobile: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            digits: true
                        },
                        alt_mobile: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            digits: true
                        },
                        id_email: {
                            required: true,
                            email: true
                        }

                    },
                    messages: {
                        id_name: {
                            required: "Please enter your name."
                        },
                        id_mobile: {
                            required: "Please enter your phone number."
                        },
                        alt_mobile: {
                            required: "Please enter your phone number."
                        },
                        id_email: {
                            required: "Please enter your email address."
                        }
                    },
                });
            });
        </script>
        <script src="assets/js/multistep.js"></script>
        <script>
            window.setInterval(function() {
                $('#slidelogchange').click();
            }, 3000);
           
        </script>
        <script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "none";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>