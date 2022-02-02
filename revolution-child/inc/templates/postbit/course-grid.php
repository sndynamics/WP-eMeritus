<?php
	global $web_utmcontent,$web_utmterm;
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );

	$vars          = $wp_query->query_vars;
	$columns       = array_key_exists( 'columns', $vars ) ? $vars['columns'] : 'large-4';
	$thb_animation = array_key_exists( 'thb_animation', $vars ) ? $vars['thb_animation'] : false;
	$thb_simple    = array_key_exists( 'thb_simple', $vars ) ? $vars['thb_simple'] : true;
	$thb_date      = array_key_exists( 'thb_date', $vars ) ? $vars['thb_date'] : true;
	$thb_excerpt   = array_key_exists( 'thb_excerpt', $vars ) ? $vars['thb_excerpt'] : false;
	$thb_cat       = array_key_exists( 'thb_cat', $vars ) ? $vars['thb_cat'] : true;

	$format    = get_post_format();
	$course_url_link = get_the_permalink();
	
	// custom code
	$duration = types_render_field('duration', array('output' => 'normal', 'id' => $post->ID));
	$prg_short_code = types_render_field('program-short-code', array('output' => 'normal', 'id' => $post->ID));
	$collaborationTitle = types_render_field('collaboration-title', array('output' => 'normal', 'id' => $post->ID));
	
	// START 29.01.2022
	// Fetch Data from Toolset => Custom Fields Group => Programs
	$startDate = types_render_field('start-date', array('output' => 'normal', 'id' => $post->ID));
	$endDate = types_render_field('end-date', array('output' => 'normal', 'id' => $post->ID));
	$hoursPerWeek = types_render_field('hours-per-week', array('output' => 'normal', 'id' => $post->ID));
	$courseType = types_render_field('course-type', array('output' => 'normal', 'id' => $post->ID));
	$courseFee = types_render_field('course-fee', array('output' => 'normal', 'id' => $post->ID));
	// END 29.01.2022

	$universities = get_the_terms(get_the_ID(), 'university');
	$arrCat = get_the_terms(get_the_ID(), 'category');
	$uniFilter = isset($universities[0]->term_id)?'filterSchool'.$universities[0]->term_id:'';
	$catFilter = isset($arrCat[0]->term_id)?'filterCat'.$arrCat[0]->term_id:'';
	$program_type 	= $post->post_type;
	$progFilter = 'filterCertificate';
	if($program_type == 'diploma-program')
	{
		$progFilter = 'filterDiploma';
	}
	
	$LP_URL =  types_render_field('external-landing-page-url', array('output' => 'raw', 'id' => $post->ID));
	$target_tab = "";
	if(!empty(trim($LP_URL)))
	{
		$utmParams		 = getUTMParameters($web_utmcontent,$web_utmterm);
		$course_url_link = $LP_URL;
		if(!empty($utmParams))
		{
			$course_url_link .= '?'.$utmParams;
		}
		$target_tab = 'target="_blank"';
	}
	else{
		$course_url_link = 'javascript:void(0);';
	}
?>

<div class="small-12 medium-6 <?php echo esc_attr( $columns . ' ' . $thb_animation ); ?> columns">
	
	<a href="<?php echo ( $course_url_link ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" <?php echo $target_tab;?> class="nohover">
		<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post style10' ); ?>>
		<div>
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery course-gallery">
					<?php the_post_thumbnail( 'revolution-bloglarge' ); ?>
			</figure>
			<?php } ?>
			<div class="style10-content">
				<div class="grid_toppart">
					<header class="post-title entry-header">
						<?php the_title( '<h4 class="entry-title" itemprop="name headline">', '</h4>' ); ?>
					</header>
					<aside class="post-category duration-btm">
						<span><?php echo $duration ?></span>
						<!-- START 29.01.2022
						// Display Data fetched from Toolset => Custom Fields Group => Programs 
						-->
						<span><?php echo $startDate ?></span>
						<span><?php echo $endDate ?></span>
						<span><?php echo $hoursPerWeek ?></span>
						<span><?php echo $courseType ?></span>
						<span><?php echo $courseFee ?></span>
						<!-- END 29.01.2022 -->
						<?php
						/*if($program_type == 'diploma-program')
						{
							?>
							TBD <span> (<?php echo $duration ?>) </span>
							<?php
						}
						else
						{
							?>
							<span><?php echo $duration ?></span>
							<?php
						}*/
						?>
					</aside> 
				</div>
				<?php /*if ( $thb_excerpt ) { ?>
					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>
				<?php }*/ ?>
				<?php
				if($program_type == 'diploma-program')
				{
					if ($universities){
						$icon = array();
						$schema_school_name = array();
						foreach ($universities as $university) {       
							$schema_school_name[] = $university->name;
							$image_src = get_term_meta($university->term_id, 'wpcf-university-logo-small', true);
							$icon[] = array('img'=>$image_src,'name'=>$university->name);                    
							?>
							<?php
						}
						$schema_school_name_str = implode(', ',$schema_school_name);
						?>
						<aside class="post-category school_div">
							<div class="schoolLogo">
								<?php
								if($collaborationTitle)
								{
									?>
									<span class="in-collob"><?php echo $collaborationTitle;?></span>
									<?php
								}
								?>
								<ul class="no-bullet uni-name">
									<?php 
									foreach ($icon as $sr => $ic)
									{
										?>
										<li><?php 
										if($sr>0)
										{
											echo " and ";
										}
										echo $ic['name'];?></li>
										<?php
									}
									?>
								</ul>                        
							</div> 
						</aside>
						<?php
					}

				}
				else
				{
					if ($universities){
						$icon = array();
						$schema_school_name = array();
						foreach ($universities as $university) {       
							$schema_school_name[] = $university->name;
							$image_src = get_term_meta($university->term_id, 'wpcf-university-logo-small', true);
							$icon[] = array('img'=>$image_src,'name'=>$university->name);                    
							?>
							<?php
						}
						$schema_school_name_str = implode(', ',$schema_school_name);
						?>
						<aside class="post-category school_div">
							<?php
							if($collaborationTitle)
							{
								?>
								<span class="in-collob"><?php echo $collaborationTitle;?></span>
								<?php
							}
							?>
							<div class="schoolLogo">
								
								<ul class="no-bullet">
									<?php 
									foreach ($icon as $ic)
									{
										?>
										<li><img src="<?= $ic['img']; ?>" alt="<?= $ic['name']; ?>"></li>
										<?php
									}
									?>
								</ul>                        
							</div> 
						</aside>
						<?php
					}
				}
				?>
				<?php /*?><a href="<?php echo esc_url( $course_url_link ); ?>" title="<?php the_title_attribute(); ?>" class="style10-readmore" <?php echo $target_tab;?>><?php esc_html_e( 'Learn More &#x203A;', 'revolution' ); ?></a><?php */?>
			</div>
		</div>
		<?php do_action( 'thb_postmeta' ); ?>
	</article>
	</a>
</div>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "<?php echo html_entity_decode(get_the_title());?>", 
   "description": "<?php echo (get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true))?get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true):html_entity_decode(get_the_title()); ?>",   
  "provider": {
  "@type": "Organization",
  "name": "<?php echo $schema_school_name_str; ?>",     
  "sameAs": "<?php echo (!empty($LP_URL))?$LP_URL:wp_get_canonical_url();?>"
  }
}
</script>
