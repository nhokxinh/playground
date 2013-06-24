{getHeader}

{if isset($sidebarType) && $sidebarType == 'home'}
	{if !is_active_sidebar('sidebar-home')}
		{var $fullwidth = true}
	{/if}
{elseif isset($sidebarType) && $sidebarType == 'item'}
	{if !is_active_sidebar('sidebar-item')}
		{var $fullwidth = true}
	{/if}
{else}
	{if !is_active_sidebar('sidebar-1')}
		{var $fullwidth = true}
	{/if}
{/if}

<div id="main" class="defaultContentWidth{ifset $fullwidth} onecolumn{/ifset}">
	<div id="wrapper-row">
		
		{ifset $fullwidth}
			<div id="primary" class="">
				<div id="content" role="main">
		{else}
			{if isset($leftSidebarType) && $leftSidebarType == 'home'}
				{isActiveSidebar sidebar-home-left}
					<div id="secondary" class="widget-area" role="complementary">
						{dynamicSidebar sidebar-home-left}
					</div>
					
					<div id="primary" class="">
						<div id="content" role="main" class="home-content-with-left-sidebar">
				{/isActiveSidebar}
			{else}
				<div id="primary" class="">
					<div id="content" role="main">
			{/if}
		{/ifset}

				{ifset $themeOptions->advertising->showBox2}
	            <div id="advertising-box-2" class="advertising-box">
	                {!$themeOptions->advertising->box2Content}
	            </div>
	            {/ifset}
				
				{ifset $fullwidth}
				{include #content, fullwidth => true}
				{else}
				{include #content}
				{/ifset}
			</div><!-- /#content -->

		</div><!-- /#primary -->

		{ifset $fullwidth}
		{else}

			{if isset($sidebarType) && $sidebarType == 'home'}
				{isActiveSidebar sidebar-home}
				<div id="secondary" class="widget-area" role="complementary">
					{dynamicSidebar sidebar-home}
				</div>
				{/isActiveSidebar}
			{elseif isset($sidebarType) && $sidebarType == 'item'}
				{isActiveSidebar sidebar-item}
				<div id="secondary" class="widget-area" role="complementary">
					{dynamicSidebar sidebar-item}
				</div>
				{/isActiveSidebar}
			{else}
				{isActiveSidebar sidebar-1}
				<div id="secondary" class="widget-area" role="complementary">
					{dynamicSidebar sidebar-1}
				</div>
				{/isActiveSidebar}
			{/if}

		{/ifset}
	</div>

</div> <!-- /#main -->

{getFooter}