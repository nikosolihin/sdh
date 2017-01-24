<?php
// Load Gravity Forms JS in the footer...really? Sheesh.
// https://bjornjohansen.no/load-gravity-forms-js-in-footer

function nl_wrap_gform_cdata_open( $content = '' ) {
  $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
  return $content;
}
add_filter( 'gform_cdata_open', 'nl_wrap_gform_cdata_open' );

function nl_wrap_gform_cdata_close( $content = '' ) {
  $content = ' }, false );';
  return $content;
}
add_filter( 'gform_cdata_close', 'nl_wrap_gform_cdata_close' );
