<?php
/**
 * Template part for displaying video posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
<?php global $company_data; ?>
<?php if(get_field('show_header_banner') != 'No' && $image_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "full")){ 
$post_image = $image_data[0];
//echo 'Size: '.$image_data[1];
//print_r($image_data);
//$img_class = $img_width = $img_height = '';
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
 ?>
<section class="full-width f-thumb-mob-tab">
	<picture><div data-jpibfi-post-title="<?php the_title(); ?>" class="full-width article-featured-image <?php echo $img_class; ?>" style="background-image:url(<?php echo mr_image_resize($post_image, $img_width, $img_height); ?>);"></div></picture>
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
	<?php $class = 'col-md-8 col-sm-7 col-md-push-2 col-sm-push-1 clearfix'; ?>
      <div class="<?php echo $class; ?> clearfix">
       
		
		<div class="full-width my-content" <?php /*if(!empty($company_data)){ echo 'style="background:'.$company_data["content_bg_color"].'"';} */?>>
		
			
			<?php if(!empty($company_data)){ ?>
			<div class="mp-brand-wrap clearfix">
			  <div class="mp-brand-thumb rel">
				<?php /*?><div class="mp-brand-placeholder"><img class="nopin" src="<?php echo get_template_directory_uri(); ?>/assets/images/image-placeholder-grey.svg" alt="<?php the_author(); ?>" >
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 133.542 100.162" enable-background="new 0 0 133.542 100.162"
	 xml:space="preserve">
<path d="M0,0v100.162h133.542V0H0z M109.759,87.735c-17.03,14.625-43.04,14.371-58.098-0.569
	c-0.352-0.349-0.684-0.706-1.017-1.063c-0.021-0.022-0.041-0.043-0.062-0.064c-0.035,0.005-0.067,0.009-0.102,0.015l0,0
	c-9.356,1.285-19.533-1.079-27.764-7.28C7.864,67.583-5.451,40.339,5.822,27.583c5.764-6.519,16.841-7.984,28.273-6.371
	c0.051,0.053-0.048,0.169,0.002,0.001C41.398,10.172,51.952,1.598,63.685,1.605C74.143,1.613,83.66,8.434,90.767,17.741
	c0.057,0.032,0.001-0.001,0.001-0.001c13.565-2.512,26.914-1.305,34.481,6.206C140.305,38.885,126.789,73.106,109.759,87.735z"/>
</svg>
                </div><?php */?>
				<div class="mp-brand-img"><a target="_blank" href="<?php echo $company_data['company_website']; ?>"><img class="nopin img-responsive" src="<?php echo $company_data['logo']; ?>" alt="<?php echo $company_data['client_name']; ?>" ></a></div>
			  </div>
			  <div class="mp-brand-desc clearfix">
				<div class="full-width">
				  <a target="_blank" href="<?php echo $company_data['company_website']; ?>"><p><?php echo html_entity_decode($company_data['company_bio']); ?></p></a>
				</div>
			  </div>
			</div>
			<?php } ?>
			<?php 
		if($videoUrl = get_field('featured_video')){
			function detect_video_service($videoUrl) {
				$videoUrl = strtolower($videoUrl);
				if (strpos($videoUrl,'youtube.com') !== false or strpos($videoUrl,'youtu.be') !== false) {
					return 'youtube';
				}
				if (strpos($videoUrl,'dailymotion.com') !== false) {
					return 'dailymotion';
				}
				if (strpos($videoUrl,'vimeo.com') !== false) {
					return 'vimeo';
				}
				if (strpos($videoUrl,'facebook.com') !== false) {
					return 'facebook';
				}
				if (strpos($videoUrl,'twitter.com') !== false) {
					return 'twitter';
				}
				return false;
			}
			function get_youtube_id($videoUrl) {
				$query_string = array();
				parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);
				if (empty($query_string["v"])) {
					$yt_short_link_parts_explode1 = explode('?', $videoUrl);
					$yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[0]);
					if (!empty($yt_short_link_parts[3])) {
						return $yt_short_link_parts[3];
					}
					return $yt_short_link_parts[0];
				} else {
					return $query_string["v"];
				}
			}
			function get_youtube_time_param($videoUrl) {
				$query_string = array();
				parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);
				if (!empty($query_string["t"])) {
					if (strpos($query_string["t"], 'm')) {
						$explode_for_minutes = explode('m', $query_string["t"]);
						$minutes = trim($explode_for_minutes[0]);
						$explode_for_seconds = explode('s', $explode_for_minutes[1]);
						$seconds = trim($explode_for_seconds[0]);
						$startTime = ($minutes * 60) + $seconds;
					}else{
						$explode_for_seconds = explode('s', $query_string["t"]);
						$seconds = trim($explode_for_seconds[0]);
						$startTime = $seconds;
					}
					return '&start=' . $startTime;
				} else {
					return '';
				}
			}
			function get_vimeo_id($videoUrl) {
				sscanf(parse_url($videoUrl, PHP_URL_PATH), '/%d', $video_id);
				return $video_id;
			}
			switch(detect_video_service($videoUrl)){
				case 'youtube':
					echo '<div class="video_wrapper">
					<iframe class="do_not_remove" id="td_youtube_player" width="100%" height="560" src="https://www.youtube.com/embed/'.get_youtube_id($videoUrl).'?enablejsapi=1&amp;feature=oembed&amp;wmode=opaque&amp;vq=hd720" frameborder="0" allowfullscreen="" style="height: 396px;"></iframe>
					</div>';
					break;
					case 'vimeo':
					echo '<div class="video_wrapper">
					<iframe class="do_not_remove" src="https://player.vimeo.com/video/'.get_vimeo_id($videoUrl).'" width="100%" height="212" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" style="height: 402.188px;"></iframe>
					</div>';
					break;
			}
		}?>
			<!--Six Second Start--> 
			<?php if(get_field("Six Second Take")): ?>
			<div class="full-width six-sec-take" <?php /*if(!empty($company_data) && !empty($company_data['text_color'])){ echo 'style="color:'.$company_data["text_color"].'"';} */?>>
				<span <?php /*if(!empty($company_data) && !empty($company_data['text_color'])){ echo 'style="color:'.$company_data["text_color"].'"';} */?>>6 second take:</span> <?php echo strip_tags(get_field("Six Second Take"));?>
			</div>
			<?php endif; ?>
			<!--Six Second Ends-->      
			
			
			<div class="post-content full-width">
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
				the_content(); ?>
				<?php echo affiliate_comparison_chart(); ?>
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
			<div class="cen-one-pow-by"><a target="_blank" href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2019/03/CentSai-Logo.svg" alt="CentSai" class="img-responsive nopin"></a><span>Powered By:</span></div>
        </div>
		<?php } ?>
        <!--New Statement-->
		<?php 
		$single_post_settings_options = get_option( 'single_post_settings_option_name' );
		$text_below_articles_0 = $single_post_settings_options['text_below_articles_0'];
		if(get_option( 'text_below_articles' ) && get_field('text_below_articles') != 'no'){ ?>
        	<div class="full-width CenOne_Txt">
            <p><?php echo html_entity_decode(get_option( 'text_below_articles' )); ?></p>
           	</div>
		<?php } ?>
        <!--New Statement-->
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
      
      
      
	  <!--<div class="sidebar-post-end full-width"></div>-->
    </div>
  </div>
</section>

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
                    <?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>
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
<?php if(!$company_data){ echo you_may_like(); ?>
<?php echo more_from_centsai(); } ?>