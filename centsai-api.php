<?php

/**
 * Plugin Name: CentSai One
 * Plugin URI: https://www.centsai.com/
 * Description: This plugin is for CentSai One API integration. It will fetch all subscribed content from CentSai One dashboard.
 * Version: 1.0
 * Author: Centsai INC
 * Author URI: http://centsai.com/
 **/

if(!session_id()){
	session_start();
}
include(plugin_dir_path(__FILE__) . '/main-functions.php');
include(plugin_dir_path(__FILE__) . '/admin/admin-functions.php');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function load_CentSai_admin_style(){
	if($_GET['page'] == 'centsai-one-settings'){
		//wp_enqueue_script( 'jquery-1.12.4-js', 'https://code.jquery.com/jquery-1.12.4.js', array(), null, true );
		//wp_enqueue_script( 'jquery-ui-js', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(), null, true );
		$handle_admin_1 = 'jquery.js';
		$list = 'enqueued';
		if (wp_script_is($handle_admin_1, $list)) {
			return;
		}else{
			//wp_enqueue_script('centsai-admin-js', plugins_url('/admin/assets/js/centsai-admin.js', __FILE__), array(), null, true);
			
			wp_enqueue_script( 'centsai-admin-js', plugin_dir_url( __FILE__ ).'admin/assets/js/centsai-admin.js', array( 'jquery' ), '1.0', true );
			wp_localize_script( 'centsai-admin-js', 'centsai_loadmore_params', array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
				'posts' => json_encode( $wp_query->query_vars ),
				'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
				'max_page' => $wp_query->max_num_pages
			) );
		}
	}
}
add_action('admin_enqueue_scripts', 'load_CentSai_admin_style');

if (!is_admin()) add_action("wp_enqueue_scripts", "centsai_one_jquery_enqueue", 11);
function centsai_one_jquery_enqueue() {
	global $wp_query;
   /*//wp_deregister_script('jquery');
   wp_register_script('centsai-one-jquery', plugins_url( '/assets/js/centsai-one.js' ), false, null);
   wp_enqueue_script('centsai-one-jquery');*/
   wp_enqueue_script( 'centsai-one-jquery', plugin_dir_url( __FILE__ ).'assets/js/centsai-one.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'centsai-one-jquery', 'centsai_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
}

function centsai_one_more_posts(){
	$out = '';
	//echo 'test';
   $page = $_POST['page'] + 1;
    $args = array(
		'post_type' => 'centsai_one_posts',
		'posts_per_page' => 6,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'paged' => $page,
	);
	$my_posts = new WP_Query( $args );
	$total_pages = $my_posts->max_num_pages;
	if($my_posts->have_posts()){ 
		while($my_posts->have_posts()){
			$my_posts->the_post();
			$out .= '<article class="col-md-4 col-sm-6 col-xs-6 l-p-col clearfix" style="margin-bottom: 50px;">
		  <div class="p-img rel"> <a title="'. get_the_title().'" rel="bookmark" href="'. get_the_permalink().'">
			<picture> <img src="'. get_post_meta(get_the_id(), 'post_image', true).'" class="img-responsive" alt="'. get_the_title().'"> </picture>
			</a> </div>
		  <div class="p-desc">
		  	<span class="p-catname block">'. get_post_meta(get_the_id(), 'category_name', true).'</span>
			<h2 class="entry-title"><a title="'. get_the_title().'" rel="bookmark" href="'. get_the_permalink().'">'. get_the_title().'</a></h2>
			<div class="post-content"></div>
			<span class="p-date block">'. get_post_meta(get_the_id(), 'post_date', true).'</span> <span class="p-auth block">'. get_post_meta(get_the_id(), 'author_name', true).'</span> </div>
		</article>';
		//$out .= CentSai_load_template_part('templates/list','list');
		}
	}
	wp_reset_postdata();
	echo json_encode(array('data' => $out, 'max_pages' => $total_pages));
    wp_die();
}
add_action('wp_ajax_nopriv_centsai_one_more_posts', 'centsai_one_more_posts');
add_action('wp_ajax_centsai_one_more_posts', 'centsai_one_more_posts');
/* Create shortcode for CentSai Content Listing */
function centsai_content_list(){
	ob_start();
    CentSai_load_template_part('templates','template-centsai_one_posts');
	$output = ob_get_clean();
	wp_enqueue_style( 'centsai-one-style' );
	return $output;
}
add_shortcode('centsai_content_list', 'centsai_content_list');
add_filter( 'template_include', 'centsai_one_force_template' );
function centsai_one_force_template( $template ) {
    if( is_archive('centsai_one_posts') ) {
        $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/archive-centsai_one_posts.php';
    }
	if( is_singular('centsai_one_posts') ) {
        $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/templates/single-centsai_one_posts.php';
    }
    return $template;
}
function centsai_one_archieve_query( $query ){
    if( ! is_admin() && $query->is_post_type_archive('centsai_one_posts') && $query->is_main_query() ){
        $query->set( 'posts_per_page', 6 );
    }
}
add_action( 'pre_get_posts', 'centsai_one_archieve_query' );
/*Social Icons start*/
function centsai_one_social_icons(){
	$url = get_permalink();
	$encoded_url = urlencode($url);
	$out = '<ul class="post-social">
            <li><a rel="nofollow noreferrer noopener" target="_blank" href="https://www.facebook.com/share.php?u='.$encoded_url.'"><svg class="si-b" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 792" preserveAspectRatio=none>
              <path d="M367.586,792V431.24h123.2l17.6-140.8h-140.8v-88.027c0-39.593,13.207-70.4,70.4-70.4h74.793V4.393C495.206,4.393,451.193,0,402.786,0c-105.6,0-180.394,66.007-180.394,184.813v105.6H99.194V431.24h123.199V792H367.586z"/>
              </svg></a></li>
            <li><a rel="nofollow noreferrer noopener" target="_blank" href="https://twitter.com/intent/tweet?text='.get_the_title().'&url='.$encoded_url.'&via=CentSai"><svg class="si-b" xmlns="http://www.w3.org/2000/svg" viewBox="0 147.791 612 496.54" preserveAspectRatio=none>
              <path d="M193.795,644.205c231.179,0,356.994-190.4,356.994-356.995v-17.016c23.756-18.075,44.428-39.878,61.211-64.563c-22.796,9.918-46.802,16.781-71.396,20.41c25.295-15.888,44.469-39.87,54.4-68.042c-24.57,13.677-50.877,23.969-78.205,30.595c-23.277-26.216-56.749-41.091-91.806-40.8c-69.039,1.039-124.756,56.755-125.795,125.795c-0.775,9.204,0.381,18.469,3.395,27.2c-101.217-4.883-195.403-53.21-258.399-132.584c-11.18,19.679-17.037,41.931-16.995,64.563c0.913,41.643,20.986,80.537,54.4,105.405c-20.437-0.407-40.392-6.275-57.795-16.995l0,0c-0.07,60.115,42.904,111.659,102.053,122.4c-11.068,2.982-22.551,4.129-33.99,3.395c-8.085,0.548-16.195-0.608-23.805-3.395c17.042,51.623,64.659,86.99,119.005,88.39c-44.69,34.909-99.682,54.038-156.39,54.4C20.341,586.967,9.976,585.854,0,583.078c56.261,40.859,124.271,62.34,193.795,61.21"/>
              </svg></a></li>
            <li><a href="//www.pinterest.com/pin/create/button/?url='.$encoded_url.'&description='.get_the_title().'" data-pin-do="buttonBookmark"  data-pin-custom="true"><svg class="si-b" xmlns="http://www.w3.org/2000/svg" viewBox="0 90.237 612.164 611.486" preserveAspectRatio=none>
              <path d="M305.99,90.237C137.053,90.18,0.057,227.084,0,396.021c0,0.069,0,0.138,0,0.206
	c-0.107,125.951,77.049,239.074,194.35,284.947c-4.046-29.137-3.733-58.712,0.927-87.756
	c5.519-23.885,35.827-152.078,35.827-152.078c-6.246-14.341-9.376-29.844-9.184-45.484c0-42.724,24.708-74.433,55.141-74.433
	c21.206-0.271,38.617,16.699,38.889,37.905c0.023,1.783-0.078,3.565-0.303,5.334c0,26.19-16.473,65.703-25.265,102.004
	c-6.033,23.704,8.291,47.812,31.995,53.846c4.403,1.12,8.953,1.557,13.488,1.294c54.214,0,96.032-57.426,96.032-140.136
	c2.036-66.8-50.466-122.602-117.266-124.638c-3.464-0.105-6.932-0.062-10.393,0.13c-73.201-3.116-135.068,53.699-138.184,126.9
	c-0.084,1.96-0.124,3.923-0.12,5.885c-0.019,25.141,8.036,49.624,22.979,69.841c2.023,2.426,2.868,5.622,2.306,8.73
	c-2.306,9.657-7.351,30.329-8.235,34.468c-1.38,5.519-4.592,6.898-10.11,4.118c-38.133-17.913-62.017-73.507-62.017-118.537
	c0-96.485,70.294-185.167,202.153-185.167c106.142,0,188.379,75.813,188.379,176.437c0,105.216-66.63,190.212-158.544,190.212
	c-27.817,0.852-54.211-12.291-70.295-35.004c0,0-15.154,58.354-18.84,72.602c-9.259,28.273-22.072,55.257-38.133,80.301
	c29.344,9.081,59.88,13.724,90.597,13.775c168.937,0.057,305.933-136.848,305.989-305.784c0-0.068,0-0.137,0-0.206
	c-0.158-168.88-137.191-305.655-306.071-305.496C306.059,90.237,306.024,90.237,305.99,90.237z"/>
              </svg></a></li>
            <li><a rel="nofollow noreferrer noopener" target="_blank" href="https://www.linkedin.com/cws/share?url='.$encoded_url.'"><svg class="si-b" xmlns="http://www.w3.org/2000/svg" viewBox="0 90.843 612.206 610.313" preserveAspectRatio=none>
              <path d="M566.234,90.849H45.858C21.082,90.501,0.638,110.148,0,134.918v522.164c0.638,24.77,21.082,44.417,45.857,44.069h520.49
	c24.771,0.335,45.208-19.306,45.858-44.069V134.918C611.556,110.109,591.048,90.45,566.234,90.849z M181.506,611.27H91.648V319.727
	h89.858V611.27z M137.505,280.724c-29.054,0-52.636-23.5-52.736-52.554c0.101-28.982,23.57-52.453,52.553-52.553h0.184
	c28.983,0.101,52.453,23.571,52.554,52.553C189.958,257.153,166.489,280.624,137.505,280.724z M522.141,609.619h-89.859V467.16
	c0-33.912,0-77.958-47.463-77.958c-47.464,0-54.251,37.305-54.251,74.588v144.109h-89.858V319.727h-1.674h1.674h84.792v38.979h1.696
	c17.684-30.729,51.023-49.035,86.442-47.463c91.556,0,108.501,61.037,108.501,139.019V609.619z"/>
              </svg></a></li>
            <li><a rel="nofollow noreferrer noopener" href="mailto:?subject='.get_the_title().'&body='.centsaione_limit_string_length(esc_html(strip_tags(strip_shortcodes(get_the_content()))), '250').' Read%20More%20Here:'.strip_tags($encoded_url).'"><svg class="si-b" xmlns="http://www.w3.org/2000/svg" viewBox="0 151.204 611.999 489.592" preserveAspectRatio=none>
              <path d="M550.805,151.204H61.195c-33.696,0.125-60.934,27.499-60.892,61.194L0,579.602c0.104,33.754,27.44,61.091,61.194,61.194
	h489.61c33.754-0.104,61.091-27.44,61.194-61.194V212.398C611.896,178.645,584.559,151.308,550.805,151.204z M550.805,579.602
	H61.195v-305.99L305.99,426.606l244.796-152.995L550.805,579.602z M305.99,365.355L61.195,212.398h489.61L305.99,365.355z"/>
              </svg></a></li>
          </ul>';
	return $out;
}
add_shortcode('centsai_one_social_icons','centsai_one_social_icons');
/*Social Icons end*/
/*Set canonical link start*/
add_action('wp_head', 'centsaione_canonical');
function centsaione_canonical(){
	if(is_singular('centsai_one_posts') && $centsaione_canonical_link = get_post_meta(get_the_id(), 'centsaione_canonical_link', true)){
		echo '<link rel="canonical" href="'.$centsaione_canonical_link.'" />';
	}
}
/*Set canonical link end*//*Limit string length start*/function centsaione_limit_string_length($string = '', $max = ''){	if( strlen(html_entity_decode($string)) > $max ) {		return substr( $string, 0, $max ). " &hellip;";	} else {		return $string;	}}/*Limit string length end*/