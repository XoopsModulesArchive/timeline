<?php
// $Id: language.php,v 1.1.1.1 2009/03/19 14:41:43 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_compo_d3_language
//=========================================================
class timeline_compo_d3_language extends timeline_base_d3_language
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_compo_d3_language( $dirname )
{
	$this->timeline_base_d3_language( $dirname, TIMELINE_TRUST_DIRNAME );
	$this->get_lang_array();
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new timeline_compo_d3_language( $dirname );
	}
	return $singletons[ $dirname ];
}

//----- class end -----
}

?>