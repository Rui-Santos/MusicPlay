<?php if (get_option('atp_topbar') != "on") { ?>
<!-- Header Style2 -->
<div class="topbar">
	<div class="inner">
		<div class="topbar_left">
			<?php echo do_shortcode(get_option('atp_top_lefttext')); ?>
		</div>
		<div class="topbar_right">
			<div id="social-icons">
				<?php echo do_shortcode(get_option('atp_top_righttext','[sociable]')); ?>
			</div>
		</div>
	</div><!-- /inner -->
</div><!-- /topbar -->
<div class="clear"></div>
<?php } ?>	
<div id="header-s2" class="header">

	<div class="header-area">
		<div class="primarymenu menuwrap">
			<?php atp_generator( 'atp_primary_menu' ); ?>
		<!-- /menuwrap-->
		</div>
		<div class="logo">
			<?php atp_generator( 'logo' ); ?>
		</div>
		<!-- /logo -->
		<div class="clear"></div>
	</div>
	
</div>
<!-- /Header Style2 -->