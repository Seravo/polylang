<?php

// template tag: displays the language switcher
function pll_the_languages($args = '') {
	global $polylang;
	return isset($polylang) ? $polylang->the_languages($args) : '';
}

// returns the current language
function pll_current_language($args = 'slug') {
	global $polylang;
	return isset($polylang) ? $polylang->current_language($args) : false;
}

// among the post and its translations, returns the id of the post which is in the language represented by $slug
function pll_get_post($post_id, $slug = false) {
	global $polylang;
	$slug = $slug ? $slug : pll_current_language();
	return isset($polylang) && $slug ? $polylang->get_post($post_id, $slug) : null;
}

// among the term and its translations, returns the id of the term which is in the language represented by $slug
function pll_get_term($term_id, $slug = false) {
	global $polylang;
	$slug = $slug ? $slug : pll_current_language();
	return isset($polylang) && $slug ? $polylang->get_term($term_id, $slug) : null;
}

// returns the home url in the right language
function pll_home_url() {
	global $polylang;
	return isset($polylang) ? $polylang->get_home_url() : home_url('/');
}

// register strings for translation in the "strings translation" panel
function pll_register_string($name, $string, $multiline = false) {
	global $polylang;
	if (isset($polylang) && is_admin())
		$polylang->register_string($name, $string, $multiline);
}

// translates string (previously registered with pll_register_string)
function pll__($string) {
	return __($string, 'pll_string');
}

// echoes translated string (previously registered with pll_register_string)
function pll_e($string) {
	_e($string, 'pll_string');
}

// compatibility with WPML API
if (!function_exists('icl_get_home_url')) {
	function icl_get_home_url() {
		return pll_home_url();
	}
}

if (!function_exists('icl_register_string')) {
	function icl_register_string($context, $name, $string) {
		pll_register_string($name, $string);
	}
}

if (!function_exists('icl_t')) {
	function icl_t($context, $name, $string) {
		return pll__($string);
	}
}

?>
