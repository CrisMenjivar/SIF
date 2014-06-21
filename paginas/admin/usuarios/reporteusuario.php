<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" type="text/javascript" src="../../../js/formularios.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/seguridad.js"></script>
<link href="../../../estilo/estiloformularios.css" rel="stylesheet" type="text/css" />
<link href="../../../estilo/reportes.css" rel="stylesheet" type="text/css" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reporte de Usuarios</title>

<script type="text/javascript" src="../../../js/ajax.js"></script>

<script type="text/javascript">
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
divTabla=window.document.getElementById('reporte2'); //3)muestra el resultado en este id
divTabla.innerHTML=texto;
}
}
}

var mitablajax=new objetoAjax('GET','reporte_areas.php',muestraResultado);
window.onload=function () {mitablajax.micompletar(window.document.forms["criterios"]);}


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
<p>Shared IT Enterprise Services</p>
</div>
</div>

<div id="astdes">
<p class="logueado">Bienvenido : <?php echo $_SESSION['user']; ?></p>
<p>An&aacute;lisis Semanal de Tiempo -- AST</p>
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
<li><a href="../ast/cargar_archivo.php" >Registrar desde archivo</a></li>
<li><a href="../ast/corregirast.php">AST Denegados [Administrador]</a></li>
<li><a href="../ast/modificarast.php">Modificar AST [Administrador]</a></li>

<?php
if( $pendientes != 0 )
{
echo '<li><a href="../ast/ast_excel.php" >Pendientes ('; echo $pendientes; echo ')</a></li>';
}
?>

<li><a href="../control/control.php">Control de entregas AST</a></li>
<li><a href="../../cerrarsesion.php">Cerrar sesi&oacute;n</a></li>
</ul>
</li>

<li><a href="#">Revisi&oacute;n AST</a>
<ul>
<li><a href="../revisarast/revisarast.php" >Revisi&oacute;n de AST por &aacute;rea</a></li>
</ul>
</li>

<li><a href="#" style="color:orange;">Usuarios</a>
<ul>
<li><a href="nuevousuario.php" >Agregar Nuevo Usuario</a></li>
<li><a href="nuevousuarioModificar.php">Modificar Usuario</a></li>
<li><a href="eliminarusuario.php">Eliminar Usuario</a></li>
<li><a href="reporteusuario.php" style="color:orange;">Reporte de Usuarios</a></li>

<!--centros de costos -->
<li><a href="../ccosto/nuevo_grupo.php" >Agregar centro de costo</a></li>
<li><a href="../ccosto/modificar_grupo.php" >Modificar centro de costo</a></li>
<li><a href="../ccosto/eliminar_grupo.php" >Eliminar centro de costo</a></li>
<li><a href="../ccosto/reporte_grupo.php" >Reporte de centros de costos</a></li>

</ul>
</li>

<li><a href="#">Departamentos</a>
<ul>
<li><a href="../departamentos/nuevodepartamento.php" >Agregar Nuevo Departamento</a></li>
<li><a href="../departamentos/nuevodepartamentoModificar.php" >Modificar Departamento</a></li>
<li><a href="../departamentos/eliminardepartamento.php">Eliminar Departamento</a></li>
<li><a href="../departamentos/reportedepartamento.php">Reporte de Departamentos</a></li>
<!--INICIO DE LOS SUBDEPARTAMENOS -->
<li><a href="../subarea/nuevodepartamento.php" >Agregar Nuevo Sub-departamento</a></li>
<li><a href="../subarea/nuevodepartamentoModificar.php" >Modificar Sub-departamento</a></li>
<li><a href="../subarea/eliminardepartamento.php">Eliminar Sub-departamento</a></li>
<li><a href="../subarea/reportedepartamento.php">Reporte de Sub-departamentos</a></li>

</ul>
</li>

<li><a href="#">Empresas</a>
<ul>
<li><a href="../empresas/nuevaempresa.php" >Agregar Nueva Empresa</a></li>
<li><a href="../empresas/nuevaempresaModificar.php" >Modificar Empresa</a></li>
<li><a href="../empresas/eliminarempresa.php">Eliminar Empresa</a></li>
<li><a href="../empresas/reporteempresa.php">Reporte de Empresas</a></li>
</ul>
</li>

<li><a href="#">Actividades</a>
<ul>
<li><a href="../actividades/nuevaactividad.php" >Agregar Nueva Actividad</a></li>
<li><a href="../actividades/eliminaractividad.php">Eliminar Actividad</a></li>
<li><a href="../actividades/reporteactividades.php">Reporte Actividades</a></li>
</ul>
</li>

<li><a href="#">Proyectos</a>
<ul>
<li><a href="../proyectos/nuevoproyectoseleccionar.php" >Agregar Nuevo Proyecto</a></li>
<li><a href="../proyectos/nuevoproyectoModificar.php" >Modificar Proyecto</a></li>
<li><a href="../proyectos/cerrarproyecto.php">Cerrar Proyecto</a></li>
<li><a href="../proyectos/reporteproyectocurso.php">Reporte Proyectos en Curso</a></li>
<li><a href="../proyectos/reporteproyectofinalizado.php">Reporte Proyectos Terminados</a></li>
</ul>
</li>

<li><a href="#">Grupos</a>
<ul>
<li><a href="../grupos/nuevo_grupo.php" >Agregar Nuevo Grupo</a></li>
<li><a href="../grupos/modificar_grupo.php" >Modificar Grupo</a></li>
<li><a href="../grupos/eliminar_grupo.php" >Eliminar Grupo</a></li>
<li><a href="../grupos/reporte_grupo.php" >Reporte De Grupos</a></li>
</ul>
</li>

<li><a href="#">Reportes</a>
<ul>
<li><a href="../reportes/reporte_seleccionar.php" >Reporte AST-Mes</a></li>
<li><a href="../reportes/reporte_seleccionar_anual.php" >Reporte AST-Anual</a></li>
<li><a href="../reportes/graficos_colaborador/colaborador_reporte.php" >Por colaborador</a></li>
<li><a href="../reportes/graficos_area/area_reporte.php" >Por &aacute;reas</a></li>
<li><a href="../reportes/graficos_empresa/empresa_reporte.php" >Por empresas</a></li>

<!--    <li><a href="reportes/horizontal2.php" >horizontal</a></li>
<li><a href="reportes/vertical.php" >vertical</a></li>
<li><a href="llenar.php" >Llenar</a></li> -->
</ul>
</li>


</ul>
</div>
</div>
<!--FIN DE LA BARRA DE MENU -->
<form name="sesiones" action="" method="post" target="_blank" >
<div id="selecuser">
<div id="prt1"><p>Reporte de usuarios registrados</p></div>
<div id="prt2">
<div id="prt21"><p>&Aacute;reas : &nbsp;</p></div>
<div id="prt22">
<select name="area" size="1" onchange="mitablajax.micompletar(this.form);" style="width: 174px" >
<?php
$sql2="select * from area where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="general">General</option>
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
$name=$areass['nombre'];
$name=strtolower($name);
$name=ucfirst($name);

echo "<option value=".$ari.">".$ari." - ".$name."</option>";
}
?>
</select>

</div>
</div>

</div>

</form>


<div id="reporte">
<div id="columnas">
<div id="col1" style="width: 38px"><p style="width: 46px">No.</p></div>
<div id="col2" style="width: 108px"><p style="width: 108px">Usuario</p></div>
<div id="col3"><p>Tipo</p></div>
<div id="col4"><p>Nombre</p></div>
<div id="col5"><p>Apellidos</p></div>
<div id="col6"><p>&Aacute;rea</p></div>
<div id="col7" style="width: 113px"><p style="width: 114px">Cargo</p></div>
<div id="col8"><p>Contrato</p></div>
<div id="col9"><p>Proveedor</p></div>
<div id="col10"><p style="width: 108px">Estado</p></div>
<div id="col11"><p style="width: 126px">Creado</p></div>
</div>
</div>
<div id="reporte2">
<table cellpadding="0" cellspacing="0" border="1">
<?php
$sql2="select * from usuarios";
$result2 = mysql_query($sql2,$conexion);
$contador=1;
while ( $usuarios=mysql_fetch_array($result2) )
{
$usuario=$usuarios['user'];
$pass=$usuarios['pass'];
$admin=$usuarios['admin'];
$nombre=$usuarios['nombre'];
$apellido=$usuarios['apellido'];
$area=$usuarios['area'];
$cargo=$usuarios['puesto'];
$contrato=$usuarios['contrato'];
$proveedor=$usuarios['proveedor'];
$estado=$usuarios['estado'];
$creado=$usuarios['creado'];

echo '<tr>';
echo '<td width="30px" height="20px" align="center" >'; echo $contador; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $usuario; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; if( $admin == "1" ){ echo "Admin";}if( $admin == "2" ){ echo "Usuario";}if( $admin == "3" ){ echo "Jefe &aacute;rea";} echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $nombre; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $apellido; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $area; echo'</td>';
echo '<td width="120px" height="20px" align="center" style="line-height:normal;" >'; echo $cargo; echo'</td>';
echo '<td width="90px" height="20px" align="center" >'; echo $contrato; echo'</td>';
echo '<td width="90px" height="20px" align="center" style="line-height:normal;" >'; echo $proveedor; echo'</td>';
echo '<td width="80px" height="20px" align="center" >'; if( $estado == "a" ){ echo "Activo";}else{echo "Inactivo";} echo'</td>';
echo '<td width="100px" height="20px" align="center" style="line-height:normal;">'; echo $creado; echo'</td>';

echo '</tr>';
$contador++;
}
?>
</table>
</div>
<div id="footer2" style="margin-top:20px;"></div>
</div>

</body>

</html>
