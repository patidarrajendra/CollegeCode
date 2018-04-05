<?php 
  // echo "<pre>";
  // print_r($data);
 
  // die;
 
 ?>

    <center><h1>Please do not refresh this page...</h1></center>
        <form method="post" action="https://pguat.paytm.com/oltp-web/processTransaction <?php  //echo  $data['action'] ?>" name="f1">
          <!--   <input type="hidden" name="MID" value="<?php echo $MID ?>" />
            <input type="hidden" name="ORDERID" value="<?php echo $ORDERID ?>" /> 
            <input type="hidden" name="TXNID" value="<?php echo $TXNID ?>" />
                
            <input type="hidden" name="TXNAMOUNT" value="<?php echo  $TXNAMOUNT ?>"  />
            <input type="hidden" name="CURRENCY" value="<?php echo  $CURRENCY ?>"  />
            <input type="hidden" name="BANKTXNID" value="<?php echo  $BANKTXNID ?>"  />
            <input  type="hidden" name="name" id="firstname" value="<?php echo $name ?>" />
            <input  type="hidden" name="email" id="email" value="<?php echo $mailid ?>" />
            <input  type="hidden" name="phone" value="<?php echo $phoneno ?>"  />
            
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>"> -->

                <table border="1">
                    <tbody>
                    <?php
                    foreach($data as $name => $value) {
                        echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                    }
                    ?>
                    <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
                    </tbody>
                </table>
                 
               
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </form>