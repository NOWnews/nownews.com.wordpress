<?php
/*  ----------------------------------------------------------------------------
    Newspaper V6.3+ Child theme - Please do not use this child theme with older versions of Newspaper Theme

    What can be overwritten via the child theme:
     - everything from /parts folder
     - all the loops (loop.php loop-single-1.php) etc
	 - please read the child theme documentation: http://forum.tagdiv.com/the-child-theme-support-tutorial/


     - the rest of the theme has to be modified via the theme api:
       http://forum.tagdiv.com/the-theme-api/

 */




/*  ----------------------------------------------------------------------------
    add the parent style + style.css from this folder
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 1001);
function theme_enqueue_styles() {
    wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );

}

//POST EDIT LINK
function change_row_title( $url, $post_id, $context )
{
    $check_group=null;
    $check_role=null;
    //get post author into group
    $authorId = get_post_field( 'post_author', $post_id );
    $groups_author = new Groups_User( $authorId );
    $author_group_ids = $groups_author->group_ids;
    //get current user into group
    $userId = get_current_user_id();
    $groups_user = new Groups_User( $userId );
    $user_group_ids = $groups_user->group_ids;
    //check role
    $user = wp_get_current_user();
    $super_role = array(
                'administrator',
                'editor_in_chief',
                'deputy_editor_in_chief'
                );
    foreach( $user->roles as $key ){
        if( in_array( $key, $super_role ) ){
            $check_role++;
        }
        //$user_role .= $key.",";
    }
    //check group
    foreach( $user_group_ids as $group_user_id ){
            foreach( $author_group_ids as $group_author_id ){
                    if( $group_user_id == $group_author_id ){
                            $check_group++;
                    }
            }
    }
    if ( 'edit-post' !== get_current_screen()->id ){
        return;
    }elseif( $authorId == $userId || $check_role > 0 ){
        return $url;
    }elseif( $check > 1 ){
        //who can't see the post ex.except the same department's director
        if( $user_role != '主任'){
            return get_permalink();
        }else{
            return $url;
        }
    }else{
        return get_permalink();
    }
}
add_filter( 'get_edit_post_link', 'change_row_title', 10, 3 );

//SAVE POST AS PENDING
function submit_for_review_update($post_id) {
    global $post,$current_user;

    if( !is_object($post) ) 
        return;

    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    
    if (!wp_is_post_revision($post_id)) {
        $my_post = array(
            'ID' => $post_id,
            'post_status' => 'pending',
        );

        remove_action('save_post', 'submit_for_review_update', 10, 3);

        if ( ($user_role != 'administrator') && ($post->post_status != 'pending') ) {
            wp_update_post($my_post);
        }
        add_action('save_post', 'submit_for_review_update', 10, 3);
    }
}
add_action('save_post', 'submit_for_review_update', 10, 3 );

//HIDE PLUBIC META BOX
function custom_load_post() {
    $post_id = $_GET['post'];
    $authorId = get_post_field( 'post_author', $post_id );
    $userId = get_current_user_id();
    //echo get_post_status($post_id)."===".$authorId."===".$userId;
    if( ($authorId == $userId) && get_post_status($post_id) == 'pending' ){
        remove_meta_box( 'A2A_SHARE_SAVE_meta' , 'post' , 'side' );
        remove_meta_box( 'categorydiv' , 'post' , 'side' );
        remove_meta_box( 'authordiv' , 'post' , 'side' );
        remove_meta_box( 'formatdiv' , 'post' , 'side' );
        remove_meta_box( 'submitdiv' , 'post' , 'side' );
    }
}
add_action( 'load-post.php' , 'custom_load_post' );
add_action( 'load-post-new.php' , 'custom_load_post' );