<?php

// Reset the allowed filetypes
// Only allow non-image files to be uploaded
// Full list here:
//https://codex.wordpress.org/Function_Reference/get_allowed_mime_types#Default_allowed_mime_types

function custom_myme_types($mime_types){
  $mime_types = array(
    'csv'                          => 'text/csv',
    'rtf'                          => 'application/rtf',
  	'pdf'                          => 'application/pdf',
  	'zip'                          => 'application/zip',
    'doc'                          => 'application/msword',
    'docx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  	'pot|pps|ppt'                  => 'application/vnd.ms-powerpoint',
    'pptx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
  	'xla|xls|xlt|xlw'              => 'application/vnd.ms-excel',
    'xlsx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  );
  return $mime_types;
}
add_filter('upload_mimes', 'custom_myme_types', 1, 1);
