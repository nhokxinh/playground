<?php //netteCache[01]000463a:2:{s:4:"time";s:21:"0.43648800 1373381597";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:74:"D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\search.php";i:2;i:1372205918;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\search.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '19b1jy7jin')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbc8114a5378_content')) { function _lbc8114a5378_content($_l, $_args) { extract($_args)
?>

<?php if ($posts): ?>
	
	<header class="entry-header">
		<h1 class="entry-title"><span><?php echo NTemplateHelpers::escapeHtml(__('Search Results for:', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($site->searchQuery, ENT_NOQUOTES) ?></span></h1>
	</header>

<?php if ($type): ?>
		
<?php NCoreMacros::includeTemplate("snippets/content-loop-dir-search.php", array('posts' => $posts) + $template->getParams(), $_l->templates['19b1jy7jin'])->render() ?>

<?php else: ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['19b1jy7jin'])->render() ?>

<?php endif ?>

<?php if($GLOBALS["wp_query"]->max_num_pages > 1): ?>
	<nav class="paginate-links">
		<?php echo WpLatteFunctions::paginateLinks(true) ?>

	</nav>
<?php endif ?>

<?php if (isset($themeOptions->advertising->showBox4)): ?>
	<div id="advertising-box-4" class="advertising-box">
	    <?php echo $themeOptions->advertising->box4Content ?>

	</div>
<?php endif ?>

<?php else: ?>

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['19b1jy7jin'])->render() ?>

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
