<?php //netteCache[01]000479a:2:{s:4:"time";s:21:"0.21316500 1374054153";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:90:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/snippets/nothing-found.php";i:2;i:1374053480;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/snippets/nothing-found.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'ukn4myjpz7')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><span><?php echo NTemplateHelpers::escapeHtml(__('Nothing Found', 'ait'), ENT_NOQUOTES) ?></span></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php echo NTemplateHelpers::escapeHtml(__('Apologies, but no results were found for the request. Perhaps searching will help find a related post.', 'ait'), ENT_NOQUOTES) ?></p>
<?php NCoreMacros::includeTemplate("search-form.php", $template->getParams(), $_l->templates['ukn4myjpz7'])->render() ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 -->