<?php if (get_option('atp_topbar') != "on") { ?>
<div class="topbar">
	<div class="inner">
		<div class="topbar_left ">
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

<div id="header" class="header clearfix">
	<div class="header-area">

		<div class="logo">
		<?php atp_generator( 'logo' ); ?>
		</div>
		<!-- /logo -->
		
		<div class="primarymenu menuwrap">
			<?php atp_generator( 'atp_primary_menu' ); ?>
		</div>
	</div>
	<!-- /inner-->
</div>
<!-- /header -->
