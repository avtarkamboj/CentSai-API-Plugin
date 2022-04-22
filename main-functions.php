<?php
define( 'PLUGIN_DIR', dirname(__FILE__).'/' );
/* The below function will help to load template file from plugin directory of wordpress*/ 
function centsai_get_template_part($slug, $name = null) {
 do_action("centsai_get_template_part_{$slug}", $slug, $name);
 $templates = array();
 if (isset($name))
     $templates[] = "{$slug}-{$name}.php";
 $templates[] = "{$slug}.php";
 centsai_get_template_path($templates, true, false);
}

/* Extend locate_template from WP Core Define a location of your plugin file dir to a constant in this case = PLUGIN_DIR_PATH */ 
function centsai_get_template_path($template_names, $load = false, $require_once = true ) {
   $located = ''; 
   foreach ( (array) $template_names as $template_name ) { 
     if ( !$template_name ) 
       continue; 
     /* search file within the PLUGIN_DIR_PATH only */ 
     if ( file_exists( plugin_dir_path( __FILE__ ) . $template_name)) { 
       $located =  plugin_dir_path( __FILE__ ) . $template_name; 
       break; 
     }
   }
   if ( $load && '' != $located )
       load_template( $located, $require_once );
   return $located;
}
/* Embedded Required Scripts start*/
function enque_centsai_one_scripts(){
    $handle_1 = 'jquery.js';
    //$handle = 'centsai.js';
    $handle_2 = 'jquery.validate.min.js';
    $list = 'enqueued';
    //wp_dequeue_script('centsai.js');
    if (wp_script_is($handle_1, $list)) {
        return;
    } else {
        wp_enqueue_script('jquery.js', plugins_url('/assets/js/jquery.min.js', __FILE__), array(), null, true);
    }
    /*if (wp_script_is($handle, $list)) {
        return;
    } else {
        wp_enqueue_script('centsai.js', plugins_url('/assets/js/centsai.js', __FILE__));
    }*/
    if (wp_script_is($handle_2, $list)) {
        return;
    } else {
        wp_enqueue_script('validate.js', plugins_url('/assets/js/jquery.validate.min.js', __FILE__));
    }
    wp_register_style('centsai-one-style', plugins_url('/assets/css/centsai-one-style.css', __FILE__), array(), '1.0', 'all');
	if(is_post_type_archive('centsai_one_posts') || is_singular('centsai_one_posts')){
		wp_enqueue_style( 'centsai-one-style' );
	}
	/*if(is_singular('centsai_one_posts') && $centsaione_canonical_link = get_post_meta(get_the_id(), 'centsaione_canonical_link', true)){
		echo '<link rel="canonical" href="'.$centsaione_canonical_link.'" />';
	}*/
}
add_action('wp_head', 'enque_centsai_one_scripts');
/* Embedded Required Scripts end*/
/* load template call function */
function CentSai_load_template_part($template_name, $part_name=null){
    $var = centsai_get_template_part(''.$template_name.'/'.$part_name.'', null);
    return $var;
}
/*function register_oppu_menu_page(){
    // add_menu_page('Tokenpass', 'Tokenpass', 'manage_api_options', 'manage_tokenpass','tokenpass_menu_page',plugins_url( 'tokenpass/assets/images/tokenly-icon.png' ),6);
    add_menu_page('OppU', 'OppU', 'manage_api_options', 'manage_oppu','oppu_menu_page','dashicons-admin-generic');
    // add_submenu_page( 'manage_oppu', 'oppu_menu_page', 'Settings', 'manage_api_options', 'manage_oppu_admin','oppu_menu_page');
    add_submenu_page( 'manage_oppu', 'oppu performance', 'Performance', 'manage_api_options', 'manage_api_options','oppu_performance_dash_html');
}
add_action( 'admin_menu', 'register_oppu_menu_page');
function oppu_menu_page(){
    echo "<h1>Admin Settings Coming Soon</h1>";
    // CentSai_load_template_part('templates','admin-dash-reports');
}*/
/**
 * Class for registering a new settings page under Settings.
 *//*
class CentSaiOne_Options_Page{
    /**
     * Constructor.
     *
    function __construct(){
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }
    /**
     * Registers a new settings page under Settings.
     *
    function admin_menu(){
        add_options_page(
            __( 'CentSai One Settings', 'textdomain' ),
            __( 'CentSai One', 'textdomain' ),
            'manage_options',
            'centsai_one_settings',
            array(
                $this,
                'settings_page'
            )
        );
    }
    /**
     * Settings page display callback.
     *
    function settings_page(){
        echo __( 'CentSai One API settings.', 'textdomain' );
        echo __( 'Copy the shortcode and paste it on page where you want to show CentSai One articles.', 'textdomain' );
        echo __( '[centsai_content_list]', 'textdomain' );
    }
}
new CentSaiOne_Options_Page;*/
class CentSaiOneSettings {
	private $centsai_one_api_settings_options;
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'centsai_one_api_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'centsai_one_api_settings_page_init' ) );
	}
	public function centsai_one_api_add_plugin_page() {
		add_menu_page(
			'CentSai One Settings', // page_title
			'CentSai One Settings', // menu_title
			'manage_options', // capability
			'centsai-one-settings', // menu_slug
			array( $this, 'centsai_one_api_settings_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			20 // position
		);
		//add_submenu_page('centsai-one-settings', 'CentSai One', 'CentSai One', 'manage_options', 'centsai-one-settings', array( $this, 'centsai_one_api_settings_create_admin_page' ) );
		//add_submenu_page( 'centsai-one-settings', 'Debt Calculator Performance', 'Debt Calculator Performance', 'manage_options', 'manage_options','oppu_performance_dash_html');
	}
	public function centsai_one_api_settings_create_admin_page() {
		$this->centsai_one_api_settings_options = get_option( 'centsai_one_api_settings_options_name' ); ?>
		<div class="wrap">
			<h2>CentSai One API Settings</h2>
			<?php settings_errors(); ?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'centsai_one_api_settings_option_group' );
					do_settings_sections( 'centsai-one-settings-admin' );
					submit_button();
				?>
			</form>
			<p class="c1-credentials-status"></p>
		</div>
		<div class="wrap">
			<h2>Sync Data</h2>
			<a href="javascript:;" class="c1-sync-now">Sync Now</a>
			<p class="c1-sync-status">Sync Status: <span class="c1-s-status"><?php echo get_option('centsai_last_sync_status'); ?></span></p>
			<p class="c1-last-sync">Last Sync: <span class="c1-last-s"><?php echo get_option('centsai_last_sync_time'); ?></span></p>
		</div>
		<div class="wrap">
			<h2>Shortcode</h2>
			<p>Shortcode to list CentSai One articles:</p>
			<p>[centsai_content_list]</p>
			<p>Default archieve page:</p>
			<p><a target="_blank" href="<?php echo site_url(); ?>/centsai-one-posts/"><?php echo site_url(); ?>/centsai-one-posts/</a></p>
		</div>
	<?php }
	public function centsai_one_api_settings_page_init() {
		register_setting(
			'centsai_one_api_settings_option_group', // option_group
			'centsai_one_api_settings_options_name', // option_name
			array( $this, 'centsai_one_api_settings_sanitize' ) // sanitize_callback
		);
		add_settings_section(
			'centsai_one_api_settings_setting_section', // id
			'CentSai One Settings', // title
			array( $this, 'centsai_one_api_settings_section_info' ), // callback
			'centsai-one-settings-admin' // page
		);
		add_settings_field(
			'centsai_one_username', // id
			'CentSai One Email', // title
			array( $this, 'centsai_one_username_callback' ), // callback
			'centsai-one-settings-admin', // page
			'centsai_one_api_settings_setting_section' // section
		);
		add_settings_field(
			'centsai_one_password', // id
			'CentSai One Password', // title
			array( $this, 'centsai_one_password_callback' ), // callback
			'centsai-one-settings-admin', // page
			'centsai_one_api_settings_setting_section' // section
		);
	}
	public function centsai_one_api_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['centsai_one_username'] ) ) {
			$sanitary_values['centsai_one_username'] = sanitize_email( $input['centsai_one_username'] );
		}
		if ( isset( $input['centsai_one_password'] ) ) {
			$sanitary_values['centsai_one_password'] = sanitize_text_field( $input['centsai_one_password'] );
		}
		return $sanitary_values;
	}
	public function centsai_one_api_settings_section_info() {		
	}
	public function centsai_one_username_callback() {
		printf(
			'<input class="regular-text" type="email" name="centsai_one_api_settings_options_name[centsai_one_username]" id="centsai_one_username" value="%s" required>',
			isset( $this->centsai_one_api_settings_options['centsai_one_username'] ) ? esc_attr( $this->centsai_one_api_settings_options['centsai_one_username']) : ''
		);
	}
	public function centsai_one_password_callback() {
		printf(
			'<input class="regular-text" type="password" name="centsai_one_api_settings_options_name[centsai_one_password]" id="centsai_one_password" value="%s" required>',
			isset( $this->centsai_one_api_settings_options['centsai_one_password'] ) ? esc_attr( $this->centsai_one_api_settings_options['centsai_one_password']) : ''
		);
	}
}
if ( is_admin() )
	$centsai_one_api_settings = new CentSaiOneSettings();
/*function oppu_performance_dash_html(){
    load_template_part('templates','admin-dash-reports');
}*/
add_action( 'init', 'create_post_type' );
function create_post_type(){
	$labels = [
		"name" => __( "CentSai One Posts", "centsai" ),
		"singular_name" => __( "CentSai One Post", "centsai" ),
		"menu_name" => __( "My CentSai One Posts", "centsai" ),
		"all_items" => __( "All CentSai One Posts", "centsai" ),
		"add_new" => __( "Add new", "centsai" ),
		"add_new_item" => __( "Add new CentSai One Post", "centsai" ),
		"edit_item" => __( "Edit CentSai One Post", "centsai" ),
		"new_item" => __( "New CentSai One Post", "centsai" ),
		"view_item" => __( "View CentSai One Post", "centsai" ),
		"view_items" => __( "View CentSai One Posts", "centsai" ),
		"search_items" => __( "Search CentSai One Posts", "centsai" ),
		"not_found" => __( "No CentSai One Posts found", "centsai" ),
		"not_found_in_trash" => __( "No CentSai One Posts found in trash", "centsai" ),
		"parent" => __( "Parent CentSai One Post:", "centsai" ),
		"featured_image" => __( "Featured image for this CentSai One Post", "centsai" ),
		"set_featured_image" => __( "Set featured image for this CentSai One Post", "centsai" ),
		"remove_featured_image" => __( "Remove featured image for this CentSai One Post", "centsai" ),
		"use_featured_image" => __( "Use as featured image for this CentSai One Post", "centsai" ),
		"archives" => __( "CentSai One Post archives", "centsai" ),
		"insert_into_item" => __( "Insert into CentSai One Post", "centsai" ),
		"uploaded_to_this_item" => __( "Upload to this CentSai One Post", "centsai" ),
		"filter_items_list" => __( "Filter CentSai One Posts list", "centsai" ),
		"items_list_navigation" => __( "CentSai One Posts list navigation", "centsai" ),
		"items_list" => __( "CentSai One Posts list", "centsai" ),
		"attributes" => __( "CentSai One Posts attributes", "centsai" ),
		"name_admin_bar" => __( "CentSai One Post", "centsai" ),
		"item_published" => __( "CentSai One Post published", "centsai" ),
		"item_published_privately" => __( "CentSai One Post published privately.", "centsai" ),
		"item_reverted_to_draft" => __( "CentSai One Post reverted to draft.", "centsai" ),
		"item_scheduled" => __( "CentSai One Post scheduled", "centsai" ),
		"item_updated" => __( "CentSai One Post updated.", "centsai" ),
		"parent_item_colon" => __( "Parent CentSai One Post:", "centsai" ),
	];

	$args = [
		"label" => __( "CentSai One Posts", "centsai" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => false,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "centsai-one-posts", "with_front" => false ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
		"show_in_graphql" => false,
	];
	register_post_type( "centsai_one_posts", $args );
	
	/**
	 * Taxonomy: CentSai One Categories.
	 */
	$labels = [
		"name" => __( "CentSai One Categories", "centsai" ),
		"singular_name" => __( "CentSai One Category", "centsai" ),
		"menu_name" => __( "CentSai One Categories", "centsai" ),
		"all_items" => __( "All CentSai One Categories", "centsai" ),
		"edit_item" => __( "Edit CentSai One Category", "centsai" ),
		"view_item" => __( "View CentSai One Category", "centsai" ),
		"update_item" => __( "Update CentSai One Category name", "centsai" ),
		"add_new_item" => __( "Add new CentSai One Category", "centsai" ),
		"new_item_name" => __( "New CentSai One Category name", "centsai" ),
		"parent_item" => __( "Parent CentSai One Category", "centsai" ),
		"parent_item_colon" => __( "Parent CentSai One Category:", "centsai" ),
		"search_items" => __( "Search CentSai One Categories", "centsai" ),
		"popular_items" => __( "Popular CentSai One Categories", "centsai" ),
		"separate_items_with_commas" => __( "Separate CentSai One Categories with commas", "centsai" ),
		"add_or_remove_items" => __( "Add or remove CentSai One Categories", "centsai" ),
		"choose_from_most_used" => __( "Choose from the most used CentSai One Categories", "centsai" ),
		"not_found" => __( "No CentSai One Categories found", "centsai" ),
		"no_terms" => __( "No CentSai One Categories", "centsai" ),
		"items_list_navigation" => __( "CentSai One Categories list navigation", "centsai" ),
		"items_list" => __( "CentSai One Categories list", "centsai" ),
		"back_to_items" => __( "Back to CentSai One Categories", "centsai" ),
	];
	$args = [
		"label" => __( "CentSai One Categories", "centsai" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => false,
		"show_in_menu" => false,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'centsai_one_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => false,
		"show_tagcloud" => false,
		"rest_base" => "centsai_one_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "centsai_one_category", [ "centsai_one_posts" ], $args );
	if($_GET['page'] == 'centsai-one-settings' && $_GET['sync'] == 1){
		get_centsai_one_posts(1);
	}
}
function centsaione_flush_rewrites() {
	create_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'centsaione_flush_rewrites' );
/*register_uninstall_hook( __FILE__, 'delete_post_type' );
function delete_post_type() {
  // Uninstallation stuff here
	 unregister_post_type( 'centsai_one_posts' );
}*/
function get_centsai_one_posts($page = 1){
	if(!session_id()){
        session_start();
    }
	$centsai_one_api_settings_options = get_option( 'centsai_one_api_settings_options_name' );
	$centsai_one_username = $centsai_one_api_settings_options['centsai_one_username'];
	$centsai_one_password = $centsai_one_api_settings_options['centsai_one_password'];
	if($centsai_one_username && $centsai_one_password){
		$url = 'https://new.centsai.com/api/centsai-api.php';
		$data = array (
			//'post_id' => '10696,',
			//'cat_id' => '168',
			'posts_per_page' => '6',
			'post_image' => '1',
			'post_url' => '1',
			'post_date' => '1',
			'author_name' => '1',
			'six_second_take' => '1',
			'author_name' => '1',
			'author_url' => '1',
			'author_image' => '1',
			'category_id' => '1',
			'category_name' => '1',
			'category_link' => '1',
			'page' => $page,
		);
		$params = '';
		foreach($data as $key=>$value)
			$params .= $key.'='.$value.'&';
		$params = trim($params, '&');
		$username = $centsai_one_username;
		$password = $centsai_one_password;
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Basic '. base64_encode("$username:$password")
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.'?'.$params );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7);
		curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		curl_close($ch);
		if(curl_errno($ch)){
			//return 'Curl error: ' . curl_error($ch);
			update_option('centsai_last_sync_time', '...');
			update_option('centsai_last_sync_status', 'Curl error: ' . curl_error($ch));
			//$_SESSION['centsai_last_sync_time'] = '...';
			//$_SESSION['centsai_last_sync_status'] = 'Curl error: ' . curl_error($ch);
			return json_encode(array('status' => 'Curl error: ' . curl_error($ch), 'date' => '...'));
			die();
		}else{
			$my_posts = json_decode($response, true);
			if(!empty($my_posts['posts'])){
				/*Check if post already published start*/
				$published_args = array(
					'post_type' => 'centsai_one_posts',
					'posts_per_page' => -1,
					'post_status' => 'publish',
				);
				$my_published_posts = new WP_Query( $published_args );
				$my_published_post_ids = array();
				if($my_published_posts->have_posts()){
					while($my_published_posts->have_posts()){
						$my_published_posts->the_post();
						$my_published_post_ids[] = get_post_meta(get_the_id(), 'centsai_post_id', true);
					}
				}wp_reset_postdata();
				$unpublished_args = array(
					'post_type' => 'centsai_one_posts',
					'posts_per_page' => -1,
					'post_status' => 'draft',
				);
				$my_unpublished_posts = new WP_Query( $unpublished_args );
				$my_unpublished_post_ids = array();
				if($my_unpublished_posts->have_posts()){
					while($my_unpublished_posts->have_posts()){
						$my_unpublished_posts->the_post();
						$my_unpublished_post_ids[] = get_post_meta(get_the_id(), 'centsai_post_id', true);
					}
				}wp_reset_postdata();
				/*Check if post already published end*/				
				$centsai_published_posts = array();
				//$centsai_republished_posts = array();
				foreach($my_posts['posts'] as $post){
					//echo 'Post_Id: '.$post['post_id'].'</br>';
					if((!in_array($post['post_id'], $my_published_post_ids) && !in_array($post['post_id'], $my_unpublished_post_ids)) || (empty($my_published_post_ids) && empty($my_unpublished_post_ids))){
						$my_post = array(
						  'post_title'    => wp_strip_all_tags($post['post_title']),
						  'post_content'  => $post['post_content'],
						  'post_status'   => 'publish',
						  'post_type'	  => 'centsai_one_posts',
						);
						$post_id = wp_insert_post($my_post);
						update_post_meta($post_id, 'post_image', $post['post_image']);
						update_post_meta($post_id, 'post_template', $post['post_template']);
						update_post_meta($post_id, 'video_url', $post['video_url']);
						update_post_meta($post_id, 'podcast_url', $post['podcast_url']);
						update_post_meta($post_id, 'author_name', $post['author_name']);
						update_post_meta($post_id, 'category_name', $post['category_name']);
						update_post_meta($post_id, 'post_date', $post['post_date']);
						update_post_meta($post_id, 'post_views', $post['post_views']);
						update_post_meta($post_id, 'read_time', $post['read_time']);
						update_post_meta($post_id, 'centsaione_canonical_link', $post['canonical_url']);
						update_post_meta($post_id, 'centsai_post_id', $post['post_id']);
					}elseif(in_array($post['post_id'], $my_unpublished_post_ids)){
						//$centsai_republished_posts[] = $post['post_id'];
						$args = array(
						  'post_type' => 'centsai_one_posts',
						  'ignore_sticky_posts' => 1,
						  'meta_key' => 'centsai_post_id',
						  'meta_value' => $post['post_id'],
						  'meta_compare' => '='
						);
						$my_query = new WP_Query( $args );
						if ( $my_query->have_posts() ) :
						  while ( $my_query->have_posts() ) : $my_query->the_post();
							$post_id = get_the_ID();
						  endwhile;
						endif;
						wp_reset_postdata();
						if($post_id){
							$republish_post = array(
								'ID'            => $post_id,
								'post_title'    => wp_strip_all_tags($post['post_title']),
								'post_content'  => $post['post_content'],
								'post_status'   => 'publish',
							);
							wp_update_post( $republish_post );
							update_post_meta($post_id, 'post_image', $post['post_image']);
							update_post_meta($post_id, 'post_template', $post['post_template']);
							update_post_meta($post_id, 'video_url', $post['video_url']);
							update_post_meta($post_id, 'podcast_url', $post['podcast_url']);
							update_post_meta($post_id, 'author_name', $post['author_name']);
							update_post_meta($post_id, 'category_name', $post['category_name']);
							update_post_meta($post_id, 'post_date', $post['post_date']);
							update_post_meta($post_id, 'post_views', $post['post_views']);
							update_post_meta($post_id, 'read_time', $post['read_time']);
							update_post_meta($post_id, 'centsaione_canonical_link', $post['canonical_url']);
						}
					}elseif(in_array($post['post_id'], $my_published_post_ids)){
						$args = array(
						  'post_type' => 'centsai_one_posts',
						  'ignore_sticky_posts' => 1,
						  'meta_key' => 'centsai_post_id',
						  'meta_value' => $post['post_id'],
						  'meta_compare' => '='
						);
						$my_query = new WP_Query( $args );
						if ( $my_query->have_posts() ) :
						  while ( $my_query->have_posts() ) : $my_query->the_post();
							$post_id = get_the_ID();
						  endwhile;
						endif;
						wp_reset_postdata();
						if($post_id){
							$republish_post = array(
								'ID'            => $post_id,
								'post_title'    => wp_strip_all_tags($post['post_title']),
								'post_content'  => $post['post_content'],
								'post_status'   => 'publish',
							);
							wp_update_post( $republish_post );
							update_post_meta($post_id, 'post_image', $post['post_image']);
							update_post_meta($post_id, 'post_template', $post['post_template']);
							update_post_meta($post_id, 'video_url', $post['video_url']);
							update_post_meta($post_id, 'podcast_url', $post['podcast_url']);
							update_post_meta($post_id, 'author_name', $post['author_name']);
							update_post_meta($post_id, 'category_name', $post['category_name']);
							update_post_meta($post_id, 'post_date', $post['post_date']);
							update_post_meta($post_id, 'post_views', $post['post_views']);
							update_post_meta($post_id, 'read_time', $post['read_time']);
							update_post_meta($post_id, 'centsaione_canonical_link', $post['canonical_url']);
						}
					}
					$centsai_published_posts[] = $post['post_id'];
				}
				if(isset($_SESSION['centsai_published_posts'])){
					$_SESSION['centsai_published_posts'] = array_merge($_SESSION['centsai_published_posts'], $centsai_published_posts);
				}else{
					$_SESSION['centsai_published_posts'] = $centsai_published_posts;
				}
				/*Republish posts start*/
				/*$republish_args = array(
					'post_type' => 'centsai_one_posts',
					'posts_per_page' => -1,
					'post_status' => 'draft',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key'     => 'centsai_post_id',
							'value'   => $centsai_republished_posts,
							'compare' => 'IN'
						)
					)
				);
				$my_republish_posts = new WP_Query( $republish_args );
				if($my_republish_posts->have_posts()){
					while($my_republish_posts->have_posts()){
						$my_republish_posts->the_post();
						$republish_post = array(
							'ID'            => get_the_id(),
							'post_status'   => 'publish',
						);
						$post_id = wp_update_post( $republish_post );
					}
				}wp_reset_postdata();*/
				/*Republish posts end*/
				if($my_posts['pages'] > 1 && $page < $my_posts['pages']){
					sleep(10);
					get_centsai_one_posts($page + 1);
				}else{
					/*Unpublish posts start*/
					$unpublish_args = array(
						'post_type' => 'centsai_one_posts',
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'centsai_post_id',
								'value'   => $_SESSION['centsai_published_posts'],
								'compare' => 'NOT IN'
							)
						)
					);
					$my_unpublish_posts = new WP_Query( $unpublish_args );
					if($my_unpublish_posts->have_posts()){
						while($my_unpublish_posts->have_posts()){
							$my_unpublish_posts->the_post();
							$unpublish_post = array(
								'ID'            => get_the_id(),
								'post_status'   => 'draft',
							);
							$post_id = wp_update_post( $unpublish_post );
						}
					}wp_reset_postdata();
					unset($_SESSION['centsai_published_posts']);
					//$_SESSION['centsai_published_posts'] = '';
					/*Unpublish posts end*/
				}
				//return 'Ok';
				$date = date( 'F j, Y g:i a', current_time( 'timestamp', 0 ) );
				update_option('centsai_last_sync_time', $date);
				update_option('centsai_last_sync_status', 'Ok');
				//$_SESSION['centsai_last_sync_time'] = $date;
				//$_SESSION['centsai_last_sync_status'] = 'Ok';
				if(!empty($my_posts['styles'])){
					foreach($my_posts['styles'] as $key => $val){
						update_option($key, $val);
					}
				}
				return json_encode(array('status' => 'Ok', 'date' => $date));
				die();
			}else{
				//return 'Message: '.$my_posts['message'];
				$date = date( 'F j, Y g:i a', current_time( 'timestamp', 0 ) );
				update_option('centsai_last_sync_time', $date);
				update_option('centsai_last_sync_status', $my_posts['message']);
				//$_SESSION['centsai_last_sync_time'] = $date;
				//$_SESSION['centsai_last_sync_status'] = $my_posts['message'];
				return json_encode(array('status' => $my_posts['message'], 'date' => $date));
				die();
			}
		}
	}else{
		//return 'Error: Check username/Password!';
		update_option('centsai_last_sync_time', '...');
		update_option('centsai_last_sync_status', 'Error: Check username/Password!');
		//$_SESSION['centsai_last_sync_time'] = '...';
		//$_SESSION['centsai_last_sync_status'] = 'Error: Check username/Password!';
		return json_encode(array('status' => 'Error: Check username/Password!', 'date' => '...'));
		die();
	}
}