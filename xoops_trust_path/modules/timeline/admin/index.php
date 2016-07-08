<?php
// $Id: index.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// timeline files
//---------------------------------------------------------
timeline_include_once( 'include/constants.php' );

timeline_include_once( 'class/base/xoops/param.php' );
timeline_include_once( 'class/base/d3/language.php' );
timeline_include_once( 'class/base/inc/admin_menu.php' );
timeline_include_once( 'class/base/lib/server_info.php' );
timeline_include_once( 'class/base/admin/base.php' );
timeline_include_once( 'class/base/admin/menu.php' );
timeline_include_once( 'class/base/admin/server_check.php' );

timeline_include_once( 'class/inc/admin_menu.php' );
timeline_include_once( 'class/compo/d3/language.php' );
timeline_include_once( 'class/admin/index.php' );

timeline_include_language( 'modinfo.php' );
timeline_include_language( 'main.php' );
timeline_include_language( 'admin.php' );

timeline_include_once_preload_trust();
timeline_include_once_preload();

//=========================================================
// main
//=========================================================
$manager =& timeline_admin_index::getInstance( TIMELINE_DIRNAME );
$manager->main();
exit();

?>