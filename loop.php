<?php 
	global $atp_readmoretxt;
	
	//Loop Archive

?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php $format = get_post_format($post->ID);?>
		<?php if( false === $format ) { $format = 'standard'; } ?>
		
		<div <?php post_class();?> id="post-<?php the_ID(); ?>">
			
			<div class="post_content">
				
				<?php get_template_part( 'includes/' . $format ); ?>
				
				<?php if( $format != 'link' && $format != 'quote' && $format != 'aside') { ?>
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>">
				<?php the_title(); ?></a></h2>
				<?php } ?>

				<?php if ( get_option( 'atp_postmeta' ) != "on" ) { ?>
				<div class="post-info">
					<?php if( $format != 'aside' && $format != 'quote' ){?>
					<?php echo atp_generator('postmetaStyle'); ?>
					<?php } ?>
				</div><!-- .post-info -->
				<?php } ?>
				
				<?php if ( $format != 'quote' ){ ?>
				<div class="post-entry">
					
					<?php the_excerpt(); ?>
					
					<?php if ( $format != 'quote'   && $format != 'aside' ) { ?>
					<a class="more-link" href="<?php the_permalink() ?>"><?php echo atp_localize($atp_readmoretxt, '', '');?></a>
					<?php  } ?>
				
				</div>
				<?php } ?>
				
			</div><!-- .post_content -->
		</div><!-- #post-<?php the_ID();?> -->

		<?php endwhile; ?>
		
		<?php if(function_exists('atp_pagination')){ echo atp_pagination(); }?>
		
		<?php else : ?>
		
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>
		
		<?php get_search_form(); ?>
		
		<?php endif;?>