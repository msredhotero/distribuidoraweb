<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosUsuarios {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


function login($usuario,$pass) {
	

	$serverName = "server2\sqlexpress"; //serverName\instanceName

	$connectionInfo = array( "Database"=>"sindicato");
	$conex = sqlsrv_connect( $serverName, $connectionInfo);


	$sqlusu = "select o.IDOrganismo from Organismos o where O.CUIT = '".$usuario."'";

//	$respusu = $this->query($sqlusu, 0);

//die(var_dump($respusu ));

if (trim($usuario) != '' and trim($pass) != '') {


//$respusu = $this->query($sqlusu, 0);
$respusu = sqlsrv_query($conex, $sqlusu, array(), array( "Scrollable"=>"buffered" ));

//die(var_dump($respusu));


if (sqlsrv_num_rows($respusu) > 0) {
	$error = '';
	
	while($row = sqlsrv_fetch_array($respusu, SQLSRV_FETCH_ASSOC)) {
    		$idUsua = $row["IDOrganismo"];
	}
	//die(var_dump($idUsua));
	
	//$sqlpass = "select nombre,Email,DNI, IDAfiliado from Afiliados where CUIL = '".$pass."' and Activo = 1 and IDAfiliado = ".$idUsua;
	
	$sqlpass = "select nombre, IDOrganismo from Organismos where CUIT = '".$pass."' and Activo = 1 and IDOrganismo = ".$idUsua;

	$resppass = sqlsrv_query($conex, $sqlpass, array(), array( "Scrollable"=>"buffered" ));
	
	if (sqlsrv_num_rows($resppass) > 0) {
		$error = '';
		} else {
			$error = 'Usuario o Password incorrecto';
		}
	
	}
	else
	
	{
		$error = 'Usuario o Password incorrecto';	
	}
	
	if ($error == '') {
		session_start();
		$_SESSION['usua_sgp'] = $usuario;
		while($row2 = sqlsrv_fetch_array($resppass, SQLSRV_FETCH_ASSOC)) {
			$_SESSION['nombre_sgp'] = $row2["nombre"];
			$_SESSION['idorganismo_sgp'] = $idUsua;
		}
		
	}
	
}	else {
	$error = 'Usuario y Password son campos obligatorios';	
}
	
	
	return $error;
	
}


function loginFacebook($usuario) {
	
	$sqlusu = "select concat(apellido,' ',nombre),email,direccion,refroll from se_usuarios where email = '".$usuario."'";
	$error = '';


if (trim($usuario) != '') {

$respusu = $this->query($sqlusu,0);

	if (mysql_num_rows($respusu) > 0) {
		
		
		if ($error == '') {
			session_start();
			$_SESSION['usua_predio'] = $usuario;
			$_SESSION['nombre_predio'] = mysql_result($resppass,0,0);
			$_SESSION['email_predio'] = mysql_result($resppass,0,1);
			$_SESSION['refroll_predio'] = mysql_result($resppass,0,3);
			//$error = 'andube por aca'-$sqlusu;
		}
		
	}	else {
		$error = 'Usuario y Password son campos obligatorios';	
	}

}

	return $error;
	
}




function loginUsuario($usuario,$pass) {
	
	$sqlusu = "select * from se_usuarios where email = '".$usuario."'";



if (trim($usuario) != '' and trim($pass) != '') {

	$respusu = $this->query($sqlusu,0);
	
	if (mysql_num_rows($respusu) > 0) {
		$error = '';
		
		$idUsua = mysql_result($respusu,0,0);
		$sqlpass = "select concat(apellido,' ',nombre),email,refroll from se_usuarios where password = '".$pass."' and IdUsuario = ".$idUsua;
	
		$resppass = $this->query($sqlpass,0);
		
			if (mysql_num_rows($resppass) > 0) {
				$error = '';

			} else {
				if (mysql_result($respusu,0,'activo') == 0) {
					$error = 'El usuario no fue activado, verifique su cuenta de email: '.$usuario;
				} else {
					$error = 'Usuario o Password incorrecto';
				}

			}
		
		}
		else
		
		{
			$error = 'Usuario o Password incorrecto';	
		}
		
		if ($error == '') {
			session_start();
			$_SESSION['usua_predio'] = $usuario;
			$_SESSION['nombre_predio'] = mysql_result($resppass,0,0);
			$_SESSION['email_predio'] = mysql_result($resppass,0,1);
			$_SESSION['refroll_predio'] = mysql_result($resppass,0,3);
		}
	
	
	}	else {
		$error = 'Usuario y Password son campos obligatorios';	
	}
	
	
	return $error;
	
}


function traerRoles() {
	$sql = "select * from tbroles";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerUsuario($email) {
	$sql = "select idusuario,usuario,refroll,nombrecompleto,email,password from se_usuarios where email = '".$email."'";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerUsuarios() {
	$sql = "select u.idusuario,u.usuario, u.password, r.descripcion, u.email , u.nombrecompleto, u.refroll
			from dbusuarios u
			inner join tbroles r on u.refroll = r.idrol 
			order by nombrecompleto";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerTodosUsuarios() {
	$sql = "select u.idusuario,u.usuario,u.nombrecompleto,u.refroll,u.email,u.password
			from se_usuarios u
			order by nombrecompleto";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerUsuarioId($id) {
	$sql = "select idusuario,usuario,nombre,email,password from dbusuarios where idusuario = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function existeUsuario($usuario) {
	$sql = "select * from dbusuarios where email = '".$usuario."'";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		return true;	
	} else {
		return false;	
	}
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


function insertarUsuario($usuario,$password,$email,$telefono) {
	$sql = "insert into dbusuarios(idusuario,usuario,password,nombre,email,telefono,activo)
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."','".utf8_decode($usuario)."','".utf8_decode($email)."','".$telefono."', 0)";
	
	if ($this->existeUsuario($email) == true) {
		return "Ya existe el usuario";	
	}
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		$ui = $this->GUID();
		$this->insertarActivacion($res,$ui);
		
		// Cuerpo o mensaje
		$mensaje = '
		<html>
		<head>
		  <title>Se ha registrado correctamente en SGP.</title>
		</head>
		<body>
		  <h3>Bienvenido/a</h3>
		  <p>Para ingresar sus datos son:</p>
		  <h4><b>Usuario:</b> '.$email.'</h4>
		  <h4><b>Password:</b> '.$password.'</h4>
		  <br>
		  <div style="border: 1px solid;
			margin: 10px 0px;
			padding:15px 10px 15px 50px;
			background-repeat: no-repeat;
			background-position: 10px center;
			font-family:Arial, Helvetica, sans-serif;
			font-size:13px;
			text-align:left;
			width:auto;
			color: #4F8A10;
			background-color: #DFF2BF;">
		  El siguiente link es para activar su cuenta. Haga click <a href="http://www.sgp.com.ar/activacion.php?token='.$ui.'">Aqui</a>
		</div>
		</body>
		</html>
		';
		
		$this->enviarEmail($email,"Se ha registrado en SGP correctamente.",$mensaje);
		return $res;
	}
}




function modificarUsuarios($id,$usuario,$password,$nombre,$email,$telefono) {
$sql = "update dbusuarios
set
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',nombre = '".utf8_decode($nombre)."',email = '".utf8_decode($email)."',telefono = '".utf8_decode($telefono)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
} 


function insertarActivacion($refcliente,$ui) {
	$sql = "insert into cv_activacion
				(idactivacion,refcliente,token)
			VALUES
			('',
			".$refcliente.",
			'".$ui."')";
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}

function traerActivacion($ui) {
	$sql = "select refcliente,token from cv_activacion where token = '".$ui."'";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		if (mysql_num_rows($res)>0) {
			return mysql_result($res,0,0);	
		} else {
			return 0;
		}
	}
}


function activarUsuario($id) {
	$sql = "UPDATE dbusuarios
			SET
				activo = 1
			WHERE idusuario = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}

function deshactivarUsuario($id) {
	$sql = "UPDATE dbusuarios
			SET
				activo = 0
			WHERE idusuario = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}

function lastInsertId($queryID) {
        sqlsrv_next_result($queryID);
        sqlsrv_fetch($queryID);
        return sqlsrv_get_field($queryID, 0);
    } 

function query($sql,$accion) {
		
		
		
		//require_once 'appconfig.php';
		
		$serverName = "server2\sqlexpress"; //serverName\instanceName

		$connectionInfo = array( "Database"=>"sindicato");
		$conex = sqlsrv_connect( $serverName, $connectionInfo);
	

		//$result = sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
		$result = sqlsrv_prepare($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
		//sqlsrv_close( $conex );
		
		return sqlsrv_execute($result);
		
		
		
	}

}

?>