<?php
// $Id: index.php,v 1.1.1.1 2009/03/19 14:41:42 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_admin_index
//=========================================================
class timeline_admin_index extends timeline_base_admin_base
{
	var $_check_class;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_admin_index( $dirname )
{
	$this->timeline_base_admin_base( $dirname, TIMELINE_TRUST_DIRNAME );

	$this->_check_class = new timeline_base_admin_server_check( $dirname, TIMELINE_TRUST_DIRNAME );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new timeline_admin_index( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function main()
{
	xoops_cp_header();

	echo $this->build_admin_menu();
	echo $this->build_admin_title( 'INDEX' );
	echo _MI_TIMELINE_DESC;
	echo "<br /><br />\n";

	echo "<h4>". _AM_TIMELINE_CHK_SERVER ."</h4>\n" ;
	echo $this->_check_class->build_server();

	echo "<h4>". _AM_TIMELINE_CHK_PHP ."</h4>\n";
	echo $this->_check_class->build_php_secure();
	echo $this->_check_class->build_php_upload();
	echo $this->_check_class->build_php_etc();
	echo $this->_check_class->build_php_iconv();
	echo "<br />\n";

	echo "<b>mbstring</b><br />\n" ;
	echo $this->_check_class->build_php_mbstring();
	echo "<br />\n";

?>
<hr />
<div style="text-align: right; font-size: 80%;">
<a href="http://linux2.ohwada.net/" target="_blank">
Powered by Happy Linux
</a><br />
&copy; 2009, Kenichi OHWADA<br />
</div>
<?php

	xoops_cp_footer();
	exit();
}

//---------------------------------------------------------
// admin_menu
//---------------------------------------------------------
function build_admin_menu()
{
	$timeline_base_class =  new timeline_base_admin_menu( $this->_DIRNAME , $this->_TRUST_DIRNAME );
	$timeline_class  =& timeline_inc_admin_menu::getSingleton( $this->_DIRNAME );

	$timeline_base_class->set_main_menu( $timeline_class->build_main_menu() );
	$menu = $timeline_base_class->build_menu_with_sub();
	return $menu ;
}

// --- class end ---
}

?>