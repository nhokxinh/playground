<?php //netteCache[01]000487a:2:{s:4:"time";s:21:"0.80098700 1371751461";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:98:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/taxonomy-ait-dir-item-location.php";i:2;i:1371724946;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/taxonomy-ait-dir-item-location.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'ue4g29rh8m')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb3bd37d0c9d_content')) { function _lb3bd37d0c9d_content($_l, $_args) { extract($_args)
?>

<article id="post-item-category">

	<header class="entry-header">
	
		<h1 class="entry-title">
			<span><?php echo $term->name ?></span>
		</h1>

		<div class="category-breadcrumb clearfix">
			<span class="here"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?></span>
			<span class="home"><a href="<?php echo $homeUrl ?>"><?php echo NTemplateHelpers::escapeHtml(__('Home', 'ait'), ENT_NOQUOTES) ?></a>&nbsp;&nbsp;&gt;</span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($ancestors) as $anc): ?>
			<?php if ($iterator->isFirst()): ?><span class="ancestors"><?php endif ?>

				<a href="<?php echo $anc->link ?>"><?php echo $anc->name ?></a>&nbsp;&nbsp;&gt;
			<?php if ($iterator->isLast()): ?></span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
			<span class="name"><a href="<?php echo $term->link ?>"><?php echo $term->name ?></a></span>
		</div>

	</header>

	<div class="entry-content">
		<?php echo $term->description ?>

	</div>

	<div class="category-subcategories clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($subcategories) as $category): ?>
		<?php if ($iterator->isFirst()): ?><ul class="subcategories"><?php endif ?>

			<li class="category">
				<div class="category-wrap-table">
					<div class="category-wrap-row">
						<div class="icon" style="background: url('<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $category->icon, 'w' => 35, 'h' => 35), "", "&amp;") ?>') no-repeat center top;"></div>
						<div class="description">
							<h3><a href="<?php echo $category->link ?>"><?php echo $category->name ?></a></h3>
							<?php echo $category->excerpt ?>

						</div>
					</div>
				</div>
			</li>
		<?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</div>

	<hr />

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
