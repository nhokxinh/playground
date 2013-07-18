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


					<div id="secondary" class="col-l" role="complementary">
                        <div class="col-l-t">&nbsp;</div>
                        <div class="col-l-m">
						{dynamicSidebar sidebar-home-left}
                        </div>
                        <div class="col-l-b">&nbsp;</div>
					</div>
					{if isset($leftSidebarType) && $leftSidebarType == 'home'}
					<div id="primary" class="">
						<div id="content" role="main" class="home-content-with-left-sidebar">

			     {else}
				<div id="primary" class="">
					<div id="content" role="main" class="home-content-with-left-sidebar">
			     {/if}
	

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
            <?php if (isset($_GET['post_type'])): ?>
			{if isset($sidebarType) && $sidebarType == 'item'}
				{isActiveSidebar sidebar-item}
				<div id="secondary" class="widget-area col-r" role="complementary">
					{dynamicSidebar sidebar-item}
				</div>
				{/isActiveSidebar}

			{/if}
            <?php endif;?>
            {isActiveSidebar sidebar-home}
				<div id="secondary" class="widget-area col-r" role="complementary">
					{dynamicSidebar sidebar-home}
				</div>
				{/isActiveSidebar}

	</div>

</div> <!-- /#main -->

{getFooter}