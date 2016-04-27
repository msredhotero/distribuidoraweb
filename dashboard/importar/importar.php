<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesReferencias.php');

$serviciosFunciones 	= new Servicios();
$serviciosUsuario 		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Imnuebles",$_SESSION['refroll_predio'],'');


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Imnueble";

$plural = "Imnuebles";

$eliminar = "eliminarInmuebles";

$insertar = "insertarInmuebles";

$tituloWeb = "Gestión: Caracol Bienes Raíces";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "inmuebles";


$lblCambio	 	= array("banios",'encontruccion','anioconstruccion','precioventapropietario','nombrepropietario','apellidopropietario','fechacarga','calc_edadconstruccion','calc_porcentajedepreciacion','calc_avaluoconstruccion','calc_depreciacion','calc_avaluoterreno','calc_preciorealmercado','calc_restacliente','calc_porcentaje','refvaloracion','refurbanizacion','reftipovivienda','refuso','refsituacioninmueble','refusuario','refcomision');
$lblreemplazo	= array("Baños",'En Contrucción','Año Construcción','Precio Venta Propietario','Nombre Propietario','Apellido Propietario','Fecha Carga','Calc. Edad Construcción','Calc. % Depreciación','Calc. Avaluo Construcción','Calc. Depreciación','Calc. Avaluo Terreno','Calc. Precio Real Mercado','Calc. Resta Cliente','Calc. Porcentaje','Valoración','Urbanización','Tipo Vivienda','Uso','Situac. Inmueble','Usuario','Comisión');

$cadRef = '';

$refdescripcion = array(0 => "");
$refCampo[] 	= ""; 
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




/////////////////////// Opciones para la creacion del view  /////////////////////


//////////////////////////////////////////////  FIN de los opciones //////////////////////////



$resUrbanizacion	=	$serviciosReferencias->traerUrbanizacion();
$resTipoVivienda	=	$serviciosReferencias->traerTipoVivienda();
$resUsos			=	$serviciosReferencias->traerUsos();
$resComision		=	$serviciosReferencias->traerComision();
$resSitInm			=	$serviciosReferencias->traerSituacionInmueble();

if ($_SESSION['idroll_predio'] == 1) {
	$resUsuario = $serviciosReferencias->traerUsuariosRegistrados();
} else {
	$resUsuario = $serviciosReferencias->traerUsuariosRegistradosPorId($_SESSION['idusuario']);
}

//$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
//die(var_dump($_FILES['archivo']['name']));


$dir_destino = '../../archivos/';
	$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES['archivo']['name'])));
	
	//$noentrar = '../imagenes/index.php';
	//$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idInmueble.'/'.'index.php';
	
	if (!file_exists($dir_destino)) {
    	mkdir($dir_destino, 0777);
	}
	
	 
	if(!is_writable($dir_destino)){
		
		echo "no tiene permisos";
		
	}	else	{
		if ($_FILES['archivo']['tmp_name'] != '') {
			if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
				/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
				echo "Mostrar contenido\n";
				echo $imagen_subida;*/
				if (move_uploaded_file($_FILES['archivo']['tmp_name'], $imagen_subida)) {
					
					$archivo = utf8_decode($_FILES['archivo']["name"]);
					$tipoarchivo = $_FILES['archivo']["type"];
					
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
				echo "nombre del archivo '". $_FILES['archivo']['tmp_name'] . "'.";
			}
		}
	}
	
$res = $serviciosReferencias->cargarExcel($_FILES['archivo']['name'],$_FILES['archivo']['name'],$_SESSION['idusuario']);
$cant = $res['cantidad']-1;
$res = $serviciosReferencias->traerImportar($res['token']);

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
  
		
	</style>
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <link rel="stylesheet" href="../../css/chosen.css">
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de <?php echo $plural; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form name="form" action="mergearimportacion.php" method="post">
            <h3>Importado con exito!!!. Registros cargado: <?php echo $cant; ?></h3>
           	<h4>Datos Importados</h4>
            
            <table class="table table-bordered table-responsive table-striped">
            	<thead>
                	<th>Dormitorios</th>
                    <th>Banios</th>	
                    <th>Mts en contruc.</th>	
                    <th>Mts2</th>	
                    <th>Anio Construc.</th>	
                    <th>Precio Venta Propietario</th>	
                    <th>Nombre Propietario</th>	
                    <th>Apellido Propietario</th>	
                    <th>Fec. Carga</th>	
                    <th>Calc.Edad Construc.</th>	
                    <th>Calc. % Deprec.</th>	
                    <th>Calc.Avaluo Construc.</th>	
                    <th>Calc.Depreciacion</th>	
                    <th>Precio real de construccion</th>	
                    <th>Calc.Avaluo Terreno</th>	
                    <th>Calc.Precio Real Mercado</th>	
                    <th>Calc.Resta Cliente</th>	
                    <th>Calc. %	Valoracion</th>	
                    <th>Valoración</th>	
                    <th>Urbanizacion</th>	
                    <th>Sector</th>	
                    <th>Ciudad</th>	
                    <th>Provincia</th>	
                    <th>Pais</th>	
                    <th>Tipo Vivienda</th>	
                    <th>Usos</th>	
                    <th>Situacion Inmueble</th>	
                    <th>Usuario</th>	
                    <th>Comision</th>
                </thead>
                <tbody>
                	<?php
						$c = 0;
						
						while ($row = mysql_fetch_array($res)) {
							$c += 1;
					?>
                    	<tr>
                        	
                            <td><input class="form-control" type="text" id="dormitorio<?php echo $c; ?>" name="dormitorio<?php echo $c; ?>" value="<?php echo $row[1]; ?>"/></td>	
                            <td><input class="form-control" type="text" id="Banios<?php echo $c; ?>" name="Banios<?php echo $c; ?>" value="<?php echo $row[2]; ?>"/></td>	
                            <td><input class="form-control" type="text" id="mtsencontruc<?php echo $c; ?>" name="mtsencontruc<?php echo $c; ?>" value="<?php echo $row[3]; ?>" style="width:100px;"/></td>	
                            <td><input class="form-control" type="text" id="mts2<?php echo $c; ?>" name="mts2<?php echo $c; ?>" value="<?php echo $row[4]; ?>" style="width:100px;"/></td>	
                            <td><input class="form-control" type="text" id="anioconstruc<?php echo $c; ?>" name="anioconstruc<?php echo $c; ?>" value="<?php echo $row[5]; ?>"/></td>	
                            <td><input class="form-control" type="text" id="precioventapropietario<?php echo $c; ?>" name="precioventapropietario<?php echo $c; ?>" value="<?php echo $row[6]; ?>" style="width:100px;"/></td>	
                            <td><input class="form-control" type="text" id="nombrepropietario<?php echo $c; ?>" name="nombrepropietario<?php echo $c; ?>" value="<?php echo $row[7]; ?>" style="width:140px;"/></td>	
                            <td><input class="form-control" type="text" id="apellidopropietario<?php echo $c; ?>" name="apellidopropietario<?php echo $c; ?>" value="<?php echo $row[8]; ?>" style="width:140px;"/></td>	
                            <td><input class="form-control" type="text" id="feccarga<?php echo $c; ?>" name="feccarga<?php echo $c; ?>" value="<?php echo $row[9]; ?>" style="width:80px;"/></td>	
                            <td><input type="text" id="calcedadconstruc<?php echo $c; ?>" name="calcedadconstruc<?php echo $c; ?>" class="form-control" value="<?php echo $row[10]; ?>" style="width:110px;"/></td>	
                            <td><input type="text" id="calcporcdeprec<?php echo $c; ?>" name="calcporcdeprec<?php echo $c; ?>" class="form-control" value="<?php echo $row[11]; ?>" style="width:110px;"/></td>	
                            <td><input type="text" id="calcavaluoconstruc<?php echo $c; ?>" class="form-control" name="calcavaluoconstruc<?php echo $c; ?>" value="<?php echo $row[12]; ?>" style="width:110px;"/></td>	
                            <td><input type="text" class="form-control" id="calcdepreciacion<?php echo $c; ?>" name="calcdepreciacion<?php echo $c; ?>" value="<?php echo $row[13]; ?>" style="width:110px;"/></td>	
                            <td><input type="text" class="form-control" id="preciorealconstruc<?php echo $c; ?>" name="preciorealconstruc<?php echo $c; ?>" value="<?php echo $row[14]; ?>" style="width:110px;"/></td>	
                            <td><input class="form-control" type="text" id="calcavaluoterreno<?php echo $c; ?>" name="calcavaluoterreno<?php echo $c; ?>" value="<?php echo $row[15]; ?>" style="width:110px;"/></td>	
                            <td><input class="form-control" type="text" id="calcpreciorealmercado<?php echo $c; ?>" name="calcpreciorealmercado<?php echo $c; ?>" value="<?php echo $row[16]; ?>" style="width:110px;"/></td>	
                            <td><input class="form-control" type="text" id="calcrestacliente<?php echo $c; ?>" name="calcrestacliente<?php echo $c; ?>" value="<?php echo $row[17]; ?>" style="width:110px;"/></td>	
                            <td><input class="form-control" type="text" id="calcvaloracion<?php echo $c; ?>" name="calcporcvaloracion<?php echo $c; ?>" value="<?php echo $row[18]; ?>" style="width:110px;"/></td>	
                            <td>
								<select class="form-control" name="valoracion<?php echo $c; ?>" id="valoracion<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[19]; ?></option>
                            	
                                </select>
                            </td>	
                            <td>
								<select class="form-control" name="urbanizacion<?php echo $c; ?>" id="urbanizacion<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[20]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="sector<?php echo $c; ?>" id="sector<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[21]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="ciudad<?php echo $c; ?>" id="ciudad<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[22]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="provincia<?php echo $c; ?>" id="provincia<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[23]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="pais<?php echo $c; ?>" id="pais<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[24]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="tipovivienda<?php echo $c; ?>" id="tipovivienda<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[25]; ?></option>
                            	
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="usos<?php echo $c; ?>" id="usos<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[26]; ?></option>
                            	
                                </select>
                            </td>
							<td>
								<select class="form-control" name="situacioninmueble<?php echo $c; ?>" id="situacioninmueble<?php echo $c; ?>" style="width:140px;">
									<option value=""><?php echo $row[27]; ?></option>
                            	
                                </select>
                            </td>
                            <td><input class="form-control" type="text" id="usuario<?php echo $c; ?>" name="usuario<?php echo $c; ?>" value="<?php echo $row[28]; ?>" style="width:140px;"/></td>
                            <td><input class="form-control" type="text" id="comision<?php echo $c; ?>" name="comision<?php echo $c; ?>" value="<?php echo $row[29]; ?>"/></td>
                        </tr>
                    
                    <?php
						}
					?>
                </tbody>
            </table>
            
            </form>
    	</div>
    </div>
    
    
    
    

    
    
   
</div>


</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	

});
</script>

<?php } ?>
</body>
</html>
