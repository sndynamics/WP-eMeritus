<?php
$qobj = get_queried_object();
$blog_pagination_style = is_home() ? ot_get_option( 'blog_pagination_style', 'style1' ) : 'style1';
$thb_blog_columns      = 3;//ot_get_option( 'thb_blog_columns', '4' );
$blog_animation        = ot_get_option( 'blog_animation', '' );
$columns               = thb_translate_columns( $thb_blog_columns );

$vars          	= $wp_query->query_vars;
$columns       	= ($columns) ? ($columns) : 'large-4';
$thb_animation 	= false;
$format    		= get_post_format();


$terms = get_terms(
        array(
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
        )
);

if (!empty($terms)):

	foreach ($terms as $t):
		$order_by = get_term_meta( $t->term_id, 'wpcf-university-order-by', true);
		$t->order_by = $order_by;
		$cust[] =(array) $t;
	endforeach;
	
	function sortByOrder($a, $b) {
		return $a['order_by'] - $b['order_by'];
	}
	usort($cust, 'sortByOrder');
	
	if(isset($is_home_page) && $is_home_page == 1)
	{
		$cust = array_slice($cust, 0, 6, true);
		?>	
		<div class="thb-page-header">
			<h2><?php echo $banner_title;?>Universities we work with</h2>
		</div>
		<?php
	}
	else if(isset($is_home_page) && $is_home_page == 2)/*404 page*/
	{
		?>	
		<div class="thb-page-header">
			<h2><?php echo $banner_title;?>Universities we work with</h2>
		</div>
		<?php
	}
	?>
			<!-- START 01.02.2022 -->
			<h1>from university-style.php page</h1>
			<?php
			$universityImage = get_term_meta($t['term_id'], 'wpcf-university-image', true);
			$featuredImage = get_term_meta($t['term_id'], 'wpcf-university-logo-small', true);
			$categoryBannerImage = get_term_meta($t['term_id'], 'wpcf-category-banner-image', true);
			$universityBannerImage = get_term_meta($qobj->term_id, 'wpcf-university-banner', true);
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
?>
<img src="<?php echo $universityImage; ?>" alt="Girl in a jacket" width="100%" height="600">
<img src="<?php echo $universityBannerImage; ?>" alt="university Banner Image" width="auto" height="450"> 
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


	<div class="row">
		<?php
		foreach ($cust as $keyIndex => $t)
		{

			$argsCourse = array(
					  'post_type' => array('university-courses','program', 'diploma-program'),
					  'post_status' => 'publish',
					  'tax_query' => array(
						array(
						  'taxonomy' => 'university',
						  'field' => 'id',
						  'terms' => $t['term_id'],
						)
					  )
				);

			$loopCourse = new WP_Query($argsCourse);
			//if course exists
			if ($loopCourse->have_posts())
			{
			?> 

			

				<div class="small-12 medium-6 <?php echo esc_attr( $columns . ' ' . $thb_animation ); ?> columns">
					<a href="<?php echo esc_url( get_term_link($t['term_id']) ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="nohover">
					<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post style10' ); ?>>
						<div>
							<?php
							if(!empty($universityImage))
							{
								?>
								<figure class="post-gallery course-gallery">
										<img width="370" height="180" src="<?php echo $universityImage;?>" class="attachment-revolution-bloglarge size-revolution-bloglarge wp-post-image" alt="<?php the_title_attribute(); ?>" loading="lazy" sizes="(max-width: 370px) 100vw, 370px"/>
								</figure>
								<?php
							}
							?>
							<div class="style10-content">
								<aside class="post-category">
									<div class="schoolLogo">
										<ul class="no-bullet">
											<li><img src="<?= $featuredImage; ?>" alt="<?= $t['name']; ?>"></li>
										</ul>
									</div> 
								</aside>
								<?php /*?><a href="<?php echo esc_url( get_term_link($t['term_id']) ); ?>" title="<?php the_title_attribute(); ?>" class="style10-readmore"><?php esc_html_e( 'View Courses &#x203A;', 'revolution' ); ?></a><?php */?>
							</div>
						</div>
					</article>
				</a>
				</div>

			<?php
			}
		}
		?>  
	</div>
<?php endif; ?>


