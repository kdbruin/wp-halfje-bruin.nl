<?php
/**
 * @package gridsby
 */
?>


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><span class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
        	<?php the_post_thumbnail( 'large', array( 'class' => 'archive-image' ) ); ?>
			<?php
				/* translators: %s: Name of current post */
				the_content( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gridsby'  ) );
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'gridsby' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
        
        <footer class="entry-footer">

			<?php if ( 'post' == get_post_type() ) : ?>
			
            <div class="entry-meta">
                <span class="meta-block"><i class="fa fa-list"></i> <?php the_category(); ?></span>
                <span class="meta-block"><?php echo get_avatar( get_the_author_meta('email'), get_the_author() ); ?><?php the_author(); ?></span>
                <span class="meta-block"><i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
		<?php echo hb_series_post_meta(); ?>
			</div><!-- .entry-meta --> 

			<?php endif; ?>
		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->
