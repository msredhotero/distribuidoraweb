<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosAfiliados {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


function enviarEmail($destinatario,$asunto,$cuerpo) {

	
	# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
	# se deshabilita y los mensajes son enviados tan rápido como sea posible.
	define("MAILQUEUE_BATCH_SIZE",0);

	//para el envío en formato HTML
	//$headers = "MIME-Version: 1.0\r\n";
	
	// Cabecera que especifica que es un HMTL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	//dirección del remitente
	$headers .= "From: SGP <info@sgp.com.ar>\r\n";
	
	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".$destinatario."\r\n";
	
	//direcciones que recibirán copia oculta
	//$headers .= "Bcc: msredhotero@msn.com\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers); 	
}


function TraerAfiliadosPorOrganismo($idOrganismo) {
	
	$serverName = "server2\sqlexpress"; //serverName\instanceName

	$connectionInfo = array( "Database"=>"sindicato", "CharacterSet" => "UTF-8");
	$conex = sqlsrv_connect( $serverName, $connectionInfo);
	
	$sql = "select
				a.activo,
				a.pendiente,
				a.dni,
				a.cuil,
				a.nacimiento,
				a.sexo,
				a.estadocivil,
				a.activocamping,
				a.email,
				a.domicilio,
				a.localidad,
				a.cp,
				a.telefono,
				a.domiciliolaboral,
				a.localidadlaboral,
				a.cplaboral,
				a.telefonolaboral,
				a.estadogremial,
				a.altagremial,
				a.bajagremial,
				a.motivogremial,
				oo.nombre as organismogremial,
				a.nroempleadog,
				a.nrogremio,
				a.estadosocial,
				a.altasocial,
				a.bajasocial,
				a.motivosocial,
				o.nombre as organismo,
				a.nroempleado,
				a.aporta,
				a.nrocoseguro,
				a.prestador,
				a.nroioma,
				a.observaciones,
				a.IDAfiliado,
				a.nombre
			from		dbo.Afiliados a
			inner
			join		dbo.Organismos o
			on			a.idorganismo = o.idorganismo
			inner
			join		dbo.Organismos oo
			on			a.idorganismog = oo.idOrganismo 
			where       a.activo = 1 and o.idorganismo = ".$idOrganismo;
	//return  $this->query($sql,0);
	
	$res = sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
	
	return $res;
}

function encode_this($string) 
{
	$string = utf8_encode($string);
	$control = "ovatsug"; //defino la llave para encriptar la cadena, cambiarla por la que deseamos usar
	$string = $control.$string.$control; //concateno la llave para encriptar la cadena
	$string = base64_encode($string);//codifico la cadena
	return($string);
} 


function decode_get2($string)
{
	$cad = split("[?]",$string); //separo la url desde el ?
	$string = $cad[1]; //capturo la url desde el separador ? en adelante
	$string = base64_decode($string); //decodifico la cadena
	$control = "ovatsug"; //defino la llave con la que fue encriptada la cadena,, cambiarla por la que deseamos usar
	$string = str_replace($control, "", "$string"); //quito la llave de la cadena
	
	//procedo a dejar cada variable en el $_GET
	$cad_get = split("[&]",$string); //separo la url por &
	foreach($cad_get as $value)
	{
		$val_get = split("[=]",$value); //asigno los valosres al GET
		$_GET[$val_get[0]]=utf8_decode($val_get[1]);
	}
}


function TraerAfiliadosPorOrganismoId($idOrganismo, $idAfiliado) {
	
	$serverName = "server2\sqlexpress"; //serverName\instanceName

	$connectionInfo = array( "Database"=>"sindicato");
	$conex = sqlsrv_connect( $serverName, $connectionInfo);
	
	$sql = "select
				a.activo,
				a.pendiente,
				a.dni,
				a.cuil,
				CONVERT(VARCHAR(24),a.nacimiento,103) as nacimiento,
				a.sexo,
				a.estadocivil,
				a.activocamping,
				a.email,
				a.domicilio,
				a.localidad,
				a.cp,
				(case when a.telefono = '' then null else a.telefono end) as telefono,
				a.domiciliolaboral,
				a.localidadlaboral,
				a.cplaboral,
				a.telefonolaboral,
				a.estadogremial,
				CONVERT(VARCHAR(24),a.altagremial,103) as altagremial,
				CONVERT(VARCHAR(24),a.bajagremial,103) as bajagremial,
				a.motivogremial,
				oo.nombre as organismogremial,
				a.nroempleadog,
				a.nrogremio,
				a.estadosocial,
				CONVERT(VARCHAR(24),a.altasocial,103) as altasocial,
				CONVERT(VARCHAR(24),a.bajasocial,103) as bajasocial,
				a.motivosocial,
				o.nombre as organismo,
				a.nroempleado,
				a.aporta,
				a.nrocoseguro,
				a.prestador,
				a.nroioma,
				a.observaciones,
				a.IDAfiliado,
				a.nombre
			from		dbo.Afiliados a
			inner
			join		dbo.Organismos o
			on			a.idorganismo = o.idorganismo
			inner
			join		dbo.Organismos oo
			on			a.idorganismog = oo.idOrganismo 
			where       a.activo = 1 and o.idorganismo = ".$idOrganismo." and a.idafiliado = ".$idAfiliado;
	//return  $this->query($sql,0);
	$res = sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
	
	while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
		
		$cad = $row['activo']."*/*".$row['pendiente']."*/*".$row['dni']."*/*".$row['cuil']."*/*".$row['nacimiento']."*/*".$row['sexo']."*/*".$row['estadocivil']."*/*".$row['activocamping']."*/*".$row['email']."*/*".$row['domicilio']."*/*".$row['localidad']."*/*".$row['cp']."*/*".$row['telefono']."*/*".$row['domiciliolaboral']."*/*".$row['localidadlaboral']."*/*".$row['cplaboral']."*/*".$row['telefonolaboral']."*/*".$row['estadogremial']."*/*".$row['altagremial']."*/*".$row['bajagremial']."*/*".$row['motivogremial']."*/*".$row['organismogremial']."*/*".$row['nroempleadog']."*/*".$row['nrogremio']."*/*".$row['estadosocial']."*/*".$row['altasocial']."*/*".$row['bajasocial']."*/*".$row['motivosocial']."*/*".$row['organismo']."*/*".$row['nroempleado']."*/*".$row['aporta']."*/*".$row['nrocoseguro']."*/*".$row['prestador']."*/*".$row['nroioma']."*/*".$row['observaciones']."*/*".base64_encode($row['IDAfiliado'])."*/*".$row['nombre'];
	}
	return $cad;
}


function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
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
		
	}

}

?>