<?php
$qobj = get_queried_object();
$blog_pagination_style = is_home() ? ot_get_option( 'blog_pagination_style', 'style1' ) : 'style1';
$thb_blog_columns      = 3;//ot_get_option( 'thb_blog_columns', '4' );
$blog_animation        = ot_get_option( 'blog_animation', '' );
$columns               = thb_translate_columns( $thb_blog_columns );
$vars         		   = $wp_query->query_vars;

set_query_var( 'columns', $columns );
set_query_var( 'thb_animation', $blog_animation );
$ppp = get_option( 'posts_per_page' );
$banner_title = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);
if(empty($banner_title))
{
	$banner_title = $qobj->name;
}

$arrCourseCat = array('university-courses');
$args = array(
		'post_type' =>$arrCourseCat,
		'post_status' => 'publish',					
		'posts_per_page' => -1,
		'orderby' => array( 
		   'title' => 'ASC' 
		),
		  'tax_query' => array(
			array(
			  'taxonomy' => $qobj->taxonomy,
			  'field' => 'id',
			  'terms' => $qobj->term_id,
			)
		  )
	);
$loop = new WP_Query($args); 
if ( $loop->have_posts()) {
	?>
	<div class="thb-page-header">
		<h2>Online Courses By <?php echo $banner_title;?></h2>
	</div>
	
	<!-- // START 30.01.2022 -->
	<?php
	$universityLocation = get_term_meta($qobj->term_id, 'wpcf-university-location', true);
	$universityIcon = get_term_meta($qobj->term_id, 'wpcf-university-icon', true);
	$universityImage = get_term_meta($qobj->term_id, 'wpcf-university-image', true);
	?>

	<img src="<?php echo $universityImage; ?>" alt="Category Banner" width="auto" height="400"><br>
	<h1 class="cat-name text-white wow fadeInLeft" 
	style="visibility: visible; animation-name: fadeInLeft;">
	<?php echo $universityLocation; ?>
	</h1>

	<div class="row">
	<?php
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
			<?php
			get_template_part( 'inc/templates/postbit/course-grid' );
			?>
	<?php 
	endwhile; 
	?>
	</div>
	<?php
}


$arrCourseCat = array('program','diploma-program');
$args = array(
		'post_type' =>$arrCourseCat,
		'post_status' => 'publish',					
		'posts_per_page' => -1,
		'orderby' => array( 
		   'title' => 'ASC' 
		),
	  'tax_query' => array(
		array(
		  'taxonomy' => $qobj->taxonomy,
		  'field' => 'id',
		  'terms' => $qobj->term_id,
		)
	  )
	);
$loop = new WP_Query($args); 
if ( $loop->have_posts()) {
	?>
	<div class="thb-page-header">
		<h2>Online Courses By Emeritus In Collaboration with <?php echo $banner_title;?></h2>
	</div>

	<div class="row">
	<?php
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
			<?php
			get_template_part( 'inc/templates/postbit/course-grid' );
			?>
	<?php 
	endwhile; 
	?>
	</div>
	<?php
}
?>
<script type="text/javascript">
function equalHeights(){
	var winWidth1 = parseInt(jQuery(window).width());
	if (winWidth1 > 639 )
	{
		var max_height = 0;
		jQuery('.grid_toppart').each(function(){
			if (jQuery(this).outerHeight() > max_height) { max_height = jQuery(this).outerHeight(); }
		});
		if(max_height > 115)
		{
			max_height = 115;
		}
		if(max_height <= 76)
		{
			max_height = 85;
		}
		jQuery('.grid_toppart').height(max_height);
		
	}
	else{
		jQuery('.grid_toppart').css('height', 'auto');
	}
};
function resetSchoolLogoHight(){
	var winWidth3 = parseInt(jQuery(window).width());
	if (winWidth3 > 639 )
	{
		var maxHeight = 0;
		jQuery(".school_div").each(function(){
			if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
		});
		jQuery('.school_div').height(maxHeight);
	}
	else{
		jQuery('.school_div').css('height', 'auto');
	}
			
};		

jQuery(document).ready(function(){
    setTimeout(function() {equalHeights()},500);
    setTimeout(function() {resetSchoolLogoHight()},500);
    //resetHeight2();
	
	jQuery(window).on('resize', function() {
		setTimeout(function() {equalHeights()},100);
		setTimeout(function() {resetSchoolLogoHight()},100);
		//resetHeight2();
	});
});
</script>
