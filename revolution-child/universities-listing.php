<?php
/* 
Template Name: University Page
*/
$vc                 = class_exists( 'WPBakeryVisualComposerAbstract' );
$enable_pagepadding = get_post_meta( get_the_ID(), 'enable_pagepadding', true );
$classes[]          = 'on' === $enable_pagepadding ? 'page-padding' : false;

$blog_header  = ot_get_option( 'blog_header', 'style1' );
$blog_style   = 'university-style';//ot_get_option( 'blog_style', 'style3' );
$blog_sidebar = ot_get_option( 'blog_sidebar', 'on' );

$thb_id         = get_the_ID();
$display_title  = get_post_meta( $thb_id, 'display_title', true );
$sidebar        = get_post_meta( $thb_id, 'sidebar', true );
$sidebar_pos    = get_post_meta( $thb_id, 'sidebar_position', true );
$custom_sidebar = get_post_meta( $thb_id, 'custom_sidebar', true ) ? get_post_meta( $thb_id, 'custom_sidebar', true ) : 'off';
?>
<?php get_header(); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
	<div <?php post_class( 'page-padding' ); ?>>
		<div class="row">
			<?php if ( 'on' === $sidebar ) { ?>
				<div class="small-12 medium-4 small-order-2 <?php if ( 'left' === $sidebar_pos ) { ?>medium-order-1<?php } ?> columns">
					<?php
					if ( 'on' === $custom_sidebar ) {
						$custom_sidebar_id = get_post_meta( $thb_id, 'custom_sidebar_id', true );
						dynamic_sidebar( $custom_sidebar_id );
					} else {
						dynamic_sidebar( 'page' );
					}
					?>
				</div>
			<?php } ?>
			<div class="small-12 <?php if ( 'on' === $sidebar ) { ?>medium-8<?php } ?> small-order-1 columns">
				<?php if ( 'off' !== $display_title ) { ?>
					<header class="post-title page-title">
						<?php the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' ); ?>
					</header>
				<?php } ?>
				<div class="post-content no-vc">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
		<?php
endwhile;
endif;
?>
<h1> from university listing Page</h1>
<!-- START 01.02.2022 -->
<?php
$qobj = get_queried_object();
$universityBannerImage = get_term_meta($qobj->term_id, 'wpcf-university-banner', true);
?>
<img src="<?php echo $universityBannerImage; ?>" alt="university Banner Image" width="auto" height="450"> 
<!-- END 01.02.2022 -->
<div class="row max_width blog_row">
	<div class="small-12 columns">
		<div class="blog-main-container">
			<div class="blog-container blog-<?php echo esc_attr( $blog_style ); ?>">
				<?php
					get_template_part( 'inc/templates/blog/' . $blog_style );
				?>
			</div>
			<?php
			
			if ( 'on' === $blog_sidebar && in_array( $blog_style, array( 'style1', 'style3', 'style4', 'style5', 'style6', 'style7', 'style10' ), true ) ) {
				get_sidebar( 'blog' );
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();
