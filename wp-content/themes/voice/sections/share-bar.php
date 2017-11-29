<?php
$share = array();
$share['facebook'] = '<a class="fa fa-facebook" href="javascript:void(0);" data-url="http://www.facebook.com/sharer/sharer.php?u='.urlencode( get_permalink() ).'&amp;t='.urlencode( esc_attr( get_the_title() ) ).'"></a>';
$share['twitter'] = '<a class="fa fa-twitter" href="javascript:void(0);" data-url="http://twitter.com/intent/tweet?url='.urlencode( get_permalink() ).'&amp;text='.urlencode( esc_attr( get_the_title() ) ).'"></a>';
$share['gplus'] = '<a class="fa fa-google-plus" href="javascript:void(0);" data-url="https://plus.google.com/share?url='.urlencode( get_permalink() ).'"></a>';
$pin_img = has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) : '';
$pin_img = isset( $pin_img[0] ) ? $pin_img[0] : '';
$share['pinterest'] = '<a class="fa fa-pinterest" href="javascript:void(0);" data-url="http://pinterest.com/pin/create/button/?url='.urlencode( get_permalink() ).'&amp;media='.urlencode( $pin_img ).'&amp;description='.urlencode( esc_attr( get_the_title() ) ).'"></a>';
$share['linkedin'] = '<a class="fa fa-linkedin" href="javascript:void(0);" data-url="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode( get_permalink() ).'&amp;title='.urlencode( esc_attr( get_the_title() ) ).'"></a>';
$share['whatsapp'] = '<a class="fa fa-whatsapp no-popup" href="whatsapp://send?text='.urlencode(esc_url( get_permalink() )).'"></a>';

if ( is_page() ) {
	$share_options = vce_get_option( 'page_social_share' );
} else {
	$share_options = vce_get_option( 'social_share' );
}

$vce_share_html = '';

foreach ( $share_options as $social => $value ) {
	if ( $value ) {
		$vce_share_html .= '<li>'.$share[$social].'</li>';
	}
}
?>

<?php if ( $vce_share_html ): ?>
	<div class="vce-share-bar">
		<ul class="vce-share-items">
			<?php echo $vce_share_html; ?>
		</ul>
	</div>
<?php endif; ?>