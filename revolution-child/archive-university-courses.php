<?php get_header(); ?>
<?php
	$blog_header  = ot_get_option( 'blog_header', 'style1' );
	$blog_style   = 'course-style';//ot_get_option( 'blog_style', 'style3' );
	$blog_sidebar = ot_get_option( 'blog_sidebar', 'on' );
	set_query_var( 'courseType', 'certificate');
	/*$arrSchoolTerms = array();
	$schoolTerms = get_categories(array(
				'post_type' => array('university-courses'),
				'taxonomy' => 'university',
				'parent' => 0,
				'hide_empty' => true,
				'meta_query' => array(
					'relation' => 'OR',
					array(
						'key'       => 'wpcf-hide-from-page',
						'value'     => 0,
						'compare'   => '='
					),
					array(
						array(
						 'key'       => 'wpcf-hide-from-page',
						 'compare' => 'NOT EXISTS', // this should work...
						 'value' => ''
						),
					)
				)
			));

	$categoryTerms = get_categories(array(
				'post_type' => array('university-courses'),
				'taxonomy' => 'category',
				'parent' => 0,
				'hide_empty' => true
			));

	if(!empty($schoolTerms))
	{
		foreach ($schoolTerms as $t): 
			$order_by = get_term_meta( $t->term_id, 'wpcf-university-order-by', true);
			$t->order_by = $order_by;                 
			$arrSchoolTerms[] =(array) $t;
		endforeach;

		function sortByOrder($a, $b) {
			return $a['order_by'] - $b['order_by'];
		}
		usort($arrSchoolTerms, 'sortByOrder');
	}
	*/
	
	//get_template_part( 'inc/templates/blog/blog-header-' . $blog_header );
?>
<div <?php post_class( 'page-padding' ); ?>>
	<div class="row">
		<div class="small-12 <?php if ( 'on' === $sidebar ) { ?>medium-8<?php } ?> small-order-1 columns">
			<header class="post-title page-title">
				<h1 class="entry-title" itemprop="name headline">Online Certificate Courses</h1>
			</header>
			<div class="post-content no-vc">
				Choose from top online programs and certificate courses designed to deliver impactful learning at individual and team level. Partner with us and learn from global faculty for transformative professional education to advance your career. Select online short courses from our world-class portfolio to embark upon your learning journey.
			</div>
		</div>
	</div>
</div>
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