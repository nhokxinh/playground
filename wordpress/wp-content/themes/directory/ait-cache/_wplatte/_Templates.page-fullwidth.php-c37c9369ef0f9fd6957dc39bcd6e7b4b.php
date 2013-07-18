<?php //netteCache[01]000471a:2:{s:4:"time";s:21:"0.31786900 1374060550";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:82:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/page-fullwidth.php";i:2;i:1374053474;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/page-fullwidth.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'i1qg2sf955')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb2562f32d35_content')) { function _lb2562f32d35_content($_l, $_args) { extract($_args)
?>
<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

	<header class="entry-header">
		
		<h1 class="entry-title">
			<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="Permalink to <?php echo htmlSpecialChars($post->title) ?>
" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
		</h1>

	</header>
	
<?php if ($post->thumbnailSrc): ?>
	<a href="<?php echo $post->thumbnailSrc ?>">
		<div class="entry-thumbnail"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $post->thumbnailSrc, 'w' => 140, 'h' => 200), "", "&amp;") ?>" alt="" /></div>
	</a>
<?php endif ?>

	<div class="entry-content">
		<?php echo $post->content ?>

	</div>

</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->

<?php NCoreMacros::includeTemplate("comments.php", array('closeable' => $themeOptions->general->closeComments, 'defaultState' => $themeOptions->general->defaultPosition) + $template->getParams(), $_l->templates['i1qg2sf955'])->render() ?>

<?php if (isset($themeOptions->advertising->showBox4)): ?>
<div id="advertising-box-4" class="advertising-box">
    <?php echo $themeOptions->advertising->box4Content ?>

</div>
<?php endif ?>

<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = true; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$_l->extends = $layout ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
