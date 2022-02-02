<?php
$blog_pagination_style = is_home() ? ot_get_option( 'blog_pagination_style', 'style1' ) : 'style3';
$blog_animation        = ot_get_option( 'blog_animation', '' );
$thb_blog_columns      = 3;//ot_get_option( 'thb_blog_columns', '4' );
$columns               = thb_translate_columns( $thb_blog_columns );
set_query_var( 'columns', $columns );
set_query_var( 'thb_animation', $blog_animation );
set_query_var( 'thb_excerpt', true );
$ppp = get_option( 'posts_per_page' );
$args = array(
	'post_type' =>array('career'),
	'post_status' => 'publish',					
	'posts_per_page' => $ppp,
	'orderby' => array( 
	   'date' => 'desc' 
	)
);
global $wp_query;
$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query( $args ); 
?>
<div class="row <?php echo esc_attr( 'pagination-loadmore'); ?>" data-count="<?php echo esc_attr( $wp_query->found_posts ); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_blog_ajax' ) ); ?>">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part( 'inc/templates/postbit/careers-grid' ); ?>
			<?php endwhile; else : ?>
				<?php get_template_part( 'inc/templates/not-found' ); ?>
	<?php endif; ?>
</div>
<?php
if($wp_query->found_posts > $ppp)
{	
?>
<div class="row pagination-space infinite-scroll">
	<div class="thb-content-preloader">
		<?php get_template_part( 'assets/img/svg/preloader-material.svg' ); ?>
	</div>
</div>
<?php 
}
?>
<?php
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
?>

<script type="text/javascript">
function equalHeights(){
	var winWidth1 = parseInt(jQuery(window).width());
	if (winWidth1 > 639 )
	{
		var max_height = 150;
		jQuery('.style10-content').each(function(){
			max_height = Math.max(jQuery('.style10-content').height(), max_height);
		});
		jQuery('.style10-content').each(function(){
			jQuery('.style10-content').height(max_height);
		});
	}
	else{
		jQuery('.style10-content').css('height', 'auto');
	}
};

jQuery(document).ready(function(){
    equalHeights();
	
	jQuery(window).on('resize', function() {
		equalHeights();
	});
});
</script>

