<?php
/**
 * The Template for displaying all single posts.
 *
 * @package hyde
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php hyde_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
