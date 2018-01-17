<?php

add_action( 'init', 'custom_buttons' );
function custom_buttons() {
    add_filter( "mce_external_plugins", "custom_add_buttons" );
    add_filter( 'mce_buttons', 'custom_register_buttons' );
}
function custom_add_buttons( $plugin_array ) {
    $plugin_array['custom'] = get_stylesheet_directory_uri() . '/tinymce-editor-buttons/custom-plugin.js';
    return $plugin_array;
}
function custom_register_buttons( $buttons ) {
    array_push( $buttons, 'drog', 'smoke', 'suicide', 'wine'); 
    return $buttons;
}