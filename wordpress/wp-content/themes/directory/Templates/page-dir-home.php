{extends $layout}


{block content}

{if $post->options('header')->headerType == 'map'}
	{include 'snippets/map-javascript.php'}
{/if}

<div id="home-slider-wrapper" style="margin-left:-5%;margin-top:-11%;width:107%;margin-bottom:5%">
{? putRevSlider($headerSlider)}
</div>

<script type="text/javascript">
	jQuery(function(){
		jQuery("div#home-slider-wrapper *").css("z-index","0");
	});
</script>

<article id="post-{$post->id}" class="{$post->htmlClasses}">

	<header class="entry-header">
		
		<h1 class="entry-title">
			<a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a>
		</h1>

	</header>
	
	{if $post->thumbnailSrc}
	<a href="{!$post->thumbnailSrc}">
		<div class="entry-thumbnail"><img src="{timthumb src => $post->thumbnailSrc, w => 140, h => 200}" alt=""></div>
	</a>
	{/if}

	<div class="entry-content">
		{!$post->content}
	</div>
	
	<div class="category-items clearfix">
		<ul n:foreach="$posts as $item" class="items">
			<li class="item clear{ifset $item->packageClass} {$item->packageClass}{/ifset}">
				{if $item->thumbnailDir}
				<div class="thumbnail">
					<img src="{timthumb src => $item->thumbnailDir, w => 100, h => 100}" alt="{__ 'Item thumbnail'}">
					<div class="comment-count">{$item->commentsCount}</div>
				</div>
				{/if}
				
				<div class="description">
					<h3>
						<a href="{!$item->link}">{$item->title}</a>
						{if $item->rating}
						<span class="rating">
							{for $i = 1; $i <= $item->rating['max']; $i++}
								<span class="star{if $i <= $item->rating['val']} active{/if}"></span>
							{/for}
						</span>
						{/if}
					</h3>
					{!$item->excerpt}
				</div>
			</li>
		</ul>
	</div>
	
	{willPaginate}
	<nav class="paginate-links">
		{paginateLinks true}
	</nav>
	{/willPaginate}
	
	{if $themeOptions->directory->dirHomepageAltContent}
	<div class="alternative-content">
		{!$themeOptions->directory->dirHomepageAltContent}
	</div>
	{/if}

</article><!-- /#post-{$post->id} -->

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

{/block}