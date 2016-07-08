<?php
// $Id: oninstall.php,v 1.2 2011/12/26 06:43:20 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

//---------------------------------------------------------
// change log
// 2011-12-25 K.OHWADA
// Assigning the return value of new by reference is now deprecated.
//---------------------------------------------------------

if ( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_inc_oninstall
//=========================================================
class timeline_base_inc_oninstall extends timeline_base_lib_handler_basic
{
	var $_IS_XOOPS_2018 = false;

	var $_msg_array = array();

	var $_DIRNAME       = null ;
	var $_MODULE_URL    = null ;
	var $_MODULE_DIR    = null;
	var $_TRUST_DIRNAME = null;
	var $_TRUST_DIR     = null;
	var $_MODULE_MID    = 0;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_inc_oninstall()
{
	$this->timeline_base_lib_handler_basic();
}

function set_trust_dirname( $trust_dirname )
{
	$this->_TRUST_DIRNAME = $trust_dirname ;
	$this->_TRUST_DIR     = XOOPS_TRUST_PATH.'/modules/'. $trust_dirname ;

// preload
	$name = "_C_". $trust_dirname. "_PRELOAD_XOOPS_2018";

	if ( defined($name) ) {
		$this->_IS_XOOPS_2018 = (bool) constant( $name ) ;
	}
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function install( &$module )
{
	global $ret ; // TODO :-D

	if ( ! is_array( $ret ) ) {
		$ret = array() ;
	}

	$this->init( $module );
	$ret_code = $this->exec_install();

	$msg_arr = $this->get_msg_array();
	if ( is_array($msg_arr) && count($msg_arr) ) {
		foreach ( $msg_arr as $msg ) {
			$ret[] = $msg."<br />\n";
		}
	}

	return $ret_code;
}

function update( &$module )
{
	global $msgs ; // TODO :-D

	if ( ! is_array( $msgs ) ) {
		$msgs = array() ;
	}

	$this->init( $module );
	$ret_code = $this->exec_update();

	$msg_arr = $this->get_msg_array();
	if ( is_array($msg_arr) && count($msg_arr) ) {
		foreach ( $msg_arr as $msg ) {
			$msgs[] = $msg;
		}
	}

	return $ret_code;
}

function uninstall( &$module )
{
	global $ret ; // TODO :-D

	if ( ! is_array( $ret ) ) {
		$ret = array() ;
	}

	$this->init( $module );
	$ret_code = $this->exec_uninstall();

	$msg_arr = $this->get_msg_array();
	if ( is_array($msg_arr) && count($msg_arr) ) {
		foreach ( $msg_arr as $msg ) {
			$ret[] = $msg."<br />";
		}
	}

	return $ret_code;
}

//---------------------------------------------------------
// private
//---------------------------------------------------------
function init( &$module )
{
	$dirname           = $module->getVar( 'dirname', 'n' );
	$this->_MODULE_MID = $module->getVar( 'mid',     'n' );

	$this->_DIRNAME       = $dirname;
	$this->_MODULE_URL    = XOOPS_URL       .'/modules/'.$dirname;
	$this->_MODULE_DIR    = XOOPS_ROOT_PATH .'/modules/'.$dirname;
}

function exec_install()
{
	// for Cube 2.1
	if ( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		$name = 'Legacy.Admin.Event.ModuleInstall.' . ucfirst($this->_DIRNAME) . '.Success';
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( $name, 'timeline_base_message_append_oninstall' ) ;
	}

	$this->set_msg( "\n Install module extention ..." );

	$res = $this->table_install();
	if ( ! $res ) { return false; }

	$this->template_install();

	return true ;
}

function exec_update()
{
	// for Cube 2.1
	if ( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		$name = 'Legacy.Admin.Event.ModuleUpdate.' . ucfirst($this->_DIRNAME) . '.Success';
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( $name, 'timeline_base_message_append_onupdate' ) ;
	}

	$this->set_msg( "\n Update module extention ..." );

	$this->table_update();
	$this->template_update();

	return true ;
}

function exec_uninstall()
{
	// for Cube 2.1
	if ( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		$name = 'Legacy.Admin.Event.ModuleUninstall.' . ucfirst($this->_DIRNAME) . '.Success';
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( $name , 'timeline_base_message_append_onuninstall' ) ;
	}

	$this->set_msg( "\n Uninstall module extention ..." );

	$this->table_uninstall();
	$this->template_uninstall();

	return true ;
}

//---------------------------------------------------------
// table handler
//---------------------------------------------------------
function table_install()
{
	$sql_file_path = $this->get_table_sql();
	if ( ! $sql_file_path ) { return true; }	// no action

	$prefix_mod = $this->_db->prefix() . '_' . $this->_DIRNAME ;
	$this->set_msg( "SQL file found at <b>". $this->sanitize($sql_file_path) ."</b>" );
	$this->set_msg( "Creating tables..." );

	if( file_exists( XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ;
		$sqlutil = new OldSqlUtility() ;
	} else {
		include_once XOOPS_ROOT_PATH.'/class/database/sqlutility.php' ;
		$sqlutil = new SqlUtility() ;
	}

	$sql_query = trim( file_get_contents( $sql_file_path ) ) ;
	$sqlutil->splitMySqlFile( $pieces , $sql_query ) ;
	if ( !is_array( $pieces ) || !count( $pieces ) ) { return true; } 	// no action

	foreach ( $pieces as $piece ) 
	{
		$prefixed_query = $sqlutil->prefixQuery( $piece , $prefix_mod ) ;
		if( ! $prefixed_query ) {
			$this->set_msg( "Invalid SQL <b>". $this->sanitize($piece) ."</b>" );
			return false ;
		}

// replace reserved words
		$sql = str_replace( '{DIRNAME}', $this->_DIRNAME, $prefixed_query[0] );

		$ret = $this->query( $sql );
		if ( ! $ret ) {
			$this->set_msg( $this->get_db_error() ) ;
			return false ;
		}

		$table = $prefixed_query[4];
		$table_name_s = $this->sanitize( $prefix_mod. '_'. $table );

		if ( $this->parse_create_table( $sql ) ) {
			$this->set_msg( 'Table <b>'.  $table_name_s .'</b> created' );

		} else {
			$this->set_msg( 'Data inserted to table <b>'. $table_name_s .'</b>' );
		}

	}

	return true;
}

function table_update()
{
	$sql_file_path = $this->get_table_sql();
	if ( ! $sql_file_path ) {
		return true;	// no action
	}

	$prefix_mod = $this->_db->prefix() . '_' . $this->_DIRNAME ;

	if( file_exists( XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ) ) {
		include_once XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ;
		$sqlutil = new OldSqlUtility() ;
	} else {
		include_once XOOPS_ROOT_PATH.'/class/database/sqlutility.php' ;
		$sqlutil = new SqlUtility() ;
	}

	$sql_query = trim( file_get_contents( $sql_file_path ) ) ;
	$sqlutil->splitMySqlFile( $pieces , $sql_query ) ;
	if ( !is_array( $pieces ) || !count( $pieces ) ) { 
		return true;  	// no action
	}

	$sql_array = array() ;

// get added table
	foreach ( $pieces as $piece ) 
	{
		$prefixed_query = $sqlutil->prefixQuery( $piece , $prefix_mod ) ;
		if( ! $prefixed_query ) {
			$this->set_msg( "Invalid SQL <b>". $this->sanitize($piece) ."</b>" );
			return false ;
		}

		$sql = $prefixed_query[0];

// get create table
		$table = $this->parse_create_table( $sql );
		if ( empty($table) ) {
			continue;
		}

// already exists
		if ( $this->exists_table( $table ) ) {
			continue;
		}

		$sql_array[ $table ] = $sql ;
	}

	if ( !is_array( $sql_array ) || !count( $sql_array ) ) { 
		return true;  	// no action
	}

	$this->set_msg( "SQL file found at <b>". $this->sanitize($sql_file_path) ."</b>" );
	$this->set_msg( "Creating tables..." );

// create added table
	foreach ( $sql_array as $table => $sql ) 
	{
		$ret = $this->query( $sql );
		if ( ! $ret ) {
			$this->set_msg( $this->get_db_error() ) ;
			return false ;
		}

		$table_name_s = $this->sanitize( $table );
		$this->set_msg( 'Table <b>'.  $table_name_s .'</b> created' );
	}

	return true;
}

function table_uninstall()
{
	$sql_file_path = $this->get_table_sql();
	if ( ! $sql_file_path ) { return true; }	// no action

	$prefix_mod = $this->_db->prefix() . '_' . $this->_DIRNAME ;

	$this->set_msg( "SQL file found at <b>".$this->sanitize($sql_file_path)."</b>" );
	$this->set_msg( "Deleting tables..." );

	$sql_lines = file( $sql_file_path ) ;

	foreach ( $sql_lines as $sql_line ) 
	{
	// get create table
		$table = $this->parse_create_table( $sql_line );
		if ( empty($table) ) {
			continue;
		}

// BUG : undefined variable table_name
		$table_name = $prefix_mod. '_'. $table ;

		$table_name_s = $this->sanitize( $table_name );
		$sql = 'DROP TABLE '. $table_name ;

		$ret = $this->query($sql) ;
		if ( $ret ) {
			$this->set_msg( 'Table <b>'. $table_name_s .'</b> dropped' );
		} else {
			$this->set_msg( $this->highlight( 'ERROR: Could not drop table <b>'. $table_name_s .'<b>.' ) );
			$this->set_msg( $this->get_db_error() ) ;
		}
	}

	return true;
}

function get_table_sql()
{
	$sql_trust_path = $this->_TRUST_DIR  .'/sql/mysql.sql' ;
	$sql_root_path  = $this->_MODULE_DIR .'/sql/mysql.sql' ;

	if ( is_file( $sql_root_path ) ) {
		return $sql_root_path;
	} elseif( is_file( $sql_trust_path ) ) {
		return $sql_trust_path;
	}
	return false;
}

function parse_create_table( $sql )
{
	if ( preg_match( '/^CREATE TABLE \`?([a-zA-Z0-9_-]+)\`? /i' , $sql, $match ) ) {
		return $match[1];
	}
	return false;
}

//---------------------------------------------------------
// template handler
//---------------------------------------------------------
function template_install()
{
	return $this->template_common();
}

function template_update()
{
	return $this->template_common();
}

function template_common()
{
	$this->set_msg( "Updating tmplates ..." );

	$TPL_TRUST_PATH = $this->_TRUST_DIR  .'/templates';
	$TPL_ROOT_PATH  = $this->_MODULE_DIR .'/templates';

// read timeline_base_xxx.html in root_path
	if ( $this->_IS_XOOPS_2018 ) {
		$tpl_path = $TPL_ROOT_PATH . '/';
		$prefix   = ''; 

// read xxx.html in trust_path
	} else {
		$tpl_path = $TPL_TRUST_PATH . '/';
		$prefix   = $this->_DIRNAME .'_'; 
	}

// TEMPLATES (all templates have been already removed by modulesadmin)
	$tplfile_handler =& xoops_gethandler( 'tplfile' ) ;

	$handler = @opendir( $tpl_path ) ;
	if ( ! $handler ) {
		xoops_template_clear_module_cache( $this->_MODULE_MID ) ;
		return true;
	}

	while( ( $file = readdir( $handler ) ) !== false ) 
	{
	// check file
		if ( !$this->check_tpl_file( $file ) ) {
			continue ;
		}

	// use optional file, if exists
		$file_trust_path = $TPL_TRUST_PATH . '/' . $file ;
		$file_root_path  = $TPL_ROOT_PATH  . '/' . $file ;
		if ( is_file( $file_root_path ) ) {
			$file_path = $file_root_path;
		} elseif( is_file( $file_trust_path ) ) {
			$file_path = $file_trust_path;
		} else {
			continue;
		}

		$dirname_file   = $prefix . $file ;
		$dirname_file_s = $this->sanitize( $dirname_file );
		$mtime = intval( @filemtime( $file_path ) ) ;

	// set table
		$tplfile =& $tplfile_handler->create() ;
		$tplfile->setVar( 'tpl_source' , file_get_contents( $file_path ) , true ) ;
		$tplfile->setVar( 'tpl_refid' , $this->_MODULE_MID ) ;
		$tplfile->setVar( 'tpl_tplset' , 'default' ) ;
		$tplfile->setVar( 'tpl_file' , $dirname_file ) ;
		$tplfile->setVar( 'tpl_desc' , '' , true ) ;
		$tplfile->setVar( 'tpl_module' , $this->_DIRNAME ) ;
		$tplfile->setVar( 'tpl_lastmodified' , $mtime ) ;
		$tplfile->setVar( 'tpl_lastimported' , 0 ) ;
		$tplfile->setVar( 'tpl_type' , 'module' ) ;

		$ret1 = $tplfile_handler->insert( $tplfile );
		if ( $ret1 ) {
			$tplid = $tplfile->getVar( 'tpl_id' ) ;
			$this->set_msg( ' &nbsp; Template <b>'. $dirname_file_s .'</b> added to the database. (ID: <b>'.$tplid.'</b>)' );

			// generate compiled file
			$ret2 = xoops_template_touch( $tplid );
			if ( $ret2 ) {
				$this->set_msg( ' &nbsp; Template <b>'. $dirname_file_s .'</b> compiled.</span>' );
			} else {
				$this->set_msg( $this->highlight( 'ERROR: Failed compiling template <b>'. $dirname_file_s .'</b>.' ) );
			}

		} else {
			$this->set_msg( $this->highlight( 'ERROR: Could not insert template <b>'. $dirname_file_s .'</b> to the database.' ) );
		}

	}

	closedir( $handler ) ;
	xoops_template_clear_module_cache( $this->_MODULE_MID ) ;

	return true;
}

function template_uninstall()
{
	// TEMPLATES (Not necessary because modulesadmin removes all templates)
}

function check_tpl_file( $file )
{
// ignore . and ..
	if ( $this->parse_first_char( $file ) == '.' ) {
		return false;
	}
// ignore 'index.htm'
	if (( $file == 'index.htm' )||( $file == 'index.html' )) {
		return false;
	}
// ignore not html
	if ( $this->parse_ext( $file ) != 'html' ){
		return false;
	}
	return true; 
}

function parse_first_char( $file )
{
	return substr( $file , 0 , 1 );
}

function parse_ext( $file )
{
	return strtolower( substr( strrchr( $file , '.' ) , 1 ) );
}


//---------------------------------------------------------
// msg
//---------------------------------------------------------
function set_msg( $msg )
{
// array type
	if ( is_array($msg) ) {
		foreach ( $msg as $m ) {
			$this->_msg_array[] = $m;
		}

// string type
	} else {
		$arr = explode("\n", $msg);
		foreach ( $arr as $m ) {
			$this->_msg_array[] = $m;
		}
	}
}

function get_msg_array()
{
	return $this->_msg_array;
}

// --- class end ---
}

?>