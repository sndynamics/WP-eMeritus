<?php get_header(); 
$qobj = get_queried_object();

/*When redirecting from Emeritus Website to Marketing LP we should pass the following utm parameters along with the above 2 (utm_medium + utm_campaign)*/
global $web_utmcontent,$web_utmterm;
$web_utmcontent	 = 'University';
$web_utmterm	 = trim($qobj->name);

$blog_header  = ot_get_option( 'blog_header', 'style1' );
$blog_style   = 'taxonomy-style';//ot_get_option( 'blog_style', 'style3' );
$blog_sidebar = ot_get_option( 'blog_sidebar', 'on' );

$banner_image = get_term_meta($qobj->term_id, 'wpcf-category-banner-image', true);
$banner_title = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);

// START 31.01.2022
	
$universityBannerImage = get_term_meta($qobj->term_id, 'wpcf-university-banner', true);
//$categoryBannerTitle = get_term_meta($qobj->term_id, 'wpcf-category-banner-title', true);
//$categorySeoDesc = get_term_meta($qobj->term_id, 'wpcf-category-seo-desc', true);

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

$universityLocation = get_term_meta($qobj->term_id, 'wpcf-university-location', true);
$universityIcon = get_term_meta($qobj->term_id, 'wpcf-university-icon', true);
$universityLogoSmall = get_term_meta($qobj->term_id, 'wpcf-university-logo-small', true);
$universityImage = get_term_meta($qobj->term_id, 'wpcf-university-image', true);
$universityVideo = get_term_meta($qobj->term_id, 'wpcf-university-video', true);
$universityWhySection = get_term_meta($qobj->term_id, 'wpcf-university-why-section', true);
$universityShortCode = get_term_meta($qobj->term_id, 'wpcf-university-short-code', true);
$universityOrderBy = get_term_meta($qobj->term_id, 'wpcf-university-order-by', true);
$universityRanking = get_term_meta($qobj->term_id, 'wpcf-university-ranking', true);
$universityRankingDesc = get_term_meta($qobj->term_id, 'wpcf-university-ranking-desc', true);

// END 31.01.2022

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


<h1> data fetched from taxonomy-university.php </h1>
<!-- START 31.01.2022 -->
<h1 class="cat-name text-white wow fadeInLeft" 
	style="visibility: visible; animation-name: fadeInLeft;">
	<?php echo $banner_title; ?>
	</h1>
	<img src="<?php echo $universityBannerImage; ?>" alt="university Banner Image" width="auto" height="450"> 
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
	<?php
	echo $universityLocation . '<br>' ;
	echo '<img src='.$universityIcon.' '.'width=150>' ;
	echo '<img src='.$universityLogoSmall.' '.'width=150>' ;
	echo '<img src='.$universityImage.' '.'width=150>' ;
	echo $universityVideo . '<br>' ;
	echo $universityWhySection . '<br>' ;
	echo $universityShortCode . '<br>' ;
	echo $universityOrderBy . '<br>' ;
	echo $universityRanking . '<br>' ;
	echo $universityRankingDesc . '<br>' ;
	?>
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