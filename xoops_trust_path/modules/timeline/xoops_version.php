<?php
// $Id: xoops_version.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// $MY_DIRNAME is set by caller
//---------------------------------------------------------

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//---------------------------------------------------------
// timeline files
//---------------------------------------------------------
include_once XOOPS_TRUST_PATH.'/modules/timeline/init.php';

timeline_include_once( 'preload/debug.php',                  $MY_DIRNAME );
timeline_include_once( 'include/constants.php',              $MY_DIRNAME );
timeline_include_once( 'include/version.php',                $MY_DIRNAME );
timeline_include_once( 'class/base/lib/handler_basic.php',   $MY_DIRNAME );
timeline_include_once( 'class/base/xoops/config_modify.php', $MY_DIRNAME );
timeline_include_once( 'class/base/inc/xoops_version.php',   $MY_DIRNAME );
timeline_include_once( 'class/inc/xoops_version.php',        $MY_DIRNAME );
timeline_include_language( 'modinfo.php',                    $MY_DIRNAME );

//---------------------------------------------------------
// main
//---------------------------------------------------------
$timeline_inc_xoops_version =& timeline_inc_xoops_version::getSingleton( $MY_DIRNAME );
$modversion = $timeline_inc_xoops_version->modversion();

?>