<?php
	$blog_pagination_style = is_home() ? ot_get_option( 'blog_pagination_style', 'style1' ) : 'style1';
	$thb_blog_columns      = 3;//ot_get_option( 'thb_blog_columns', '4' );
	$blog_animation        = ot_get_option( 'blog_animation', '' );
	$columns               = thb_translate_columns( $thb_blog_columns );
	$vars         		   = $wp_query->query_vars;
	$courseType       = array_key_exists( 'courseType', $vars ) ? $vars['courseType'] : 'certificate';
	
	set_query_var( 'columns', $columns );
	set_query_var( 'thb_animation', $blog_animation );
	$ppp = get_option( 'posts_per_page' );
?>
<div class="row <?php echo esc_attr( 'pagination-' . $blog_pagination_style ); ?>" data-count="<?php echo esc_attr( $ppp ); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_blog_ajax' ) ); ?>">
<?php
$arrCourseCat = array('university-courses');
if($courseType == 'certificate')
{
	$arrCourseCat = array('university-courses');
}	
else if($courseType == 'whitelabel')
{
	$arrCourseCat = array('university-courses','program');
}	
else {
	$arrCourseCat = array('diploma-program');
}

$args = array(
		'post_type' =>$arrCourseCat,
		'post_status' => 'publish',					
		'posts_per_page' => -1,
		'orderby' => array( 
		   'title' => 'ASC' 
		)
	);
$loop = new WP_Query($args); 
if ( $loop->have_posts()) :
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
			<?php
			get_template_part( 'inc/templates/postbit/course-grid' );
			?>
	<?php endwhile; else : ?>
		<?php get_template_part( 'inc/templates/not-found' ); ?>
	<?php endif; ?>
</div>

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
