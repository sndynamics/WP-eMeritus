<?php
/*if external page link exists than redirect*/ 
$article_link   = types_render_field('article-link', array('output' => 'raw', 'id' => $post->ID));
if(!empty(trim($article_link)))
{
	wp_redirect( $article_link, 301 ) ;
	exit;
}
/*if external page link exists than redirect*/

get_header(); 
?>
<?php
$article_sidebar     = ot_get_option( 'article_sidebar', 'on' );
$article_author_name = ot_get_option( 'article_author_name', 'on' );
$article_date        = ot_get_option( 'article_date', 'on' );
$article_cat         = ot_get_option( 'article_cat', 'on' );

$thb_id         = get_the_ID();
$post_header_bg = get_post_meta( $thb_id, 'post_header_bg', true );
$article_style  = ot_get_option( 'article_style', 'style2' );

$article_sidebar     = ot_get_option( 'article_sidebar', 'on' );
$article_author_name = ot_get_option( 'article_author_name', 'on' );
$article_date        = ot_get_option( 'article_date', 'on' );
$article_cat         = ot_get_option( 'article_cat', 'on' );
	
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$arrCat 				= get_the_terms(get_the_ID(), 'newsroom-category');
		$article_date 			= types_render_field('article-date', array('output' => 'normal', 'id' => $post->ID));
		$article_link 			= types_render_field('article-link', array('output' => 'raw', 'id' => $post->ID));
		$article_publication 	= types_render_field('publication-name', array('output' => 'normal', 'id' => $post->ID));
		?>
		<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post post-detail style1-detail custompost-detail' ); ?>>
		<figure class="post-gallery parallax post-gallery-detail">
			<div class="parallax_bg">
				<?php if ( $post_header_bg ) { ?>
					<style>
						.post-<?php echo esc_attr( $thb_id ); ?> .parallax_bg {
							<?php thb_bgoutput( $post_header_bg ); ?>
						}
					</style>
					<?php
				} else {
					//the_post_thumbnail( 'revolution-wide-3x' ); 
				}
				?>
			</div>

			<div class="header-spacer-force"></div>
			<header class="post-title entry-header animation bottom-to-top-3d">
				<div class="row align-center">
					<div class="small-12 medium-10 large-7 columns">
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
						<?php the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' ); ?>
						<aside class="post-meta">
							<?php echo ucwords(date('j F Y', strtotime($article_date))); ?> | <?php echo $article_publication; ?>
						</aside>
					</div>
				</div>
			</header>
		</figure>
		<div class="row align-center">
			<div class="small-12 columns">
				<div class="post-content">
					<?php the_content(); ?>
					<?php// wp_link_pages(); ?> 
				</div>
				<?php //get_template_part( 'inc/templates/blog/post-tags' ); ?>
			</div>
			<?php
			if ( 'on' === $article_sidebar ) {
				get_sidebar( 'single' ); }
			?>
		</div>
		<?php //get_template_part( 'inc/templates/blog/post-end' ); ?>
		<?php //do_action( 'thb_postmeta' ); ?>
	</article>
		<?php
	endwhile;
endif;
?>
<?php
get_footer();
