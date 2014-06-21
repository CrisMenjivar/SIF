<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript" src="../../../js/horas/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/password_checker.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/horas/jquery.validate.min.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css"/>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<title>Nuevo Usuario</title>
<style type="text/css">
.auto-style1 {
}
</style>
<script type="text/javascript" src="../../../js/ajax.js"></script>
<script type="text/javascript">
$(function() {
	$("#sesiones").validate({
		rules: {
			pass: {
				required: true,
				pwcheck: true,
				minlength: 8
			},
			 confirmar: {
                                required: true,
                                equalTo: "#password"
                            }
		},
		messages: {
			pass: {
				required: "Password requerido",
				pwcheck: "Password no válido.",
				minlength: "Minimo 8 caracteres"
			},
			confirmar: {
                                required: "Confirmacion requerida",
                                equalTo: "Password deben coincidir"
                        }
		}
	});
	$.validator.addMethod("pwcheck", function(value) {
	   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
		   && /[a-z]/.test(value) // has a lowercase letter
		   && /\d/.test(value) // has a digit
	});
});
objetoAjax.prototype.micompletar=micompletar;
function micompletar(forma)
{// 2)realiza la primera llamada al query dependiendo q se selecciono
var varea=forma.area;
// muestra el complemento de la url
this.curl="?area="+varea.options[varea.selectedIndex].value;
//alert('COMPLEMENTO DE URL: \n\r'+this.curl);
this.ejecutar();//ejecuta la llamada
}
function muestraResultado()
{
if(this.readyState == 4)
{
if(this.status == 200)
{
var texto=this.responseText;
divTabla=window.document.getElementById('subareasajax'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}
var mitablajax=new objetoAjax('GET','nuevousuario_subareas_ajax.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}
/********** FUNCION PARA VALIDAR QUE SE INGRESEN SOLO LETRAS EN EL NOMBRE *********/    
function validar_letras(campo)
{
    var RegExPattern = /^([a-z Ññáéíóú]{3,50})$/i;
    var errorMessage = 'Nombre incorrecto.';
    if ((campo.value.match(RegExPattern)))
    {
   	 document.getElementById('errorNombre').innerHTML = '';
   	 document.getElementById('confirmarNombre').innerHTML = '';           	 
    }
    else
    {
   	 console.log(errorMessage);
   	 document.getElementById('errorNombre').innerHTML = '<br />El nombre debe contener solamente letras y no puede contener caracteres especiales <br><br>';   	 
   	 document.getElementById('confirmarNombre').innerHTML = '';           	 
    }
}
function validar_apellido(campo)
{
    var RegExPattern = /^([a-z Ññáéíóú]{3,50})$/i;
    var errorMessage = 'Nombre incorrecto.';
    if ((campo.value.match(RegExPattern)))
    {
   	 document.getElementById('errorNombre').innerHTML = '';
   	 document.getElementById('confirmarNombre').innerHTML = '';           	 
    }
    else
    {
   	 console.log(errorMessage);
   	 document.getElementById('errorNombre').innerHTML = '<br />El apellido debe contener solamente letras y no puede contener caracteres especiales <br><br>';   	 
   	 document.getElementById('confirmarNombre').innerHTML = '';           	 
    }
}
</script>
</head>
<body>
<?php
include '../../../config/db.php';
//guardar la conexion realizada al servidor de bases de datos en una variable
$conexion=mysql_connect($servidor,$usuario,$contra) or die(mysql_error());
//verificar si la conexion se realizo con exito
if(!$conexion)
{
die("No se pudo conectar");
}
//Seleccionar la base de datos a las que nos conectaremos
$bd=mysql_select_db($nombre_bd,$conexion) or die(mysql_error());
//Verificamos que el usuario haya iniciado sesion
session_start();
if($_SESSION['user']=="")
{
header ("Location: ../../../index.php");
}
else
{
$ver=$_SESSION['user'];
$change="select admin from usuarios where user='$ver' ";
$verify = mysql_query($change,$conexion);
$move=mysql_fetch_array($verify);
if($move['admin']=="2")
{
header ("Location: ../../usuarios/ast.php");
}
if($move['admin']=="3")
{
header ("Location: ../../jefes/ast.php");
}
if($move['admin']=="4")
{
header ("Location: ../../jefes_proyectos/ast.php");
}
}//fin else
//------------------------------------------------------------
//pendientes
$sq = "select count(usuario) as tot from excel where usuario='".$_SESSION['user']."' ";
$resP = mysql_query($sq,$conexion);
$resP2=mysql_fetch_array($resP);
$pendientes=$resP2['tot'];
?>
<div id="contenedor">
	<div id="encabezadologin">
		<div id="logo">
			<div id="logoimagen">
				<img src="../../../imagenes/sites.png" alt="sites"/>
			</div>
			<div id="textologo">
				<p>
					 Shared IT Enterprise Services
				</p>
			</div>
		</div>
		<div id="astdes">
			<p class="logueado">
				 Bienvenido : <?php echo $_SESSION['user']; ?>
			</p>
			<p>
				 An&aacute;lisis Semanal de Tiempo -- AST
			</p>
		</div>
	</div>
	<!--INICIO DE LA BARRA DE MENU-->
	<div id="conteencabezado">
		<div id="cerrar">
			<ul>
				<li><a href="#">Men&uacute;</a>
				<ul>
					<li><a href="../menuadmin.php">Inicio</a></li>
					<li><a href="../../instrucciones.php" target="_blank">Gu&iacute;a para registro</a></li>
					<li><a href="../correo/nuevo_correo.php">Enviar correo</a></li>
					<li><a href="../ast/ast.php">Llenar AST [Administrador]</a></li>
					<li><a href="../ast/cargar_archivo.php">Registrar desde archivo</a></li>
					<li><a href="../ast/corregirast.php">AST Denegados [Administrador]</a></li>
					<li><a href="../ast/modificarast.php">Modificar AST [Administrador]</a></li>
					<?php
if( $pendientes != 0 )
{
echo '<li>
					<a href="../ast/ast_excel.php">Pendientes ('; echo $pendientes; echo ')</a></li>
					 '; } ?>
					<li><a href="../control/control.php">Control de entregas AST</a></li>
					<li><a href="../../cerrarsesion.php">Cerrar sesi&oacute;n</a></li>
				</ul>
				</li>
				<li><a href="#">Revisi&oacute;n AST</a>
				<ul>
					<li><a href="../revisarast/revisarast.php">Revisi&oacute;n de AST por &aacute;rea</a></li>
				</ul>
				</li>
				<li><a href="#" style="color:orange;">Usuarios</a>
				<ul>
					<li><a href="nuevousuario.php" style="color:orange;">Agregar Nuevo Usuario</a></li>
					<li><a href="nuevousuarioModificar.php">Modificar Usuario</a></li>
					<li><a href="eliminarusuario.php">Eliminar Usuario</a></li>
					<li><a href="reporteusuario.php">Reporte de Usuarios</a></li>
					<!--centros de costos -->
					<li><a href="../ccosto/nuevo_grupo.php">Agregar centro de costo</a></li>
					<li><a href="../ccosto/modificar_grupo.php">Modificar centro de costo</a></li>
					<li><a href="../ccosto/eliminar_grupo.php">Eliminar centro de costo</a></li>
					<li><a href="../ccosto/reporte_grupo.php">Reporte de centros de costos</a></li>
				</ul>
				</li>
				<li><a href="#">Departamentos</a>
				<ul>
					<li><a href="../departamentos/nuevodepartamento.php">Agregar Nuevo Departamento</a></li>
					<li><a href="../departamentos/nuevodepartamentoModificar.php">Modificar Departamento</a></li>
					<li><a href="../departamentos/eliminardepartamento.php">Eliminar Departamento</a></li>
					<li><a href="../departamentos/reportedepartamento.php">Reporte de Departamentos</a></li>
					<!--INICIO DE LOS SUBDEPARTAMENOS -->
					<li><a href="../subarea/nuevodepartamento.php">Agregar Nuevo Sub-departamento</a></li>
					<li><a href="../subarea/nuevodepartamentoModificar.php">Modificar Sub-departamento</a></li>
					<li><a href="../subarea/eliminardepartamento.php">Eliminar Sub-departamento</a></li>
					<li><a href="../subarea/reportedepartamento.php">Reporte de Sub-departamentos</a></li>
				</ul>
				</li>
				<li><a href="#">Empresas</a>
				<ul>
					<li><a href="../empresas/nuevaempresa.php">Agregar Nueva Empresa</a></li>
					<li><a href="../empresas/nuevaempresaModificar.php">Modificar Empresa</a></li>
					<li><a href="../empresas/eliminarempresa.php">Eliminar Empresa</a></li>
					<li><a href="../empresas/reporteempresa.php">Reporte de Empresas</a></li>
				</ul>
				</li>
				<li><a href="#">Actividades</a>
				<ul>
					<li><a href="../actividades/nuevaactividad.php">Agregar Nueva Actividad</a></li>
					<li><a href="../actividades/eliminaractividad.php">Eliminar Actividad</a></li>
					<li><a href="../actividades/reporteactividades.php">Reporte Actividades</a></li>
				</ul>
				</li>
				<li><a href="#">Proyectos</a>
				<ul>
					<li><a href="../proyectos/nuevoproyectoseleccionar.php">Agregar Nuevo Proyecto</a></li>
					<li><a href="../proyectos/nuevoproyectoModificar.php">Modificar Proyecto</a></li>
					<li><a href="../proyectos/cerrarproyecto.php">Cerrar Proyecto</a></li>
					<li><a href="../proyectos/reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
					<li><a href="../proyectos/reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
				</ul>
				</li>
				<li><a href="#">Grupos</a>
				<ul>
					<li><a href="../grupos/nuevo_grupo.php">Agregar Nuevo Grupo</a></li>
					<li><a href="../grupos/modificar_grupo.php">Modificar Grupo</a></li>
					<li><a href="../grupos/eliminar_grupo.php">Eliminar Grupo</a></li>
					<li><a href="../grupos/reporte_grupo.php">Reporte De Grupos</a></li>
				</ul>
				</li>
				<li><a href="#">Reportes</a>
				<ul>
					<li><a href="../reportes/reporte_seleccionar.php">Reporte AST-Mes</a></li>
					<li><a href="../reportes/reporte_seleccionar_anual.php">Reporte AST-Anual</a></li>
					<li><a href="../reportes/graficos_colaborador/colaborador_reporte.php">Por colaborador</a></li>
					<li><a href="../reportes/graficos_area/area_reporte.php">Por &aacute;reas</a></li>
					<li><a href="../reportes/graficos_empresa/empresa_reporte.php">Por empresas</a></li>
					<!--    <li><a href="reportes/horizontal2.php" >horizontal</a></li>
<li><a href="reportes/vertical.php" >vertical</a></li>
<li><a href="llenar.php" >Llenar</a></li> -->
				</ul>
				</li>
			</ul>
		</div>
	</div>
	<!--FIN DE LA BARRA DE MENU -->
	<div id="contenedorform">
		<form name="sesiones" id="sesiones" action="nuevousuarioinsertar.php" method="post" onsubmit="return validarusuario(this)">
			<div id="encabezado">
				<p>
					 Agregar nuevo usuario
				</p>
			</div>
			<div id="cajas">
				<!--    <div id="inputtex" style="width: 53%" class="auto-style1">
<input type="text"  name="login" value="" style="width: 151px" />
<p style="width: 103px; margin:-20px;">@siman.com</p>
</div>
-->
				<div id="c1">
					<div id="inputtex2">
						<input type="text" name="login" value="" style="box-shadow: 0 1px 2px -2px black;" pattern="[a-zA-Z0-9\s_-]{10,15}$"/>
					</div>
				</div>
				<div id="textos" style="width: 28%">
					<p style="width: 158px">
						 Login de usuario<b> :</b>
					</p>
				</div>
			</div>
			<div id="cajas2">
				<div id="radiotex1">
					<div id="radiotex2">
						<input type="radio" name="acceso" value="1"/>
					</div>
					<div id="textradio">
						<p>
							 Administrador
						</p>
					</div>
				</div>
				<div id="textos">
					<p>
						 Nivel de acceso :
					</p>
				</div>
			</div>
			<div id="cajas2">
				<div id="radiotex1">
					<div id="radiotex2">
						<input type="radio" name="acceso" value="2" checked="checked"/>
					</div>
					<div id="textradio">
						<p>
							 Usuario
						</p>
					</div>
				</div>
				<div id="textos">
					<p>
						<b></b>
					</p>
				</div>
			</div>
			<div id="cajas2">
				<div id="radiotex1">
					<div id="radiotex2">
						<input type="radio" name="acceso" value="3"/>
					</div>
					<div id="textradio">
						<p>
							 Jefe de &aacute;rea
						</p>
					</div>
				</div>
				<div id="textos">
					<p>
						<b></b>
					</p>
				</div>
			</div>
			<div id="cajas2">
				<div id="radiotex1">
					<div id="radiotex2">
						<input type="radio" name="acceso" value="4"/>
					</div>
					<div id="textradio">
						<p>
							 Jefe de &aacute;rea-Admin
						</p>
					</div>
				</div>
				<div id="textos">
					<p>
						<b></b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="inputtex">
					<input type="password" name="pass" id="pass" value="" style="box-shadow: 0 1px 2px -2px black;" maxlength="16"/>
				</div>
				<div id="textos">
					<p>
						<b> Contrase&ntilde;a :</b>
					</p>
				</div>
			</div>
			<br/>
			<div id="cajas">
				<div id="inputtex">
					<input type="password" name="confirmar" id="confirmar " value="" style="box-shadow: 0 1px 2px -2px black;" maxlength="16"/>
				</div>
				<div id="textos">
					<p>
						<b> Confirmar contrase&ntilde;a :</b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="pass-info">
				</div>
			</div>
			<div id="cajas">
				<div id="inputtex">
					<input type="text" name="nombre" value="" style="box-shadow: 0 1px 2px -2px black;" onkeyup="validar_letras(this)"/>
				</div>
				<div id="textos">
					<p>
						 Nombre<b> :</b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="inputtex">
					<input type="text" name="apellido" value="" style="box-shadow: 0 1px 2px -2px black;" onkeyup="validar_apellido(this)"/>
				</div>
				<div id="textos">
					<p>
						 Apellido :
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="selecttex">
					<select name="area" size="1" onchange="mitablajax.micompletar(this.form);" style="box-shadow: 0 1px 2px -2px black;">
						<?php
$sql2="select * from area where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
						<option value="">Seleccione el &aacute;rea</option>
						<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
$name=$areass['nombre'];
$name=strtolower($name);
$name=ucfirst($name);
echo "<option value=".$ari.">
						 ".$ari." - ".$name."</option>
						 "; } ?>
					</select>
				</div>
				<div id="textos">
					<p>
						<b> &Aacute;rea :</b>
					</p>
				</div>
			</div>
			<div id="subareasajax">
				<div id="cajas">
					<div id="selecttex">
						<select name="subarea" size="1" style="box-shadow: 0 1px 2px -2px black;">
							<option value="">Seleccione la sub-&aacute;rea</option>
						</select>
					</div>
					<div id="textos">
						<p>
							<b> Sub-&aacute;rea :</b>
						</p>
					</div>
				</div>
			</div>
			<!--fin  subareaajax -->
			<div id="cajas">
				<div id="selecttex">
					<select name="ccosto" size="1" style="box-shadow: 0 1px 2px -2px black;">
						<?php
$sql2="select * from ccosto where estado='a' order by codigo ASC";
$result2 = mysql_query($sql2,$conexion);
?>
						<option value="">Seleccione centro de costo</option>
						<?php
while ( $areass=mysql_fetch_array($result2) )
{
$code=$areass['codigo'];
$ari=$areass['nombre'];
$mos=$ari;
$mos=strtr($mos,'_',' ');
$mos=strtolower($mos);
$mos=ucwords($mos);
echo "<option value=".$code.">
						 ".$code." - ".$mos."</option>
						 "; } ?>
					</select>
				</div>
				<div id="textos">
					<p>
						<b> Centro de costo :</b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="inputtex">
					<input type="text" name="cargo" value="" style="box-shadow: 0 1px 2px -2px black;"/>
				</div>
				<div id="textos">
					<p>
						 Cargo<b> :</b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="selecttex">
					<select name="contrato" size="1" style="width: 184px;box-shadow: 0 1px 2px -2px black;" onchange="tipo(this.form)">
						<option value="">Seleccione una opci&oacute;n</option>
						<option value="Planilla">Planilla</option>
						<option value="Outsourcing">Outsourcing</option>
					</select>
				</div>
				<div id="textos">
					<p>
						<b> Contrato :</b>
					</p>
				</div>
			</div>
			<input name="empresa" type="hidden" value="vacio"/>
			<div id="cajas">
				<div id="inputtex">
					<input type="text" name="proveedor" value="" style="box-shadow: 0 1px 2px -2px black;"/>
				</div>
				<div id="textos">
					<p>
						<b> Proveedor :</b>
					</p>
				</div>
			</div>
			<div id="cajas">
				<div id="inputtex">
					<input type="email" name="correo" value=""/>
				</div>
				<div id="textos">
					<p>
						<b> Correo electronico :</b>
					</p>
				</div>
			</div>
			<div id="errorNombre">
			</div>
			<div id="ConfirmarNombre">
			</div>
			<div id="cajasbotom">
				<div id="inputbotom">
					<input type="submit" value="Guardar usuario"/>
				</div>
			</div>
		</form>
	</div>
	<div id="footer2">
	</div>
</div>
</body>
</html>