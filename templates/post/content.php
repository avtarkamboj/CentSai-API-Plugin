<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage CentSai
 * @since 1.0
 * @version 1.2
 */

?>
<?php if(get_field('show_header_banner') != 'No' && $image_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "full")){
$post_image = $image_data[0];
if($image_data[1] >= 1920 && $image_data[2] >= 833){
	$img_class = 'full-size';
	$img_width = 1920;
	$img_height = 833;
}elseif($image_data[1] >= 1280 && $image_data[2] >= 555){
	$img_class = 'small-size';
	$img_width = 1280;
	$img_height = 555;
}elseif($image_data[1] >= 1100 && $image_data[2] >= 555){
	$img_class = 'v-small-size';
	$img_width = 1100;
	$img_height = 555;
}else{
	$img_class = 'vv-small-size';
	$img_width = 940;
	$img_height = 350;
}
global $company_data;
 ?>
<section class="full-width f-thumb-mob-tab">
	<picture><div data-jpibfi-post-title="<?php the_title(); ?>" class="full-width article-featured-image pin-me <?php echo $img_class; ?>" style="background-image:url(<?php echo mr_image_resize($post_image, $img_width, $img_height); ?>);"></div></picture>
	<div style="display:none"><img src="<?php echo mr_image_resize($post_image, '400', '400'); ?>"></div>
	<?php if(get_field('image_credit')){ ?>
	<div class="full-width photo-credit text-right"><?php the_field('image_credit'); ?></div>
	<?php } ?>
</section>
<?php } ?>
<section class="full-width" <?php /*if(!empty($company_data)){ echo 'style="background:'.$company_data["header_bg_color"].'"';} */?>>
	<div class="container-home">
    	<div class="full-width mp-br-head">
        	<div class="container">
		<div class="row">
		<?php $class = 'col-md-8 col-sm-7 col-md-push-2 col-sm-push-1 clearfix'; ?>
		<div class="<?php echo $class; ?> clearfix">
		
		 <div class="scat-name"> <?php echo post_category(true); ?>
          <div class="after" <?php /*if(!empty($company_data) && $company_data['label_after_color']){echo 'style="border-top-color:'.$company_data['label_after_color'].'"'; }*/ ?>></div>
        </div>
        <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
		<div class="author-info full-width">
          <div class="auth-thumb rel">
            <div class="auth-placeholder"><?php /*?><img class="nopin" src="<?php echo get_template_directory_uri(); ?>/assets/images/image-placeholder.svg" alt="<?php the_author(); ?>" ><?php */?>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 133.542 100.162" enable-background="new 0 0 133.542 100.162"
	 xml:space="preserve">
<path d="M0,0v100.162h133.542V0H0z M109.759,87.735c-17.03,14.625-43.04,14.371-58.098-0.569
	c-0.352-0.349-0.684-0.706-1.017-1.063c-0.021-0.022-0.041-0.043-0.062-0.064c-0.035,0.005-0.067,0.009-0.102,0.015l0,0
	c-9.356,1.285-19.533-1.079-27.764-7.28C7.864,67.583-5.451,40.339,5.822,27.583c5.764-6.519,16.841-7.984,28.273-6.371
	c0.051,0.053-0.048,0.169,0.002,0.001C41.398,10.172,51.952,1.598,63.685,1.605C74.143,1.613,83.66,8.434,90.767,17.741
	c0.057,0.032,0.001-0.001,0.001-0.001c13.565-2.512,26.914-1.305,34.481,6.206C140.305,38.885,126.789,73.106,109.759,87.735z"/>
</svg>
            </div>
            <div class="auth-img"><img class="nopin img-responsive" src="<?php echo get_author_image_url($post->post_author); ?>" alt="<?php the_author(); ?>" ></div>
          </div>
          <div class="auth-desc" itemscope itemtype="http://schema.org/Person">
            <div class="auth-name full-width" itemprop="name">
			<?php if($company_data){ ?>
				<?php the_author(); ?>
			<?php }else{ ?>
				<a itemprop="url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
			<?php } ?>
			<meta itemprop="sameAs" content="<?php echo get_the_author_meta( 'user_url' ); ?>"></div>
            <div class="full-width">
              <div class="td-post-date">
                <time class="entry-date updated td-module-date" datetime="<?php echo post_date(); ?>"><?php echo post_date(); ?></time>
              </div>
              <div class="x-mins-wrap rel"><?php echo estimated_reading_time(get_the_content()); ?></div>
            </div>
          </div>
		  <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
          <meta itemprop="dateModified" content="<?php echo get_the_modified_date('c'); ?>">
		  <meta itemprop="description" content="<?php echo strip_tags(get_the_author_meta('user_description')); ?>">
        </div>

        <div class="full-width post-social-wrap">
          <?php echo social_icons(); ?>
          <div class="no-views"><?php echo getPostViews(get_the_ID()); ?></div>
		  <?php echo (do_shortcode('[get_compliance_cop]')); ?>
        </div>
        <!--<div class="full-width social-follow">
            <div class="linkdin-wrap sfw-wrap">
                <script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                <script type="IN/FollowCompany" data-id="10011272" data-counter="right"></script>
            </div>
            <div class="facebook-wrap sfw-wrap">
                <div class="fb-like" data-href="https://www.facebook.com/CentSaiGuru" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
            </div>
            <div class="twitter-wrap sfw-wrap">
                <a href="https://twitter.com/CentSai" class="twitter-follow-button" data-show-screen-name="false" data-show-count="true">Follow</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="pinterest-wrap sfw-wrap">
                <a href="https://www.pinterest.com/centsai/" data-pin-do="buttonFollow">CentSai</a>
            </div>
        </div>-->
        <!--Advertiser disclosure text start--> 
		<?php if(!$company_data['client_id']){ ?>
		<div class="nadv-closs">
        <em>CentSai</em> relies on reader support. When you buy from one of our valued partners, <em>CentSai</em> may earn an affiliate commission. <a href="javascript:;" data-toggle="modal" data-target="#advertiser-disclosure">Advertising Disclosure</a></div>
        <?php } ?>
		<!--Advertiser disclosure text end--> 
		
		
		
		
		</div>
		
		</div>
	</div>
        </div>
    </div>
</section>

<section class="full-width post-content-wrap">
  <div class="container">
    <div class="row">

    	<div class="clearfix"></div>

	<?php $class = 'col-md-8 col-sm-7 col-md-push-2 col-sm-push-1 clearfix'; ?>
      <div class="<?php echo $class; ?> clearfix">
		
		
       <div class="wv-button-placeholder" style="margin-bottom:20px"></div>
			<?php if(get_field('show_header_banner') != 'No' && get_the_post_thumbnail_url(get_the_id(), 'full')){ ?>
			<div class="f-thumb-desktop clearfix">
				<div class="f-thumb-d-inn">
					<img src="<?php echo mr_image_resize($post_image, 0, 440); ?>" alt="<?php echo get_the_title(); ?>" class="img-responsive pin-me">
					<?php if(get_field('image_credit')){ ?>
					<div class="full-width photo-credit text-right"><?php the_field('image_credit'); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<?php if(!empty($company_data)){ ?>
			<div class="mp-brand-wrap clearfix">
			  <div class="mp-brand-thumb rel">
				<div class="mp-brand-img"><a target="_blank" href="<?php echo $company_data['company_website']; ?>"><img class="nopin img-responsive" src="<?php echo $company_data['logo']; ?>" alt="<?php echo $company_data['client_name']; ?>" ></a></div>
			  </div>
			  <div class="mp-brand-desc clearfix">
				<div class="full-width">
				  <a target="_blank" href="<?php echo $company_data['company_website']; ?>"><p><?php echo html_entity_decode($company_data['company_bio']); ?></p></a>
				</div>
			  </div>
			</div>
			<?php } ?>
			<!--Six Second Start--> 
			<div class="post-content full-width">
			
			<?php /*if(get_field("Six Second Take")): ?>
			<div class="full-width six-sec-take">
				<p><span >6 second take:</span> <?php echo strip_tags(get_field("Six Second Take"));?></p>
			</div>
			<?php endif;*/ ?>
			<!--Six Second Ends-->      
			
			
			
			  <?php 
			    /*if($company_data['level'] == '2'){
					$doc = new DOMDocument(); 
					$doc->loadHTML('<?xml encoding="utf-8" ?>' .apply_filters('the_content',get_the_content())); 
					$link = $doc->getElementsByTagName('a');  
					for ($i = $link->length - 1; $i >= 0; $i--) {
						$linkNode = $link->item($i);
						//if(strpos($linkNode->getAttribute('class'), 'thirstylink') !== false){
							$lnkText = $linkNode->textContent;
							$newTxtNode = $doc->createTextNode($lnkText);
							$linkNode->parentNode->replaceChild($newTxtNode, $linkNode);
						//}
					}
					echo $doc->saveHTML();
				}elseif($company_data['level'] == '3'){
					$new_href = $company_data["company_website"];
					$doc = new DOMDocument;
					$doc->loadHTML('<?xml encoding="utf-8" ?>' .apply_filters('the_content',get_the_content()));
					foreach ($doc->getElementsByTagName('a') as $link) {
						$link_class = $link->getAttribute('class');
						if(strpos($link_class, 'thirstylink') !== false){
							$link->setAttribute('href', $new_href);
						}
					}
					echo $doc->saveHTML();
				}else{ the_content(); } */
				the_content();
				//echo 'Post_author: '.get_post_meta(get_the_id(), 'centsai_one_author', true);
				
				//echo do_shortcode('[duplicate_post]');
				/*if (current_user_can('edit_posts')) {
					echo '<a href="' . wp_nonce_url('?action=rd_duplicate_post_as_draft&post=' . get_the_id(), basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
				}*/
				?>
				<?php //echo affiliate_comparison_chart(); ?>
			  <?php $user_id = 'user_'.get_the_author_meta('ID'); if(get_field('author_blurb', $user_id)){ echo get_field('author_blurb', $user_id); } ?>
			</div>
		</div>
		<?php if($company_data['disclosure_text']){ echo $company_data['disclosure_text']; } ?>
		<?php if($company_data){ ?>
		<div class="cen-disc-in">
				<div class="row">
					<div class="cen-disc-txt">This article's view is the author's and does not reflect the opinion of any member of CentSai's management. The author is not being paid by any financial services company nor has been paid to promote any individual product or service. The author is not a financial advisor or a broker-dealer. The content above is education-only and any reader is encouraged to seek advice from a registered financial advisor before taking any action.</div>
			 </div>
		</div>
		<?php } ?>
		<?php if($company_data){ ?>
        <div class="full-width">
			<div class="cen-one-pow-by"><a target="_blank" href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2019/03/CentSai-Logo.svg" alt="CentSai" class="img-responsive nopin"></a><span>Powered By</span></div>
        </div>
		<?php } ?>
        <!--New Statement-->
		<?php /*?><?php 
		if(get_option( 'text_below_articles' ) && get_field('text_below_articles') != 'no'){ ?>
        	<div class="full-width CenOne_Txt">
            <p><?php echo html_entity_decode(get_option( 'text_below_articles' )); ?></p>
           	</div>
		<?php } ?><?php */?>
        <!--New Statement-->
		<!--New Statement 1-->
		<?php 
		if(!$company_data && get_option( 'desktop_image_below_articles' ) && get_option( 'mobile_image_below_articles' ) && get_option('image_url_below_articles')){ ?>
        	<div class="full-width CenOne_Txt">
            <div class="full-width img_desktop"><a href="<?php echo get_option( 'image_url_below_articles' ); ?>" target="_blank"><img class="img-responsive nopin" src="<?php echo get_option( 'desktop_image_below_articles' ); ?>"/></a></div>
            <div class="full-width img_mobile"><a href="<?php echo get_option( 'image_url_below_articles' ); ?>" target="_blank"><img class="img-responsive nopin" src="<?php echo get_option( 'mobile_image_below_articles' ); ?>"/></a></div>
           	</div>
		<?php } ?>
		<!--New Statement 1-->
		<?php /*?><div class="full-width">
		<?php if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
		</div><?php */?>
      </div>
	  <?php if(!$company_data){  ?>
	  <?php if(is_active_sidebar('post-sidebar') && get_field('display_sidebar') != 'no'){ ?>
		  <div class="col-md-2 col-sm-3 pull-right pos-inherit cnt-sdbar-l">
		  <!--<div class="col-md-2 pos-inherit visible-md visible-lg">-->
		  <?php dynamic_sidebar( 'post-sidebar' ); ?>
		  </div>
	  <?php } ?>
	  <?php } ?>
        <!--New Affiliate-->
		<?php /*if( have_rows('affiliate_comparison_chart') ){ ?>
        <div class="full-width">
        	<div class="container">
            	<div class="row">
        			<div class="col-md-8 col-sm-7 col-md-push-2 col-sm-push-1 clearfix clearfix">
            	<div class="n-aff-tab full-width">
                    <h3>Comparison of Investing Applications in 2021</h3>
                    <div class="n-aff-head-desk full-width">
                        <label>App</label>
                        <label>About</label>
                        <label>Total Score <span>?</span></label>
                        <label>Learn More</label>
                    </div>
                    <div class="n-aff-body full-width">
                   		<!--Row-->
						<?php while ( have_rows('affiliate_comparison_chart') ) { the_row();
						if( get_row_layout() == 'affiliate_content' ){
						?>
                        <div class="n-aff-row full-width">
                            <div class="n-aff-lbl-mob">App</div>
                            <div class="n-aff-col n-col-1">
                            	<div class="n-aff-thumb">
								<?php
									$image = get_sub_field('logo');		
									$image_url = $image['url'];		
								?>
								<img src="<?php echo $image_url; ?>" class="img-responsive" alt="Acorns"></div>
                                <span><?php echo get_sub_field('title'); ?></span>
                            </div>
                            <div class="n-aff-col n-col-2">
                                <label>About</label>
                                <p><?php echo get_sub_field('description'); ?></p>
                            </div>
                            <div class="n-aff-col n-col-3">
                                <label>Total Score <span>?</span></label>
                                <div class="aff-ts"><?php echo get_sub_field('score'); ?></div>
                                <div class="n-aff-cta"><a href="<?php echo get_sub_field('website_url'); ?>">Our Review</a></div>                        
                            </div>
                            <div class="n-aff-col n-col-4">
                                <label>Learn More</label>
                                <a href="<?php echo get_sub_field('website_url'); ?>">Get Started</a>
                            </div>
                        </div>
						<?php } ?>
						<?php } ?>
                   		<!--Row-->
                   		
                        <div class="n-aff-vm full-width">
                        	<a href="javascript:">View More</a>
                        </div>
                    </div>
                </div>
            </div>
	            </div>
            </div>
        </div>
		<?php } */?>
        <!--New Affiliate Ends-->
      
	  <!--<div class="sidebar-post-end full-width"></div>-->
    </div>
  </div>
</section>
<?php echo do_shortcode('[comparison_table]'); ?>


<?php if(!$company_data){ ?>
    <section class="full-width">
        <div class="container-home">
            <div class="full-width cstar-rating">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-md-push-2 col-sm-push-1 cstar-rating-inn" >
                            <label>RATE US</label>
                            <div class="rat-p">
                                <span>Your rating will help CentSai learn what you love to see.</span><span>Please send your thoughts and comments to <a href="mailto:info@centsai.com">info@centsai.com</a></span>
                            </div>
                            <div class="rat-star">
                                <?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings(get_the_id()); endif; ?>
                            </div>
                            <div class="rat-p-2">
                                <span>Your rating will help CentSai learn what you love to see.</span><span>Please send your thoughts and comments to <a href="mailto:info@centsai.com">info@centsai.com</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </section>
	<?php } ?>
         <?php if(!$company_data){  ?>
         <div class="full-width"> 
            <div class="container">
            	<div class="row">
                    <div class="col-md-8 col-sm-7 col-md-push-2 col-sm-push-1" >
                        <?php if(get_field('show_below_content_ad', get_the_id()) != "no" && is_dynamic_sidebar('google-ads-after-content')):
                        dynamic_sidebar('google-ads-after-content');
                        endif; ?>
                    </div>
                  </div>
                 </div>
            </div>
		 <?php } ?>
<?php if(!$company_data){ echo you_may_like(); ?>
<?php echo more_from_centsai(); } ?>
<?php // echo more_from_centsai_new(); ?>
<?php 
global $wpdb;
if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$new_post_author = $post->post_author;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'publish',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
		add_post_meta($new_post_id, 'centsai_one_post', 'yes');
		add_post_meta($new_post_id, 'original_post_id', $post_id);
		add_post_meta($new_post_id, 'centsai_one_author_id', get_current_user_id());
		update_post_meta($new_post_id, '_yoast_wpseo_canonical', get_permalink($post_id));
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		//wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		wp_redirect( get_permalink( $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
 ?>