<?php 
/* 
Template Name: Career Page
*/
get_header(); 

$blog_header  = ot_get_option( 'blog_header', 'style1' );
$blog_style   = 'careers-style';//ot_get_option( 'blog_style', 'style3' );
$blog_sidebar = ot_get_option( 'blog_sidebar', 'on' );

//get_template_part( 'inc/templates/blog/blog-header-' . $blog_header );
?>
<div <?php post_class( 'page-padding' ); ?>>
	<div class="row">
		<div class="small-12 <?php if ( 'on' === $sidebar ) { ?>medium-8<?php } ?> small-order-1 columns">
			<header class="post-title page-title">
				<h1 class="entry-title" itemprop="name headline">OPEN POSITIONS</h1>
			</header>
			<div class="post-content no-vc">
				At Emeritus, our vision is to MAKE WORLD-CLASS EDUCATION ACCESSIBLE AND AFFORDABLE TO WORKING PROFESSIONALS ACROSS THE GLOBE. Online education can be truly transformational for an individual’s career. Join our dynamic team of professionals in creating and providing world-class programs.
			</div>
		</div>
	</div>
</div>
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
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
	<div <?php post_class( 'page-padding' ); ?>>
		<div class="row">
			<?php if ( 'on' === $sidebar ) { ?>
				<div class="small-12 medium-4 small-order-2 <?php if ( 'left' === $sidebar_pos ) { ?>medium-order-1<?php } ?> columns">
					<?php
					if ( 'on' === $custom_sidebar ) {
						$custom_sidebar_id = get_post_meta( $thb_id, 'custom_sidebar_id', true );
						dynamic_sidebar( $custom_sidebar_id );
					} else {
						dynamic_sidebar( 'page' );
					}
					?>
				</div>
			<?php } ?>
			<div class="small-12 <?php if ( 'on' === $sidebar ) { ?>medium-8<?php } ?> small-order-1 columns">
				<div class="post-content no-vc">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
		<?php
endwhile;
endif;
?>

<script type="text/javascript">
jQuery.noConflict($);
/* Ajax functions */
jQuery(document).ready(function($) {
	container 	= $('.pagination-loadmore'),
	security 	= container.data('security'),
	page 		= 2,
	thb_loading = false,
	count 		= container.data('count'),
	l 			= <?php echo get_option( 'posts_per_page' );?>,
	ppp 		= <?php echo get_option( 'posts_per_page' );?>,
	preloader 	= container.parents('.blog-container').find('.thb-content-preloader');
	
	var scrollFunction = _.debounce(function(){
		if ( (thb_loading === false ) && ( (jQuery(window).scrollTop() + jQuery(window).height() + 150) >= (container.offset().top + container.outerHeight()) ) ) {
			if (preloader.length) {
				gsap.set(preloader, {autoAlpha: 1});
			}
			$.ajax( themeajax.url, {
				method : 'POST',
				data : {
					action: 'thb_ajax_loadmore',
					post_type: 'career',
					template: 'careers-grid',
					columns: '3',
					security: security,
					page : page++
				},
				beforeSend: function() {
					thb_loading = true;
				},
				success : function(data) {
					var d = $.parseHTML($.trim(data));
					l += parseInt(ppp);
							
					console.log(l+"=="+count);
					if (preloader.length) {
						gsap.to(preloader, {duration: 0.25, autoAlpha: 0});
					}
					if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
						jQuery('.pagination-space').css('display','none');
						//jQuery(window).off('scroll', scrollFunction);
						
					} else {
						$(d).appendTo(container).hide().imagesLoaded(function() {
							if (container.data('isotope')) {
								container.isotope('appended', $(d));
							}
							$(d).show();
							thb_loading = false;
						});

						if (l >= count) {
							equalHeights();
							jQuery(window).on('scroll', scrollFunction);
						}
						
					}
				}
			});
		}
	}, 30);

	jQuery(window).scroll(scrollFunction);
});
</script>
<?php
get_footer();