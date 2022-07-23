<?php
if (!defined('ABSPATH')) {
	exit;
}

function my_pagenate()
{
	global $wp_query;
	$bignum = 999999999;
	if ($wp_query->max_num_pages <= 1) {
		return;
	}
	echo '<nav class="pagination block-child">';
	echo paginate_links(
		array(
			'base'      => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
			'format'    => '',
			'current'   => max(1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '<span class="link-arrow link-arrow--sm link-arrow--back"></span>',
			'next_text' => '<span class="link-arrow link-arrow--sm"></span>',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3,
		)
	);
	echo '</nav>';
}
