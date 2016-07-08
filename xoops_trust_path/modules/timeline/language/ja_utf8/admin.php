<?php
// $Id: admin.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

// === define begin ===
if( !defined("_AM_TIMELINE_LANG_LOADED") ) 
{

define("_AM_TIMELINE_LANG_LOADED" , 1 ) ;

// menu
define("_AM_TIMELINE_MYMENU_TPLSADMIN","テンプレート管理");
define("_AM_TIMELINE_MYMENU_BLOCKSADMIN","ブロック管理/アクセス権限");
define("_AM_TIMELINE_MYMENU_GOTO_MODULE" , "モジュールへ" ) ;

// index
define("_AM_TIMELINE_CHK_SERVER" , "サーバー環境" ) ;
define("_AM_TIMELINE_CHK_PHP" , "PHP設定" ) ;
define("_AM_TIMELINE_CHK_DIR" , "ディレクトリ設定" ) ;
define("_AM_TIMELINE_CHK_BOTH_OK" , "両方 ok" ) ;
define("_AM_TIMELINE_CHK_NEED_ON" , "要 on" ) ;

// === define end ===
}

?>