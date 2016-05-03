<?php

$serverName = "WIN-9BC91H82UD8";
//$serverName = "(local)";
	//$connectionInfo = array( "Database"=>"Distribuidora");
	$connectionInfo = array("UID"=>"usuario", "PWD"=>"distribuidora", "Database"=>"distribuidora");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
	//$conn = mssql_connect("WIN-9BC91H82UD8\SQLEXPRESS","usuario","distribuidora") or die ("error en conexion");
	//mssql_select_db("Distribuidora",$conn) or die ("error de base");
	
	
	if( $conn === false )
{
echo "No es posible conectarse al servidor.</br>";

}

?>