<?php
add_filter('wpseo_breadcrumb_links', 'force_www_in_breadcrumb_links');

function force_www_in_breadcrumb_links($links) {
    foreach ($links as &$link) {
        $link['url'] = force_www($link['url']);
    }
    return $links;
}

function force_www($url) {
    // Check if the URL already starts with www
    if (strpos($url, '://www.') === false) {
        $url = preg_replace('/(https?:\/\/)(.*)/i', '$1www.$2', $url);
    }
    return $url;
}