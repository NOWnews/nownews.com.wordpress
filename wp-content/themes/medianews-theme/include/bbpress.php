<?php
// Author Before Action
if ( ! function_exists( 'px_bbp_theme_before_topic_author_by' ) ) {
function px_bbp_theme_before_topic_author_by(){
	_e('by','Medianews');
} 
add_action('bbp_theme_before_topic_author','px_bbp_theme_before_topic_author_by');
add_action('bbp_theme_before_topic_freshness_author','px_bbp_theme_before_topic_author_by');
add_action('bbp_theme_before_reply_author_details','px_bbp_theme_before_topic_author_by');
}

// Breadcrumbs
if ( ! function_exists( 'px_bbp_beadcrumbs' ) ) {
function px_bbp_beadcrumbs($arg) { return true; }
add_filter('bbp_no_breadcrumb', 'px_bbp_beadcrumbs' );
}
 
function px_bbp_return_blank() {
	return '';
}

// Post Time Fromat
if ( ! function_exists( 'px_bbp_change_time_format' ) ) {
	function px_bbp_change_time_format( $anchor, $forum_id )
	{
		$last_active = get_post_meta( $forum_id, '_bbp_last_active_time', true );
	
		if ( empty( $last_active ) ) {
			$reply_id = bbp_get_forum_last_reply_id( $forum_id );
	
			if ( !empty( $reply_id ) ) {
				$last_active = get_post_field( 'post_date', $reply_id );
			} else {
				$topic_id = bbp_get_forum_last_topic_id( $forum_id );
	
				if ( !empty( $topic_id ) ) {
					$last_active = bbp_get_topic_last_active_time( $topic_id );
				}
			}
		}
	
		  $date   = get_post_time( get_option( 'date_format' ), $gmt, $reply_id, true );
		  $time   = get_post_time( get_option( 'time_format' ), $gmt, $reply_id, true );
		  $dt = sprintf( _x( '%1$s %2$s', '', 'bbpress' ), $date, $time );    
	
		$time_since = bbp_get_forum_last_active_time( $forum_id );
	
		return str_replace( "$time_since</a>", "$dt</a>", $anchor );
	}
	add_filter( 'bbp_get_forum_freshness_link', 'px_bbp_change_time_format', 10, 2 );
	add_filter( 'bbp_get_topic_freshness_link', 'px_bbp_change_time_format', 10, 2 );
}