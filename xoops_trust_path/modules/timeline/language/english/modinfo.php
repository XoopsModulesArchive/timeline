<?php
// $Id: modinfo.php,v 1.1.1.1 2009/03/19 14:41:41 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

// test
if ( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) {
	$MY_DIRNAME = 'timeline' ;

// normal
} elseif (  isset($GLOBALS['MY_DIRNAME']) ) {
	$MY_DIRNAME = $GLOBALS['MY_DIRNAME'];

// call by altsys/mytplsadmin.php
} elseif ( $mydirname ) {
	$MY_DIRNAME = $mydirname;

// probably error
} else {
	echo "not set dirname in ". __FILE__ ." <br />\n";
	$MY_DIRNAME = 'timeline' ;
}

$constpref = strtoupper( '_MI_' . $MY_DIRNAME. '_' ) ;

// === define begin ===
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref."LANG_LOADED") ) 
{

define($constpref."LANG_LOADED" , 1 ) ;

// module name
define($constpref."NAME","Timeline");
define($constpref."DESC","Show timeline using MIT Timeline");

// menu
define($constpref."ADMENU_INDEX","Index");

}
// === define begin ===

?>