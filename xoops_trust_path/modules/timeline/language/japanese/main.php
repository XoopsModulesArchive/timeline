<?php
// $Id: main.php,v 1.4 2011/12/28 15:57:34 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

// === define begin ===
if( !defined("_MB_TIMELINE_LANG_LOADED") ) 
{

define("_MB_TIMELINE_LANG_LOADED" , 1 ) ;

// index
define("_TIMELINE_TITLE_TIMELINE", "タイムラインの表示");
define("_TIMELINE_TITLE_SIMPLE_XML",     "Simple XML");
define("_TIMELINE_TITLE_SIMPLE_EVENTS",  "Simple Eventes");
define("_TIMELINE_TITLE_PAINTER_JSON",   "Painter JSON");
define("_TIMELINE_TITLE_PAINTER_EVENTS", "Painter Eventes");
define("_TIMELINE_JS_INVALID", "貴方のブラウザでは JavaScript が使用できません");
define("_TIMELINE_CAUTION_IE", "InternetExpolar では表示できないことがあります。<br />Firfox, Opera, Safari など他のブラウザにてお試しください。");

//---------------------------------------------------------
// v0.20
//---------------------------------------------------------
// index
define("_TIMELINE_TITLE_MONET_XML",      "Monet XML");
define("_TIMELINE_TITLE_MONET_EVENTS",   "Monet Eventes");

// scale
define("_TIMELINE_UNIT_MILLISECOND" , "１ミリ秒" ) ;
define("_TIMELINE_UNIT_SECOND" ,      "１秒" ) ;
define("_TIMELINE_UNIT_MINUTE" ,      "１分" ) ;
define("_TIMELINE_UNIT_HOUR" ,        "１時間" ) ;
define("_TIMELINE_UNIT_DAY" ,         "１日" ) ;
define("_TIMELINE_UNIT_WEEK",         "１週間") ;
define("_TIMELINE_UNIT_MONTH",        "１ヶ月") ;
define("_TIMELINE_UNIT_YEAR",         "１年") ;
define("_TIMELINE_UNIT_DECADE",       "１０年") ;
define("_TIMELINE_UNIT_CENTURY" ,     "１世紀" ) ;
define("_TIMELINE_UNIT_MILLENNIUM" ,  "１０世紀" ) ;

// === define end ===
}

?>