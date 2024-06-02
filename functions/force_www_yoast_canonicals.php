<?php

add_filter('wpseo_canonical', 'force_www_in_canonical');

function force_www_in_canonical($url) {
    // Check if the URL already starts with www
    if (strpos($url, '://www.') === false) {
        $url = preg_replace('/(https?:\/\/)(.*)/i', '$1www.$2', $url);
    }
    return $url;
}