<?php
function get_captch_id(){
	if(get_option('ptthemes_antispam_dislay')=='Yes'){$cap_num = ((strlen(get_option('admin_email')) * date("z"))) + date("z"); $cap_secure = 'cap_'.$cap_num;}else{$cap_secure='anti_captcha';}
	return $cap_secure;
}
function pt_get_captch()
{
	global $captchaimagepath;
	$captchaimagepath = get_bloginfo('template_url').'/library/captcha/';
	$cap_secure = get_captch_id();
?>
<h5 class="form_title"><?php echo CAPTCHA_TITLE_TEXT;?></h5> 
<div class="form_row clearfix">
<label><?php _e(CAPTCHA);?></label>
<input type="text" id="<?php echo $cap_secure; ?>" name="<?php echo $cap_secure; ?>"  size="6" maxlength="6" class="captcha textfield textfield_m" /> 
<input type="text" name="go_captcha"  size="6" maxlength="6" class="captcha textfield textfield_m" style="display:none"/> 
<img src="<?php bloginfo('template_url');?>/library/captcha/captcha.php" alt="captcha image" />
<?php if(isset($_REQUEST['emsg']) && $_REQUEST['emsg']=='captch'){echo '<br /><span class="message_error2" id="category_span">'.__('Please enter valid Verification code.').'</span>';}?>
</div>
<?php
}
function pt_get_captch_app()
{
	global $captchaimagepath;
	$captchaimagepath = get_bloginfo('template_url').'/library/captcha/';
	$cap_secure = get_captch_id();
?>
<h2 class="title"><?php echo CAPTCHA_TITLE_TEXT;?></h2> 
<div class="box-white">
<p><label><img src="<?php bloginfo('template_url');?>/library/captcha/captcha.php" alt="captcha image" /></label>
<input type="text" id="<?php echo $cap_secure; ?>" name="<?php echo $cap_secure; ?>"  size="6" maxlength="6" class="captcha textfield textfield_m" /> 
<input type="text" name="go_captcha"  size="6" maxlength="6" class="captcha textfield textfield_m" style="display:none"/> 
</p>
<?php if(isset($_REQUEST['emsg']) && $_REQUEST['emsg']=='captch'){echo '<br /><span class="message_error2" id="category_span">'.__('Please enter valid Verification code.').'</span>';}?>
</div>
<?php
}
function pt_check_captch_cond()
{
	$cap_secure = get_captch_id();
	if($_SESSION[$cap_secure]==$_POST[$cap_secure] && $_POST[$cap_secure]!='')
	{ 
		return true;
	}
	else
	{ 
		return false;
	}	
}
?>