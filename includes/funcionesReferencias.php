<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function subirArchivo($file) {
	$dir_destino = '../archivos/';
	$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
	
	//$noentrar = '../imagenes/index.php';
	//$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idInmueble.'/'.'index.php';
	
	if (!file_exists($dir_destino)) {
    	mkdir($dir_destino, 0777);
	}
	
	 
	if(!is_writable($dir_destino)){
		
		echo "no tiene permisos";
		
	}	else	{
		if ($_FILES[$file]['tmp_name'] != '') {
			if(is_uploaded_file($_FILES[$file]['tmp_name'])){
				/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
				echo "Mostrar contenido\n";
				echo $imagen_subida;*/
				if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
					
					$archivo = utf8_decode($_FILES[$file]["name"]);
					$tipoarchivo = $_FILES[$file]["type"];
					
					/*if ($this->existeArchivo($idInmueble,$archivo,$tipoarchivo) == 0) {
						$sql	=	"insert into pifotos(idfoto,refinmueble,imagen,type) values ('',".$idInmueble.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
						$this->query($sql,1);
					}
					echo "";
					
					copy($noentrar, $nuevo_noentrar);
	*/
				} else {
					echo "Posible ataque de carga de archivos!\n";
				}
			}else{
				echo "Posible ataque del archivo subido: ";
				echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
			}
		}
	}	
}


function traerArticulos() {
	$sql = "SELECT TOP 1000 [codigo]
      ,[descripcion]
      ,[proveedor]
      ,[Tipo]
      ,[Oferta]
      ,[Nov]
      ,[Faltante]
      ,[costo]
      ,[costo2]
      ,[costo3]
      ,[Unidades]
      ,[Cant2]
      ,[CostoUnd]
      ,[lista1]
      ,[lista2]
      ,[lista3]
      ,[lista4]
      ,[lista5]
      ,[lista6]
      ,[lista7]
      ,[lista8]
      ,[lista9]
      ,[lista10]
      ,[lista11]
      ,[lista12]
      ,[lista13]
      ,[lista14]
      ,[renta1]
      ,[renta2]
      ,[renta3]
      ,[renta4]
      ,[renta5]
      ,[renta6]
      ,[renta7]
      ,[renta8]
      ,[renta9]
      ,[renta10]
      ,[renta11]
      ,[renta12]
      ,[renta13]
      ,[renta14]
      ,[CodigoRempla]
      ,[DescRempla]
      ,[Actualizado]
      ,[paq1]
      ,[paq2]
      ,[paq3]
      ,[paq4]
      ,[paq5]
      ,[paq6]
      ,[paq7]
      ,[paq8]
      ,[paq9]
      ,[paq10]
      ,[paq11]
      ,[paq12]
      ,[paq13]
      ,[paq14]
      ,[stock]
      ,[lista15]
      ,[renta15]
      ,[paq15]
      ,[sugerido]
      ,[modificado]
      ,[lista16]
      ,[lista17]
      ,[lista18]
      ,[paq16]
      ,[paq17]
      ,[paq18]
      ,[renta18]
      ,[lista19]
      ,[renta19]
      ,[paq19]
      ,[minimo]
      ,[maximo]
      ,[estadistica]
      ,[fecha]
      ,[stockanterior]
      ,[lista21]
      ,[lista22]
      ,[lista23]
      ,[lista24]
      ,[lista25]
      ,[lista26]
      ,[lista27]
      ,[lista28]
      ,[lista29]
      ,[paq21]
      ,[paq22]
      ,[paq23]
      ,[paq24]
      ,[paq25]
      ,[paq26]
      ,[paq27]
      ,[paq28]
      ,[paq29]
      ,[valor]
      ,[orden]
      ,[permiso]
      ,[TIPOPROVEEDOR]
      ,[cantdesc]
      ,[ArribaAbajo]
      ,[PedirProveedor]
      ,[CajaUnidad]
      ,[PorcenAumento]
      ,[Vencimiento]
      ,[Activo]
      ,[Kilos]
  FROM [Distribuidora].[dbo].[articulos]";
}


function traerProveedor() {
	$sql = "SELECT [id]
      ,[codigo]
      ,[proveedor]
      ,[demora]
      ,[diaentrega]
      ,[compraminima]
      ,[compramaxima]
      ,[contacto]
      ,[telefono]
      ,[pedido]
      ,[dia]
      ,[porcentaje]
      ,[razonsocial]
      ,[cuit]
      ,[Activo]
  FROM [Distribuidora].[dbo].[proveedores] where Activo = 1";
  /*
  $serverName = "WIN-9BC91H82UD8\sqlexpress";
	//$connectionInfo = array( "Database"=>"Distribuidora");
	//$connectionInfo = array("UID"=>"usuario", "PWD"=>"distribuidora", "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$connectionInfo = array( "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$conex = sqlsrv_connect( $serverName, $connectionInfo);
		*/
  $res = $this->query($sql,0);
  return $res;
}

/* Fin */

function query($sql,$accion) {
		
		
		/*
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		*/
		
		$serverName = "WIN-9BC91H82UD8\sqlexpress";
	//$connectionInfo = array( "Database"=>"Distribuidora");
	//$connectionInfo = array("UID"=>"usuario", "PWD"=>"distribuidora", "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$connectionInfo = array( "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$conex = sqlsrv_connect( $serverName, $connectionInfo);
	
	
		        $error = 0;
		//mysql_query("BEGIN");
		//$result=mysql_query($sql,$conex);
		$result=sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
		
		/*
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		*/
		return $result;
		
	}

}

?>