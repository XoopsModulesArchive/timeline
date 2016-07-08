<?php
// $Id: constants.php,v 1.5 2011/12/27 08:09:39 ohwada Exp $

//=========================================================
// webphoto module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

// === define begin ===
if( !defined("_C_TIMELINE_LOADED") ) 
{

define("_C_TIMELINE_LOADED", 1 ) ;

//=========================================================
// Constant
//=========================================================

// simile-ajax-bundle.js
// SimileAjax.DateTime.MILLISECOND=0;
// SimileAjax.DateTime.SECOND=1;
// SimileAjax.DateTime.MINUTE=2;
// SimileAjax.DateTime.HOUR=3;
// SimileAjax.DateTime.DAY=4;
// SimileAjax.DateTime.WEEK=5;
// SimileAjax.DateTime.MONTH=6;
// SimileAjax.DateTime.YEAR=7;
// SimileAjax.DateTime.DECADE=8;
// SimileAjax.DateTime.CENTURY=9;
// SimileAjax.DateTime.MILLENNIUM=10;
// SimileAjax.DateTime.EPOCH=-1;
// SimileAjax.DateTime.ERA=-2;

define("_C_TIMELINE_UNIT_MILLISECOND",  0) ;
define("_C_TIMELINE_UNIT_SECOND",       1) ;
define("_C_TIMELINE_UNIT_MINUTE",       2) ;
define("_C_TIMELINE_UNIT_HOUR",         3) ;
define("_C_TIMELINE_UNIT_DAY",          4) ;
define("_C_TIMELINE_UNIT_WEEK",         5) ;
define("_C_TIMELINE_UNIT_MONTH",        6) ;
define("_C_TIMELINE_UNIT_YEAR",         7) ;
define("_C_TIMELINE_UNIT_DECADE",       8) ;
define("_C_TIMELINE_UNIT_CENTURY",      9) ;
define("_C_TIMELINE_UNIT_MILLENNIUM",  10) ;
define("_C_TIMELINE_UNIT_EPOCH",       -1) ;
define("_C_TIMELINE_UNIT_ERA",         -2) ;

// width 600 px
// 1:60
define("_C_TIMELINE_PIXELS_HOUR_MINUTE",           10) ;
define("_C_TIMELINE_PIXELS_HOUR_HOUR",             30) ;
// 1:24
define("_C_TIMELINE_PIXELS_DAY_HOUR",              30) ;
define("_C_TIMELINE_PIXELS_DAY_DAY",               80) ;
// 1:30
define("_C_TIMELINE_PIXELS_WEEK_DAY",              80) ;
define("_C_TIMELINE_PIXELS_WEEK_MONTH",           100) ;
// 1:4
define("_C_TIMELINE_PIXELS_MONTH_WEEK",           120) ;
define("_C_TIMELINE_PIXELS_MONTH_MONTH",           50) ;
// 1:12
define("_C_TIMELINE_PIXELS_YEAR_MONTH",            50) ;
define("_C_TIMELINE_PIXELS_YEAR_YEAR",             60) ;
// 1:10
define("_C_TIMELINE_PIXELS_DECADE_YEAR",           60) ;
define("_C_TIMELINE_PIXELS_DECADE_DECADE",         60) ;
// 1:10
define("_C_TIMELINE_PIXELS_CENTURY_DECADE",        60) ;
define("_C_TIMELINE_PIXELS_CENTURY_CENTURY",       60) ;
// 1:10
define("_C_TIMELINE_PIXELS_MILLENNIUM_CENTURY",    60) ;
define("_C_TIMELINE_PIXELS_MILLENNIUM_MILLENNIUM", 60) ;

// sample
define("_C_TIMELINE_SAMPLE_URL_SIMPLE_XML", "http://code.google.com/p/simile-widgets/wiki/Timeline_GettingStarted") ;
define("_C_TIMELINE_SAMPLE_URL_PAINTER_JSON", "http://www.simile-widgets.org/timeline/examples/compact-painter/compact-painter.html") ;
define("_C_TIMELINE_SAMPLE_URL_MONET_XML", "http://www.simile-widgets.org/timeline/examples/monet/monet.html") ;

define("_C_TIMELINE_BAND_1_SYNCWITH", "0" ) ;
define("_C_TIMELINE_BAND_1_HIGHLIGHT", "true" ) ;

define("_C_TIMELINE_SIMPLE_XML_BAND_DATE", "Jun 28 2006 00:00:00 GMT") ;
define("_C_TIMELINE_SIMPLE_XML_BAND_0_WIDTH",  "70%" ) ;
define("_C_TIMELINE_SIMPLE_XML_BAND_1_WIDTH",  "30%" ) ;
define("_C_TIMELINE_SIMPLE_XML_BAND_0_PIXELS", "100" ) ;
define("_C_TIMELINE_SIMPLE_XML_BAND_1_PIXELS", "200" ) ;
define("_C_TIMELINE_SIMPLE_XML_BAND_0_UNIT", _C_TIMELINE_UNIT_MONTH ) ;
define("_C_TIMELINE_SIMPLE_XML_BAND_1_UNIT", _C_TIMELINE_UNIT_YEAR ) ;

define("_C_TIMELINE_SIMPLE_EVENTS_BAND_DATE", "Jun 28 2006 00:00:00 GMT") ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_0_WIDTH",  "70%" ) ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_1_WIDTH",  "30%" ) ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_0_PIXELS", "100" ) ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_1_PIXELS", "200" ) ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_0_UNIT", _C_TIMELINE_UNIT_MONTH ) ;
define("_C_TIMELINE_SIMPLE_EVENTS_BAND_1_UNIT", _C_TIMELINE_UNIT_YEAR ) ;

define("_C_TIMELINE_PAINTER_JSON_BAND_DATE", "Jun 10 2001 00:00:00 GMT") ;
define("_C_TIMELINE_PAINTER_JSON_BAND_0_WIDTH",  "93%" ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_1_WIDTH",  "7%" ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_0_PIXELS", "150" ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_1_PIXELS", "100" ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_0_UNIT", _C_TIMELINE_UNIT_WEEK ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_1_UNIT", _C_TIMELINE_UNIT_MONTH ) ;
define("_C_TIMELINE_PAINTER_JSON_BAND_1_LAYOUT", "overview" ) ;

define("_C_TIMELINE_PAINTER_EVENTS_BAND_DATE", "Jun 10 2001 00:00:00 GMT") ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_0_WIDTH",  "93%" ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_1_WIDTH",  "7%" ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_0_PIXELS", _C_TIMELINE_PIXELS_MONTH_WEEK ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_1_PIXELS", _C_TIMELINE_PIXELS_MONTH_MONTH ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_0_UNIT", _C_TIMELINE_UNIT_WEEK ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_1_UNIT", _C_TIMELINE_UNIT_MONTH ) ;
define("_C_TIMELINE_PAINTER_EVENTS_BAND_1_LAYOUT", "overview" ) ;

define("_C_TIMELINE_MONET_XML_BAND_YEAR",     "1850") ;
define("_C_TIMELINE_MONET_XML_BAND_0_PIXELS", "200" ) ;
define("_C_TIMELINE_MONET_XML_BAND_1_PIXELS", "200" ) ;

define("_C_TIMELINE_MONET_EVENTS_BAND_YEAR",     "1850") ;
define("_C_TIMELINE_MONET_EVENTS_BAND_0_PIXELS", "200" ) ;
define("_C_TIMELINE_MONET_EVENTS_BAND_1_PIXELS", "200" ) ;

// === define end ===
}

?>