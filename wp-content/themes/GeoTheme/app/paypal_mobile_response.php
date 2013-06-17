<?php 
$paymentOpts = get_payment_optins('paypal');
$merchantid = $paymentOpts['merchantid'];
$returnUrl = $paymentOpts['returnUrl'];
$cancel_return = $paymentOpts['cancel_return'];
$notify_url = $paymentOpts['notify_url'];
$currency_code = get_currency_type();
global $payable_amount,$post_title,$last_postid;
$payable_amount = $_REQUEST['pay'];
$post_title = $_REQUEST['title'];
$last_postid = $_REQUEST['pid'];

?>
<form name="frm_payment_method" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="text" value="<?php echo $payable_amount;?>" name="amount"/>
<input type="text" value="<?php echo $returnUrl;?>&pid=<?php echo $last_postid;?>" name="return"/>
<input type="text" value="<?php echo $cancel_return;?>&pid=<?php echo $last_postid;?>" name="cancel_return"/>
<input type="text" value="<?php echo $notify_url;?>" name="notify_url"/>
<input type="text" value="_xclick" name="cmd"/>
<input type="text" value="<?php echo $post_title;?>" name="item_name"/>
<input type="text" value="<?php echo $merchantid;?>" name="business"/>
<input type="text" value="<?php echo $currency_code;?>" name="currency_code"/>
<input type="text" value="<?php echo $last_postid;?>" name="custom" />
<input type="text" name="no_note" value="1">
<input type="text" name="no_shipping" value="1">
<input type="submit" value="pay now"/>
</form>

<div class="wrapper" >
		<div class="clearfix container_message">
            	<center><h1 class="head2"><?php echo PAYPAL_MSG;?></h1></center>
         </div>
</div>
<script>
setTimeout("document.frm_payment_method.submit()",5000); 
</script> 