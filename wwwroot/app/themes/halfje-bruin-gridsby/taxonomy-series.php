<?php
/**
 * The template for displaying series pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package halfje-bruin
 */

get_header(); ?>

<?php
// is it paged?
if ( get_query_var( 'page' ) )
{
	$paged = get_query_var( 'page' );
}
else if ( get_query_var( 'paged' ) )
{
	$paged = get_query_var( 'paged' );
}
else
{
	$paged = 1;
}
$term = get_query_var('term');
$tax = get_query_var('taxonomy');
$number = get_option( 'posts_per_page' );
$offset = ( $paged - 1 ) * $number;
// build query arguments
$args = array(
	'post_status' => 'publish',
	'post_type' => 'post',
	'ignore_sticky_posts' => true,
	'orderby' => 'date',
	'order' => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => $tax,
			'field' => 'slug',
			'terms' => $term
		)
	),
	'paged' => $paged,
	'posts_per_page' => $number,
	'offset' => $offset,
	'number' => $number
);
//print_r($args);
// create the loop
$loop = new WP_Query( $args );
// use the query for paging
//$current = $loop->query_vars[ 'paged' ] > 1 ? $loop->query_vars[ 'paged' ] : 1;
// set the "paginate_links" array to do what we would like it it.
// see: http://codex.wordpress.org/Function_Reference/paginate_links
//$pagination = array(
//	'base' => @add_query_arg( 'paged', '%#%' ),
//	//'format' => '',
//	'showall' => false,
//	'end_size' => 4,
//	'mid_size' => 4,
//	'total' => $loop->max_num_pages,
//	'current' => $current,
//	'type' => 'plain'
//);
//build the paging links
//if ( $wp_rewrite->using_permalinks() )
//{
//	$pagination[ 'base' ] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
//}
//more paging links
//if ( !empty( $loop->query_vars[ 's' ] ) )
//{
//	$pagination[ 'add_args' ] = array( 's' => get_query_var( 's' ) );
//}
?>
<div class="grid grid-pad">
	<div class="col-9-12 content-wrapper">
        <section id="primary" class="content-area blog-archive">
            <main id="main" class="site-main" role="main">
    
            <?php if ( $loop->have_posts() ) : ?>
   
                <header class="page-header">
                    <h1 class="page-title">
                        <?php printf( __( 'Series: %s', 'halfje-bruin' ), hb_series_name() ); ?>
                    </h1>
                    <?php
                        // Show an optional term description.
                        $term_description = term_description();
                        if ( ! empty( $term_description ) ) :
                            printf( '<div class="taxonomy-description">%s</div>', $term_description );
                        endif;
                    ?>
                </header><!-- .page-header -->
    
                <?php /* Start the Loop */ ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                 
                    <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'content', get_post_format() );
                    ?>
    
                <?php endwhile; ?>
    
                <?php gridsby_the_posts_navigation(); ?>  
    
            <?php else : ?>
    
                <?php get_template_part( 'content', 'none' ); ?>
    
            <?php endif; ?>
    
            </main><!-- #main -->
        </section><!-- #primary -->
	</div>
<?php
// reset the custom query */
wp_reset_postdata();
?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
