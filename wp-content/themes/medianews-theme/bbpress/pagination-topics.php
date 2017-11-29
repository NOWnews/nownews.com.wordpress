<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination">
	<?php if(bbp_get_forum_id()):?>
	<div class="bbp-pagination-count">
		<h2><a class="bbp-forum-title pix-heading-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a><span><?php bbp_forum_pagination_count(); ?></span></h2>
	</div>
<?php endif;?>
	<div class="bbp-pagination-links">

		<?php bbp_forum_pagination_links(); ?>

	</div>
</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
