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
/*Show No Posts if no data for the category*/
$noPostCount  = 1;

$arrCourseCat = array('university-courses');
$args = array(
		'post_type' =>$arrCourseCat,
		'post_status' => 'publish',					
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
			  'taxonomy' => $qobj->taxonomy,
			  'field' => 'id',
			  'terms' => $qobj->term_id,
			)
		  ),
		'orderby' => array( 
		   'title' => 'ASC' 
		)
	);
$loop = new WP_Query($args); 
if ( $loop->have_posts()) {
$noPostCount  = 0;
	?>
	<?php
	// START 29.01.2022
	// commenting below coz datas to pull from category.php
	// $categoryBannerImage = get_term_meta($qobj->term_id, 'wpcf-category-banner-image', true);
	// $categoryBannerTitle = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);
	// $categorySeoDesc = get_term_meta($qobj->term_id, 'wpcf-category-seo-desc', true);

	// Fetch Data from Toolset => Custom Fields Group => Stats
	// $statsIcon1 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-1', true);
	// $statsTitle1 = get_term_meta($qobj->term_id, 'wpcf-stats-title-1', true);
	// $statsContent1 = get_term_meta($qobj->term_id, 'wpcf-stats-content-1', true);
	
	// $statsIcon2 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-2', true);
	// $statsTitle2 = get_term_meta($qobj->term_id, 'wpcf-stats-title-2', true);
	// $statsContent2 = get_term_meta($qobj->term_id, 'wpcf-stats-content-2', true);

	// $statsIcon3 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-3', true);
	// $statsTitle3 = get_term_meta($qobj->term_id, 'wpcf-stats-title-3', true);
	// $statsContent3 = get_term_meta($qobj->term_id, 'wpcf-stats-content-3', true);

	// $statsIcon4 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-4', true);
	// $statsTitle4 = get_term_meta($qobj->term_id, 'wpcf-stats-title-4', true);
	// $statsContent4 = get_term_meta($qobj->term_id, 'wpcf-stats-content-4', true);
	?>
	<!-- <h1>from category style page</h1>
	<section id="categoryBanner" style="background-image: <?php echo $categoryBannerImage; ?>">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <h1 class="cat-name text-white wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">Finance</h1>
          <p class="cat-desc text-white wow fadeInLeft" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">Lord Ipsum integer lobortis nec sem et
            feugiat. Donec id odio iaculis,
            fringilla nulla ut, sodales erat.
            Suspendisse dignissim magna congue urna mollis, sit amet faucibus tortor mollis. Nunc consequat non metus
            quis facilisis. In finibus feugiat tortor nec fermentum. Ut ut pretium velit, sit amet hendrerit enim.</p>
        </div>
        <div class="col-md-6 col-xl-5 offset-xl-1 text-center">
          <a data-toggle="modal" href="#catvideoModal">
            <img src="img/categories/video-thumb.png" class="video-thumb">
          </a>
          <p class="mt-4 text-white mb-0 watch"> <img src="img/categories/icons/Icon feather-arrow-down.png"><span class="d-block">Watch finance intro video</span></p> -->
          <!--Category video Modal -->
          <!-- <div class="modal fade" id="catvideoModal" tabindex="-1" aria-labelledby="catvideoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-0 p-0">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <iframe src="https://www.youtube.com/embed/nWwpyclIEu4" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="100%" height="315" frameborder="0"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</section> -->

	<!-- <img src="<?php //echo $categoryBannerImage; ?>" alt="Category Banner" width="auto" height="400"><br>
	<h1 class="cat-name text-white wow fadeInLeft" 
	style="visibility: visible; animation-name: fadeInLeft;">
	<?php //echo $categoryBannerTitle; ?>
	</h1>
	<p class="cat-desc text-white wow fadeInLeft" data-wow-delay=".3s" 
	style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
	<?php //echo $categorySeoDesc; ?>
	</p>
	<img src="<?php //echo $statsIcon1; ?>" alt="Statistics Icon 01" width="28" height="28">
	<h4 class="fact-title"><?php //echo $statsTitle1; ?>
		<span class="small-text"><?php //echo $statsContent1; ?></span>
	</h4>
	<img src="<?php //echo $statsIcon2; ?>" alt="Statistics Icon 02" width="28" height="28">
	<h4 class="fact-title"><?php //echo $statsTitle2; ?>
		<span class="small-text"><?php //echo $statsContent2; ?></span>
	</h4>
	<img src="<?php //echo $statsIcon3; ?>" alt="Statistics Icon 03" width="28" height="28">
	<h4 class="fact-title"><?php //echo $statsTitle3; ?>
		<span class="small-text"><?php //echo $statsContent3; ?></span>
	</h4>
	<img src="<?php //echo $statsIcon4; ?>" alt="Statistics Icon 04" width="28" height="28">
	<h4 class="fact-title"><?php //echo $statsTitle4; ?>
		<span class="small-text"><?php //echo $statsContent4; ?></span>
	</h4> -->
	<!-- END 29.01.2022 -->

	<div class="thb-page-header">
		<h2><?php echo $banner_title;?> From Universities</h2>
	</div>
	<div class="row">
	<?php
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
			<?php
			get_template_part( 'inc/templates/postbit/course-grid' );
			
			//get_template_part( 'inc/templates/postbit/newsroom-grid' );
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
		'tax_query' => array(
			array(
			  'taxonomy' => $qobj->taxonomy,
			  'field' => 'id',
			  'terms' => $qobj->term_id,
			)
		  ),
		 'orderby' => array( 
		   'title' => 'ASC' 
		)
	);
$loop = new WP_Query($args); 
if ( $loop->have_posts()) {
$noPostCount  = 0;
	?>
	<div class="thb-page-header">
		<h2><?php //echo $banner_title;?>By Emeritus in Collaboration with Universities</h2>
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

if($noPostCount)
{
	?>
	<div class="row">
	<?php get_template_part( 'inc/templates/not-found' ); ?>
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