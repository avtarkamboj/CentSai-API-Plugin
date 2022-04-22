<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$args = array(
	'post_type' => 'centsai_one_posts',
	'posts_per_page' => 6,
	'post_status' => 'publish',
);
$my_posts = new WP_Query( $args );
//var_dump($_SESSION['centsai_published_posts']);
/*echo $_SESSION['centsai_last_sync']. '<br />';
echo "current_time( 'mysql' ) returns local site time: " . current_time( 'mysql' ) . '<br />';
echo "current_time( 'mysql', 1 ) returns GMT: " . current_time( 'mysql', 1 ) . '<br />';
echo "current_time( 'timestamp' ) returns local site time: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ). '<br />';
echo "current_time( 'timestamp', 1 ) returns GMT: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) ). '<br />';*/
?>
<section class="full-width press-release archives clearfix">
    <div class="container">
        <div class="row">
        <?php if($my_posts->have_posts()){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
            	<div id="centsai-one-ajax-content" class="full-width">
					<?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
						CentSai_load_template_part('templates/list','list');
					 endwhile; ?>
                </div>
				<?php if($my_posts->max_num_pages > 1){ ?>
					<div class="full-width arc-more-btn centsai-one-pagination"><a href="javascript:;" class="btn btn-orange-secondary btn-lg full-width centsai_one_loadmore">MORE STORIES</a></div>
				<?php } ?>
            </div>
			<?php }else{ ?>
				<div class="col-lg-12 col-md-12 col-sm-12 clearfix"><p>No posts found!</p></div>
			<?php }wp_reset_postdata(); ?>
        </div>
	</div>
</section>