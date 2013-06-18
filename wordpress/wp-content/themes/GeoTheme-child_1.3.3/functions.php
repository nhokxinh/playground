<?php 
################################# FIX IE 7 bugs #############################################
add_action( 'wp_head', 'ie_conditional' );
if (!function_exists('ie_conditional')) {
function ie_conditional()
{
echo "
<!--[if IE 7]>
<style>
#sidebar { margin-top:-16px;}
body.home #sidebar { margin-top:0px;}
#plusone-div {padding: 0 0 10px !important;} 
#plusone-div {position:absolute;margin:12px 0 0 0 !important;display:inline;padding: 0 0 10px !important;}
</style>
<![endif]-->
<!--[if IE 8]>
<style>
#plusone-div {position:absolute;margin:12px 0 0 0 !important;display:inline;padding: 0 0 10px !important;}
</style>
<![endif]-->
";
}}
################################# END FIX FOR FACEBOOK LIKE THUMB URL ##########################################
?>
