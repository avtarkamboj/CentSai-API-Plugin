<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage CentSai
 * @since 1.0
 * @version 1.0
 */
 get_header();
 GLOBAL $post;
 ?>
 <style>
 .mp-br-head {
    background: <?php echo get_option('header_bg_color'); ?> !important;
}
.mp-brand .post-content {
    background: <?php echo get_option('content_bg_color'); ?> !important
}
.mpbrand-dark .author-info .auth-name, .mpbrand-dark .author-info .auth-name a, .mpbrand-dark .author-info .auth-name a:hover, .mpbrand-dark .con-quiz-so circle, .mpbrand-dark .con-quiz-so li:nth-child(1) path, .mpbrand-dark .con-quiz-so svg, .mpbrand-dark .con-quiz-soout label, .mpbrand-dark .n-head-wrap h1, .mpbrand-dark .nadv-closs, .mpbrand-dark .post-social-wrap .no-views, .mpbrand-dark .quiz-auth-info .auth-name, .mpbrand-dark .td-post-date, .mpbrand-dark .x-mins-wrap, .mpbrand-dark h1.entry-title{
color: !important
}
.mp-brand .my-content .six-sec-take, .mp-brand .my-content .six-sec-take span, .mp-brand .hq-expert .hq-ex-head, .mp-brand .post-content blockquote, .post-content a, .post-content a:hover, .mp-brand .post-content h1, .mp-brand .post-content h2, .mp-brand .post-content h3, .mp-brand .post-content h4, .mp-brand .post-content h5, .mp-brand .post-content h6{
color: !important
}
.post-content p, .post-content ul, .post-content ul li, .post-content ol, .post-content ol li {
    color: !important;
}
.mpbrand-dark .scat-name a {
    background: #000!important;
    color: #fff!important;
}
.mpbrand-dark .scat-name .after, .mpbrand-dark.post-column .scat-name .after {
    border-top-color: #000!important;
}

 </style>
<?php
 while ( have_posts() ) : the_post(); 
 //$image_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "full");
 $post_id = get_the_id();
 $post_image = get_post_meta($post_id, 'post_image', true);
 $author_name = get_post_meta($post_id, 'author_name', true);
 $category_name = get_post_meta($post_id, 'category_name', true);
 $post_date = get_post_meta($post_id, 'post_date', true);
 $post_views = get_post_meta($post_id, 'post_views', true);
 $read_time = get_post_meta($post_id, 'read_time', true);
 //get_post_meta($post_id, 'centsai_post_id', true);
 /*$header_bg_color = get_option('header_bg_color');
 $content_bg_color = get_option('content_bg_color');
 $header_text_color = get_option('header_text_color');*/
  $header_text_color = get_option('header_text_color');
 if($header_text_color == 'black'){
	 $branding_class = 'mpbrand-dark';
 }else{
	 $branding_class = 'mpbrand-light';
 }
?>
<?php /*?>
FEATURED IMAGE WILL SHOW IN THE CONTENT
<section class="full-width f-thumb-mob-tab">
	<picture><div data-jpibfi-post-title="<?php the_title(); ?>" class="full-width article-featured-image pin-me" style="background-image:url(<?php echo $post_image; ?>);"></div></picture>
	<div style="display:none"><img src="<?php echo $post_image; ?>"></div>
</section><?php */?>
<section class="mp-brand full-width <?php echo $branding_class; ?>">
<div class="full-width" <?php /*if(!empty($company_data)){ echo 'style="background:'.$company_data["header_bg_color"].'"';} */?>>
  <div class="container-home">
    <div class="full-width mp-br-head">
      <?php $class = ''; ?>
      <div class="clearfix">
        <div class="scat-name">
          <a href="javacript:;"><?php echo $category_name; ?></a>
          <div class="after" <?php /*if(!empty($company_data) && $company_data['label_after_color']){echo 'style="border-top-color:'.$company_data['label_after_color'].'"'; }*/ ?>></div>
        </div>
        <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
        <div class="author-info full-width">
          <div class="auth-desc" itemscope itemtype="http://schema.org/Person">
            <div class="auth-name full-width" itemprop="name">
              <?php /*if($company_data){ ?>
				<?php the_author(); ?>
			<?php }else{ ?>
				<a itemprop="url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
			<?php }*/ ?>
            </div>
            <div class="full-width">
              <div class="td-post-date">
                <time class="entry-date updated td-module-date" datetime="<?php echo $post_date; ?>">
                  <?php echo $post_date; ?>
                </time>
              </div>
              <div class="x-mins-wrap rel">
                <?php echo $read_time; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="full-width post-social-wrap">
          <?php echo centsai_one_social_icons(); ?>
          <div class="no-views">
            <?php echo $post_views; ?>
          </div>
          <?php //echo (do_shortcode('[get_compliance_cop]')); ?>
        </div>
        <!--Advertiser disclosure text start-->
        <?php /*if(!$company_data['client_id']){ ?>
        <div class="nadv-closs"> <em>CentSai</em> relies on reader support. When you buy from one of our valued partners, <em>CentSai</em> may earn an affiliate commission. <a href="javascript:;" data-toggle="modal" data-target="#advertiser-disclosure">Advertising Disclosure</a></div>
        <?php }*/ ?>
        <!--Advertiser disclosure text end--> 
      </div>
    </div>
  </div>
</div>
<div class="full-width post-content-wrap">
  <div class="container-home">
      <?php $class = ''; ?>
      <div class="clearfix">
        <div class="wv-button-placeholder"></div>
        <?php /*if(get_field('show_header_banner') != 'No' && get_the_post_thumbnail_url(get_the_id(), 'full')){ ?>
			<div class="f-thumb-desktop clearfix">
				<div class="f-thumb-d-inn">
					<img src="<?php echo $post_image; ?>" alt="<?php echo get_the_title(); ?>" class="img-responsive pin-me">
					<?php if(get_field('image_credit')){ ?>
					<div class="full-width photo-credit text-right"><?php the_field('image_credit'); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php }*/ ?>
        <?php if(!empty($company_data)){ ?>
        <div class="mp-brand-wrap clearfix">
          <div class="mp-brand-thumb rel">
            <div class="mp-brand-img"><a target="_blank" href="<?php echo $company_data['company_website']; ?>"><img class="nopin img-responsive" src="<?php echo $company_data['logo']; ?>" alt="<?php echo $company_data['client_name']; ?>" ></a></div>
          </div>
          <div class="mp-brand-desc clearfix">
            <div class="full-width"> <a target="_blank" href="<?php echo $company_data['company_website']; ?>">
              <p><?php echo html_entity_decode($company_data['company_bio']); ?></p>
              </a> </div>
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
		  <div class="mp-feat-img full-width">
		  <?php 
			if($videoUrl = get_post_meta($post_id, 'video_url', true)){
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
			}else{ ?>
		  <img src="<?php echo $post_image; ?>">
			<?php } ?>
		  </div>
          <div class="mp-feat-cnt full-width"><?php the_content(); ?></div>
          <div class="clearALL"></div>
        </div>
      </div>
      <?php if($company_data['disclosure_text']){ echo $company_data['disclosure_text']; } ?>
      <?php //if($company_data){ ?>
      <div class="cen-disc-in">
        <div class="row">
          <div class="cen-disc-txt">This article's view is the author's and does not reflect the opinion of any member of CentSai's management. The author is not being paid by any financial services company nor has been paid to promote any individual product or service. The author is not a financial advisor or a broker-dealer. The content above is education-only and any reader is encouraged to seek advice from a registered financial advisor before taking any action.</div>
        </div>
      </div>
      <?php //} ?>
      <?php //if($company_data){ ?>
      <div class="full-width">
        <div class="cen-one-pow-by"><a target="_blank" href="https://centsai.com/centsaione/"><img src="<?php echo plugin_dir_url(''); ?>centsai-one/assets/images/CentSai-Logo.svg" alt="CentSai" class="img-responsive nopin"></a><span>Powered By</span></div>
      </div>
      <?php //} ?>
  </div>
  </div>
</div>
<div style="clear: both"></div>
</section>
<?php endwhile; 
 get_footer();
?>