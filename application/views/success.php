<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Payment</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-label">You are here:</li>
                    <li><a href="index-2.html">Home</a><i class="fa fa-angle-right"></i></li>
                    <li class="current">Payment</li>
                </ul>
            </div><!--//breadcrumbs-->
        </header> 
        <div class="page-content">
            <div class="row page-row">
                  <div class="news-wrapper col-md-12 col-sm-7">    
                    <article class="news-item page-row has-divider clearfix row">       
                        <figure class="thumb col-md-2 col-sm-3 col-xs-4">
                            <img class="img-responsive" src="assets/images/news/news-thumb-1.jpg" alt="" />
                        </figure>
                        <div class="details col-md-10 col-sm-9 col-xs-8">
                            <h3 class="title"><p>Thank You. Your order status is <?php  echo  $status ?></p></h3>
                            <p>Your Transaction ID for this transaction is. <?php echo $txnid; ?> </p>
                            <p>We have received a payment of Rs. <?php echo $amount; ?> </p>
                             
                        </div>
                    </article><!--//news-item-->
                   </div> 

                   <div class="news-wrapper col-md-12 col-sm-7">    
                    <article class="news-item page-row has-divider clearfix row">  
                        <figure class="thumb col-md-2 col-sm-3 col-xs-4">
                            <img class="img-responsive" src="assets/images/news/news-thumb-1.jpg" alt="" />
                        </figure>     
                        <div class="details col-md-10 col-sm-9 col-xs-8 timercount">
                            <p><a href="<?php echo base_url(); ?>" id="loadonclick">Click Here</a> to page load</p>
                            <input type="hidden" id="transferlink" value="<?php echo base_url(); ?>"></span>
                            <p> Autoload in <span id="timercount"></span> Seconds</p>
                        </div>
                    </article><!--//news-item-->
                   </div> 

            </div>
        </div>     
    </div>
</div>

<script>
$(window).ready( function() {

    var time = 20

    setInterval( function() {

         time--;
         
         $("#timercount").text(time);
              if (time === 0) {
               window.location.href = $('#transferlink').val();
          }    


    }, 1000 );

});
</script>
  
