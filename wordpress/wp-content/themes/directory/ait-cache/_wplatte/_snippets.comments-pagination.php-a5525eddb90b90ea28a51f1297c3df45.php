<?php //netteCache[01]000501a:2:{s:4:"time";s:21:"0.09294600 1372071785";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:111:"/Users/longlc/Sites/playground/wordpress/wp-content/themes/directory/Templates/snippets/comments-pagination.php";i:2;i:1372069802;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /Users/longlc/Sites/playground/wordpress/wp-content/themes/directory/Templates/snippets/comments-pagination.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'q1jez14cyb')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($post->willCommentsPaginate): ?>
<nav id="comment-nav-<?php echo htmlSpecialChars($location) ?>">

	<?php ob_start() ?> <?php echo NTemplateHelpers::escapeHtml(__('&larr; Older Comments', 'ait'), ENT_NOQUOTES) ?>
 <?php $prev = ob_get_clean() ?>

	<?php ob_start() ?> <?php echo NTemplateHelpers::escapeHtml(__('Newer Comments &rarr;', 'ait'), ENT_NOQUOTES) ?>
 <?php $next = ob_get_clean() ?>


	<div class="nav-previous"><?php previous_comments_link($prev) ?></div>
	<div class="nav-next"><?php next_comments_link($next) ?></div>
</nav>
<?php endif ;
