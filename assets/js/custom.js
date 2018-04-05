 var category=[];//['category','level'];
 var level = [];

  var student10 = new Array(); 
  var student12 = new Array(); 
  var student_master = new Array();
  var student_detail = new Array();
  var school_detail = new Array();
  var feeamount = 0;
 function ajax_func(id,controller,div_id,sectionname,categoryid=""){
   
   if(sectionname=='category')
      category[0]= id;
      // student_master.push({category_id:id});
    //student_master['category_id']=id;
         
   if(sectionname=='level')
      level[0]= id;
       //student_master.push({level_id:id});
    $.ajax({
         url: controller,
         type: 'POST',
         data:{
             key:id,category_id:categoryid
         },
         success: function(data)
         {
            
            $('#'+div_id).html(data);
            $('#nextBtn').click();
            //skipscreen(3);
             
         },
       }); 
   
 }

function skipscreen(n) {
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



 $("#collegelistapply").click(function(){

     var legchecked = $('input[class^=checkbox_check]:checked').length;
     if(legchecked==0)
      {
        alert('Please select at least one college');
        return false;
      } 
      feeamount = 0;
      var collegearr= new Array();
      $("input:checkbox").each(function(){
        var $this=$(this);
        if($this.is(':checked'))
        {
            student_master.push({category_id:category[0],level_id:level[0],college_id:$this.attr("id"),college_amount:$this.data("price"),stream_id:''});
            //collegearr.push({});
            /* To get Stream on apply form */ 
             feeamount += parseInt($this.data("price"));
             collegeid=$this.attr("id");
            ajax_func(collegeid,$(this).data("controller"),'course_stream','','');
 /*           $.ajax({
                   url: $(this).data("controller"),
                   type: 'POST',
                   data:{
                       key:$this.attr("id")
                   },
                   success: function(data)
                   {

                      $('#'+div_id).html(data);
                      $('#nextBtn').click();
                      //skipscreen(3);
                       
                   },
                 }); 
   */
             
           
        }
      });
      console.log(student_master);
      //student_master.push({college:collegearr}); 

 
      //$('#nextBtn').click();
 });
  
  $("#applicationsubmit").click(function(){
     
        if($("#course_stream").val()!="")
         {
          for(i=0 ;i<student_master.length;i++)
             student_master[i]['stream_id']= $("#course_stream").val();
         } 
          //student_master.pushcourse_stream
        //console.log(student_master);

       if($("#student_fullname").val()!="")
         student_detail.push({student_fullname:$("#student_fullname").val()});
       else
       {
         alert('Applicant name is required !');
         return
       }
       if($("#student_mobile").val()!="")
        student_detail.push({student_mobile:$("#student_mobile").val()});
       else
       {
         alert('Phone number is required !');
         return false;
       }
       if($("#alternate_phone").val()!="")
        student_detail.push({alternate_phone:$("#alternate_phone").val()});
       if($('input[name=student_gender]:checked').val()!="")
         student_detail.push({student_gender:$('input[name=student_gender]:checked').val()});
       if($('input[name=marital_status]:checked').val()!="")
        student_detail.push({marital_status:$('input[name=marital_status]:checked').val()});
       if($("#student_email").val()!="")
         student_detail.push({student_email:$("#student_email").val()}); 
       else
       {
         alert('Email-id is required !');
         return false;
       }
       if($("#student_dob").val()!="")
         student_detail.push({student_dob:$("#student_dob").val()});
       if($("#student_category").val()!="")
         student_detail.push({student_category:$("#student_category").val()});
       if($("#mother_tongue").val()!="")
         student_detail.push({mother_tongue:$("#mother_tongue").val()});
       if($('input[name=student_disability]:checked').val()!="")
         student_detail.push({student_disability:$('input[name=student_disability]:checked').val()});
       if($("#mother_tongue").val()!="")
          student_detail.push({mother_tongue:$("#mother_tongue").val()});
       if($("#student_address").val()!="") 
          student_detail.push({student_address:$("#student_address").val()});
       if($("#student_country").val()!="") 
          student_detail.push({student_country:$("#student_country").val()});
       if($("#student_state").val()!="") 
          student_detail.push({student_state:$("#student_state").val()});
       if($("#student_city").val()!="")  
          student_detail.push({student_city:$("#student_city").val()});
       if($("#student_postalcode").val()!="") 
          student_detail.push({student_postalcode:$("#student_postalcode").val()});
       if($("#annual_income").val()!="") 
          student_detail.push({annual_income:$("#annual_income").val()});
       if($("#annual_income").val()!="") 
          student_detail.push({parent_name:$("#parent_name").val()});
       if($("#parent_occupation").val()!="")  
          student_detail.push({parent_occupation:$("#parent_occupation").val()});
       if($("#entrance_exam").val()!="")   
          student_detail.push({entrance_exam:$("#entrance_exam").val()});
       if($("#entrance_examdate").val()!="")    
          student_detail.push({entrance_examdate:$("#entrance_examdate").val()});
       if($("#entrance_exammarks").val()!="")    
          student_detail.push({entrance_exammarks:$("#entrance_exammarks").val()});
     
          
        school_detail.push({subject:$("#tenth_school").val(),school_name:$("#tenth_subjects").val(),board:$("#tenth_board").val(),  passing_year:$("#twelth_passing_year").val(),markes:$("#twelth_marks").val(),course_type:$("#tenth_mode").val()});
        school_detail.push({subject:$("#twelth_school").val(),school_name:$("#twelth_subjects").val(),board:$("#twelth_board").val(),  passing_year:$("#twelth_passing_year").val(),markes:$("#twelth_marks").val(),course_type:$("#twelth_mode").val()});
 
        $("#student_master").val(JSON.stringify(student_master));
        $("#student_detail").val(JSON.stringify(student_detail));
        $("#school_detail").val(JSON.stringify(school_detail));
        $("#payuname").val($("#student_fullname").val());
        $("#payuemail").val($("#student_email").val());
        $("#payuphone").val($("#student_mobile").val());
        $("#payupamount").val(feeamount);
        $("#paytmamount").val(feeamount);
        $('#nextBtn').click();
  }); 

 function paymentprocess()
 {
    $.ajax({
         url: 'payumoney/paymentprocess',
         type: 'POST',
         data:{
             key:id
         },
         success: function(data)
         {
            $('#'+div_id).html(data);
            $('#nextBtn').click();
         },
       }); 
 } 
 function changepaymenturl(control_fun)
 {
  
      $("#paymentform").attr('action',control_fun);
 }
 
 $("#counselling_submit").click(function(event)
 {
       if($("#conseling_name").val()=="")
       {
         alert('Student name is required !');
          event.preventDefault();
       }
       else
       if($("#parent_name").val()!="")
       {
         alert('Parents name is required !');
         event.preventDefault();
       }
       else
       if($("#conseling_email").val()=="")
       {
         alert('Email-id is required !');
          event.preventDefault();
       }
       else
       if($("#parent_mobile").val()=="")
       {
         alert('Parents mobile number is required !');
          event.preventDefault();
       }
       else
       if($("#conseling_mobile").val()=="")
       {
         alert('mobile number is required !');
          event.preventDefault();
       }
       else
       if(!$("#agree_check").is(':checked'))
       {
         alert('Please mark checked in checkbox !');
         event.preventDefault();
       }  
      
       
        
 
 });
 $("#conseling_name").keyup(function(){
 
   $("#studentnameagree").text( $("#conseling_name").val());
 });



//console.log(student_master);
//console.log(student_detail);
console.log(school_detail);

