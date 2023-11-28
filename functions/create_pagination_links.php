<?php

function create_pagination_links($wpquery) {

	$paged = (get_query_var( 'page' )) ? get_query_var( 'page' ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );
	$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

	$pagination_args = array(
		'base' =>  $pagenum_link,
		'format'    => '?page=%#%',
		'total'     => $wpquery->max_num_pages,
		'current'   => $paged,
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
	);

	return paginate_links($pagination_args);

}
