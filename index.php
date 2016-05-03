<?php

require 'includes/funcionesUsuarios.php';
include ('includes/funciones.php');
include ('includes/funcionesReferencias.php');


$serviciosUsuarios = new ServiciosUsuarios();
$servicios = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

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
  FROM [Distribuidora].[dbo].[proveedores]";
  
  $serverName = "WIN-9BC91H82UD8\sqlexpress";
	//$connectionInfo = array( "Database"=>"Distribuidora");
	//$connectionInfo = array("UID"=>"usuario", "PWD"=>"distribuidora", "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$connectionInfo = array( "Database"=>"distribuidora", "CharacterSet" => "UTF-8");
		$conex = sqlsrv_connect( $serverName, $connectionInfo);
		
  $resProveedor = sqlsrv_query($conex, $sql, array(), array( "Scrollable"=>"buffered" ));
  
//$resProveedor = $serviciosReferencias->traerProveedor();

//var_dump($resProveedor);
//die();

?>
<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Acceso Restringido: Distribuidora Discas</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
      


        
        
</head>



<body>


<div class="content">

<!--<div class="row" style="margin-top:10px; font-family:Verdana, Geneva, sans-serif;" align="center">
		<img src="imagenes/logo.png" width="300" height="273">
   
</div>-->


<div class="logueo" align="center">
<br>
<br>
<br>
	<section style="width:50%; padding-top:10px; padding-top:60px;padding:25px;
background-color: #ffffff; border:1px solid #101010; box-shadow: 2px 2px 4px #020202;-webkit-box-shadow: 4px 4px 5px #020202;-moz-box-shadow: 4px 4px 5px #020202;">
			<div id="error" style="text-align:left; color:#666;">
            
            </div>

            <div align="center">
            	<div class="row">
                <div class="col-md-12 col-xs-12">
            
            	<img src="imagenes/logo_discas2.png" width="50%">
                
				<div align="center"><p style="color:#363636; font-size:1.3em;">Acceso al panel de control</p></div>
                </div>
                </div>
                <br>
            </div>
			<form role="form" class="form-horizontal">
              

              <div class="form-group">
                <label for="usuario" class="col-md-2 col-xs-3 control-label" style="color:#363636;text-align:left;">E-Mail</label>
                <div class="col-md-10 col-xs-10">
                  <input type="email" class="form-control" id="email" name="email" 
                         placeholder="E-Mail">
                </div>
              </div>

              <div class="form-group">
                <label for="ejemplo_password_2" class="col-md-2 col-xs-3 control-label" style="color:#363636;text-align:left; font-size:1em;">Contraseña</label>
                <div class="col-md-10 col-xs-10">
                  <input type="password" class="form-control" id="pass" name="pass" 
                         placeholder="password">
                </div>
              </div>
              
              <div class="form-group">
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF;text-align:left;">Proveedor</label>
                <div class="col-lg-7">
                  <select class="form-control" id="refproveedor" name="refproveedor" >
                  	<?php while($row = sqlsrv_fetch_array($resProveedor, SQLSRV_FETCH_ASSOC)) { ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['proveedor']." - ".$row['razonsocial']; ?></option>	
					<?php } ?>
                  </select>
                </div>
              </div>
              

             
              <div class="form-group">
                <div class="col-md-12 col-xs-12">
                  <button type="button" class="btn btn-default" id="login">Login</button>
                </div>
              </div>
				
                <div id="load">
                
                </div>

            </form>

     </section>
     <br>
     <br>
     <br>
     </div>
</div><!-- fin del content -->



</body>
<script type="text/javascript">
		
			$(document).ready(function(){
				
				
					$("#email").click(function(event) {
        			$("#email").removeClass("alert alert-danger");
					$("#email").attr('placeholder','Ingrese el email');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert alert-danger");
        			$("#email").attr('placeholder','Ingrese el email');
        			});
					
					
					$("#pass").click(function(event) {
        			$("#pass").removeClass("alert alert-danger");
					$("#pass").attr('placeholder','Ingrese el password');
        			});

        			$("#pass").change(function(event) {
        			$("#pass").removeClass("alert alert-danger");
        			$("#pass").attr('placeholder','Ingrese el password');
        			});
					
				
				function validador(){

        				$error = "";
		
        				if ($("#email").val() == "") {
        					$error = "Es obligatorio el campo E-Mail.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").attr('placeholder',$error);
        				}
						
						if ($("#pass").val() == "") {
        					$error = "Es obligatorio el campo Password.";

        					$("#pass").addClass("alert alert-danger");
        					$("#pass").attr('placeholder',$error);
        				}
						

						
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = "El E-Mail ingresado es inválido.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
						  }

        				return $error;
        		}
				
				
				$("#login").click(function(event) {
        			
						if (validador() == "")
        				{
        						$.ajax({
                                data:  {email:			$("#email").val(),
										pass:			$("#pass").val(),
										refproveedor:	$("#refproveedor").val(),
										accion:		'login'},
                                url:   'ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response != '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');

                                        } else {
											url = "dashboard/";
											$(location).attr('href',url);
										}
                                        
                                }
                        });
        				}
        		});
				
			});/* fin del document ready */
		
		</script>
</html>