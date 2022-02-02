<?php 
add_action('init', 'setUTMCookie');
function setUTMCookie(){
   $all_the_params_to_track = [
		  'gclid','media_id','utm_ad_id','utm_adset_id','utm_campaign_id','utm_campaign','utm_content','utm_medium','utm_placement','utm_source','utm_term','fbclid'
		];
	$arrTrack = array();
	$isQueryExists 		= false;
	$isCookieExists 	= false;
	$isOrganic		 	= false;
	
	foreach($all_the_params_to_track as $utmData)
	{
		if(isset($_COOKIE['_em_'.$utmData]) && !empty($_COOKIE['_em_'.$utmData]))
		{				
			$isCookieExists = true;
		}
	}
	
	if(!$isCookieExists)
	{
		foreach($all_the_params_to_track as $utmData)
		{
			if(isset($_GET[$utmData]) && !empty($_GET[$utmData]))
			{
				$isQueryExists  = true;
				$UTMValue		= sanitize_text_field($_GET[$utmData]);
				$newdata = $utmData.'='.$UTMValue;
				array_push($arrTrack,$newdata);
				
				/*Get NO UTM SET Than only update the cookie*/
				$paramNew	= '_em_'.$utmData;
				setcookie($paramNew, $UTMValue, time() + 60*60*24*1095,'/');
			}
		}
	}
	
	/*if no cookie & no query string than default organic*/
	if(!$isQueryExists && !$isCookieExists)
	{
		$referCampaign = 'direct';
		if ((isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))) {
			if (strtolower(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)) != strtolower($_SERVER['HTTP_HOST'])) {
				// referer not from the same domain
				$referCampaign = 'organic';
			}
		}
		setcookie('_em_utm_campaign', $referCampaign, time() + 60*60*24*1095,'/');
		setcookie('_em_utm_medium', 'EmWebsite', time() + 60*60*24*1095,'/');
	}
}

function thb_ajax_loadmore() {
	check_ajax_referer( 'thb_blog_ajax', 'security' );
	$page       = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );
	$post_type  = filter_input( INPUT_POST, 'post_type', FILTER_SANITIZE_STRING );
	$columns  	= filter_input( INPUT_POST, 'columns', FILTER_SANITIZE_STRING );
	$template 	= filter_input( INPUT_POST, 'template', FILTER_SANITIZE_STRING );

	$ppp        = get_option( 'posts_per_page');
	$blog_style = $template;

	$args = array(
		'post_type' =>array($post_type),
		'posts_per_page' => $ppp,
		'paged'          => $page,
		'post_status'    => 'publish'
	);
	
	if($post_type == 'newsroom')
	{
		$args['meta_key'] = 'wpcf-article-date';
		$args['orderby'] = 'meta_value';
		$args['order'] = 'DESC';
	}
	else{
		$args['orderby'] = 'date';
		$args['order'] = 'desc';
	}
	
	$thb_blog_columns = $columns;
	$blog_animation   = ot_get_option( 'blog_animation', '' );
	$columns          = thb_translate_columns( $thb_blog_columns );

	$more_query = new WP_Query( $args );
	
	add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );
	if ( $more_query->have_posts() ) :
		while ( $more_query->have_posts() ) :
			$more_query->the_post();
			set_query_var( 'columns', $columns );
			set_query_var( 'thb_animation', $blog_animation );
			if ( 'style5' === $blog_style ) {
				set_query_var( 'thb_i', '999' );
			}
			get_template_part( 'inc/templates/postbit/' . $blog_style );
	endwhile;
	endif;
	wp_die();
}
add_action( 'wp_ajax_nopriv_thb_ajax_loadmore', 'thb_ajax_loadmore' );
add_action( 'wp_ajax_thb_ajax_loadmore', 'thb_ajax_loadmore' );


add_filter('pto/posts_orderby/ignore', 'theme_pto_posts_orderby', 10, 3);
function theme_pto_posts_orderby($ignore, $orderBy, $query)
{
	if((! is_array($query->query_vars['post_type']) && ($query->query_vars['post_type'] == 'newsroom')))
	{
		$ignore = TRUE;
	}
	else if(is_array($query->query_vars['post_type']) && (in_array('newsroom',$query->query_vars['post_type']) || in_array('university-courses',$query->query_vars['post_type']) || in_array('program',$query->query_vars['post_type']) || in_array('diploma-program',$query->query_vars['post_type'])))
	{
		$ignore = TRUE;
	}
  
	return $ignore;
}

function getUTMParameters($utm_content= '',$utm_term = '')
{
	$all_the_params_to_track = [
		  'gclid','media_id','utm_ad_id','utm_adset_id','utm_campaign_id','utm_campaign','utm_content','utm_medium','utm_placement','utm_source','utm_term','fbclid'
		];
	$arrTrack = array();
	$isQueryExists 		= false;
	$isCookieExists 	= false;
	$isOrganic		 	= false;
	
	foreach($all_the_params_to_track as $utmData)
	{
		if(isset($_COOKIE['_em_'.$utmData]) && !empty($_COOKIE['_em_'.$utmData]))
		{				
			$isCookieExists = true;
			$newdata = $utmData.'='.htmlspecialchars($_COOKIE['_em_'.$utmData], ENT_QUOTES);
			array_push($arrTrack,$newdata);
		}
	}
	
	if(isset($_COOKIE['_em_utm_campaign']) && (strtolower(trim($_COOKIE['_em_utm_campaign'])) == 'organic' || strtolower(trim($_COOKIE['_em_utm_campaign'])) == 'direct'))
	{
		$referCampaign   = htmlspecialchars($_COOKIE['_em_utm_campaign'], ENT_QUOTES);
		$isOrganic		 = true;
	}
	
	
	if(!$isCookieExists)
	{
		foreach($all_the_params_to_track as $utmData)
		{
			if(isset($_GET[$utmData]) && !empty($_GET[$utmData]))
			{
				$isQueryExists  = true;
				$newdata = $utmData.'='.sanitize_text_field($_GET[$utmData]);
				array_push($arrTrack,$newdata);
			}
		}
	}
	
	
	/*if no cookie & no query string than default organic*/
	if(!$isQueryExists && !$isCookieExists)
	{
		$isOrganic		 = true;
	}
	
	/*set utm campaign and term based on the page if cookie not exists PSD-584*/
	if($isOrganic)
	{
		$position = array_search('utm_medium=EmWebsite', $arrTrack);
		if(false !== $position && isset($arrTrack[$position]))
		{
			unset($arrTrack[$position]);
		}
		$newdata = 'utm_medium=EmWebsite';
		array_push($arrTrack,$newdata);
	}
	
	/*Update utm_campaign Parameter on website tracking for organic traffic PSD-603*/
	if($isOrganic && trim($utm_content) != '')
	{
		$newdata = 'utm_content='.$utm_content;
		array_push($arrTrack,$newdata);
	}
	
	if($isOrganic && trim($utm_term) != '')
	{
		$utm_term_new = preg_replace('#[ -]+#', '-', $utm_term);
		$newdata = 'utm_term='.$utm_term_new;
		array_push($arrTrack,$newdata);
	}
	
	if($isOrganic)
	{
		
		if(!$isQueryExists && !$isCookieExists)
		{
			$referCampaign = 'direct';
		}
		
		$positionc = array_search('utm_campaign='.$referCampaign, $arrTrack);
		if(false !== $positionc && isset($arrTrack[$positionc]))
		{
			unset($arrTrack[$positionc]);
		}
		$utm_campaign_new = $referCampaign.'_EmWebsite';
		if(trim($utm_content) != '')
		{
			$utm_campaign_new = $utm_campaign_new.'_'.$utm_content;
		}
		if(trim($utm_term) != '')
		{
			$utm_term_new = preg_replace('#[ -]+#', '-', $utm_term);
			$utm_campaign_new = $utm_campaign_new.'_'.$utm_term_new;
		}
		$newdata = 'utm_campaign='.$utm_campaign_new;
		array_push($arrTrack,$newdata);
	}
	/*set utm campaign and term based on the page if cookie not exists over*/
	
	
	return implode('&',$arrTrack);;
}


// redirect media page urls to parent posts 
add_action( 'template_redirect', 'wpsites_attachment_redirect' );
function wpsites_attachment_redirect(){
global $post;
if ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent != 0) ) :
    wp_redirect( get_permalink( $post->post_parent ), 301 );
    exit();
    wp_reset_postdata();
    endif;
}


/**
 * Extend get terms with post type parameter.
 *
 * @global $wpdb
 * @param string $clauses
 * @param string $taxonomy
 * @param array $args
 * @return string
 */
function df_terms_clauses( $clauses, $taxonomy, $args ) {
	
	if ( isset( $args['post_type'] ) && ! empty( $args['post_type'] ) && $args['fields'] !== 'count' ) {
		global $wpdb;

		$post_types = array();

		if ( is_array( $args['post_type'] ) ) {
			foreach ( $args['post_type'] as $cpt ) {
				$post_types[] = "'" . $cpt . "'";
			}
		} else {
			$post_types[] = "'" . $args['post_type'] . "'";
		}
		
		if ( ! empty( $post_types ) ) {
			$clauses['fields'] = 'DISTINCT ' . str_replace( 'tt.*', 'tt.term_taxonomy_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields'] ) . ', COUNT(p.post_type) AS count';
			
			
			$clauses['join'] .= ' LEFT JOIN ' . $wpdb->term_relationships . ' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id LEFT JOIN ' . $wpdb->posts . ' AS p ON p.ID = r.object_id';
			if(isset($args['post_ids']) && is_array($args['post_ids']) && !empty($args['post_ids']))
			{
				$clauses['where'] .= ' AND (p.post_type IN (' . implode( ',', $post_types ) . ') OR p.post_type IS NULL) AND (p.ID in (' . implode( ',', $args['post_ids'] ) . ') ) AND p.post_status = "publish" ';
			}
			else{
				$clauses['where'] .= ' AND (p.post_type IN (' . implode( ',', $post_types ) . ') OR p.post_type IS NULL) AND p.post_status = "publish" ';
			}
			
			$clauses['orderby'] = 'GROUP BY t.term_id ' . $clauses['orderby'];
		}
	}
	return $clauses;
}
add_filter( 'terms_clauses', 'df_terms_clauses', 10, 3 );


add_filter('wpseo_robots', 'yoast_no_home_noindex', 999);
function yoast_no_home_noindex($robotsstr= "") {
    if (strpos(site_url(),'beta2-sg.emeritus.org') || strpos(site_url(),'beta2.emeritus.org') || strpos(site_url(),'beta3.emeritus.org') || strpos(site_url(),'localhost')) {
        $robotsstr= "noindex,nofollow";
    }
	return $robotsstr;
}

/*Exclude Canonicalization on Emeritus's course pages that are redirected to WL domains and remove from sitemap PSD-522*/
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', function () {
	$args = array(
			  'post_type' => array('university-courses','program', 'diploma-program'),
			  'post_status' => 'publish',
			  'posts_per_page' => -1,
			  'meta_query' => array(
					array(
						'key' => 'wpcf-external-landing-page-url',
						'compare' => '!=',
						'value' => ''
					)
				)
			);
	$allPosts = new WP_Query($args); 
	$post_ids = wp_list_pluck( $allPosts->posts, 'ID' );
	return $post_ids;
} );
/*Exclude redirected Links from SiteMAP OVer*/

/*Exclude Canonicalization on Emeritus's course pages that are redirected to WL domains and remove from sitemap PSD-522*/
function yoast_seo_canonical_change_woocom_shop( $canonical ) {
	if(is_single() && (get_post_type() == 'program' || get_post_type() == 'diploma-program' || get_post_type() == 'university-courses'))
	{
		global $post;
		$LP_URL =  types_render_field('external-landing-page-url', array('output' => 'raw', 'id' => $post->ID));
		if(!empty($LP_URL))
		{
			$canonical = $LP_URL;
		}
	}
	return $canonical;
}
add_filter( 'wpseo_canonical', 'yoast_seo_canonical_change_woocom_shop', 10, 1 );



/**
Cross Domain Sitemap PSD-623
 * USAGE:
 * - Configure the return value of the `CUSTOM_SITEMAP_post_types` to required post type(s) - otherwise populates sitemap with all posts and pages
 * - Search and replace the `CUSTOM_SITEMAP` string with a lowercase identifier name: e.g., "myseo", "vehicles", "customer_profiles", "postspage", etc.
 * - Uses heredocs for inline XML: https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
 */

/**
 * Uncomment the next line of code to disable sitemap caching.
 * - For development environments and debugging only. 
 * - All other scenarios, follow the "Manual Sitemap Update" instructions in the Yoast documentation:
 *   - https://yoast.com/help/sitemap-does-not-update/#manual
 */
add_filter("wpseo_enable_xml_sitemap_transient_caching", "__return_false");

/**
 * Configure return value of this function to required post type(s)
 */
function university_sitemap_post_types() {
    $schoolTerms = get_categories(array(
		'post_type' => array('program','university-courses','diploma-program'),
		'taxonomy' => 'university',
		'parent' => 0,
		'hide_empty' => true
	));
	return $schoolTerms;
}

/**
 * Add university-sitemap.xml to Yoast sitemap index
 */
function university_sitemap_index($sitemap_index) {
    global $wpseo_sitemaps;
	$schoolTerms = university_sitemap_post_types();
	if(is_array($schoolTerms) && count($schoolTerms)>0)
	{
	  foreach($schoolTerms as $listData)
	  {
		  
		$sitemap_url = home_url($listData->slug."-sitemap.xml");
		$sitemap_date = $wpseo_sitemaps->get_last_modified( array('program','university-courses','diploma-program')); 
	$university = <<<SITEMAP_INDEX_ENTRY
<sitemap>
	<loc>%s</loc>
	<lastmod>%s</lastmod>
</sitemap>
SITEMAP_INDEX_ENTRY;

		$sitemap_index .= sprintf($university, $sitemap_url, $sitemap_date);
	  }
	}
    return $sitemap_index;
}
add_filter("wpseo_sitemap_index", "university_sitemap_index");

/**
 * Register university sitemap with Yoast
 */
function university_sitemap_register() {
    global $wpseo_sitemaps;
    if (isset($wpseo_sitemaps) && !empty($wpseo_sitemaps)) {
		$schoolTerms = university_sitemap_post_types();
		if(is_array($schoolTerms) && count($schoolTerms)>0)
		{
		  foreach($schoolTerms as $listData)
		  {
			$key = $listData->slug;
			$wpseo_sitemaps->register_sitemap($key,function() use ( $listData )  {
				global $wpseo_sitemaps;
				$urls_string = university_sitemap_urls($listData);
	$sitemap_body = <<<SITEMAP_BODY
<urlset
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
%s
</urlset>
SITEMAP_BODY;
				$sitemap = sprintf($sitemap_body, $urls_string);
				$wpseo_sitemaps->set_sitemap($sitemap);
			} );  
		  }
		}
    }
}
add_action("init", "university_sitemap_register",99);


/**
 * Generate sitemap `<url>` tags from the given $post_types
 * @param $post_types string|array Slugs of posts to load: e.g., "post", "page", "custom_type" - according to the `WP_Query` `post_type` parameter: https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters
 * @return string
 */
function university_sitemap_urls($qobj) {
	
    global $wpseo_sitemaps;
    $urls = array();
    $args = array(
		  'post_type' => array('program','university-courses','diploma-program'),
		  'post_status' => 'publish',
		  'posts_per_page' => -1,
		  'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'wpcf-external-landing-page-url',
					'compare' => '!=',
					'value' => ''
				)
			),
		 'tax_query' => array(
			array(
			  'taxonomy' => $qobj->taxonomy,
			  'field' => 'id',
			  'terms' => $qobj->term_id,
			)
		  )
		);

    $query = new WP_Query($args);
	if ($query->have_posts())
	{		
		foreach ($query->posts as $post) {
			
			$LP_URL =  types_render_field('external-landing-page-url', array('output' => 'raw', 'id' => $post->ID));
			// Basic URL details - location and last modified
			$url = array(
				"mod" => get_the_date(DATE_W3C, $post),  # <lastmod></lastmod>
				"loc" => $LP_URL,  # <loc></loc>
			);
			// Detect and use any featured image / post thumbnail
			$attachment_id = get_post_thumbnail_id($post);
			if ($attachment_id) {
				$image_url = wp_get_attachment_url($attachment_id);
				$image_title = get_post_meta($attachment_id, "_wp_attachment_image_alt", true);
				$image_caption = wp_get_attachment_caption($attachment_id);
			} else {
				$image_url = "";
				$image_title = "";
				$image_caption = "";
			}
			if ($image_url) {
				$url["images"] = array(
					array(  # <image:image></image:image>
						"src" => $image_url,  # <image:loc></image:loc>
						"title" => $image_title,  # <image:title></image:title>
						"alt" => $image_caption,  # <image:caption></image:caption>
					),
				);
			}
			// Transform url array to sitemap `<url></url>` schema format
			$urls[]= $wpseo_sitemaps->renderer->sitemap_url($url);
		}
	}
    return implode("\n", $urls);
}

// to fix xframe vulnerability issue
add_action( 'send_headers', 'send_frame_options_header', 10, 0 );
