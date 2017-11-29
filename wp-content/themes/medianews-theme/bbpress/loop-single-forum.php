<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Medianews
 */

?>


<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(bbp_forum_id(),'px-parent-forum'); ?>>
	<li>
		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<h2><a class="bbp-forum-title pix-heading-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h2>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

        
       </li>
        <li>
        
                <?php do_action( 'bbp_theme_before_forum_description' ); ?>
        
                <div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>
        
                <?php do_action( 'bbp_theme_after_forum_description' ); ?>
        </li>
	<?php 
	
	$sub_forums = bbp_forum_get_subforums( bbp_get_forum_id() );
	if ( !empty( $sub_forums ) ) {
	
	// Total count (for separator)
		$total_subs = count( $sub_forums );

	?>
    <li class="bbp-header">
    
            <ul class="forum-titles">
                <li class="bbp-forum-info"><?php _e( 'Disscussion Board', 'bbpress' ); ?></li>
                <li class="bbp-forum-topic-count"><?php _e( 'Topics', 'bbpress' ); ?></li>
                <li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></li>
                <li class="bbp-forum-freshness"><?php _e( 'Last Post', 'bbpress' ); ?></li>
            </ul>
    
    </li><!-- .bbp-header -->
    <li>
        
            <?php 
                // Total count (for separator)
                $total_subs = count( $sub_forums );
                foreach ( $sub_forums as $sub_forum ) {
                    
                    $permalink = bbp_get_forum_permalink( $sub_forum->ID );
                    $title     = bbp_get_forum_title( $sub_forum->ID );
                ?>
                   <ul id="bbp-forum-<?php bbp_forum_id($sub_forum->ID); ?>" <?php bbp_forum_class($sub_forum->ID,'px-child-forums'); ?>>
                    
                    <li class="bbp-forum-info">
                
                    
                        <?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>
                        
                        
                        <?php echo '<span class="px-forum-icon"></span><a href="' . esc_url( $permalink ) . '" class="bbp-forum-link">' . $title . '</a>';?>
                        
                        <div class="bbp-forum-content"><?php bbp_forum_content($sub_forum->ID); ?></div>
                        
                        
                        <?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>
                
                        <?php bbp_forum_row_actions(); ?>
                
                    </li>
                
                    <li class="bbp-forum-topic-count"><?php echo bbp_get_forum_topic_count($sub_forum->ID); ?></li>
                
                    <li class="bbp-forum-reply-count"><?php bbp_show_lead_topic($sub_forum->ID) ? bbp_forum_reply_count() : bbp_forum_post_count($sub_forum->ID); ?></li>
                
                    <li class="bbp-forum-freshness bbp-forum-last-post">
                        <p class="bbp-topic-meta">
                            <span class="bbp-topic-freshness-author">
                            <?php	
							if(bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'type' => 'name' ) )){
                                do_action( 'bbp_theme_before_topic_author' );
                                bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'type' => 'name' ) );
                           		do_action( 'bbp_theme_after_topic_author' );
							}?>
                             <?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
                            <time><?php bbp_forum_freshness_link(); ?></time>
                            <?php //do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
                             </span>
                            <?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'type' => 'avatar', 'size' => 32 ) );?>
                        </p>
                    </li>
                    </ul>
        <?php 
            }
    
        ?>
        <!-- #bbp-forum-<?php bbp_forum_id($sub_forum->ID); ?> -->
        
     </li> 
 <?php }?> 
 </ul>
