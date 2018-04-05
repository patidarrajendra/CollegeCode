        <div class="ecounciling-form">  

            <div class="container">
                <div class="row">
                    <div class="modal-body1">
                      

                        <div > 
                            <h3> <b> e-Counselling Form </b> </h3> 
							<br>
                            <form id="conseling_form" action="<?php echo base_url() ?>paytm/checkpaytm" name="applicationform" method="POST" novalidate="novalidate">

                                

                                <div class="col-md-12" style="margin: 0 0 30px 0; text-align: left;" id="scrollforvalidate">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
										
                                            <div class="panel-heading panel-heading-bg">
                                                <h4 class="panel-title">
                                                    <a href="#" class="next-submit">1. Student Details</a>    	   
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse in">    
                                                <div class="panel-body">
                                                    
                                                    <div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Name of Student : <sup>*</sup></label>
                                                                <input type="text" name="student_name" class="form-control" id="conseling_name" placeholder="please enter the name" value=""> 
                                                            </div>

                                                             <div class="form-group">
                                                                <label for="applicant_name">Parents / Guardians Name : <sup>*</sup></label>
                                                                <input type="text" name="parent_name" class="form-control" id="parent_name" placeholder="please enter the name" value=""> 
                                                            </div>

                                                         
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email Address : <sup>*</sup></label>
                                                                <input type="email" name="email" class="form-control" id="conseling_email" placeholder="" value="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mobile">Parents / Guardians Mobile No : <sup>*</sup></label> 
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">+91</div>
                                                                    <input type="number" id="parent_mobile" name="parent_mobile" class="form-control" required="" value="">
                                                                </div>
                                                            </div>

                                                         
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="">
                                                            <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Mobile No : <sup>*</sup></label> 
                                                                <div class="input-group">  
                                                                    <div class="input-group-addon">+91</div>
                                                                    <input type="number" id="conseling_mobile" name="mobile" class="form-control" required="" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Age :</label>
                                                                <input class="form-control" id="" maxlength="100" name="age" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group" style="padding-top: 20px;">
                                                                <label for="gender" class="col-md-4">Gender :</label>

                                                                <label>
                                                                    <input type="radio" id="" value="MALE" name="gender" checked="checked"> Male
                                                                </label>
                                                                <label style="margin-left: 26px;">
                                                                    <input type="radio" id="" value="FEMALE" name="gender"> Female
                                                                </label>

                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Address">Address :</label> 
                                                            <textarea name="address" id="" class="form-control" rows="2" required=""></textarea>
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
                                                    <a href="#" class="next-submit">2. Class Xth Results: </a>
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Board : </label>
                                                                <!--<input class="form-control valid" id="" name="Xth_board" step="1" min="1" type="text" value="">--> 
                                                                <select class="form-control" id="" name="Xth_board">
	                                                                <option value="">Select Board</option>
	                                                                <option value="ICSE">ICSE</option>
	                                                                <option value="CBSE">CBSE</option>
	                                                                <option value="State Board">State Board</option>
	                                                                <option value="Others">Others</option>
                                                               </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Year : </label>
                                                                <select class="form-control" id="" name="Xth_year">
                                                                    <option value="" selected="selected">Select Year</option>
                                                                    <option value="">2012</option>
                                                                    <option value="">2013</option>
                                                                    <option value="">2014</option>
                                                                    <option value="">2015</option>
                                                                    <option value="">2016</option>
                                                                    <option value="">2017</option>
                                                                    <option value="">2018</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="postal_code">Roll No : </label>
                                                                <input class="form-control valid" id="" name="Xth_roll_no" step="1" min="1" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Percentage : </label>
                                                                <input class="form-control valid" id="" name="Xth_percentage" step="1" min="1" type="text" value="" placeholder="%">  
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
                                                    <a href="#" class="next-submit">3. Class XII th Results: </a>  
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Board : </label>
                                                                <!-- <input class="form-control valid" id="" name="XII_board" step="1" min="1" type="text" value="">-->
                                                                 <select class="form-control" id="" name="XII_board">
	                                                                <option value="">Select Board</option>
	                                                                <option value="ICSE">ICSE</option>
	                                                                <option value="CBSE">CBSE</option>
	                                                                <option value="State Board">State Board</option>
	                                                                <option value="Others">Others</option>
                                                               </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Year : </label>
                                                                <select class="form-control" id="" name="XII_year">
                                                                    <option value="" selected="selected">Select Year</option>
                                                                    <option value="">2012</option>
                                                                    <option value="">2013</option>
                                                                    <option value="">2014</option>
                                                                    <option value="">2015</option>
                                                                    <option value="">2016</option>
                                                                    <option value="">2017</option>
                                                                    <option value="">2018</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="postal_code">Roll No : </label>
                                                                <input class="form-control valid" id="" name="XII_roll_no" step="1" min="1" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Percentage : </label>
                                                                <input class="form-control valid" id="" name="XII_percentage" step="1" min="1" type="text" value="" placeholder="%">  
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Subject : </label> 
                                                                <input class="form-control valid" id="" name="XII_subject" step="1" min="1" type="text" value="" placeholder="">  
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
                                                    <a href="#" class="next-submit">4. Competition Exam: </a> 
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Name of the Examination : </label>
                                                                <input class="form-control valid" id="" name="competition_exam" step="1" min="1" type="text" value=""> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px">
                                                                <label for="correspondence_city">Year of Exam : </label>
                                                                
                                                                <select class="form-control" id="" name="competition_exam_year">
                                                                    <option value="" selected="selected">Select Year</option>
                                                                    <option value="">2012</option>
                                                                    <option value="">2013</option>
                                                                    <option value="">2014</option>
                                                                    <option value="">2015</option>
                                                                    <option value="">2016</option>
                                                                    <option value="">2017</option>
                                                                    <option value="">2018</option>
                                                                </select>
                                                           
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <div class="form-group" style="margin-left:10px"> 
                                                                <label for="postal_code">Enrollment No : </label>       
                                                                <input class="form-control valid" id="" name="enrollment_no" step="1" min="1" type="text" value=""> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="applicant_name">Rank/Score : </label>    
                                                                <input class="form-control valid" id="" name="score" step="1" min="1" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 sometxt"> 
                                              <label class="col-md-1">   
                                                    <input type="checkbox" id="agree_check" name="agree" value="50">
                                                     
                                              </label> 
                                              <label class="col-md-11">
                                                  <span> I </span><span id="studentnameagree"> </span><span> do hereby certify that the above mentioned information is true to my knowlegde and belief. </span>    
                                              </label>
                                        </div>  


										

								   </div>
                                    <div id="appresponse"></div>
                                    <div class="clearfix"></div>
                                    <input type= "hidden" value="conselling" name="screen">
                                    <input type="submit" onclick="checkconselingform()" name="submit" id="counselling_submit" class="btn btn-theme" value="Submit"> 
                                </div>
                            </form>
                        </div> 

                    </div>
                </div>
            </div>

        </div>

