<?php
// $Id: handler_basic.php,v 1.1.1.1 2009/03/19 14:41:43 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_lib_handler_basic
//=========================================================
class timeline_base_lib_handler_basic
{
	var $_db;

	var $_cached = array();

	var $_DEBUG_SQL   = false;
	var $_DEBUG_ERROR = 0 ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_lib_handler_basic()
{
	$this->_db =& Database::getInstance();
}

//---------------------------------------------------------
// get query
//---------------------------------------------------------
function get_count_by_sql( $sql )
{
	return intval( $this->get_first_row_by_sql( $sql ) );
}

function get_first_row_by_sql( $sql )
{
	$res = $this->query($sql);
	if ( !$res ) { return false; }

	$row = $this->_db->fetchRow( $res );
	if ( isset( $row[0] ) ) {
		return $row[0];
	}

	return false;
}

function get_row_by_sql( $sql )
{
	$res = $this->query( $sql );
	if ( !$res ) { return false; }

	$row = $this->_db->fetchArray($res);
	return $row; 
}

function get_rows_by_sql( $sql, $limit=0, $offset=0, $key=null )
{
	$arr = array();

	$res = $this->query( $sql, $limit, $offset );
	if ( !$res ) { return false; }

	while ( $row = $this->_db->fetchArray($res) ) 
	{
		if ( $key && isset( $row[ $key ] ) ) {
			$arr[ $row[ $key ] ] = $row;
		} else {
			$arr[] = $row;
		}
	}
	return $arr; 
}

function get_first_rows_by_sql( $sql, $limit=0, $offset=0 )
{
	$res = $this->query( $sql, $limit, $offset );
	if ( !$res ) { return false; }

	$arr = array();

	while ( $row = $this->_db->fetchRow($res) ) {
		$arr[] = $row[0];
	}
	return $arr;
}

//---------------------------------------------------------
// cached
//---------------------------------------------------------
function get_cached_row_by_id( $id )
{
	if ( isset( $this->_cached[ $id ] ) ) {
		return  $this->_cached[ $id ];
	}

	$row = $this->get_row_by_id( $id );
	if ( is_array($row) ) {
		$this->_cached [$id ] = $row;
		return $row;
	}

	return null;
}

function get_cached_value_by_id_name( $id, $name, $flag_sanitize=false )
{
	$row = $this->get_cached_row_by_id( $id );
	if ( isset( $row[ $name ] ) ) {
		$val = $row[ $name ];
		if ( $flag_sanitize ) {
			$val = $this->sanitize( $val );
		}
		return $val;
	}
	return null;
}

//---------------------------------------------------------
// update
//---------------------------------------------------------
function exists_table( $table )
{
	$sql = "SHOW TABLES LIKE ". $this->quote($table);

	$res = $this->query($sql); 
	if ( !$res ) {
		return false;
	}

	while ( $row = $this->_db->fetchRow( $res ) ) {
		if ( strtolower( $row[0] ) == strtolower( $table ) ) {
			return true;
		}
	}

	return false;
}

function exists_column( $table, $column )
{
	$row = $this->get_column_row( $table, $column );
	if ( is_array($row) ) {
		return true;
	}
	return false;
}

function get_column_row( $table, $column )
{
	$sql = "SHOW COLUMNS FROM ". $table. " LIKE ". $this->quote($column);

	$res =& $this->query($sql); 
	if ( !$res ) {
		return false;
	}

	while ( $row = $this->_db->fetchArray( $res ) ) {
		if ( $row['Field'] == $column ) {
			return $row;
		}
	}

	return false;
}

//---------------------------------------------------------
// query
//---------------------------------------------------------
function query( $sql, $limit=0, $offset=0, $force=false )
{
	if ( $force ) {
		return $this->queryF( $sql, $limit, $offset );
	}

	$this->print_sql_full_when_debug_sql( $sql, $limit, $offset );

	$res = $this->_db->query( $sql, $limit, $offset );
	if ( !$res  ) {
		$this->print_db_error( $sql, $limit, $offse );
	}

	return $res;
}

function queryF( $sql, $limit=0, $offset=0 )
{
	$this->print_sql_full_when_debug_sql( $sql, $limit, $offset );

	$res = $this->_db->queryF( $sql, $limit, $offset );
	if ( !$res ) {
		$this->print_db_error( $sql, $limit, $offset );
	}

	return $res;
}

function quote( $str )
{
	$str = "'". addslashes($str) ."'";
	return $str;
}

function db_prefix( $name )
{
	return $this->_db->prefix( $name ) ;
}

function get_db_error()
{
	return $this->_db->error() ;
}

//---------------------------------------------------------
// error
//---------------------------------------------------------
function print_sql_full_when_debug_sql( $sql, $limit, $offset )
{
	if ( $this->_DEBUG_SQL ) {
		$sql = $this->print_sql_ful( $sql, $limit, $offset );
	}
}

function print_sql_full( $sql, $limit, $offset )
{
	$sql = $this->build_sql_ful( $sql, $limit, $offset );
	echo $this->sanitize( $sql )."<br />\n";
}

function print_db_error( $sql, $limit, $offset )
{
	if ( ! $this->_DEBUG_SQL ) {
		$this->print_sql_full( $sql, $limit, $offset );
	}
	if ( $this->_DEBUG_ERROR ) {
		echo $this->highlight( $this->get_db_error() )."<br />\n";
	}
	if ( $this->_DEBUG_ERROR > 1 ) {
		debug_print_backtrace() ;
	}
}

function build_sql_ful( $sql, $limit, $offset )
{
	$str = $sql .': limit='. $limit .' :offset='. $offset ;
	return $str ;
}

function sanitize( $str )
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

function highlight( $str )
{
	$val = '<span style="color:#ff0000;">'. $str .'</span>';
	return $val;
}

//---------------------------------------------------------
// debug
//---------------------------------------------------------
function set_debug_sql( $val )
{
	$this->_DEBUG_SQL = (bool)$val;
}

function set_debug_error( $val )
{
	$this->_DEBUG_ERROR = intval($val);
}

function set_debug_sql_by_const_name( $name )
{
	$name = strtoupper( $name );
	if ( defined($name) ) {
		$this->set_debug_sql( constant($name) );
	}
}

function set_debug_error_by_const_name( $name )
{
	$name = strtoupper( $name );
	if ( defined($name) ) {
		$this->set_debug_error( constant($name) );
	}
}

// --- class end ---
}

?>