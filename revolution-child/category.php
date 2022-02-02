<?php get_header(); 
$qobj = get_queried_object();

/*When redirecting from Emeritus Website to Marketing LP we should pass the following utm parameters along with the above 2 (utm_medium + utm_campaign)*/
global $web_utmcontent,$web_utmterm;
$web_utmcontent	 = 'Category';
$web_utmterm	 = trim($qobj->name);

$blog_header  = ot_get_option( 'blog_header', 'style1' );
$blog_style   = 'category-style';//ot_get_option( 'blog_style', 'style3' );
$blog_sidebar = ot_get_option( 'blog_sidebar', 'on' );

//$banner_image = get_term_meta($qobj->term_id, 'wpcf-category-banner-image', true);
$banner_title = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);

	// START 30.01.2022
	
	$categoryBannerImage = get_term_meta($qobj->term_id, 'wpcf-category-banner-image', true);
	//$categoryBannerTitle = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);
	$categorySeoDesc = get_term_meta($qobj->term_id, 'wpcf-category-seo-desc', true);

	// Fetch Data from Toolset => Custom Fields Group => Stats
	$statsIcon1 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-1', true);
	$statsTitle1 = get_term_meta($qobj->term_id, 'wpcf-stats-title-1', true);
	$statsContent1 = get_term_meta($qobj->term_id, 'wpcf-stats-content-1', true);
	
	$statsIcon2 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-2', true);
	$statsTitle2 = get_term_meta($qobj->term_id, 'wpcf-stats-title-2', true);
	$statsContent2 = get_term_meta($qobj->term_id, 'wpcf-stats-content-2', true);

	$statsIcon3 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-3', true);
	$statsTitle3 = get_term_meta($qobj->term_id, 'wpcf-stats-title-3', true);
	$statsContent3 = get_term_meta($qobj->term_id, 'wpcf-stats-content-3', true);

	$statsIcon4 = get_term_meta($qobj->term_id, 'wpcf-stats-icon-4', true);
	$statsTitle4 = get_term_meta($qobj->term_id, 'wpcf-stats-title-4', true);
	$statsContent4 = get_term_meta($qobj->term_id, 'wpcf-stats-content-4', true);

	$categoryVideoUrl = get_term_meta($qobj->term_id, 'category-video-url', true);
	

if(empty($banner_title))
{
	$banner_title = $qobj->name;
}
$description = '';//'Programs from';
?>
<div class="thb-page-header">
	<h1><?php echo $banner_title;?></h1>
	<?php if (!empty($qobj->description)) { ?>
		<div class="row align-center archive-description">
			<div class="small-12 medium-10 large-8 columns">
				<?php
				echo wp_kses_post( $qobj->description );
				?>
			</div>
		</div>
	<?php } ?>
</div>
<!-- START 30.01.2022 -->
<h1> data fetched from category.php </h1>
<!-- <img src="<?php //echo $statsIcon1; ?>" alt="Statistics Icon 01" width="150" height="150"> -->

<!-- <h1>JUST TRY FOR DESIGN - Static </h1> -->
<!-- JUST TRY FOR DESIGN -->
<!-- <section id="categoryBanner" style="background-image: <?php //echo $categoryBannerImage; ?>">
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
          <p class="mt-4 text-white mb-0 watch"> <img src="img/categories/icons/Icon feather-arrow-down.png"><span class="d-block">Watch finance intro video</span></p>
		-->
          <!--Category video Modal -->
          <!--<div class="modal fade" id="catvideoModal" tabindex="-1" aria-labelledby="catvideoModalLabel" aria-hidden="true">
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
	<!-- END 30.01.2022 -->

	<!-- START 31.01.2022 -->
	<h1 class="cat-name text-white wow fadeInLeft" 
	style="visibility: visible; animation-name: fadeInLeft;">
	<?php echo $categoryBannerTitle; ?>
	</h1>
	<img src="<?php echo $categoryBannerImage; ?>" alt="Statistics Icon 01" width="auto" height="450"> 
	<p class="cat-desc text-white wow fadeInLeft" data-wow-delay=".3s" 
	style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
	<?php echo $categorySeoDesc; ?>
	</p>
	<img src="<?php echo $statsIcon1; ?>" alt="Statistics Icon 01" width="28" height="28">
	<h4 class="fact-title"><?php echo $statsTitle1; ?>
		<span class="small-text"><?php echo $statsContent1; ?></span>
	</h4>
	<img src="<?php echo $statsIcon2; ?>" alt="Statistics Icon 02" width="28" height="28">
	<h4 class="fact-title"><?php echo $statsTitle2; ?>
		<span class="small-text"><?php echo $statsContent2; ?></span>
	</h4>
	<img src="<?php echo $statsIcon3; ?>" alt="Statistics Icon 03" width="28" height="28">
	<h4 class="fact-title"><?php echo $statsTitle3; ?>
		<span class="small-text"><?php echo $statsContent3; ?></span>
	</h4>
	<img src="<?php echo $statsIcon4; ?>" alt="Statistics Icon 04" width="28" height="28">
	<h4 class="fact-title"><?php echo $statsTitle4; ?>
		<span class="small-text"><?php echo $statsContent4; ?></span>
	</h4> 

	<?php echo $categoryVideoUrl; ?>
	<!-- END 31.01.2022 -->

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


