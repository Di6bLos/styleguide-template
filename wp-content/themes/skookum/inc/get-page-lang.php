<?php
/**
 * Function: get_page_lang
 * 
 * Description: This function retrieves the language directory from the current page's permalink.
 * 
 * @package skookum
 */

function get_page_lang() {

	$slug = explode( '/', get_permalink() );
	$dir = isset( $slug[3] ) ? $slug[3] : '';

	return $dir;
}
