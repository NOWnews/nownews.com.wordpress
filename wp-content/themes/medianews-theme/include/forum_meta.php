<?php

add_action( 'add_meta_boxes', 'px_meta_forum_add' );
function px_meta_forum_add()
{  
	add_meta_box( 'px_meta_forum', 'Forum Layout Options', 'px_meta_forum', 'forum', 'normal', 'low' );
	add_meta_box( 'px_meta_forum', 'Topics Layout Options', 'px_meta_forum', 'topic', 'normal', 'low' );
	
}

function px_meta_forum( $post ) {
	$post_xml = get_post_meta($post->ID, "forum_meta", true);
	global $px_xmlObject;
	if ( $post_xml <> "" ) {
		$px_xmlObject = new SimpleXMLElement($post_xml);
		$sub_title = $px_xmlObject->sub_title;
	}else{
		$sub_title = "";
	}
	?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/select.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/prettyCheckable.js"></script>
	<div class="page-wrap">
        <div class="option-sec row">
            <div class="opt-conts">
            	<!--<ul class="form-elements" style="display:none;">
                    <li class="to-label"><label>Sub Title</label></li>
                    <li class="to-field">
                    	<input type="text" name="sub_title" value="<?php //echo $sub_title ?>" />
                        <p>Put the sub title.</p>
                    </li>
                </ul>-->
			</div>
		</div>
		<div class="clear"></div>
		<?php meta_layout()?>
        <input type="hidden" name="post_forum_meta_form" value="1" />
    </div>
    <?php
}

	if ( isset($_POST['post_forum_meta_form']) and $_POST['post_forum_meta_form'] == 1 ) {
		add_action( 'save_post', 'px_meta_forum_post_save' );
		function px_meta_forum_post_save( $post_id ) {
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
				
					$sxe = new SimpleXMLElement("<px_meta_forum></px_meta_forum>");
						$sxe = save_layout_xml($sxe);
						
			update_post_meta( $post_id, 'forum_meta', $sxe->asXML() );
		}
	}


?>