<?php
// $Id: main.php,v 1.4 2011/12/28 15:57:34 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// change log
// 2011-12-25 K.OHWADA
// _TIMELINE_TITLE_MONET_XML
//---------------------------------------------------------

// === define begin ===
if( !defined("_MB_TIMELINE_LANG_LOADED") ) 
{

define("_MB_TIMELINE_LANG_LOADED" , 1 ) ;

// index
define("_TIMELINE_TITLE_TIMELINE", "Show Timeline");
define("_TIMELINE_TITLE_SIMPLE_XML",     "Simple XML");
define("_TIMELINE_TITLE_SIMPLE_EVENTS",  "Simple Eventes");
define("_TIMELINE_TITLE_PAINTER_JSON",   "Painter JSON");
define("_TIMELINE_TITLE_PAINTER_EVENTS", "Painter Eventes");
define("_TIMELINE_TITLE_MONET_XML",      "Monet XML");
define("_TIMELINE_TITLE_MONET_EVENTS",   "Monet Eventes");
define("_TIMELINE_JS_INVALID", "Your browser cannot use JavaScript");
define("_TIMELINE_CAUTION_IE", "In InternetExpolar, you cannot see it sometimes.<br />Please try in other browsers such as Firfox, Opera, Safari.");

//---------------------------------------------------------
// v0.20
//---------------------------------------------------------
// index
define("_TIMELINE_TITLE_MONET_XML",      "Monet XML");
define("_TIMELINE_TITLE_MONET_EVENTS",   "Monet Eventes");

// scale
define("_TIMELINE_UNIT_MILLISECOND" , "Millisecond" ) ;
define("_TIMELINE_UNIT_SECOND" ,      "Second" ) ;
define("_TIMELINE_UNIT_MINUTE" ,      "Minute" ) ;
define("_TIMELINE_UNIT_HOUR" ,        "Hour" ) ;
define("_TIMELINE_UNIT_DAY" ,         "Day" ) ;
define("_TIMELINE_UNIT_WEEK",         "Week") ;
define("_TIMELINE_UNIT_MONTH",        "Month") ;
define("_TIMELINE_UNIT_YEAR",         "Year") ;
define("_TIMELINE_UNIT_DECADE",       "Decade") ;
define("_TIMELINE_UNIT_CENTURY" ,     "Century" ) ;
define("_TIMELINE_UNIT_MILLENNIUM" ,  "Millennium" ) ;

// === define end ===
}

?>