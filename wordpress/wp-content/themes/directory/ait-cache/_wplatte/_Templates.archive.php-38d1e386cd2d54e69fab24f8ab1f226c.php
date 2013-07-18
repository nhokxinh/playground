<?php //netteCache[01]000464a:2:{s:4:"time";s:21:"0.64569600 1372953832";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\archive.php";i:2;i:1372205918;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\archive.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'gh3qqytpfw')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb1638dc716d_content')) { function _lb1638dc716d_content($_l, $_args) { extract($_args)
?>

<?php if ($posts): ?>

<?php if ($type): ?>

		<article>

				<header class="entry-header">

					<h1 class="entry-title">
						<span><?php echo NTemplateHelpers::escapeHtml(__('Search result', 'ait'), ENT_NOQUOTES) ?></span>
					</h1>

				</header>

		</article>

<?php NCoreMacros::includeTemplate("snippets/content-loop-dir-search.php", array('posts' => $posts) + $template->getParams(), $_l->templates['gh3qqytpfw'])->render() ?>

<?php if($GLOBALS["wp_query"]->max_num_pages > 1): ?>
		<nav class="paginate-links">
			<?php echo WpLatteFunctions::paginateLinks(true) ?>

		</nav>
<?php endif ?>

<?php else: ?>

		<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

				<header class="entry-header">

					<h1 class="entry-title">
						<span>
<?php if ($archive->isDay): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Daily Archives:', 'ait'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, $site->dateFormat), ENT_NOQUOTES) ?></span>
<?php elseif ($archive->isMonth): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Monthly Archives:', 'ait'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, 'F Y'), ENT_NOQUOTES) ?></span>
<?php elseif ($archive->isYear): ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Yearly Archives:', 'ait'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml($template->date($posts[0]->date, 'Y'), ENT_NOQUOTES) ?></span>
<?php else: ?>
							<?php echo NTemplateHelpers::escapeHtml(__('Blog Archives', 'ait'), ENT_NOQUOTES) ?>

<?php endif ?>
						</span>
					</h1>

				</header>

		</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->


<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['gh3qqytpfw'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['gh3qqytpfw'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['gh3qqytpfw'])->render() ?>

<?php endif ?>

<?php if (isset($themeOptions->advertising->showBox4)): ?>
	<div id="advertising-box-4" class="advertising-box">
	    <?php echo $themeOptions->advertising->box4Content ?>

	</div>
<?php endif ?>

<?php else: ?>

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['gh3qqytpfw'])->render() ?>

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
