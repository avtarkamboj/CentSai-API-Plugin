<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<article class="col-md-4 col-sm-6 col-xs-6 l-p-col clearfix">
  <div class="p-img rel"> <a title="<?php echo get_the_title(); ?>" rel="bookmark" href="<?php echo get_the_permalink(); ?>">
	<picture> <img src="<?php echo get_post_meta(get_the_id(), 'post_image', true); ?>" class="img-responsive" alt="<?php echo get_the_title(); ?>"> </picture>
	</a> </div>
  <div class="p-desc"> <?php //echo post_category(true, 'p-cat'); ?>
  <span class="p-catname block"><?php echo get_post_meta(get_the_id(), 'category_name', true); ?></span>
	<h2 class="entry-title"><a title="<?php echo get_the_title(); ?>" rel="bookmark" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
	<div class="post-content"><?php //echo $post['post_content']; ?></div>
	<span class="p-date block"><?php echo get_post_meta(get_the_id(), 'post_date', true); ?></span> <span class="p-auth block"><?php echo get_post_meta(get_the_id(), 'author_name', true); ?></span> </div>
</article>