<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage CentSai
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>
<section class="full-width reg-slide">
	<div class="con-n-outer rel">
    	<!--<div class="reg-page-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stories/General-Banner.png" alt="" class="img-responsive">
        </div> -->
        <div class="con-outer-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-push-1 con-n-wrap clearfix">                              
                        <div class="n-head-wrap full-width">
                            <h1>CentSai One Articles</h1>
                            <?php /*?><div class="n-head-desc"><p>Money quizzes are our strong suit. Test your personal finance knowledge and have fun, too.</p></div><?php */?>
                        </div>
                    </div>
                </div>        
            </div>
        </div> 
    </div>
</section>
<section class="full-width press-release archives clearfix">
    <div class="container">
        <div class="row">
        <?php if(have_posts()){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
            	<div id="centsai-one-ajax-content" class="full-width">
					<?php while ( have_posts() ) : the_post(); 
						CentSai_load_template_part('templates/list','list'); 
					endwhile; ?>
                </div>
				<?php global $wp_query; if($wp_query->max_num_pages > 1){ ?>
					<div class="full-width arc-more-btn centsai-one-pagination"><a href="javascript:;" class="btn btn-orange-secondary btn-lg full-width centsai_one_loadmore">MORE STORIES</a></div>
				<?php } ?>
            </div>
			<?php }else{ ?>
				<div class="col-lg-12 col-md-12 col-sm-12 clearfix"><p>No posts found!</p></div>
			<?php }wp_reset_postdata(); ?>
        </div>
	</div>
</section>
<div style="clear: both">
<?php get_footer();