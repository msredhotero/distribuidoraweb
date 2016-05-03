<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funciones.php');
include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');

$serviciosFunciones 	= new Servicios();
$serviciosUsuario 		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();


$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Dashboard",$_SESSION['refroll_predio'],$_SESSION['usua_empresa']);


/////////////////////// Opciones pagina ///////////////////////////////////////////////

$tituloWeb = "Gestión: Distribuidora Discas";
//////////////////////// Fin opciones ////////////////////////////////////////////////


$sql2 = "SELECT a.[codigo],a.[codigo]
      ,[descripcion]
      ,[Tipo]
      ,[Faltante]
      ,[costo]
      ,[costo2]
      ,[costo3]
      ,[Unidades]
      ,[Cant2]
      ,[CostoUnd]
      ,[stock]
      ,[modificado]
      ,[stockanterior]
      ,[valor]
      ,[PedirProveedor]
      ,[PorcenAumento]
      ,[Kilos]

  FROM [Distribuidora].[dbo].[articulos] a
  inner
  join	proveedores p
  on	a.proveedor = p.proveedor --and p.Activo = 1
  where p.id = ".$_SESSION['usua_idempresa']."
  order by a.descripcion";
  
  $sql = "SELECT a.[codigo],a.[codigo]
      ,[descripcion]
      ,[Tipo]
      ,[Faltante]
      ,[stock]
      ,[stockanterior]
      ,[PedirProveedor]

  FROM [Distribuidora].[dbo].[articulos] a
  inner
  join	proveedores p
  on	a.proveedor = p.proveedor --and p.Activo = 1
  where p.id = ".$_SESSION['usua_idempresa']."
  order by a.descripcion";
 // echo $sql;
  $serverName = "WIN-9BC91H82UD8\sqlexpress";
	//$connectionInfo = array( "Database"=>"Distribuidora");
	//$connectionInfo = array("UID"=>"usuario", "PWD"=>"distribuidora", "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$connectionInfo = array( "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$conex = sqlsrv_connect( $serverName, $connectionInfo);
		
  $resProveedor = sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
  
  /////////////////////// Opciones para la creacion del view  /////////////////////
$cabeceras2 		= "	<th>Codigo</th>
				<th>Descripción</th>
				<th>Tipo</th>
				<th>Faltante</th>
				<th>Costo</th>
				<th>Costo 2</th>
				<th>Costo 3</th>
				<th>Unidades</th>
				<th>Cant.</th>
				<th>CostoUnd</th>
				<th>Stock</th>
				<th>Modificado</th>
				<th>Stock Anterior</th>
				<th>Valor</th>
				<th>Pedir Prove.</th>
				<th>% Aumento</th>
				<th>Kilos</th>";
				
$cabeceras 		= "	<th>Codigo</th>
				<th>Descripción</th>
				<th>Tipo</th>
				<th>Falta</th>
				<th>Stock</th>
				<th>Stock Anterior</th>
				<th>Pedir Prove.</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////

  //$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$resProveedor,99);
  	$cadView = '';
	$cadRows = '';
		
  	$cantidad = 7;
	$classMod = 'varver';
	$classEli = '';
	$idresultados = "resultados";
				
  $cadView = '';
		$cadRows = '';
		switch ($cantidad) {
			case 99:
				$cantidad = 7;
				$classMod = 'varver';
				$classEli = '';
				$idresultados = "resultados";
				break;
			case 98:
				$cantidad = 3;
				$classMod = 'varmodificarpredio';
				$classEli = 'varborrarpredio';
				$idresultados = "resultadospredio";
				break;
			case 97:
				$cantidad = 3;
				$classMod = 'varmodificarprincipal';
				$classEli = 'varborrarprincipal';
				$idresultados = "resultadosprincipal";
				break;
			default:
				$classMod = 'varmodificar';
				$classEli = 'varborrar';
				$idresultados = "resultados";
		}
		/*if ($cantidad == 99) {
			$cantidad = 5;
			$classMod = 'varmodificargoleadores';
			$classEli = 'varborrargoleadores';
			$idresultados = "resultadosgoleadores";
		} else {
			$classMod = 'varmodificar';
			$classEli = 'varborrar';
			$idresultados = "resultados";
		}*/
		
		while ($row = sqlsrv_fetch_array($resProveedor, SQLSRV_FETCH_NUMERIC)) {
			$cadsubRows = '';
			$cadRows = $cadRows.'
			
					<tr class="'.$row[0].'">
                        	';
			
			
			for ($i=1;$i<=$cantidad;$i++) {
				
				$cadsubRows = $cadsubRows.'<td><div>'.$row[$i].'</div></td>';	
			}
			
			
			if ($classMod != '') { 
				$cadRows = $cadRows.'
								'.$cadsubRows.'
								<td>
									
									<div class="btn-group" id="botonM">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
										   
											<li>
											<a href="javascript:void(0)" class="'.$classMod.'" id="'.$row[0].'">Ver</a>
											</li>
										

											
										</ul>
									</div>
									<a href="javascript:void(0)" class="'.$classMod.' verM" id="'.$row[0].'">Ver</a>
								</td>
							</tr>
				';
			} else {
				$cadRows = $cadRows.'
								'.$cadsubRows.'
								<td>
									
									<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
										
											<li>
											<a href="javascript:void(0)" class="'.$classEli.'" id="'.$row[0].'">Borrar</a>
											</li>
											
										</ul>
									</div>
								</td>
							</tr>
				';
			}
		}
		
		$cadView = $cadView.'
			<table class="table table-striped table-responsive table-bordered" id="example">
            	<thead>
                	<tr>
                    	'.$cabeceras.'
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="'.$idresultados.'">

                	'.utf8_encode($cadRows).'
                </tbody>
            </table>
			<div style="margin-bottom:85px; margin-right:60px;"></div>
		
		';	
?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

	
    
   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <link rel="stylesheet" href="../css/chosen.css">
    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="../js/graficos/morris.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
	<script src="../lib/example.js"></script>
  	<link rel="stylesheet" href="../lib/example.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
    <link rel="stylesheet" href="../css/graficos/morris.css">
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">

<h3>Dashboard</h3>

    <div class="row" style="margin-right:15px;">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	Lista de Articulos
            </div>
            <div class="panel-body">
            	<?php echo $cadView; ?>
            </div>
        </div>
    </div>
    
    



</div>



<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  
  <script>
  $(function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $( "#fechacarga" ).datepicker();

    $( "#fechacarga" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('.abrir').click(function() {
		
		if ($('.abrir').text() == '(Abrir)') {
			$('.filt').show( "slow" );
			$('.abrir').text('(Cerrar)');
			$('.abrir').removeClass('glyphicon glyphicon-plus');
			$('.abrir').addClass('glyphicon glyphicon-minus');
		} else {
			$('.filt').slideToggle( "slow" );
			$('.abrir').text('(Abrir)');
			$('.abrir').addClass('glyphicon glyphicon-plus');
			$('.abrir').removeClass('glyphicon glyphicon-minus');

		}
	});
	
	$('.abrir').click();
	
	$('.abrir').click(function() {
		$('.filt').show();
	});
	
	function traerInmuebles() {
		$.ajax({
				data:  {refurbanizacion : $('#refurbanizacion').val(),
						reftipovivienda : $('#reftipovivienda').val(),
						refuso : $('#refuso').val(),
						refsituacioninmueble : $('#refsituacioninmueble').val(),
						dormitorios : $('#dormitorios').val(),
						banios : $('#banios').val(),
						encontruccion : $('#encontruccion').val(),
						mts2 : $('#mts2').val(),
						anioconstruccion : $('#anioconstruccion').val(),
						precioventapropietario : $('#precioventapropietario').val(),
						nombrepropietario : $('#nombrepropietario').val(),
						apellidopropietario : $('#apellidopropietario').val(),
						fechacarga : $('#fechacarga').val(),
						refusuario : $('#refusuario').val(),
						refcomision : $('#refcomision').val(),
						accion: 'Filtros'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('.resultados').html(response);
						
				}
		});
	}
	
	
	function traerOportunidades() {
		$.ajax({
				data:  {refurbanizacion : $('#refurbanizacion').val(),
						reftipovivienda : $('#reftipovivienda').val(),
						refuso : $('#refuso').val(),
						refsituacioninmueble : $('#refsituacioninmueble').val(),
						dormitorios : $('#dormitorios').val(),
						banios : $('#banios').val(),
						encontruccion : $('#encontruccion').val(),
						mts2 : $('#mts2').val(),
						anioconstruccion : $('#anioconstruccion').val(),
						precioventapropietario : $('#precioventapropietario').val(),
						nombrepropietario : $('#nombrepropietario').val(),
						apellidopropietario : $('#apellidopropietario').val(),
						fechacarga : $('#fechacarga').val(),
						refusuario : $('#refusuario').val(),
						refcomision : $('#refcomision').val(),
						accion: 'Oportunidades'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('.oportunidades').html(response);
						
				}
		});
	}
	
	function graficos() {
	
	  eval($('#code').text());
	  prettyPrint();
	}
	
	function graficosTV() {
	
	  eval($('#code2').text());
	  prettyPrint();
	}
	
	function graficosU() {
	
	  eval($('#code3').text());
	  prettyPrint();
	}
	
	function GraficoValoracion() {
		$.ajax({
				data:  {refurbanizacion : $('#refurbanizacion').val(),
						reftipovivienda : $('#reftipovivienda').val(),
						refuso : $('#refuso').val(),
						refsituacioninmueble : $('#refsituacioninmueble').val(),
						dormitorios : $('#dormitorios').val(),
						banios : $('#banios').val(),
						encontruccion : $('#encontruccion').val(),
						mts2 : $('#mts2').val(),
						anioconstruccion : $('#anioconstruccion').val(),
						precioventapropietario : $('#precioventapropietario').val(),
						nombrepropietario : $('#nombrepropietario').val(),
						apellidopropietario : $('#apellidopropietario').val(),
						fechacarga : $('#fechacarga').val(),
						refusuario : $('#refusuario').val(),
						refcomision : $('#refcomision').val(),
						accion: 'graficosValoracion'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#code').html(response);
						graficos();
				}
		});
	}
	
	function GraficosTipoVivienda() {
		$.ajax({
				data:  {refurbanizacion : $('#refurbanizacion').val(),
						reftipovivienda : $('#reftipovivienda').val(),
						refuso : $('#refuso').val(),
						refsituacioninmueble : $('#refsituacioninmueble').val(),
						dormitorios : $('#dormitorios').val(),
						banios : $('#banios').val(),
						encontruccion : $('#encontruccion').val(),
						mts2 : $('#mts2').val(),
						anioconstruccion : $('#anioconstruccion').val(),
						precioventapropietario : $('#precioventapropietario').val(),
						nombrepropietario : $('#nombrepropietario').val(),
						apellidopropietario : $('#apellidopropietario').val(),
						fechacarga : $('#fechacarga').val(),
						refusuario : $('#refusuario').val(),
						refcomision : $('#refcomision').val(),
						accion: 'graficosTipoVivienda'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#code2').html(response);
						graficosTV();
				}
		});
	}
	
	
	function GraficosUsos() {
		$.ajax({
				data:  {refurbanizacion : $('#refurbanizacion').val(),
						reftipovivienda : $('#reftipovivienda').val(),
						refuso : $('#refuso').val(),
						refsituacioninmueble : $('#refsituacioninmueble').val(),
						dormitorios : $('#dormitorios').val(),
						banios : $('#banios').val(),
						encontruccion : $('#encontruccion').val(),
						mts2 : $('#mts2').val(),
						anioconstruccion : $('#anioconstruccion').val(),
						precioventapropietario : $('#precioventapropietario').val(),
						nombrepropietario : $('#nombrepropietario').val(),
						apellidopropietario : $('#apellidopropietario').val(),
						fechacarga : $('#fechacarga').val(),
						refusuario : $('#refusuario').val(),
						refcomision : $('#refcomision').val(),
						accion: 'graficosUsos'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#code3').html(response);
						graficosU();
				}
		});
	}
	
	traerInmuebles();
	traerOportunidades();
	GraficoValoracion();
	GraficosTipoVivienda();
	GraficosUsos();
	$('#buscar').click(function(e) {
        
		
	});
	
	$('.actualizar').click(function() {
		traerOportunidades();
	});
	
	
	
	
});
</script>
<?php } ?>
</body>
</html>
