<?php //netteCache[01]000463a:2:{s:4:"time";s:21:"0.49257800 1371785039";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/author.php";i:2;i:1371744554;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/author.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'm1thgkhraf')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb271cb3b084_content')) { function _lb271cb3b084_content($_l, $_args) { extract($_args)
?>

<?php if ($posts): ?>
	
		<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

				<header class="entry-header">
		
					<h1 class="entry-title">
						 <?php echo NTemplateHelpers::escapeHtml(__('Author Archives:', 'ait'), ENT_NOQUOTES) ?>

		                <span class="vcard">
		                    <a class="url fn n" href="<?php echo htmlSpecialChars($author->postsUrl) ?>
" title="<?php echo htmlSpecialChars($author->name) ?>" rel="me"><?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?></a>
		                </span>
					</h1>
					
				</header>

<?php if (strlen($author->bio) !== 0): ?>
				<div class="entry-content">
					<div id="author-info" class="clearfix">
						<div id="author-avatar" class="left"><?php echo $author->avatar(60) ?></div>
						<div id="author-description" class="left">
							<div class="author-name"><?php echo NTemplateHelpers::escapeHtml(_x('About', 'about author', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?></div>
							<div class="bio"><?php echo NTemplateHelpers::escapeHtml($author->bio, ENT_NOQUOTES) ?></div>
						</div>
					</div>
				</div>
<?php endif ?>
				
		</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->	


<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['m1thgkhraf'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['m1thgkhraf'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['m1thgkhraf'])->render() ?>

<?php if (isset($themeOptions->advertising->showBox4)): ?>
	<div id="advertising-box-4" class="advertising-box">
	    <?php echo $themeOptions->advertising->box4Content ?>

	</div>
<?php endif ?>

<?php else: ?>

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['m1thgkhraf'])->render() ?>

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
