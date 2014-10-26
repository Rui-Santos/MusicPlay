<?php
	/***
	 * get Footer widgets based on Columns Counts from theme options
	 */
	$footerwidgetcounts=get_option('atp_footerwidgetcount');
	$f=0;
	if(is_numeric($footerwidgetcounts)) {
		for($s=1; $s<=$footerwidgetcounts; $s++) {
			$f++; global $fclass,$footerwidgetcounts;
			$flast = ($f == $footerwidgetcounts && $footerwidgetcounts != 1) ? 'last' : '';
			echo'<div class="'.$fclass.' '. $flast.'">';
			if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footercolumn'.$s)) :?>

			<div class="widget">
			<h3 class="widget-title">Main Links</h3>
			<ul>
				<li><a href="#">Home </a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Contacts </a></li>
			</ul>
			</div>
		<?php 
			endif;
			echo "</div>";
		}
	}else{
		switch($footerwidgetcounts) {
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