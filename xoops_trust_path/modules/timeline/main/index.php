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
timeline_include_once( 'include/api_timeline.php' );
timeline_include_once( 'class/base/xoops/param.php' );
timeline_include_once( 'class/view/timeline.php' );
timeline_include_once( 'class/main/index.php' );

timeline_include_language( 'modinfo.php' );
timeline_include_language( 'main.php' );

timeline_include_once_preload_trust();
timeline_include_once_preload();

//=========================================================
// main
//=========================================================
$manage =& timeline_main_index::getInstance( TIMELINE_DIRNAME );

$xoopsOption['template_main'] = TIMELINE_DIRNAME.'_main_index.html' ;
include XOOPS_ROOT_PATH . "/header.php" ;

$xoopsTpl->assign( $manage->main() ) ;

include( XOOPS_ROOT_PATH . "/footer.php" ) ;

?>