<?php //netteCache[01]000470a:2:{s:4:"time";s:21:"0.40196600 1372945144";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:81:"D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\page-dir-home.php";i:2;i:1372205918;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\page-dir-home.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'gxxxhhlufx')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbc6464c5b64_content')) { function _lbc6464c5b64_content($_l, $_args) { extract($_args)
?>

<?php if ($post->options('header')->headerType == 'map'): NCoreMacros::includeTemplate('snippets/map-javascript.php', $template->getParams(), $_l->templates['gxxxhhlufx'])->render() ;endif ?>

<div id="home-slider-wrapper" style="margin-left:-5%;margin-top:-11%;width:107%;margin-bottom:5%">
<?php putRevSlider($headerSlider) ?>
</div>

<script type="text/javascript">
	jQuery(function(){
		jQuery("div#home-slider-wrapper *").css("z-index","0");
	});
</script>

<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

	<header class="entry-header">
		
		<h1 class="entry-title">
			<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="<?php echo htmlSpecialChars(__('Permalink to', 'ait')) ?>
 <?php echo htmlSpecialChars($post->title) ?>" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
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
	
	<div class="category-items clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($posts) as $item): ?>
		<ul class="items">
			<li class="item clear<?php if (isset($item->packageClass)): ?> <?php echo htmlSpecialChars($item->packageClass) ;endif ?>">
<?php if ($item->thumbnailDir): ?>
				<div class="thumbnail">
					<img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $item->thumbnailDir, 'w' => 100, 'h' => 100), "", "&amp;") ?>
" alt="<?php echo htmlSpecialChars(__('Item thumbnail', 'ait')) ?>" />
					<div class="comment-count"><?php echo NTemplateHelpers::escapeHtml($item->commentsCount, ENT_NOQUOTES) ?></div>
				</div>
<?php endif ?>
				
				<div class="description">
					<h3>
						<a href="<?php echo $item->link ?>"><?php echo NTemplateHelpers::escapeHtml($item->title, ENT_NOQUOTES) ?></a>
<?php if ($item->rating): ?>
						<span class="rating">
<?php for ($i = 1; $i <= $item->rating['max']; $i++): ?>
								<span class="star<?php if ($i <= $item->rating['val']): ?> active<?php endif ?>"></span>
<?php endfor ?>
						</span>
<?php endif ?>
					</h3>
					<?php echo $item->excerpt ?>

				</div>
			</li>
		</ul>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</div>
	
<?php if($GLOBALS["wp_query"]->max_num_pages > 1): ?>
	<nav class="paginate-links">
		<?php echo WpLatteFunctions::paginateLinks(true) ?>

	</nav>
<?php endif ?>
	
<?php if ($themeOptions->directory->dirHomepageAltContent): ?>
	<div class="alternative-content">
		<?php echo $themeOptions->directory->dirHomepageAltContent ?>

	</div>
<?php endif ?>

</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->

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
