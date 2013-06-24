<?php //netteCache[01]000478a:2:{s:4:"time";s:21:"0.17909600 1371819287";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:89:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/single-ait-dir-review.php";i:2;i:1371801498;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/single-ait-dir-review.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'xt8kkxn5pp')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4e85032845_content')) { function _lb4e85032845_content($_l, $_args) { extract($_args)
?>

<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

	<header class="entry-header">

		<h1 class="entry-title">
			<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="Permalink to <?php echo htmlSpecialChars($post->title) ?>
" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
<?php if ($rating): ?>
			<span class="rating">
<?php for ($i = 1; $i <= $rating['max']; $i++): ?>
					<span class="star<?php if ($i <= $rating['val']): ?> active<?php endif ?>"></span>
<?php endfor ?>
			</span>
<?php endif ?>
		</h1>
		
		<div class="category-breadcrumb clearfix">
			<span class="here"><?php echo NTemplateHelpers::escapeHtml(__('You are here', 'ait'), ENT_NOQUOTES) ?></span>
			<span class="home"><a href="<?php echo $homeUrl ?>"><?php echo NTemplateHelpers::escapeHtml(__('Home', 'ait'), ENT_NOQUOTES) ?></a>&nbsp;&nbsp;></span>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($ancestors) as $anc): ?>
				<?php if ($iterator->isFirst()): ?><span class="ancestors"><?php endif ?>

				<a href="<?php echo $anc->link ?>"><?php echo $anc->name ?></a>&nbsp;&nbsp;>
				<?php if ($iterator->isLast()): ?></span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
			<?php if (isset($term)): ?><span class="name"><a href="<?php echo $term->link ?>
"><?php echo $term->name ?></a></span><?php endif ?>

			<span class="title"> >&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></span>
		</div>

	</header>

	<div class="entry-content clearfix">
<?php if ($post->thumbnailSrc): ?>
		<div class="item-image">
			<img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $post->thumbnailSrc, 'w' => 140, 'h' => 200), "", "&amp;") ?>
" alt="<?php echo htmlSpecialChars(__('Item image', 'ait')) ?>" />
		</div>
<?php endif ?>
		
		<div class="item-info">

<?php if ('venue'): ?>
			<dl class="item-address">

				<dt class="title"><h4>
					<a href="<?php echo htmlSpecialChars($venue['permalink']) ?>" title="Permalink to <?php echo htmlSpecialChars($venue['name']) ?>" rel="bookmark">
						<?php echo $venue['name'] ?>

					</a>
				</h4></dt> 

<?php if ($venue['address']): ?>
			    <dt class="address"><?php echo NTemplateHelpers::escapeHtml(__('Address:', 'ait'), ENT_NOQUOTES) ?></dt>
			    <dd class="data"><?php echo $venue['address'] ?></dd>
<?php endif ?>

<?php if ($venue['telephone']): ?>
			    <dt class="phone"><?php echo NTemplateHelpers::escapeHtml(__('Telephone:', 'ait'), ENT_NOQUOTES) ?></dt>
			    <dd class="data"><?php echo NTemplateHelpers::escapeHtml($venue['telephone'], ENT_NOQUOTES) ?></dd>
<?php endif ?>

<?php if ($venue['email']): ?>
			    <dt class="email"><?php echo NTemplateHelpers::escapeHtml(__('Email:', 'ait'), ENT_NOQUOTES) ?> </dt>
			    <dd class="data"><a href="mailto:<?php echo $venue['email'] ?>"><?php echo $venue['email'] ?></a></dd>
<?php endif ?>

<?php if ($venue['web']): ?>
			    <dt class="web"><?php echo NTemplateHelpers::escapeHtml(__('Web:', 'ait'), ENT_NOQUOTES) ?> </dt>
			    <dd class="data"><a href="<?php echo $venue['web'] ?>"><?php echo $venue['web'] ?></a></dd>
<?php endif ?>

			</dl>
<?php endif ?>
			
<?php if ($event_date || $event_time): ?>
			<dl class="item-hours">

				<dt class="title"><h4><?php echo NTemplateHelpers::escapeHtml(__('Thời gian diễn ra sự kiện', 'ait'), ENT_NOQUOTES) ?></h4></dt> 

<?php if ($event_date): ?>
			    <dt class="day"><?php echo NTemplateHelpers::escapeHtml(__('Ngày:', 'ait'), ENT_NOQUOTES) ?></dt>
			    <dd class="data"><?php echo $event_date ?></dd>
<?php endif ?>

<?php if ($event_time): ?>
			    <dt class="day"><?php echo NTemplateHelpers::escapeHtml(__('Giờ:', 'ait'), ENT_NOQUOTES) ?></dt>
			    <dd class="data"><?php echo $event_time ?></dd>
<?php endif ?>

			</dl>
<?php endif ?>

		</div>
	</div>
	
	<hr />

	<div class="entry-content clearfix">
		<?php echo $post->content ?>

	</div>

<?php if (isset($themeOptions->directory->showShareButtons)): ?>
	<div class="item-share">
		<!-- facebook -->
		<div class="social-item fb">
			<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo htmlSpecialChars($post->permalink) ?>&amp;send=false&amp;layout=button_count&amp;width=113&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:113px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- twitter -->
		<div class="social-item">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo htmlSpecialChars($post->permalink) ?>
" data-text="<?php echo htmlSpecialChars($themeOptions->directory->shareText) ?>
 <?php echo htmlSpecialChars($post->permalink) ?>" data-lang="en">Tweet</a>
			<script>!function(d,s,id){ var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){ js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<!-- google plus -->
		<!-- Place this tag where you want the +1 button to render. -->
		<div class="social-item">
			<div class="g-plusone"></div>
			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>

	</div>
<?php endif ?>
	
	<hr />
	
	<div class="item-info">

<?php if ('venue'): ?>
			<dl class="item-address">

				<dt class="title"><h4>
					<a href="<?php echo htmlSpecialChars($venue['permalink']) ?>" title="Permalink to <?php echo htmlSpecialChars($venue['name']) ?>" rel="bookmark">
						<?php echo $venue['name'] ?>

					</a>
				</h4></dt> 

			    <dt class="item-image" style="width:inherit;margin-left:-50px"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $venue['thumb'], 'w' => 140, 'h' => 200), "", "&amp;") ?>
" alt="<?php echo htmlSpecialChars(__('Item image', 'ait')) ?>" /></dt>
			    <dd class="data"><?php echo $venue['excerpt'] ?></dd>

			</dl>
<?php endif ?>

	</div>
	
	<div class="item-map clearfix">
	</div>

	<hr />
	
<?php if ($options['alternativeContent']): ?>
	<div class="item-alternative-content">
		<?php echo do_shortcode($options['alternativeContent']) ?>

	</div>
<?php endif ?>

</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->

<?php echo getAitRatingElement($post->id) ?>


<?php NCoreMacros::includeTemplate("comments-dir.php", array('closeable' => $themeOptions->general->closeComments, 'defaultState' => $themeOptions->general->defaultPosition) + $template->getParams(), $_l->templates['xt8kkxn5pp'])->render() ?>

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
