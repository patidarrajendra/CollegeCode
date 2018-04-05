 

    	  <form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
            <input type="hidden" name="key" value="<?php echo $mkey ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $tid ?>" />
                
                <input type="hidden" name="amount" value="<?php echo  $amount ?>"  />
                <input  type="hidden" name="firstname" id="firstname" value="<?php echo $name ?>" />
                <input  type="hidden" name="email" id="email" value="<?php echo $mailid ?>" />
                <input  type="hidden" name="phone" value="<?php echo $phoneno ?>"  />
                <textarea  type="hidden" name="productinfo" readonly><?php echo $pinfo ?></textarea>
                <input  type="hidden" name="address1" value="<?php echo $address ?>" />     
            
                <input name="surl" value="<?php echo $sucess ?>" type="hidden" />
                <input name="furl" value="<?php echo  $failure ?>" type="hidden" />                             
                <input type="hidden" name="service_provider" value=""/> 
                <input name="curl" value="<?php echo $cancel ?>" type="hidden" />
             
             
        </form>                                  
                 
<script>
  $('form#payuForm').submit();
</script>