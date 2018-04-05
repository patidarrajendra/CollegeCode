<div class="colleges-listing">  
 <div class="container"> 
  <div class="row">
    <div class="col-md-12">
        <section class="comment-list">
          <p class="col-lists">College List</p> 
          <!-- First Comment -->
          
           <!-- First Comment -->
  
       <?php 
          
          foreach($colleges as $college) 
          { 
          ?>
          <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                  <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $college->image ?>" /> 
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><?php echo $college->college_name ?></div>                 
                    <!-- <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time> -->  
                  </header>
                  <div class="comment-post">
                    <p>
                      <?php echo substr($college->college_description,0,350)."...." ;?> 
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>
         <?php 
          }
          
         ?> 
        

    <?php /*      <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/college1.jpg" />  
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user">BM Group of Colleges Indore</div>
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>

          <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/college2.jpg" />   
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user">P.M.B. Gujarati Arts College Indore</div>
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>

          <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/placements1.jpg" /> 
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user">MB Khalsa College Indore</div> 
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>

          <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/placements2.jpg" /> 
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user">Christian Eminent College Indore</div> 
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>

          <article class="row">           
            <div class="col-md-2 col-sm-2 hidden-xs"> 
              <figure class="">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/placements3.jpg" />                                          
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user">Akshay Academy College Indore</div>
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                  </div>
                  <p class="text-right"><a href="<?php echo base_url();?>front/college-details" class="btn btn-primary">Read More</a></p> 
                </div>
              </div>
            </div>
          </article>
 */?>
         

        </section>
    </div>
  </div>
</div>
</div>