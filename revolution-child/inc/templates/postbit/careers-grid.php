<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
	$vars          = $wp_query->query_vars;
	$columns       = array_key_exists( 'columns', $vars ) ? $vars['columns'] : 'large-4';
	$thb_animation = array_key_exists( 'thb_animation', $vars ) ? $vars['thb_animation'] : false;
	$thb_excerpt   = array_key_exists( 'thb_excerpt', $vars ) ? $vars['thb_excerpt'] : false;
	$thb_cat       = array_key_exists( 'thb_cat', $vars ) ? $vars['thb_cat'] : true;
	$arrCat 		= get_the_terms(get_the_ID(), 'career-category');
	$location = types_render_field('job-location', array('output' => 'normal', 'id' => $post->ID));
	
	//get_the_terms(get_the_ID(), '');
	$format    = get_post_format();
	$permalink = get_the_permalink();
	if ( 'link' === $format ) {
		$permalink = get_post_meta( get_the_ID(), 'post_link', true );
	}
?>
<div class="small-12 medium-6 <?php echo esc_attr( $columns . ' ' . $thb_animation ); ?> columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post style10' ); ?>>
		<div>
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<a href="<?php echo esc_url( $permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
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
					<?php the_title( '<h4 class="entry-title" itemprop="name headline"><a href="' . esc_url( $permalink ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="nohover">', '</a></h4>' ); ?>
				</header>
				<?php /*if ( $thb_excerpt ) { ?>
					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>
				<?php }*/ ?>
				<aside class="post-category">
					<?php echo $location; ?>
				</aside>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="style10-readmore"><?php esc_html_e( 'Read More &#x203A;', 'revolution' ); ?></a>
			</div>
		</div>
		<?php do_action( 'thb_postmeta' ); ?>
	</article>
</div>

