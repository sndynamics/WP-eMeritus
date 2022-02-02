<?php 
/*if external page link exists than redirect*/
$LP_URL 		= types_render_field('external-landing-page-url', array('output' => 'raw', 'id' => $post->ID));
if(!empty(trim($LP_URL)))
{
	$utmParams		 = getUTMParameters();
	if(!empty($utmParams))
	{
		$LP_URL .= '?'.$utmParams;
	}
	wp_redirect( $LP_URL, 301 ) ;
	exit;
}

$selectedPType 	= get_post_type();
if(in_array($selectedPType,array('university-courses','program','diploma-program')))
{
	wp_redirect( site_url(), 301 ) ;
	exit;
}
/*if external page link exists than redirect*/


get_header(); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
			<?php
			$article_style = ot_get_option( 'article_style', 'style1' );
			get_template_part( 'inc/templates/article/' . $article_style );
			?>
			<?php if ( comments_open() || get_comments_number() ) : ?>
<!-- Start #comments -->
				<?php comments_template( '', true ); ?>
<!-- End #comments -->
<?php endif; ?>
		<?php
	endwhile;
endif;
?>
<?php
get_footer();
