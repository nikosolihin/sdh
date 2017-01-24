<?php
// add_action( 'admin_head', 'custom_wordings' );
function custom_wordings(){
  if ( $GLOBALS['pagenow'] != 'upload.php' ){
    return;
  }
  $GLOBALS['title'] =  __( 'File Library' );
}
