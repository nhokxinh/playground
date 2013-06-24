{extends $layout}

{block content}

<article id="post-{$post->id}" class="{$post->htmlClasses}">

	<header class="entry-header">

		<h1 class="entry-title">
			<a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a>
			{if $rating}
			<span class="rating">
				{for $i = 1; $i <= $rating['max']; $i++}
					<span class="star{if $i <= $rating['val']} active{/if}"></span>
				{/for}
			</span>
			{/if}
		</h1>
		
		<div class="category-breadcrumb clearfix">
			<span class="here">{__ 'You are here'}</span>
			<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;></span>
			{foreach $ancestors as $anc}
				{first}<span class="ancestors">{/first}
				<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;>
				{last}</span>{/last}
			{/foreach}
			{ifset $term}<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>{/ifset}
			<span class="title"> >&nbsp;&nbsp;{$post->title}</span>
		</div>

	</header>

	<div class="entry-content clearfix">
		{if $post->thumbnailSrc}
		<div class="item-image">
			<img src="{timthumb src => $post->thumbnailSrc, w => 140, h => 200}" alt="{__ 'Item image'}">
		</div>
		{/if}
		
		<div class="item-info">

			{if venue}
			<dl class="item-address">

				<dt class="title"><h4>
					<a href="{$venue['permalink']}" title="Permalink to {$venue['name']}" rel="bookmark">
						{!$venue['name']}
					</a>
				</h4></dt> 

				{if $venue['address']}
			    <dt class="address">{__ 'Address:'}</dt>
			    <dd class="data">{!$venue['address']}</dd>
			    {/if}

			    {if $venue['telephone']}
			    <dt class="phone">{__ 'Telephone:'}</dt>
			    <dd class="data">{$venue['telephone']}</dd>
			    {/if}

			    {if $venue['email']}         
			    <dt class="email">{__ 'Email:'} </dt>
			    <dd class="data"><a href="mailto:{!$venue['email']}">{!$venue['email']}</a></dd>
			    {/if}

			    {if $venue['web']} 
			    <dt class="web">{__ 'Web:'} </dt>
			    <dd class="data"><a href="{!$venue['web']}">{!$venue['web']}</a></dd>
			    {/if}

			</dl>
			{/if}
			
			{if $event_date || $event_time}     
			<dl class="item-hours">

				<dt class="title"><h4>{__ 'Thời gian diễn ra sự kiện'}</h4></dt> 

				{if $event_date}
			    <dt class="day">{__ 'Ngày:'}</dt>
			    <dd class="data">{!$event_date}</dd>
			    {/if}

			    {if $event_time}
			    <dt class="day">{__ 'Giờ:'}</dt>
			    <dd class="data">{!$event_time}</dd>
			    {/if}

			</dl>
			{/if}

		</div>
	</div>
	
	<hr>

	<div class="entry-content clearfix">
		{!$post->content}
	</div>

	{ifset $themeOptions->directory->showShareButtons}
	<div class="item-share">
		<!-- facebook -->
		<div class="social-item fb">
			<iframe src="//www.facebook.com/plugins/like.php?href={$post->permalink}&amp;send=false&amp;layout=button_count&amp;width=113&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:113px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- twitter -->
		<div class="social-item">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="{$post->permalink}" data-text="{$themeOptions->directory->shareText} {$post->permalink}" data-lang="en">Tweet</a>
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
	{/ifset}
	
	<hr>
	
	<div class="item-info">

		{if venue}
			<dl class="item-address">

				<dt class="title"><h4>
					<a href="{$venue['permalink']}" title="Permalink to {$venue['name']}" rel="bookmark">
						{!$venue['name']}
					</a>
				</h4></dt> 

			    <dt class="item-image" style="width:inherit;margin-left:-50px"><img src="{timthumb src => $venue['thumb'], w => 140, h => 200}" alt="{__ 'Item image'}"></dt>
			    <dd class="data">{!$venue['excerpt']}</dd>

			</dl>
		{/if}

	</div>
	
	<div class="item-map clearfix">
	</div>

	<hr>
	
	{if $options['alternativeContent']}
	<div class="item-alternative-content">
		{!do_shortcode($options['alternativeContent'])}
	</div>
	{/if}

</article><!-- /#post-{$post->id} -->

{!getAitRatingElement($post->id)}

{include comments-dir.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

{/block}