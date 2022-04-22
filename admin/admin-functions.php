<?php 
function centsai_one_sync_posts(){
	/*$out = 'Ok';
	$date = date( 'F j, Y g:i a', current_time( 'timestamp', 0 ) );
	$_SESSION['centsai_last_sync_time'] = $date;
	$_SESSION['centsai_last_sync_status'] = 'Ok';*/
	echo get_centsai_one_posts(1);
	//echo json_encode(array('status' => get_centsai_one_posts(1), 'date' => $date));
    wp_die();
}
add_action('wp_ajax_nopriv_centsai_one_sync_posts', 'centsai_one_sync_posts');
add_action('wp_ajax_centsai_one_sync_posts', 'centsai_one_sync_posts');
?>