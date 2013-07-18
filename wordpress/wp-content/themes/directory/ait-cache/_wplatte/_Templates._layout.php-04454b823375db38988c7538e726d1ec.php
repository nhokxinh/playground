<?php //netteCache[01]000464a:2:{s:4:"time";s:21:"0.39836400 1374053519";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:75:"/home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/@layout.php";i:2;i:1374053474;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /home/tgud/tgud.com.vn/pg/wp-content/themes/directory/Templates/@layout.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '7pw1u3u61t')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
get_header("") ?>

<?php if (isset($sidebarType) && $sidebarType == 'home'): if (!is_active_sidebar('sidebar-home')): $fullwidth = true ;endif ;elseif (isset($sidebarType) && $sidebarType == 'item'): if (!is_active_sidebar('sidebar-item')): $fullwidth = true ;endif ;else: if (!is_active_sidebar('sidebar-1')): $fullwidth = true ;endif ;endif ?>

<div id="main" class="defaultContentWidth<?php if (isset($fullwidth)): ?> onecolumn<?php endif ?>">
	<div id="wrapper-row">


					<div id="secondary" class="col-l" role="complementary">
                        <div class="col-l-t">&nbsp;</div>
                        <div class="col-l-m">
<?php dynamic_sidebar('sidebar-home-left') ?>
                        </div>
                        <div class="col-l-b">&nbsp;</div>
					</div>
<?php if (isset($leftSidebarType) && $leftSidebarType == 'home'): ?>
					<div id="primary" class="">
						<div id="content" role="main" class="home-content-with-left-sidebar">

<?php else: ?>
				<div id="primary" class="">
					<div id="content" role="main" class="home-content-with-left-sidebar">
<?php endif ?>
	

<?php if (isset($themeOptions->advertising->showBox2)): ?>
	            <div id="advertising-box-2" class="advertising-box">
	                <?php echo $themeOptions->advertising->box2Content ?>

	            </div>
<?php endif ?>
				
<?php if (isset($fullwidth)): NUIMacros::callBlock($_l, 'content', array('fullwidth' => true) + $template->getParams()) ;else: NUIMacros::callBlock($_l, 'content', $template->getParams()) ;endif ?>
			</div><!-- /#content -->
		</div><!-- /#primary -->
            <?php if (isset($_GET['post_type'])): if (isset($sidebarType) && $sidebarType == 'item'): if(is_active_sidebar("sidebar-item")): ?>
				<div id="secondary" class="widget-area col-r" role="complementary">
<?php dynamic_sidebar('sidebar-item') ?>
				</div>
<?php endif ?>

<?php endif ?>
            <?php endif;if(is_active_sidebar("sidebar-home")): ?>
				<div id="secondary" class="widget-area col-r" role="complementary">
<?php dynamic_sidebar('sidebar-home') ?>
				</div>
<?php endif ?>

	</div>

</div> <!-- /#main -->

<?php get_footer("") ;
