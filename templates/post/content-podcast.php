<?php
/**
 * Template part for displaying audio posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
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
<section class="full-width post-content-wrap">
  <div class="container">
    <div class="row">
      <?php /*$class = 'col-md-12';	if(is_active_sidebar('post-sidebar') && get_field('display_sidebar') != 'no'){ $class = 'col-md-8'; }*/$class = 'col-md-8 col-sm-7 col-md-push-2 col-sm-push-1'; ?>
      <div class="<?php echo $class; ?> clearfix">
        <div class="scat-name"> <?php echo post_category(true); ?>
          <div class="after"></div>
        </div>
        <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
        <div class="author-info full-width">
          <div class="auth-thumb rel">
            <div class="auth-placeholder"><img class="nopin" src="<?php echo get_template_directory_uri(); ?>/assets/images/image-placeholder.svg" alt="<?php the_author(); ?>" ></div>
            <div class="auth-img"><img class="nopin" src="<?php echo get_author_image_url($post->post_author); ?>" alt="<?php the_author(); ?>" class="img-responsive" ></div>
          </div>
          <div class="auth-desc" itemscope itemtype="http://schema.org/Person">
            <div class="auth-name full-width" itemprop="name"><a itemprop="url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a><meta itemprop="sameAs" content="<?php echo get_the_author_meta( 'user_url' ); ?>"></div>
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
        </div>
		<!--Advertiser disclosure text start--> 
		<div class="nadv-closs"><em>CentSai</em> relies on reader support. When you buy from one of our valued partners, <em>CentSai</em> may earn an affiliate commission. <a href="javascript:;" data-toggle="modal" data-target="#advertiser-disclosure">Advertising Disclosure</a></div>
        <!--Advertiser disclosure text end--> 
        
		<?php if(get_field('show_header_banner') != 'No' && get_the_post_thumbnail_url(get_the_id(), 'full')){ ?>
		<div class="f-thumb-desktop clearfix">
        	<div class="f-thumb-d-inn">
                <img src="<?php echo mr_image_resize($post_image, 0, 440); ?>" alt="<?php echo get_the_title(); ?>" class="img-responsive">
                <?php if(get_field('image_credit')){ ?>
                <div class="full-width photo-credit text-right"><?php the_field('image_credit'); ?></div>
                <?php } ?>
             </div>
		</div>
		<?php } ?><!--Six Second Start--> 
        <?php if(get_field("Six Second Take")): ?>
		<div class="full-width six-sec-take">
        	<span>6 second take:</span> <?php echo strip_tags(get_field("Six Second Take"));?>
        </div>
        <?php endif; ?>
        <!--Six Second Ends-->  
        <div class="post-content full-width">
		<?php 
		if($podcast_url = get_field('podcast_url')){
			echo do_shortcode('[audio src="'.$podcast_url.'"]');
		}
		?>
          <?php the_content(); ?>
		  <?php echo affiliate_comparison_chart(); ?>
		  <?php $user_id = 'user_'.get_the_author_meta('ID'); if(get_field('author_blurb', $user_id)){ echo get_field('author_blurb', $user_id); } ?>
        </div>
		<?php /*?><div class="full-width">
		<?php if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
		</div><?php */?>
      </div>
	  <?php if(is_active_sidebar('post-sidebar') && get_field('display_sidebar') != 'no'){ ?>
		  <div class="col-md-2 col-sm-3 pull-right pos-inherit cnt-sdbar-l">
		  <?php dynamic_sidebar( 'post-sidebar' ); ?>
		  </div>
	  <?php } ?>
	  <div class="sidebar-post-end full-width"></div>
    </div>
  </div>
</section>
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
<?php echo you_may_like(); ?>
<?php echo more_from_centsai(); ?>