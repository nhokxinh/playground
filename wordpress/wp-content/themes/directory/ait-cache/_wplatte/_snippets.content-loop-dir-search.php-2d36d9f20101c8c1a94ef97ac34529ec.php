<?php //netteCache[01]000490a:2:{s:4:"time";s:21:"0.05292100 1372953833";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:100:"D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\snippets\content-loop-dir-search.php";i:2;i:1372205918;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: D:\wamp\www\2tpro\pg\html\wp-content\themes\directory\Templates\snippets\content-loop-dir-search.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '4r0g1arfkt')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($posts) as $item): if ($iterator->isFirst()): ?>
<ul class="items"><?php endif ?>

	<li class="item clear<?php if (isset($item->packageClass)): ?> <?php echo htmlSpecialChars($item->packageClass) ;endif ?>">
<?php if ($item->thumbnailDir): ?>
		<div class="thumbnail">
			<img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $item->thumbnailDir, 'w' => 100, 'h' => 100), "", "&amp;") ?>
" alt="<?php echo htmlSpecialChars(__('Item thumbnail', 'ait')) ?>" />
			<div class="comment-count"><?php echo NTemplateHelpers::escapeHtml($item->comment_count, ENT_NOQUOTES) ?></div>
		</div>
<?php endif ?>
		
		<div class="description">
			<h3>
				<a href="<?php echo $item->link ?>"><?php echo NTemplateHelpers::escapeHtml($item->post_title, ENT_NOQUOTES) ?></a>
<?php if ($item->rating): ?>
				<span class="rating">
<?php for ($i = 1; $i <= $item->rating['max']; $i++): ?>
						<span class="star<?php if ($i <= $item->rating['val']): ?> active<?php endif ?>"></span>
<?php endfor ?>
				</span>
<?php endif ?>
			</h3>
			<?php echo $item->excerptDir ?>

		</div>
	</li>
<?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;
