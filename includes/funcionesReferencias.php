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

function eliminarImportar($id) { 
$sql = "delete from dbimportar where idimportar =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function eliminarTodoImportar() { 
$sql = "delete from dbimportar "; 
$res = $this->query($sql,0); 
return $res; 
} 

function insertarImportar($dormitorios,$banios,$mtsencontruc,$mts2,$anioconstruc,$precioventapropietario,$nombrepropietario,$apellidopropietario,$feccarga,$calcedadconstruc,$calcporcdeprec,$calcavaluoconstruc,$calcdepreciacion,$preciorealdeconstruccion,$calcavaluoterreno,$calcpreciorealmercado,$calcrestacliente,$calcporc,$valoracion,$urbanizacion,$sector,$ciudad,$provincia,$pais,$tipovivienda,$usos,$situacioninmueble,$usuario,$comision,$refvaloracion,$refurbanizacion,$refsector,$refciudad,$refprovincia,$refpais,$reftipovivienda,$refusos,$refsituacioninmueble,$refcomision,$token) {
$sql = "insert into dbimportar(idimportar,dormitorios,banios,mtsencontruc,mts2,anioconstruc,precioventapropietario,nombrepropietario,apellidopropietario,feccarga,calcedadconstruc,calcporcdeprec,calcavaluoconstruc,calcdepreciacion,preciorealdeconstruccion,calcavaluoterreno,calcpreciorealmercado,calcrestacliente,calcporc,valoracion,urbanizacion,sector,ciudad,provincia,pais,tipovivienda,usos,situacioninmueble,usuario,comision,refvaloracion,refurbanizacion,refsector,refciudad,refprovincia,refpais,reftipovivienda,refusos,refsituacioninmueble,refcomision,token)
values ('',".$dormitorios.",".$banios.",".$mtsencontruc.",".$mts2.",".$anioconstruc.",".$precioventapropietario.",'".utf8_decode($nombrepropietario)."','".utf8_decode($apellidopropietario)."','".utf8_decode($feccarga)."',".$calcedadconstruc.",".$calcporcdeprec.",".$calcavaluoconstruc.",".$calcdepreciacion.",".$preciorealdeconstruccion.",".$calcavaluoterreno.",".$calcpreciorealmercado.",".$calcrestacliente.",".$calcporc.",'".utf8_decode($valoracion)."','".utf8_decode($urbanizacion)."','".utf8_decode($sector)."','".utf8_decode($ciudad)."','".utf8_decode($provincia)."','".utf8_decode($pais)."','".utf8_decode($tipovivienda)."','".utf8_decode($usos)."','".utf8_decode($situacioninmueble)."','".utf8_decode($usuario)."','".utf8_decode($comision)."',".$refvaloracion.",".$refurbanizacion.",".$refsector.",".$refciudad.",".$refprovincia.",".$refpais.",".$reftipovivienda.",".$refusos.",".$refsituacioninmueble.",".$refcomision.",'".$token."')";
$res = $this->query($sql,1);
return $res;
} 


function traerImportar($token) {
$sql = "select idimportar,dormitorios,banios,mtsencontruc,mts2,anioconstruc,precioventapropietario,nombrepropietario,apellidopropietario,feccarga,calcedadconstruc,calcporcdeprec,calcavaluoconstruc,calcdepreciacion,preciorealdeconstruccion,calcavaluoterreno,calcpreciorealmercado,calcrestacliente,calcporc,valoracion,urbanizacion,sector,ciudad,provincia,pais,tipovivienda,usos,situacioninmueble,usuario,comision,refvaloracion,refurbanizacion,refsector,refciudad,refprovincia,refpais,reftipovivienda,refusos,refsituacioninmueble,refcomision,token from dbimportar where token ='".$token."' order by 1";
$res = $this->query($sql,0);
return $res;
} 

function cargarExcel($archivo,$nombre,$usuario) {
	//$this->eliminarTodoImportar();
					$token = $this->GUID();
					$token2 = $this->GUID();
                    //incluimos la clase
                    require_once '../../excelClass/PHPExcel/IOFactory.php';
                    
					$datos = array('comprobante' => '00004',
								   'codigocuenta' => array ('14350504','14350505','14350506','24081001','220501','129505','233595'),
								   'fecha' => '',
								   'documento' => '',
								   'documentoreferencia' => '',
								   'nit' => '',
								   'detalle' => array('COMPRA GRAVADA','COMPRA EXCLUIDA','COMPRA EXENTA','IVA DESCONTABLE','PROVEEDOR DE MERCANCIA','APORTES COOPERATIVA','APORTES COOPERATIVA'),
								   'tipo' => array('1','1','1','1','2','1','2'),
								   'valor' => array(),
								   'valorbase' => array(),
								   'centrocostos' => array('01','01','01','','','',''),
								   'transaccion' => '',
								   'plazo' => '0');
					
                    //cargamos el archivo que deseamos leer
                    $objPHPExcel = PHPExcel_IOFactory::load('../../archivos/'.$archivo);
                    //obtenemos los datos de la hoja activa (la primera)
                    //$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                    $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					
					//$objHoja=$objPHPExcel->getSheet(0)->toArray(null,true,true,true);
					// ó
					//$objPHPExcel->getSheetByName('Worksheet 1');
					
                    //recorremos las filas obtenidas
					$resValoracion 			= '';
					$resUrbanizacion		= '';
					$resSector				= '';
					$resCiudad				= '';
					$resProvincia			= '';
					$resPais				= '';
					$resTipoVivienda		= '';
					$resUsos				= '';
					$resSituacionInmueble	= '';
					
					$refValoracion 			= 0;
					$refUrbanizacion		= 0;
					$refSector				= 0;
					$refCiudad				= 0;
					$refProvincia			= 0;
					$refPais				= 0;
					$refTipoVivienda		= 0;
					$refUsos				= 0;
					$refSituacionInmueble	= 0;
					$refComision			= 0;
							
					$i = 0;
					$a = '';
					$resp = '';
					$relacion = array(0,0,0,0,0);
					$localidades = array('','','','','');
                    foreach ($objHoja as $iIndice=>$objCelda) {
                        //imprimimos el contenido de la celda utilizando la letra de cada columna
						if ($i != 0) {
							
							$refValoracion 			= $this->traerValoracionPorValor($objCelda['S'] == '' ? '' : $objCelda['S']);
							$refUrbanizacion		= $this->traerUrbanizacionPorUrbanizacion($objCelda['T'] == '' ? '' : $objCelda['T']);
							$refSector				= $this->traerSectorPorSector($objCelda['U'] == '' ? '' : $objCelda['U']);
							$refCiudad				= $this->traerCiudadesPorCiudad($objCelda['V'] == '' ? '' : $objCelda['V']);
							$refProvincia			= $this->traerProvinciasPorProvincia($objCelda['W'] == '' ? '' : $objCelda['W']);
							$refPais				= $this->traerPaisesPorNombre($objCelda['X'] == '' ? '' : $objCelda['X']);
							$refTipoVivienda		= $this->traerTipoViviendaPorTipoVivienda($objCelda['Y'] == '' ? '' : $objCelda['Y']);
							$refUsos				= $this->traerUsosPorUsos($objCelda['Z'] == '' ? '' : $objCelda['Z']);
							$refSituacionInmueble	= $this->traerSituacionInmueblePorSituacionInmueble($objCelda['AA'] == '' ? '' : $objCelda['AA']);
							$refComision			= $this->traerComisionPorComision($objCelda['AC'] == '' ? '' : $objCelda['AC']);
							
							if ($refPais == 0) {
								$refPais=$this->insertarPaises($objCelda['X']);
								
								$relacion[0] = $refPais;
							}	else {
								$relacion[0] = 0;	
							}
							if ($refProvincia == 0) {
								$refProvincia =$this->insertarProvincias($refPais,$objCelda['W']);
								
								$relacion[1] = $refProvincia;
							} 	else {
								$relacion[1] = 0;	
							}
							if ($refCiudad == 0) {
								$refCiudad =$this->insertarCiudades($refProvincia,$objCelda['V']);	
								
								$relacion[2] = $refCiudad;
							} 	else {
								$relacion[2] = 0;	
							}
							if ($refSector == 0) {	
								$refSector =$this->insertarSector($refCiudad,$objCelda['U']);
								
								$relacion[3] = $refSector;
							}	else {
								$relacion[3] = 0;	
							}
							if ($refUrbanizacion == 0) {	
								$refUrbanizacion =$this->insertarUrbanizacion($refSector,$objCelda['T']);
								
								$relacion[4] = $refUrbanizacion;
							}	else {
								$relacion[4] = 0;	
							}
							
							$localidades[0] = $objCelda['X'];
							$localidades[1] = $objCelda['W'];
							$localidades[2] = $objCelda['V'];
							$localidades[3] = $objCelda['U'];
							$localidades[4] = $objCelda['T'];
							
							if (($relacion[0] != 0)	|| ($relacion[1] != 0) || ($relacion[2] != 0) || ($relacion[3] != 0))
							$this->insertarRelacion($relacion,$localidades);		
							
							//die(var_dump($relacion));
							
							$resp = $this->insertarImportar(($objCelda['A'] == '' ? 0 : $objCelda['A']),
													 ($objCelda['B'] == '' ? 0 : $objCelda['B']),
													 ($objCelda['C'] == '' ? 0 : $objCelda['C']),
													 ($objCelda['D'] == '' ? 0 : $objCelda['D']),
													 ($objCelda['E'] == '' ? 0 : $objCelda['E']),
													 ($objCelda['F'] == '' ? 0 : $objCelda['F']),
													 ($objCelda['G'] == '' ? '' : $objCelda['G']),
													 ($objCelda['H'] == '' ? '' : $objCelda['H']),
													 ($objCelda['I'] == '' ? date('Y-m-d') : $objCelda['I']),
													 ($objCelda['J'] == '' ? 0 : $objCelda['J']),
													 ($objCelda['K'] == '' ? 0 : $objCelda['K']),
													 ($objCelda['L'] == '' ? 0 : $objCelda['L']),
													 ($objCelda['M'] == '' ? 0 : $objCelda['M']),
													 ($objCelda['N'] == '' ? 0 : $objCelda['N']),
													 ($objCelda['O'] == '' ? 0 : $objCelda['O']),
													 ($objCelda['P'] == '' ? 0 : $objCelda['P']),
													 ($objCelda['Q'] == '' ? 0 : $objCelda['Q']),
													 ($objCelda['R'] == '' ? 0 : $objCelda['R']),
													 ($objCelda['S'] == '' ? '' : $objCelda['S']),
													 ($objCelda['T'] == '' ? '' : $objCelda['T']),
													 ($objCelda['U'] == '' ? '' : $objCelda['U']),
													 ($objCelda['V'] == '' ? '' : $objCelda['V']),
													 ($objCelda['W'] == '' ? '' : $objCelda['W']),
													 ($objCelda['X'] == '' ? '' : $objCelda['X']),
													 ($objCelda['Y'] == '' ? '' : $objCelda['Y']),
													 ($objCelda['Z'] == '' ? '' : $objCelda['Z']),
													 ($objCelda['AA'] == '' ? '' : $objCelda['AA']),
													 ($objCelda['AB'] == '' ? '' : $objCelda['AB']),
													 ($objCelda['AC'] == '' ? 0 : $objCelda['AC']),
													  $refValoracion,
													  $refUrbanizacion,
													  $refSector,
													  $refCiudad,
													  $refProvincia,
													  $refPais,
													  $refTipoVivienda,
													  $refUsos,
													  $refSituacionInmueble,
													  $refComision,
													  $token);
							//$a .= $resp;
						}
						
						$i +=1;
						
                    }
					
					//$this->query($a,1);
					//return $this->traerDatosImportadosToken($token);
					$imp = $this->insertarInmueblesImportados($usuario,$token);
					return array("cantidad"=>$i,"token"=>$token,"insertados"=>$imp);;
}


function insertarRelacion($relacion,$localidades) {
	
	if ($relacion[0] != 0) {
		$this->insertarProvincias($relacion[0],$localidades[1]);
	}
	if ($relacion[1] != 0) {
		$this->insertarCiudades($relacion[1],$localidades[2]);	
	}
	if ($relacion[2] != 0) {
		$this->insertarSector($relacion[2],$localidades[3]);	
	}
	if ($relacion[3] != 0) {
		$this->insertarUrbanizacion($relacion[3],$localidades[4]);	
	}


}

function insertarInmueblesImportados($usuario, $token) {
	$res = $this->traerImportar($token);
	$i = 0;
	while ($row = mysql_fetch_array($res)) {
		
		$this->insertarInmuebles($row['refurbanizacion'],$row['reftipovivienda'],$row['refusos'],$row['refsituacioninmueble'],$row['dormitorios'],$row['banios'],$row['mtsencontruc']	,$row['mts2'],$row['anioconstruc'],$row['precioventapropietario'],$row['nombrepropietario'],$row['apellidopropietario'],$row['feccarga'],$usuario,$row['refcomision'],$row['calcedadconstruc'],$row['calcporcdeprec'],$row['calcavaluoconstruc'],$row['calcdepreciacion'],$row['calcavaluoterreno'],$row['calcpreciorealmercado'],$row['calcrestacliente'],$row['calcporc'],$row['refvaloracion'],0,0,$row['token']);
		$i += 1;
	}
	return $i;
}

function traerRegiones() {
$sql = "select idregion,region from regiones order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRegionesPorId($id) {
$sql = "select idregion,region from regiones where idregion =".$id;
$res = $this->query($sql,0);
return $res;
} 

/* PARA Sector */

function insertarSector($refciudad,$sector) {
$sql = "insert into sector(idsector,refciudad,sector)
values ('',".$refciudad.",'".utf8_decode($sector)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSector($id,$refciudad,$sector) {
$sql = "update sector
set
refciudad = ".$refciudad.",sector = '".utf8_decode($sector)."'
where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSector($id) {
$sql = "delete from sector where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSector() {
$sql = "select idsector,sector, c.ciudad, p.provincia, pa.nombre ,refciudad
		from sector s 
		inner join ciudades c on c.idciudad = s.refciudad
		inner join provincias p on p.idprovincia = c.refprovincia
		inner join paises pa on pa.idpais = p.refpais
		order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSectorPorId($id) {
$sql = "select idsector,refciudad,sector from sector where idsector =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerSectorPorSector($sector) {
$sql = "select idsector,refciudad,sector from sector where sector like '%".$sector."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */


/* PARA Ciudades */

function insertarCiudades($refprovincia,$ciudad) {
$sql = "insert into ciudades(idciudad,refprovincia,ciudad)
values ('',".$refprovincia.",'".utf8_decode($ciudad)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarCiudades($id,$refprovincia,$ciudad) {
$sql = "update ciudades
set
refprovincia = ".$refprovincia.",ciudad = '".utf8_decode($ciudad)."'
where idciudad =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarCiudades($id) {
$sql = "delete from ciudades where idciudad =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCiudades() {
$sql = "select 
			c.idciudad, c.ciudad, p.provincia, pa.nombre, c.refprovincia, pa.idpais
		from ciudades c
		inner join provincias p on p.idprovincia = c.refprovincia
		inner join paises pa on pa.idpais = p.refpais 
		order by 2";
$res = $this->query($sql,0);
return $res;
}


function traerCiudadesPorId($id) {
$sql = "select idciudad,refprovincia,ciudad from ciudades where idciudad =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerCiudadesPorCiudad($ciudad) {
$sql = "select idciudad,refprovincia,ciudad from ciudades where ciudad like '%".$ciudad."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;

}

/* Fin */

/* PARA Provincias */

function insertarProvincias($refpais,$provincia) {
$sql = "insert into provincias(idprovincia,refpais,provincia)
values ('',".$refpais.",'".utf8_decode($provincia)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarProvincias($id,$refpais,$provincia) {
$sql = "update provincias
set
refpais = ".$refpais.",provincia = '".utf8_decode($provincia)."'
where idprovincia =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarProvincias($id) {
$sql = "delete from provincias where idprovincia =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerProvincias() {
$sql = "select 
			p.idprovincia, p.provincia, pa.nombre, p.refpais
		from provincias  p
		inner join paises pa on pa.idpais = p.refpais 
		order by 2";
$res = $this->query($sql,0);
return $res;
}


function traerProvinciasPorId($id) {
$sql = "select 
			p.idprovincia, p.provincia, p.refpais
		from provincias p
		inner join paises pa on pa.idpais = p.refpais
			where idprovincia =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerProvinciasPorProvincia($provincia) {
$sql = "select 
			p.idprovincia, p.provincia, p.refpais
		from provincias p
			where p.provincia like '%".$provincia."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;

}

/* Fin */


/* PARA Paises */

function insertarPaises($nombre) {
$sql = "insert into paises(idpais,nombre)
values ('','".utf8_decode($nombre)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPaises($id,$nombre) {
$sql = "update paises
set
nombre = '".utf8_decode($nombre)."'
where idpais =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPaises($id) {
$sql = "delete from paises where idpais =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPaises() {
$sql = "select idpais,nombre from paises order by 2";
$res = $this->query($sql,0);
return $res;
}


function traerPaisesPorId($id) {
$sql = "select idpais,nombre from paises where idpais =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerPaisesPorNombre($nombre) {
$sql = "select idpais,nombre from paises where nombre like '%".$nombre."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */

/* PARA Valoracion */

function insertarValoracion($valoracion,$observacion) {
$sql = "insert into valoracion(idvaloracion,valoracion,observacion)
values ('','".utf8_decode($valoracion)."','".utf8_decode($observacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarValoracion($id,$valoracion,$observacion) {
$sql = "update valoracion
set
valoracion = '".utf8_decode($valoracion)."',observacion = '".utf8_decode($observacion)."'
where idvaloracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarValoracion($id) {
$sql = "delete from valoracion where idvaloracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerValoracion() {
$sql = "select idvaloracion,valoracion,observacion from valoracion order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerValoracionPorId($id) {
$sql = "select idvaloracion,valoracion,observacion from valoracion where idvaloracion =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerValoracionPorPorcentaje($porcentaje) {
	$sql = "SELECT idvaloracion FROM valoracion v where	".$porcentaje." between desde and hasta";
	$res = $this->query($sql,0);
	return $res;
}

function traerValoracionPorValor($valor) {
$sql = "select idvaloracion,valoracion,observacion from valoracion where observacion like '%".$valor."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */


/* PARA Usos */

function insertarUsos($usos) {
$sql = "insert into usos(iduso,usos)
values ('','".utf8_decode($usos)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsos($id,$usos) {
$sql = "update usos
set
usos = '".utf8_decode($usos)."'
where iduso =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsos($id) {
$sql = "delete from usos where iduso =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsos() {
$sql = "select iduso,usos from usos order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsosPorId($id) {
$sql = "select iduso,usos from usos where iduso =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerUsosPorUsos($usos) {
$sql = "select iduso,usos from usos where usos like '%".$usos."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */


/* PARA TipoVivienda */

function insertarTipoVivienda($tipovivienda) {
$sql = "insert into tipovivienda(idtipovivienda,tipovivienda)
values ('','".utf8_decode($tipovivienda)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipoVivienda($id,$tipovivienda) {
$sql = "update tipovivienda
set
tipovivienda = '".utf8_decode($tipovivienda)."'
where idtipovivienda =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipoVivienda($id) {
$sql = "delete from tipovivienda where idtipovivienda =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipoVivienda() {
$sql = "select idtipovivienda,tipovivienda from tipovivienda order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipoViviendaPorId($id) {
$sql = "select idtipovivienda,tipovivienda from tipovivienda where idtipovivienda =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerTipoViviendaPorTipoVivienda($tipovivienda) {
$sql = "select idtipovivienda,tipovivienda from tipovivienda where tipovivienda like '%".$tipovivienda."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */

/* PARA TipoUsuarios */

function insertarTipoUsuarios($descripcion) {
$sql = "insert into tipousuarios(idtipousuario,descripcion)
values ('','".utf8_decode($descripcion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipoUsuarios($id,$descripcion) {
$sql = "update tipousuarios
set
descripcion = '".utf8_decode($descripcion)."'
where idtipousuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipoUsuarios($id) {
$sql = "delete from tipousuarios where idtipousuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipoUsuarios() {
$sql = "select idtipousuario,descripcion from tipousuarios order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipoUsuariosPorId($id) {
$sql = "select idtipousuario,descripcion from tipousuarios where idtipousuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */

/* PARA TipodeInformacion */

function insertarTipodeInformacion($tipodeinformacion) {
$sql = "insert into tipodeinformacion(idtipodeinformacion,tipodeinformacion)
values ('','".utf8_decode($tipodeinformacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipodeInformacion($id,$tipodeinformacion) {
$sql = "update tipodeinformacion
set
tipodeinformacion = '".utf8_decode($tipodeinformacion)."'
where idtipodeinformacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipodeInformacion($id) {
$sql = "delete from tipodeinformacion where idtipodeinformacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipodeInformacion() {
$sql = "select idtipodeinformacion,tipodeinformacion from tipodeinformacion order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipodeInformacionPorId($id) {
$sql = "select idtipodeinformacion,tipodeinformacion from tipodeinformacion where idtipodeinformacion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */


/* PARA SituacionInmueble */

function insertarSituacionInmueble($situacioninmueble) {
$sql = "insert into situacioninmueble(idsituacioninmueble,situacioninmueble)
values ('','".utf8_decode($situacioninmueble)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSituacionInmueble($id,$situacioninmueble) {
$sql = "update situacioninmueble
set
situacioninmueble = '".utf8_decode($situacioninmueble)."'
where idsituacioninmueble =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSituacionInmueble($id) {
$sql = "delete from situacioninmueble where idsituacioninmueble =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSituacionInmueble() {
$sql = "select idsituacioninmueble,situacioninmueble from situacioninmueble order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSituacionInmueblePorId($id) {
$sql = "select idsituacioninmueble,situacioninmueble from situacioninmueble where idsituacioninmueble =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSituacionInmueblePorSituacionInmueble($situacioninmueble) {
$sql = "select idsituacioninmueble,situacioninmueble from situacioninmueble where situacioninmueble like '%".$situacioninmueble."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */


/* PARA Situaciones */

function insertarSituaciones($situacion) {
$sql = "insert into situaciones(idsituacion,situacion)
values ('','".utf8_decode($situacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarSituaciones($id,$situacion) {
$sql = "update situaciones
set
situacion = '".utf8_decode($situacion)."'
where idsituacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSituaciones($id) {
$sql = "delete from situaciones where idsituacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSituaciones() {
$sql = "select idsituacion,situacion from situaciones order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSituacionesPorId($id) {
$sql = "select idsituacion,situacion from situaciones where idsituacion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA Urbanizacion */

function insertarUrbanizacion($refsector,$urbanizacion) {
$sql = "insert into urbanizacion(idurbanizacion,refsector,urbanizacion)
values ('',".$refsector.",'".utf8_decode($urbanizacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUrbanizacion($id,$refsector,$urbanizacion) {
$sql = "update urbanizacion
set
refsector = ".$refsector.",urbanizacion = '".utf8_decode($urbanizacion)."'
where idurbanizacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUrbanizacion($id) {
$sql = "delete from urbanizacion where idurbanizacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUrbanizacion() {
$sql = "select 
			u.idurbanizacion, u.urbanizacion, s.sector, c.ciudad, p.provincia, pa.nombre , c.idciudad, idsector, p.idprovincia, pa.idpais
		from urbanizacion u
		inner join sector s on s.idsector = u.refsector 
		inner join ciudades c on c.idciudad = s.refciudad
		inner join provincias p on p.idprovincia = c.refprovincia
		inner join paises pa on pa.idpais = p.refpais 
		order by 2";
$res = $this->query($sql,0);
return $res;
}


function traerUrbanizacionPorId($id) {
$sql = "select idurbanizacion,refsector,urbanizacion from urbanizacion where idurbanizacion =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerUrbanizacionPorUrbanizacion($urbanizacion) {
$sql = "select idurbanizacion,refsector,urbanizacion from urbanizacion where urbanizacion like '%".$urbanizacion."%'";
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */




/* PARA Perfiles */

function insertarPerfiles($reftipousuario,$nombreperfil) {
$sql = "insert into perfiles(idperfil,reftipousuario,nombreperfil)
values ('',".$reftipousuario.",'".utf8_decode($nombreperfil)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPerfiles($id,$reftipousuario,$nombreperfil) {
$sql = "update perfiles
set
reftipousuario = ".$reftipousuario.",nombreperfil = '".utf8_decode($nombreperfil)."'
where idperfil =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPerfiles($id) {
$sql = "delete from perfiles where idperfil =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPerfiles() {
$sql = "select idperfil,reftipousuario,nombreperfil from perfiles order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPerfilesPorId($id) {
$sql = "select idperfil,reftipousuario,nombreperfil from perfiles where idperfil =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA CostoNacional */

function existeCostoNacional($refpais) {
	$sql	=	"select * from costonacional where refpais = ".$refpais;
	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		return 1;
	}
	return 0;
}

function insertarCostoNacional($refpais,$valormts,$fechamodi,$refusuario) {
$sql = "insert into costonacional(idcostonacional,refpais,valormts,fechamodi,refusuario)
values ('',".$refpais.",".$valormts.",'".utf8_decode($fechamodi)."',".$refusuario.")";
$res = $this->query($sql,1);
return $res;
}


function modificarCostoNacional($id,$refpais,$valormts,$fechamodi,$refusuario) {
$sql = "update costonacional
set
refpais = ".$refpais.",valormts = ".$valormts.",fechamodi = '".utf8_decode($fechamodi)."',refusuario = ".$refusuario."
where idcostonacional =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarCostoNacional($id) {
$sql = "delete from costonacional where idcostonacional =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCostoNacional() {
$sql = "select c.idcostonacional ,pa.nombre ,c.valormts ,c.fechamodi ,ur.apellidoynombre ,c.refusuario ,c.refpais
from costonacional c 
inner join paises pa on pa.idpais = c.refpais
inner join usuariosregistrados ur on ur.idusuarioregistrado = c.refusuario 
order by pa.nombre";
$res = $this->query($sql,0);
return $res;
}


function traerCostoNacionalPorId($id) {
$sql = "select idcostonacional,refpais,valormts,fechamodi,refusuario from costonacional where idcostonacional =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerCostoNacionalPorPais($idPais) {
$sql = "select co.idcostonacional,co.refpais,co.valormts,co.fechamodi,co.refusuario, ur.apellidoynombre
		from costonacional co 
		inner join usuariosregistrados ur on ur.idusuarioregistrado = co.refusuario 
		where refpais in (select 
            pa.idpais
        from
            ciudades cc
				inner join
			sector ss ON ss.refciudad = cc.idciudad
                inner join
            urbanizacion u ON ss.idsector = u.refsector
				inner join
			provincias p ON cc.refprovincia = p.idprovincia
				inner join
			paises pa ON pa.idpais = p.refpais
        where
            u.idurbanizacion =".$idPais.")";
$res = $this->query($sql,0);
return $res;
}

/* Fin */


/* PARA Costomts */

function insertarCostomts($refprovincia,$refciudad,$refsector,$refurbanizacion,$refuso,$valormts,$fechamodi,$refusuario) {
$sql = "insert into costomts(idcostomts,refprovincia,refciudad,refsector,refurbanizacion,refuso,valormts,fechamodi,refusuario)
values ('',".($refprovincia == '' ? 'null' : $refprovincia).",".($refciudad == '' ? 'null' : $refciudad).",".($refsector == '' ? 'null' : $refsector).",".($refurbanizacion == '' ? 'null' : $refurbanizacion).",".$refuso.",".$valormts.",'".utf8_decode($fechamodi)."',".$refusuario.")";
$res = $this->query($sql,1);
return $res;
}


function modificarCostomts($id,$refprovincia,$refciudad,$refsector,$refurbanizacion,$refuso,$valormts,$fechamodi,$refusuario) {
$sql = "update costomts
set
refprovincia = ".$refprovincia.",refciudad = ".$refciudad.",refsector = ".$refsector.",refurbanizacion = ".$refurbanizacion.",refuso = ".$refuso.",valormts = ".$valormts.",fechamodi = '".utf8_decode($fechamodi)."',refusuario = ".$refusuario."
where idcostomts =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarCostomts($id) {
$sql = "delete from costomts where idcostomts =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCostomts() {

$sql = "select
t.idcostomts,max(t.urbanizacion) as urbanizacion,max(t.sector) as sector,max(t.ciudad) as ciudad,max(t.provincia) as provincia, t.usos,t.valormts, t.fechamodi, t.apellidoynombre,t.refusuario,t.refuso
from (
	select 
		idcostomts,
		uu.urbanizacion,
		'' as sector,
		'' as ciudad,
		'' as provincia,
		u.usos,
		valormts,
		fechamodi,
		ur.apellidoynombre,
		refusuario,
		refuso
	from
		costomts c
			inner join
		urbanizacion uu ON uu.idurbanizacion = c.refurbanizacion
			inner join
		sector ss ON ss.idsector = uu.refsector
			inner join
		ciudades cc ON cc.idciudad = ss.refciudad
			inner join
		provincias p ON p.idprovincia = cc.refprovincia
			inner join
		paises pa ON pa.idpais = p.refpais
			inner join
		usos u ON u.iduso = c.refuso
			inner join
		usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario

	union all

	select 
		idcostomts,
		'' as urbanizacion,
		ss.sector as sector,
		'' as ciudad,
		'' as provincia,
		u.usos,
		valormts,
		fechamodi,
		ur.apellidoynombre,
		refusuario,
		refuso
	from
		costomts c
			inner join
		sector ss ON ss.idsector = c.refsector
			inner join
		ciudades cc ON cc.idciudad = ss.refciudad
			inner join
		provincias p ON p.idprovincia = cc.refprovincia
			inner join
		paises pa ON pa.idpais = p.refpais
			inner join
		usos u ON u.iduso = c.refuso
			inner join
		usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario

	union all

	select 
		idcostomts,
		'' as urbanizacion,
		'' as sector,
		cc.ciudad as ciudad,
		'' as provincia,
		u.usos,
		valormts,
		fechamodi,
		ur.apellidoynombre,
		refusuario,
		refuso
	from
		costomts c
			inner join
		ciudades cc ON cc.idciudad = c.refciudad
			inner join
		provincias p ON p.idprovincia = cc.refprovincia
			inner join
		paises pa ON pa.idpais = p.refpais
			inner join
		usos u ON u.iduso = c.refuso
			inner join
		usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario

	union all

	select 
		idcostomts,
		'' as urbanizacion,
		'' as sector,
		'' as ciudad,
		p.provincia as provincia,
		u.usos,
		valormts,
		fechamodi,
		ur.apellidoynombre,
		refusuario,
		refuso
	from
		costomts c
			inner join
		provincias p ON p.idprovincia = c.refprovincia
			inner join
		paises pa ON pa.idpais = p.refpais
			inner join
		usos u ON u.iduso = c.refuso
			inner join
		usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario
	) as t
	group by t.idcostomts, t.usos,t.valormts, t.fechamodi, t.apellidoynombre,t.refusuario,t.refuso
";

$res = $this->query($sql,0);
return $res;
}


function traerCostomtsPorId($id) {
$sql = "select idcostomts,refciudad,refuso,valormts,fechamodi,refusuario 
from costomts where idcostomts =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCostomtsPorCiudad($idCiudad, $iduso) {
$sql = "select
*
from	(
		select 
			idcostomts,
			CAST(CONCAT(pa.nombre,
					' - ',
					p.provincia,
					' - ',
					cc.ciudad,
					' - ',
					ss.sector,
					' - ',
					uu.urbanizacion) as CHAR(300)) as Lugar,
			'Urbanización' as tipo,		
			u.usos,
			valormts,
			fechamodi,
			ur.apellidoynombre,
			refusuario,
			refuso,
			4 as orden
		from
			costomts c
				inner join
			urbanizacion uu ON uu.idurbanizacion = c.refurbanizacion
				inner join
			sector ss ON ss.idsector = uu.refsector
				inner join
			ciudades cc ON cc.idciudad = ss.refciudad
				inner join
			provincias p ON p.idprovincia = cc.refprovincia
				inner join
			paises pa ON pa.idpais = p.refpais
				inner join
			usos u ON u.iduso = c.refuso
				inner join
			usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario
			where uu.idurbanizacion = (select
										distinct    s.idsector
										from		provincias p
										inner
										join		ciudades c ON p.idprovincia = c.refprovincia
										inner
										join		sector s ON c.idciudad = s.refciudad
										inner
										join		urbanizacion u ON s.idsector = u.refsector
										where		u.idurbanizacion = ".$idCiudad.") and c.refuso = ".$iduso."
										
		union all

		select 
			idcostomts,
			CAST(CONCAT(pa.nombre,
					' - ',
					p.provincia,
					' - ',
					cc.ciudad,
					' - ',
					ss.sector) as CHAR(300)) as Lugar,
			'Sector' as tipo,	
			u.usos,
			valormts,
			fechamodi,
			ur.apellidoynombre,
			refusuario,
			refuso,
			3 as orden
		from
			costomts c
				inner join
			sector ss ON ss.idsector = c.refsector
				inner join
			ciudades cc ON cc.idciudad = ss.refciudad
				inner join
			provincias p ON p.idprovincia = cc.refprovincia
				inner join
			paises pa ON pa.idpais = p.refpais
				inner join
			usos u ON u.iduso = c.refuso
				inner join
			usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario
			where ss.idsector = (select
										distinct    s.idsector
										from		provincias p
										inner
										join		ciudades c ON p.idprovincia = c.refprovincia
										inner
										join		sector s ON c.idciudad = s.refciudad
										inner
										join		urbanizacion u ON s.idsector = u.refsector
										where		u.idurbanizacion = ".$idCiudad.") and c.refuso = ".$iduso."
		union all

		select 
			idcostomts,
			CAST(CONCAT(pa.nombre,
					' - ',
					p.provincia,
					' - ',
					cc.ciudad) as CHAR(300)) as Lugar,
			'Ciudad' as tipo,
			u.usos,
			valormts,
			fechamodi,
			ur.apellidoynombre,
			refusuario,
			refuso,
			2 as orden
		from
			costomts c
				inner join
			ciudades cc ON cc.idciudad = c.refciudad
				inner join
			provincias p ON p.idprovincia = cc.refprovincia
				inner join
			paises pa ON pa.idpais = p.refpais
				inner join
			usos u ON u.iduso = c.refuso
				inner join
			usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario
			where cc.idciudad = (select
										distinct    c.idciudad
										from		provincias p
										inner
										join		ciudades c ON p.idprovincia = c.refprovincia
										inner
										join		sector s ON c.idciudad = s.refciudad
										inner
										join		urbanizacion u ON s.idsector = u.refsector
										where		u.idurbanizacion = ".$idCiudad.") and c.refuso = ".$iduso."
		union all

		select 
			idcostomts,
			CAST(CONCAT(pa.nombre,
					' - ',
					p.provincia) as CHAR(300)) as Lugar,
			'Provincia' as tipo,
			u.usos,
			valormts,
			fechamodi,
			ur.apellidoynombre,
			refusuario,
			refuso,
			1 as orden
		from
			costomts c
				inner join
			provincias p ON p.idprovincia = c.refprovincia
				inner join
			paises pa ON pa.idpais = p.refpais
				inner join
			usos u ON u.iduso = c.refuso
				inner join
			usuariosregistrados ur ON ur.idusuarioregistrado = c.refusuario
			where p.idprovincia = (select
										distinct    p.idprovincia
										from		provincias p
										inner
										join		ciudades c ON p.idprovincia = c.refprovincia
										inner
										join		sector s ON c.idciudad = s.refciudad
										inner
										join		urbanizacion u ON s.idsector = u.refsector
										where		u.idurbanizacion = ".$idCiudad.") and c.refuso = ".$iduso."
	) t

order by t.orden desc
        ";
		//where u.idurbanizacion =".$idCiudad.") and co.refuso = ".$iduso
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA Comision */

function insertarComision($comision) {
$sql = "insert into comision(idcomision,comision)
values ('','".utf8_decode($comision)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarComision($id,$comision) {
$sql = "update comision
set
comision = '".utf8_decode($comision)."'
where idcomision =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarComision($id) {
$sql = "delete from comision where idcomision =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerComision() {
$sql = "select idcomision,comision from comision order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerComisionPorId($id) {
$sql = "select idcomision,comision from comision where idcomision =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerComisionPorComision($comision) {
$sql = "select idcomision,comision from comision where comision =".$comision;
$res = $this->query($sql,0);

if (mysql_num_rows($res)>0) {
	return mysql_result($res,0,0);
}
return 0;
}

/* Fin */



/* PARA Pedidos */

function insertarPedidos($reftipoinformacion,$refinmueble,$refusuario,$fechapedido,$comentariousuario) {
$sql = "insert into pedidos(idpedido,reftipoinformacion,refinmueble,refusuario,fechapedido,comentariousuario)
values ('',".$reftipoinformacion.",".$refinmueble.",".$refusuario.",'".utf8_decode($fechapedido)."','".utf8_decode($comentariousuario)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPedidos($id,$reftipoinformacion,$refinmueble,$refusuario,$fechapedido,$comentariousuario) {
$sql = "update pedidos
set
reftipoinformacion = ".$reftipoinformacion.",refinmueble = ".$refinmueble.",refusuario = ".$refusuario.",fechapedido = '".utf8_decode($fechapedido)."',comentariousuario = '".utf8_decode($comentariousuario)."'
where idpedido =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPedidos($id) {
$sql = "delete from pedidos where idpedido =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPedidos() {
$sql = "select idpedido,reftipoinformacion,refinmueble,refusuario,fechapedido,comentariousuario from pedidos order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPedidosPorId($id) {
$sql = "select idpedido,reftipoinformacion,refinmueble,refusuario,fechapedido,comentariousuario from pedidos where idpedido =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */




/* PARA UsuariosRegistrados */


function insertarUsuariosRegistrados($fechadeingreso,$reftipousuario,$apellidoynombre,$nombreentidad,$celular1,$celular2,$celular3,$email1,$email2,$refsituacion,$refurbanizacion,$calle,$nro,$codpostal,$documento,$password) {
$sql = "insert into usuariosregistrados(idusuarioregistrado,fechadeingreso,reftipousuario,apellidoynombre,nombreentidad,celular1,celular2,celular3,email1,email2,refsituacion,refurbanizacion,calle,nro,codpostal,documento,password)
values ('','".utf8_decode($fechadeingreso)."',".$reftipousuario.",'".utf8_decode($apellidoynombre)."','".utf8_decode($nombreentidad)."','".utf8_decode($celular1)."','".utf8_decode($celular2)."','".utf8_decode($celular3)."','".utf8_decode($email1)."','".utf8_decode($email2)."',".$refsituacion.",".$refurbanizacion.",'".utf8_decode($calle)."','".utf8_decode($nro)."','".utf8_decode($codpostal)."','".utf8_decode($documento)."','".utf8_decode($password)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuariosRegistrados($id,$fechadeingreso,$reftipousuario,$apellidoynombre,$nombreentidad,$celular1,$celular2,$celular3,$email1,$email2,$refsituacion,$refurbanizacion,$calle,$nro,$codpostal,$documento,$password) {
$sql = "update usuariosregistrados
set
fechadeingreso = '".utf8_decode($fechadeingreso)."',reftipousuario = ".$reftipousuario.",apellidoynombre = '".utf8_decode($apellidoynombre)."',nombreentidad = '".utf8_decode($nombreentidad)."',celular1 = '".utf8_decode($celular1)."',celular2 = '".utf8_decode($celular2)."',celular3 = '".utf8_decode($celular3)."',email1 = '".utf8_decode($email1)."',email2 = '".utf8_decode($email2)."',refsituacion = ".$refsituacion.",refurbanizacion = ".$refurbanizacion.",calle = '".utf8_decode($calle)."',nro = '".utf8_decode($nro)."',codpostal = '".utf8_decode($codpostal)."',documento = '".utf8_decode($documento)."',password = '".utf8_decode($password)."'
where idusuarioregistrado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuariosRegistrados($id) {
$sql = "delete from usuariosregistrados where idusuarioregistrado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosRegistrados() {
$sql = "select 
			idusuarioregistrado,
			fechadeingreso,
			descripcion,
			apellidoynombre,
			nombreentidad,
			celular1,
			celular2,
			celular3,
			email1,
			email2,
			s.situacion,
			u.urbanizacion,
			calle,
			nro,
			codpostal,
			documento,
			password,
			reftipousuario,
			refsituacion,
			refurbanizacion
		from
			usuariosregistrados ur
				inner join
			tipousuarios tu ON tu.idtipousuario = ur.reftipousuario
				inner join
			situaciones s ON s.idsituacion = ur.refsituacion
				inner join
			urbanizacion u ON u.idurbanizacion = ur.refurbanizacion
		order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosRegistradosPorId($id) {
$sql = "select idusuarioregistrado,fechadeingreso,reftipousuario,apellidoynombre,nombreentidad,celular1,celular2,celular3,email1,email2,refsituacion,refurbanizacion,calle,nro,codpostal,documento,password from usuariosregistrados
where idusuarioregistrado =".$id;
$res = $this->query($sql,0);
return $res;
} 

/* Fin */



/* PARA Inmuebles */

function calc_edadconstruccion($anioConstruccion) {
	if ($anioConstruccion >= 0) {
		return (integer)date('Y') - (integer)$anioConstruccion;	
	}
	return 0;
}

function calc_porcentajedepreciacion($edad) {
	return $edad * 1.666666667;
}

function calc_avaluoconstruccion($mtrsConstruccion, $idprecioNacional) {
	//tabla costonacional
	$resPrecioNacional	=	$this->traerCostoNacionalPorId($idprecioNacional);
	//echo $idprecioNacional;
	return $mtrsConstruccion * mysql_result($resPrecioNacional,0,2);
}

function calc_depreciacion($edad) {
	if ($edad != 0) {
		return 60 / $edad;
	}
	return 0;
}

function calc_avaluoterreno($mtrsTerreno, $idprecio) {
	//tabla costomts
	$resPrecio	=	$this->traerCostomtsPorId($idprecio);
	return $mtrsTerreno * mysql_result($resPrecio,0,'valormts');
}

function calc_preciorealmercado() {
	//este es calc_depreciacion + calc_avaluoterreno
}

function calc_restacliente() {
	// (Precio Real del mercado) – (Precio del Cliente)  = ganancia
}

function calc_porcentaje() {
	//ganancia x100/PrecioRealdelMercado
	//calc_restacliente * 100 / calc_preciorealmercado
}


function insertarInmuebles($refurbanizacion,$reftipovivienda,$refuso,$refsituacioninmueble,$dormitorios,$banios,$encontruccion,$mts2,$anioconstruccion,$precioventapropietario,$nombrepropietario,$apellidopropietario,$fechacarga,$refusuario,$refcomision,$calc_edadconstruccion,$calc_porcentajedepreciacion,$calc_avaluoconstruccion,$calc_depreciacion,$calc_avaluoterreno,$calc_preciorealmercado,$calc_restacliente,$calc_porcentaje,$refvaloracion,$idCostoMts,$idCostoNacional,$token) {
	
	if ($token == '') {
	//calculos fijos
	$calc_edadconstruccion 			= $this->calc_edadconstruccion($anioconstruccion);
	$calc_porcentajedepreciacion 	= $this->calc_porcentajedepreciacion(date('Y') - $anioconstruccion);
	$calc_avaluoconstruccion 		= $this->calc_avaluoconstruccion( $encontruccion,$idCostoNacional);
	$calc_depreciacion 				= $this->calc_depreciacion(date('Y') - $anioconstruccion);
	$calc_avaluoterreno 			= $this->calc_avaluoterreno($mts2,$idCostoMts);
	$calc_preciorealmercado 		= $calc_depreciacion + $calc_avaluoterreno;
	$calc_restacliente 				= $calc_preciorealmercado - $precioventapropietario;
	$calc_porcentaje 				= $calc_restacliente * 100 / $calc_preciorealmercado;
	$refvaloracion 					= mysql_result($this->traerValoracionPorPorcentaje($calc_porcentaje),0,0);	
	}
	
$sql = "insert into inmuebles(idinmueble,refurbanizacion,reftipovivienda,refuso,refsituacioninmueble,dormitorios,banios,encontruccion,mts2,anioconstruccion,precioventapropietario,nombrepropietario,apellidopropietario,fechacarga,refusuario,refcomision,calc_edadconstruccion,calc_porcentajedepreciacion,calc_avaluoconstruccion,calc_depreciacion,calc_avaluoterreno,calc_preciorealmercado,calc_restacliente,calc_porcentaje,refvaloracion,token)
values ('',".$refurbanizacion.",".$reftipovivienda.",".$refuso.",".$refsituacioninmueble.",".$dormitorios.",".$banios.",".$encontruccion.",".$mts2.",".$anioconstruccion.",".$precioventapropietario.",'".utf8_decode($nombrepropietario)."','".utf8_decode($apellidopropietario)."','".utf8_decode($fechacarga)."',".$refusuario.",".$refcomision.",".$calc_edadconstruccion.",".$calc_porcentajedepreciacion.",".$calc_avaluoconstruccion.",".$calc_depreciacion.",".$calc_avaluoterreno.",".$calc_preciorealmercado.",".$calc_restacliente.",".$calc_porcentaje.",".$refvaloracion.",'".($token == '' ? ''  : $token)."')";
$res = $this->query($sql,1);
return $res;
}






function modificarInmuebles($id,$refurbanizacion,$reftipovivienda,$refuso,$refsituacioninmueble,$dormitorios,$banios,$encontruccion,$mts2,$anioconstruccion,$precioventapropietario,$nombrepropietario,$apellidopropietario,$fechacarga,$refusuario,$refcomision,$calc_edadconstruccion,$calc_porcentajedepreciacion,$calc_avaluoconstruccion,$calc_depreciacion,$calc_avaluoterreno,$calc_preciorealmercado,$calc_restacliente,$calc_porcentaje,$refvaloracion,$idCostoMts,$idCostoNacional) {
	
	//calculos fijos
	$calc_edadconstruccion 			= $this->calc_edadconstruccion($anioconstruccion);
	$calc_porcentajedepreciacion 	= $this->calc_porcentajedepreciacion(date('Y') - $anioconstruccion);
	$calc_avaluoconstruccion 		= $this->calc_avaluoconstruccion( $encontruccion,$idCostoNacional);
	$calc_depreciacion 				= $this->calc_depreciacion(date('Y') - $anioconstruccion);
	$calc_avaluoterreno 			= $this->calc_avaluoterreno($mts2,$idCostoMts);
	$calc_preciorealmercado 		= $calc_depreciacion + $calc_avaluoterreno;
	$calc_restacliente 				= $calc_preciorealmercado - $precioventapropietario;
	$calc_porcentaje 				= $calc_restacliente * 100 / $calc_preciorealmercado;
	$refvaloracion 					= mysql_result($this->traerValoracionPorPorcentaje($calc_porcentaje),0,0);	
	
	
$sql = "update inmuebles
set
refurbanizacion = ".$refurbanizacion.",reftipovivienda = ".$reftipovivienda.",refuso = ".$refuso.",refsituacioninmueble = ".$refsituacioninmueble.",dormitorios = ".$dormitorios.",banios = ".$banios.",encontruccion = ".$encontruccion.",mts2 = ".$mts2.",anioconstruccion = ".$anioconstruccion.",precioventapropietario = ".$precioventapropietario.",nombrepropietario = '".utf8_decode($nombrepropietario)."',apellidopropietario = '".utf8_decode($apellidopropietario)."',fechacarga = '".utf8_decode($fechacarga)."',refusuario = ".$refusuario.",refcomision = ".$refcomision.",calc_edadconstruccion = ".$calc_edadconstruccion.",calc_porcentajedepreciacion = ".$calc_porcentajedepreciacion.",calc_avaluoconstruccion = ".$calc_avaluoconstruccion.",calc_depreciacion = ".$calc_depreciacion.",calc_avaluoterreno = ".$calc_avaluoterreno.",calc_preciorealmercado = ".$calc_preciorealmercado.",calc_restacliente = ".$calc_restacliente.",calc_porcentaje = ".$calc_porcentaje.",refvaloracion = ".$refvaloracion."
where idinmueble =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarInmuebles($id) {
$sql = "delete from inmuebles where idinmueble =".$id;
$res = $this->query($sql,0);
return $res;
} 


function traerInmuebles() {
$sql = "
	select
i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
v.valoracion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision

from inmuebles i 
inner join valoracion v on v.idvaloracion = i.refvaloracion
inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
inner join sector ss on ss.idsector = u.refsector
inner join ciudades c on c.idciudad = ss.refciudad
inner join provincias p on p.idprovincia = c.refprovincia
inner join paises pa on pa.idpais = p.refpais
inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
inner join usos us on us.iduso = i.refuso
inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
inner join comision co on co.idcomision = i.refcomision
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerInmueblesPorId($id) {
$sql = "select idinmueble,refurbanizacion,reftipovivienda,refuso,refsituacioninmueble,dormitorios,banios,encontruccion,mts2,anioconstruccion,precioventapropietario,nombrepropietario,apellidopropietario,fechacarga,refusuario,refcomision,calc_edadconstruccion,calc_porcentajedepreciacion,calc_avaluoconstruccion,calc_depreciacion,calc_avaluoterreno,calc_preciorealmercado,calc_restacliente,calc_porcentaje,refvaloracion from inmuebles where idinmueble =".$id;
$res = $this->query($sql,0);
return $res;
} 


function buscarInmuebles($tipobusqueda,$busqueda) {
		switch ($tipobusqueda) {
			case '1':
				$sql = "select
						i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
						
						from inmuebles i 
						inner join valoracion v on v.idvaloracion = i.refvaloracion
						inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
						inner join sector ss on ss.idsector = u.refsector
						inner join ciudades c on c.idciudad = ss.refciudad
						inner join provincias p on p.idprovincia = c.refprovincia
						inner join paises pa on pa.idpais = p.refpais
						inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
						inner join usos us on us.iduso = i.refuso
						inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
						inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
						inner join comision co on co.idcomision = i.refcomision
				where pa.nombre like '%".$busqueda."%'
				order by pa.nombre,p.provincia,c.ciudad,u.urbanizacion";
				break;
			case '2':
				$sql = "select
						i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
						
						from inmuebles i 
						inner join valoracion v on v.idvaloracion = i.refvaloracion
						inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
						inner join sector ss on ss.idsector = u.refsector
						inner join ciudades c on c.idciudad = ss.refciudad
						inner join provincias p on p.idprovincia = c.refprovincia
						inner join paises pa on pa.idpais = p.refpais
						inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
						inner join usos us on us.iduso = i.refuso
						inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
						inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
						inner join comision co on co.idcomision = i.refcomision
				where p.provincia like '%".$busqueda."%'
				order by pa.nombre,p.provincia,c.ciudad,u.urbanizacion";
				break;
			case '3':
				$sql = "select
						i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
						
						from inmuebles i 
						inner join valoracion v on v.idvaloracion = i.refvaloracion
						inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
						inner join sector ss on ss.idsector = u.refsector
						inner join ciudades c on c.idciudad = ss.refciudad
						inner join provincias p on p.idprovincia = c.refprovincia
						inner join paises pa on pa.idpais = p.refpais
						inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
						inner join usos us on us.iduso = i.refuso
						inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
						inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
						inner join comision co on co.idcomision = i.refcomision
				where i.nombrepropietario like '%".$busqueda."%'
				order by pa.nombre,p.provincia,c.ciudad,u.urbanizacion, i.nombrepropietario";
				break;
			case '4':
				$sql = "select
						i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
						
						from inmuebles i 
						inner join valoracion v on v.idvaloracion = i.refvaloracion
						inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
						inner join sector ss on ss.idsector = u.refsector
						inner join ciudades c on c.idciudad = ss.refciudad
						inner join provincias p on p.idprovincia = c.refprovincia
						inner join paises pa on pa.idpais = p.refpais
						inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
						inner join usos us on us.iduso = i.refuso
						inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
						inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
						inner join comision co on co.idcomision = i.refcomision
				where i.apellidopropietario like '%".$busqueda."%'
				order by pa.nombre,p.provincia,c.ciudad,u.urbanizacion, i.apellidopropietario";
				break;
			case '5':
				$sql = "select
						i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
						
						from inmuebles i 
						inner join valoracion v on v.idvaloracion = i.refvaloracion
						inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
						inner join sector ss on ss.idsector = u.refsector
						inner join ciudades c on c.idciudad = ss.refciudad
						inner join provincias p on p.idprovincia = c.refprovincia
						inner join paises pa on pa.idpais = p.refpais
						inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
						inner join usos us on us.iduso = i.refuso
						inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
						inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
						inner join comision co on co.idcomision = i.refcomision
				where v.observacion = ".$busqueda."
				order by pa.nombre,p.provincia,c.ciudad,u.urbanizacion";
				break;
		
		}
		return $this->query($sql,0);
	}

function graficosValoracion($where) {
	if ($where != '') {
		$sql = "select
			i.refvaloracion, count(*)
		
		from inmuebles i 
			inner join valoracion v on v.idvaloracion = i.refvaloracion
			inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
			inner join sector ss on ss.idsector = u.refsector
			inner join ciudades c on c.idciudad = ss.refciudad
			inner join provincias p on p.idprovincia = c.refprovincia
			inner join paises pa on pa.idpais = p.refpais
			inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
			inner join usos us on us.iduso = i.refuso
			inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
			inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
			inner join comision co on co.idcomision = i.refcomision
		group by i.refvaloracion
		order by i.refvaloracion
		";
		
		
		$sqlT = "select
			count(*)
		
		from inmuebles i 
			inner join valoracion v on v.idvaloracion = i.refvaloracion
			inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
			inner join sector ss on ss.idsector = u.refsector
			inner join ciudades c on c.idciudad = ss.refciudad
			inner join provincias p on p.idprovincia = c.refprovincia
			inner join paises pa on pa.idpais = p.refpais
			inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
			inner join usos us on us.iduso = i.refuso
			inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
			inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
			inner join comision co on co.idcomision = i.refcomision
				";

		
	} else {
		$sql = "select
					i.refvaloracion, count(*)
				
				from inmuebles i 
					inner join valoracion v on v.idvaloracion = i.refvaloracion
					inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					inner join sector ss on ss.idsector = u.refsector
					inner join ciudades c on c.idciudad = ss.refciudad
					inner join provincias p on p.idprovincia = c.refprovincia
					inner join paises pa on pa.idpais = p.refpais
					inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					inner join usos us on us.iduso = i.refuso
					inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					inner join comision co on co.idcomision = i.refcomision
				group by i.refvaloracion
				order by i.refvaloracion
				";
				
		$sqlT = "select
					count(*)
				
				from inmuebles i 
					inner join valoracion v on v.idvaloracion = i.refvaloracion
					inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					inner join sector ss on ss.idsector = u.refsector
					inner join ciudades c on c.idciudad = ss.refciudad
					inner join provincias p on p.idprovincia = c.refprovincia
					inner join paises pa on pa.idpais = p.refpais
					inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					inner join usos us on us.iduso = i.refuso
					inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					inner join comision co on co.idcomision = i.refcomision
				";
	}
	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$porcentajeOportunidad = 0;
	$porcentajeNormal = 0;
	$porcentajeCaro = 0;
	$porcentajeFueraMercado = 0;
	
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			switch ($row[0]) {
				case 1:
					$porcentajeOportunidad	=	(100 * $row[1])	/ $resT;
					break;
				case 2:
					$porcentajeNormal		=	(100 * $row[1])	/ $resT;
					break;
				case 3:
					$porcentajeCaro			=	(100 * $row[1])	/ $resT;
					break;
				case 4:
					$porcentajeFueraMercado	=	(100 * $row[1])	/ $resT;
					break;
			}
		}
	}
	
	$cad	= "Morris.Donut({
              element: 'graph',
              data: [
                {value: ".$porcentajeOportunidad.", label: 'Oportunidad'},
                {value: ".$porcentajeNormal.", label: 'Normal'},
                {value: ".$porcentajeCaro.", label: 'Caro'},
                {value: ".$porcentajeFueraMercado.", label: 'Fuera del Mercado'}
              ],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}


function graficosTipoVivienda($where) {
	
	/*
	i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
	
	*/
	if ($where != '') {
		$sql = "select
					tv.idtipovivienda, tv.tipovivienda, coalesce(count(i.reftipovivienda),0)
				
				from tipovivienda tv 
					left join inmuebles i on tv.idtipovivienda = i.reftipovivienda
					left join valoracion v on v.idvaloracion = i.refvaloracion
					left join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					left join usos us on us.iduso = i.refuso
					left join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					left join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					left join comision co on co.idcomision = i.refcomision
				group by tv.idtipovivienda, tv.tipovivienda
				order by tv.idtipovivienda
		";
		
		
		$sqlT = "select
			count(*)
		
		from inmuebles i 
			inner join valoracion v on v.idvaloracion = i.refvaloracion
			inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
			inner join sector ss on ss.idsector = u.refsector
			inner join ciudades c on c.idciudad = ss.refciudad
			inner join provincias p on p.idprovincia = c.refprovincia
			inner join paises pa on pa.idpais = p.refpais
			inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
			inner join usos us on us.iduso = i.refuso
			inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
			inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
			inner join comision co on co.idcomision = i.refcomision
				";

		
	} else {
		$sql = "select
					tv.idtipovivienda, tv.tipovivienda, coalesce(count(i.reftipovivienda),0)
				
				from tipovivienda tv 
					left join inmuebles i on tv.idtipovivienda = i.reftipovivienda
					left join valoracion v on v.idvaloracion = i.refvaloracion
					left join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					
					left join usos us on us.iduso = i.refuso
					left join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					left join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					left join comision co on co.idcomision = i.refcomision
				group by tv.idtipovivienda, tv.tipovivienda
				order by tv.idtipovivienda
				";
				
		$sqlT = "select
					count(*)
				
				from inmuebles i 
					inner join valoracion v on v.idvaloracion = i.refvaloracion
					inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					inner join sector ss on ss.idsector = u.refsector
					inner join ciudades c on c.idciudad = ss.refciudad
					inner join provincias p on p.idprovincia = c.refprovincia
					inner join paises pa on pa.idpais = p.refpais
					inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					inner join usos us on us.iduso = i.refuso
					inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					inner join comision co on co.idcomision = i.refcomision
				";
	}
	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph2',
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	
/*
                {value: ".$porcentajeOportunidad.", label: 'Oportunidad'},
                {value: ".$porcentajeNormal.", label: 'Normal'},
                {value: ".$porcentajeCaro.", label: 'Caro'},
                {value: ".$porcentajeFueraMercado.", label: 'Fuera del Mercado'}*/
	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}


function graficosUsos($where) {
	
	/*
	i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
						i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
						i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
						i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
						v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
						i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
	
	*/
	if ($where != '') {
		$sql = "select
					us.iduso, us.usos, coalesce(count(i.reftipovivienda),0)
				
				from usos us 
					left join inmuebles i on us.iduso = i.refuso
					left join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					left join valoracion v on v.idvaloracion = i.refvaloracion
					left join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					
					left join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					left join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					left join comision co on co.idcomision = i.refcomision
				group by us.iduso, us.usos
				order by us.iduso
		";
		
		
		$sqlT = "select
			count(*)
		
		from inmuebles i 
			inner join valoracion v on v.idvaloracion = i.refvaloracion
			inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
			inner join sector ss on ss.idsector = u.refsector
			inner join ciudades c on c.idciudad = ss.refciudad
			inner join provincias p on p.idprovincia = c.refprovincia
			inner join paises pa on pa.idpais = p.refpais
			inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
			inner join usos us on us.iduso = i.refuso
			inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
			inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
			inner join comision co on co.idcomision = i.refcomision
				";

		
	} else {
		$sql = "select
					us.iduso, us.usos, coalesce(count(i.reftipovivienda),0)
				
				from usos us 
					left join inmuebles i on us.iduso = i.refuso
					left join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					left join valoracion v on v.idvaloracion = i.refvaloracion
					left join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					
					left join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					left join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					left join comision co on co.idcomision = i.refcomision
				group by us.iduso, us.usos
				order by us.iduso
				";
				
		$sqlT = "select
					count(*)
				
				from inmuebles i 
					inner join valoracion v on v.idvaloracion = i.refvaloracion
					inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
					inner join sector ss on ss.idsector = u.refsector
					inner join ciudades c on c.idciudad = ss.refciudad
					inner join provincias p on p.idprovincia = c.refprovincia
					inner join paises pa on pa.idpais = p.refpais
					inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
					inner join usos us on us.iduso = i.refuso
					inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
					inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
					inner join comision co on co.idcomision = i.refcomision
				";
	}
	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph3',
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	
/*
                {value: ".$porcentajeOportunidad.", label: 'Oportunidad'},
                {value: ".$porcentajeNormal.", label: 'Normal'},
                {value: ".$porcentajeCaro.", label: 'Caro'},
                {value: ".$porcentajeFueraMercado.", label: 'Fuera del Mercado'}*/
	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}

function filtros($where) {
	
	if ($where != '') {
				$sql = "select
				i.idinmueble,v.observacion, i.dormitorios, i.banios, i.encontruccion, i.mts2,
				i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
				i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
				i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
				u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
				i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
				
				from inmuebles i 
				inner join valoracion v on v.idvaloracion = i.refvaloracion
				inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
				inner join sector ss on ss.idsector = u.refsector
				inner join ciudades c on c.idciudad = ss.refciudad
				inner join provincias p on p.idprovincia = c.refprovincia
				inner join paises pa on pa.idpais = p.refpais
				inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
				inner join usos us on us.iduso = i.refuso
				inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
				inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
				inner join comision co on co.idcomision = i.refcomision

		order by i.refvaloracion,pa.nombre,p.provincia,c.ciudad,u.urbanizacion";

		
	} else {
		$sql = "select
				i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
				i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
				i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
				i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
				v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
				i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
				
				from inmuebles i 
				inner join valoracion v on v.idvaloracion = i.refvaloracion
				inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
				inner join sector ss on ss.idsector = u.refsector
				inner join ciudades c on c.idciudad = ss.refciudad
				inner join provincias p on p.idprovincia = c.refprovincia
				inner join paises pa on pa.idpais = p.refpais
				inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
				inner join usos us on us.iduso = i.refuso
				inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
				inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
				inner join comision co on co.idcomision = i.refcomision

		order by i.refvaloracion,pa.nombre,p.provincia,c.ciudad,u.urbanizacion";
	}
	
	return $this->query($sql,0);
		
}


function Oportunidades($where) {
	
	if ($where != '') {
				$sql = "select
				i.idinmueble,v.observacion, i.dormitorios, i.banios, i.encontruccion, i.mts2,
				i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
				i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
				i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
				u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
				i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
				
				from inmuebles i 
				inner join valoracion v on v.idvaloracion = i.refvaloracion
				inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
				inner join sector ss on ss.idsector = u.refsector
				inner join ciudades c on c.idciudad = ss.refciudad
				inner join provincias p on p.idprovincia = c.refprovincia
				inner join paises pa on pa.idpais = p.refpais
				inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
				inner join usos us on us.iduso = i.refuso
				inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
				inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
				inner join comision co on co.idcomision = i.refcomision
				where v.idvaloracion = 1
		order by i.calc_porcentaje";

		
	} else {
		$sql = "select
				i.idinmueble, i.dormitorios, i.banios, i.encontruccion, i.mts2,
				i.anioconstruccion, i.precioventapropietario, i.nombrepropietario, i.apellidopropietario, i.fechacarga,
				i.calc_edadconstruccion, i.calc_porcentajedepreciacion, i.calc_avaluoconstruccion, i.calc_depreciacion, i.calc_avaluoterreno,
				i.calc_preciorealmercado, i.calc_restacliente, i.calc_porcentaje,
				v.observacion, u.urbanizacion, c.ciudad, p.provincia, pa.nombre, tv.tipovivienda, us.usos, si.situacioninmueble, ur.apellidoynombre, co.comision,
				i.refvaloracion, i.refurbanizacion, i.reftipovivienda, i.refuso, i.refsituacioninmueble, i.refusuario, i.refcomision
				
				from inmuebles i 
				inner join valoracion v on v.idvaloracion = i.refvaloracion
				inner join urbanizacion u on u.idurbanizacion = i.refurbanizacion
				inner join sector ss on ss.idsector = u.refsector
				inner join ciudades c on c.idciudad = ss.refciudad
				inner join provincias p on p.idprovincia = c.refprovincia
				inner join paises pa on pa.idpais = p.refpais
				inner join tipovivienda tv on tv.idtipovivienda = i.reftipovivienda
				inner join usos us on us.iduso = i.refuso
				inner join situacioninmueble si on si.idsituacioninmueble = i.refsituacioninmueble
				inner join usuariosregistrados ur on ur.idusuarioregistrado = i.refusuario
				inner join comision co on co.idcomision = i.refcomision
				where v.idvaloracion = 1
		order by i.calc_porcentaje";
	}
	
	return $this->query($sql,0);
	//return $sql;	
}

/* Fin */

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