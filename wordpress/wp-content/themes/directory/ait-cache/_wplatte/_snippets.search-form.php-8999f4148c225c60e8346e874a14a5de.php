<?php //netteCache[01]000493a:2:{s:4:"time";s:21:"0.90394400 1372070634";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:103:"/Users/longlc/Sites/playground/wordpress/wp-content/themes/directory/Templates/snippets/search-form.php";i:2;i:1372069803;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /Users/longlc/Sites/playground/wordpress/wp-content/themes/directory/Templates/snippets/search-form.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '386w8nw213')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<form method="get" id="searchform" action="<?php echo htmlSpecialChars($homeUrl) ?>">
	<label for="s" class="assistive-text"><?php echo NTemplateHelpers::escapeHtml(_x('Search', 'assistive-text', 'ait'), ENT_NOQUOTES) ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php echo htmlSpecialChars(_x('Search', 'search field placeholder', 'ait')) ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php echo htmlSpecialChars(_x('Search', 'search button text', 'ait')) ?>" />
</form>
