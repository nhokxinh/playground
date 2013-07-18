<?php //netteCache[01]000479a:2:{s:4:"time";s:21:"0.28440600 1373037110";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:90:"D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\post-type-ait-dir-item.php";i:2;i:1372205918;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\post-type-ait-dir-item.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'br93hvlw8d')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb53128e234_content')) { function _lbb53128e234_content($_l, $_args) { extract($_args)
?>

<article id="post-item-category">

	<header class="entry-header">
	
		<h1 class="entry-title">
			<span><?php echo $term->name ?></span>
			<span style="float:right">
				<a style="padding:0" href="#" id="list-view" title="Xem danh sách">
					<img src="<?php echo get_template_directory_uri() ?>/design/img/default-category-icon.png" />
				</a>
				<a style="padding:0" href="#" id="map-view" title="Xem bản đồ">
					<img style="height:35px" src="<?php echo get_template_directory_uri() ?>/design/img/map-icon/default.png" />
				</a>
			</span>
		</h1>

		<div class="category-breadcrumb clearfix">
			<span class="here"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?></span>
			<span class="home"><a href="<?php echo $homeUrl ?>"><?php echo NTemplateHelpers::escapeHtml(__('Trang Chủ', 'ait'), ENT_NOQUOTES) ?></a>&nbsp;&nbsp;&gt;</span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($ancestors) as $anc): ?>
			<?php if ($iterator->isFirst()): ?><span class="ancestors"><?php endif ?>

				<a href="<?php echo $anc->link ?>"><?php echo $anc->name ?></a>&nbsp;&nbsp;&gt;
			<?php if ($iterator->isLast()): ?></span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
			<span class="name"><a href="<?php echo $term->link ?>"><?php echo $term->name ?></a></span>
			
			<?php $idx = 0; $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($tax_queries) as $tax): ?>
				<?php if ($iterator->isFirst()): ?>&nbsp;&nbsp;&gt;<span class="predecessors"><?php endif ?>

					<a href="<?php echo $tax->link ?>"><?php echo $tax->name ?></a>
<?php if ($idx < count($tax_queries) - 1): ?>
						&nbsp;&#124;
<?php endif ?>
					<?php $idx++ ?>
				<?php if ($iterator->isLast()): ?></span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		</div>

	</header>

	<div id="directory-main-bar" data-category="<?php echo htmlSpecialChars($mapCategory) ?>
" data-location="<?php echo htmlSpecialChars($mapLocation) ?>" data-search="<?php echo htmlSpecialChars($mapSearch) ?>
" data-geolocation="<?php if (isset($isGeolocation)): ?>true<?php else: ?>false<?php endif ?>">
    </div>
<?php NCoreMacros::includeTemplate('snippets/map-javascript.php', $template->getParams(), $_l->templates['br93hvlw8d'])->render() ?>

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

</article><!-- /#post-item-category -->

<?php if (isset($themeOptions->advertising->showBox4)): ?>
<div id="advertising-box-4" class="advertising-box">
    <?php echo $themeOptions->advertising->box4Content ?>

</div>
<?php endif ?>

<script type="text/javascript">
	jQuery(function(){
		jQuery('div#directory-main-bar').hide();
		jQuery('a#list-view').click(function(){
			mapCenter = map.getCenter();
			mapZoom = map.getZoom();
			jQuery('div#directory-main-bar').hide();
			jQuery('div.category-items').show();
			jQuery('nav.paginate-links').show();
		});
		
		jQuery('a#map-view').click(function(){
			jQuery('div#directory-main-bar').show();
			jQuery('div.category-items').hide();
			jQuery('nav.paginate-links').hide();
			google.maps.event.trigger(map, "resize");
			map.setZoom(mapZoom);
			map.setCenter(mapCenter);
		});
	});
</script>

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
