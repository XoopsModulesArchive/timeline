<?php
// $Id: config_modify.php,v 1.1.1.1 2009/03/19 14:41:42 ohwada Exp $

//=========================================================
// timeline module
// 2009-03-15 K.OHWADA
//=========================================================

if( ! defined( 'XOOPS_TRUST_PATH' ) ) die( 'not permit' ) ;

//=========================================================
// class timeline_base_xoops_config_update
//=========================================================
class timeline_base_xoops_config_modify extends timeline_base_lib_handler_basic
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function timeline_base_xoops_config_modify()
{
	$this->timeline_base_lib_handler_basic();
}

//---------------------------------------------------------
// xoops config table
//---------------------------------------------------------
function modify_title_length()
{
	// configs (Though I know it is not a recommended way...)
	$table_config = $this->db_prefix("config");

	$check_sql = "SHOW COLUMNS FROM ". $table_config ." LIKE 'conf_title'" ;
	$row = $this->get_row_by_sql( $check_sql );
	if ( !is_array($row) ) { 
		return false; 
	}

// default: varchar(30)
	if ( preg_match( '/varchar\((\d+)\)/i', $row['Type'], $matches ) ) {
		if ( $matches[1] > 30 ) {
			return true; 
		}
	}

	$sql  = "ALTER TABLE ". $table_config;
	$sql .= " MODIFY `conf_title` varchar(255) NOT NULL default '', ";
	$sql .= " MODIFY `conf_desc`  varchar(255) NOT NULL default '' ";

	return $this->query( $sql );
}

// --- class end ---
}

?>