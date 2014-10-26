<?php
	/**
	 * get Footer widgets based on Columns Counts from theme options
	 */
	$footerwidgetcounts = get_option( 'atp_footerwidgetcount' );
	if ( $footerwidgetcounts ) {
		if ( $footerwidgetcounts == '6') { $fclass = 'one_sixth'; }
		if ( $footerwidgetcounts == '5') { $fclass = 'one_fifth'; }
		if ( $footerwidgetcounts == '4') { $fclass = 'one_fourth'; }
		if ( $footerwidgetcounts == '3') { $fclass = 'one_third'; }
		if ( $footerwidgetcounts == '2') { $fclass = 'one_half'; }
		if ( $footerwidgetcounts == '1') { $fclass = 'fullwidth'; }
	}
	$footer_columns = 0; // Footer count
	if ( is_numeric( $footerwidgetcounts ) ) {
		for ( $i = 1; $i <= $footerwidgetcounts; $i++ ) {
			$footer_columns++; 

			$last = ( $footer_columns == $footerwidgetcounts && $footerwidgetcounts != 1 ) ? 'last' : '';
			
			echo '<div class="'.$fclass.' '. $last.'">';
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'footercolumn'.$i ) ) {
				//
			}
			echo '</div>';
		}

	} else {

		switch ( $footerwidgetcounts ) {
			case 'half_one_half': ?>
				<div class="one_half"><?php dynamic_sidebar('footercolumn1'); ?></div>
				<div class="one_half last">
					<div class="one_half"><?php dynamic_sidebar('footercolumn2'); ?></div>
					<div class="one_half last"><?php dynamic_sidebar('footercolumn3'); ?></div>
				</div>
				<?php
				break;
			case 'half_one_third': ?>
				<div class="one_half"><?php dynamic_sidebar('footercolumn1'); ?></div>
				<div class="one_half last">
					<div class="one_third"><?php dynamic_sidebar('footercolumn2'); ?></div>
					<div class="one_third"><?php  dynamic_sidebar('footercolumn3'); ?></div>
					<div class="one_third last"><?php dynamic_sidebar('footercolumn4'); ?></div>
				</div>
				<?php break;
			case 'one_half_half': ?>
				<div class="one_half">
					<div class="one_half"><?php dynamic_sidebar('footercolumn1'); ?></div>
					<div class="one_half last"> <?php dynamic_sidebar('footercolumn2'); ?></div>
				</div>
				<div class="one_half last"><?php dynamic_sidebar('footercolumn3'); ?></div>
				<?php break;
			case 'one_third_half': ?>
				<div class="one_half">
				<div class="one_third"><?php dynamic_sidebar('footercolumn1'); ?></div>
					<div class="one_third"><?php dynamic_sidebar('footercolumn2'); ?></div>
					<div class="one_third last"><?php dynamic_sidebar('footercolumn3'); ?></div>
				</div>
				<div class="one_half last"><?php dynamic_sidebar('footercolumn4'); ?></div>
				<?php break;
		}
	}
?>