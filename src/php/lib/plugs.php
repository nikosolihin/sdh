<?php
//=============================================
// Radio Button for Taxonomies
//=============================================
// Disable the "No term" option on a the "resource_type" taxonomy
add_filter( "radio-buttons-for-taxonomies-no-term-campus", "__return_FALSE" );

//==========================================================
// Admin Columns Pro
// Use the following code so column settings
// apply to multisites
//
// Uncoment the action before pushing to prod
// Use the GUI on dev since if using php GUI is disabled
//==========================================================
