<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
	$vars          = $wp_query->query_vars;
	$columns       = array_key_exists( 'columns', $vars ) ? $vars['columns'] : 'large-4';
	$thb_animation = array_key_exists( 'thb_animation', $vars ) ? $vars['thb_animation'] : false;
	$thb_excerpt   = array_key_exists( 'thb_excerpt', $vars ) ? $vars['thb_excerpt'] : false;
	$thb_cat       = array_key_exists( 'thb_cat', $vars ) ? $vars['thb_cat'] : true;
	
	$arrCat 				= get_the_terms(get_the_ID(), 'newsroom-category');
	$article_date 			= types_render_field('article-date', array('output' => 'normal', 'id' => $post->ID));
	$article_link 			= types_render_field('article-link', array('output' => 'raw', 'id' => $post->ID));
	$article_publication 	= types_render_field('publication-name', array('output' => 'normal', 'id' => $post->ID));

	
	//get_the_terms(get_the_ID(), '');
	$format    = get_post_format();
	$permalink = get_the_permalink();
	
	$target_tab = "";
	if(!empty(trim($article_link)))
	{
		$permalink = $article_link;
		$target_tab = 'target="_blank"';
	}
?>
<div class="small-12 medium-6 <?php echo esc_attr( $columns . ' ' . $thb_animation ); ?> columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post style10 newsroom' ); ?>>
		<div>
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" <?php echo $target_tab;?>>
					<?php the_post_thumbnail( 'revolution-bloglarge' ); ?>
				</a>
			</figure>
			<?php } ?>
			<div class="style10-content">
				<aside class="post-category">
					<?php
					$categories = array();
					if(!empty($arrCat) && count($arrCat)>0)
					{
						foreach($arrCat as $category) {
						  $categories[] = $category->name;
						}
					}
					echo implode(', ',$categories);
					?>
				</aside>
				<header class="post-title entry-header">
					<?php the_title( '<h4 class="entry-title" itemprop="name headline"><a href="' . esc_url( $permalink ) . '" title="' . the_title_attribute( 'echo=0' ) . '" '.$target_tab.' class="nohover">', '</a></h4>' ); ?>
				</header>
				<?php /*if ( $thb_excerpt ) { ?>
					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>
				<?php }*/ ?>
				<aside class="post-category">
					<?php echo ucwords(date('j F Y', strtotime($article_date))); ?> | <?php echo $article_publication; ?>
				</aside>
				<a href="<?php echo esc_url( $permalink ); ?>" title="<?php the_title_attribute(); ?>" class="style10-readmore" <?php echo $target_tab;?>><?php esc_html_e( 'Read Article &#x203A;', 'revolution' ); ?></a>
			</div>
		</div>
		<?php do_action( 'thb_postmeta' ); ?>
	</article>
</div>

