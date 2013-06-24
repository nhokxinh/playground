{foreach $posts as $item}
{first}<ul class="items">{/first}
	<li class="item clear{ifset $item->packageClass} {$item->packageClass}{/ifset}">
		{if $item->thumbnailDir}
		<div class="thumbnail">
			<img src="{timthumb src => $item->thumbnailDir, w => 100, h => 100}" alt="{__ 'Item thumbnail'}">
			<div class="comment-count">{$item->comment_count}</div>
		</div>
		{/if}
		
		<div class="description">
			<h3>
				<a href="{!$item->link}">{$item->post_title}</a>
				{if $item->rating}
				<span class="rating">
					{for $i = 1; $i <= $item->rating['max']; $i++}
						<span class="star{if $i <= $item->rating['val']} active{/if}"></span>
					{/for}
				</span>
				{/if}
			</h3>
			{!$item->excerptDir}
		</div>
	</li>
{last}</ul>{/last}
{/foreach}
