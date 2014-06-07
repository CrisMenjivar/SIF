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


//recuperamos los datos del usuario a modificar
//$nombre=$_POST['usuario'];
$userast = $_GET['usuario'];

$sqlusuario="select * from usuarios where user='$userast'";
$result2 = mysql_query($sqlusuario,$conexion);
$datos=mysql_fetch_array($result2);

if($userast!="")
{
?>

<div id="contenedorform">
<div id="encabezado" style="border-radius:0px;">
<p>---------------------- Datos de usuario a eliminar ---------------------</p>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  disabled="disabled" name="login" value="<?php echo $datos['user']; ?>"  />
</div>
<div id="textos">
<p>Login de usuario<b> :</b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="1" <?php if( $datos['admin'] == "1" ){ echo 'checked="checked"';} ?> />
</div>
<div id="textradio"><p>Administrador</p></div>
</div>
<div id="textos">
<p>Nivel de acceso :</p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="2" <?php if( $datos['admin'] == "2" ){ echo 'checked="checked"';} ?>  />
</div>
<div id="textradio"><p>Usuario</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="3" <?php if( $datos['admin'] == "3" ){ echo 'checked="checked"';} ?>  />
</div>
<div id="textradio"><p>Jefe de &aacute;rea</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>


<div id="cajas" >
<div id="inputtex">
<input type="text"  name="pass" value="<?php echo $datos['pass']; ?>" disabled="disabled" />

</div>
<div id="textos">
<p><b> Contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="confirmar" value="<?php echo $datos['pass']; ?>" disabled="disabled" />

</div>
<div id="textos">
<p><b> Confirmar contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="<?php echo $datos['nombre']; ?>" disabled="disabled" />
</div>
<div id="textos">
<p>Nombre<b> :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="apellido" value="<?php echo $datos['apellido']; ?>" disabled="disabled" />
</div>
<div id="textos">
<p>Apellido :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="area" size="1" disabled="disabled" >
<?php
$sql2="select * from area where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="<?php echo $datos['area']; ?>"><?php echo $datos['area']; ?></option>
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$name=$areass['nombre'];
$ari=$areass['codigo'];
echo "<option value=".$ari.">".$name." - ".$ari."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b> &Aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="subarea" size="1" disabled="disabled">
<?php
$sql2="select * from subarea where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option value="<?php echo $datos['subarea']; ?>"><?php echo $datos['subarea']; ?></option>
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['codigo'];
echo "<option value=".$ari.">".$ari."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b> Sub-&aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="ccosto" size="1" disabled="disabled">
<?php
$sql2="select * from ccosto where estado='a'";
$result2 = mysql_query($sql2,$conexion);
?>
<option selected="selected" value="<?php echo $datos['ccosto']; ?>"><?php echo $datos['ccosto']; ?></option>
<?php
while ( $areass=mysql_fetch_array($result2) )
{
$ari=$areass['nombre'];
$code=$areass['codigo'];
echo "<option value=".$ari.">".$code." - ".$ari."</option>";
}
?>
</select>
</div>
<div id="textos">
<p><b> Centro de costo :</b></p>
</div>
</div>


<div id="cajas" >
<div id="inputtex">
<input type="text"  name="cargo" value="<?php echo $datos['puesto']; ?>" disabled="disabled" />

</div>
<div id="textos">
<p>Cargo<b> :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="contrato" value="<?php echo $datos['contrato']; ?>" disabled="disabled" />

</div>
<div id="textos">
<p><b> Contrato :</b></p>
</div>
</div>

<input type="hidden" name="empresa" value="<?php echo $datos['empresa']; ?>" />
<!--
<div id="cajas" >
<div id="selecttex">
<select name="empresa" size="1" disabled="disabled">
<?php
$sql3="select * from empresas where estado='a' ";
$result3 = mysql_query($sql3,$conexion);
?>
<option value="<?php echo $datos['empresa']; ?>"><?php echo $datos['empresa']; ?></option>
<?php
while ( $empresa=mysql_fetch_array($result3) )
{
$empre=$empresa['nombre'];
echo "<option value=".$empre.">".$empre."</option>";
}
?>
</select>
</div>
<div id="textos">
<p>Empresa :</p>
</div>
</div>
-->
<div id="cajas" >
<div id="inputtex">
<input type="text"  name="proveedor" value="<?php echo $datos['proveedor']; ?>" disabled="disabled" />
</div>
<div id="textos">
<p><b> Proveedor :</b></p>
</div>
</div>

<!--
<div id="cajas" >
<div id="inputtex">
<input type="text"  name="correo" value="<?php //echo $datos['email']; ?>" disabled="disabled" />
</div>
<div id="textos">
<p><b> Correo electronico :</b></p>
</div>
</div>
-->
<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" value="Eliminar Usuario"/>
</div>
</div>
</div>

<?php
}
else
{
?>

<div id="contenedorform">
<div id="encabezado">
<p>---------------------- Datos de usuario a eliminar ---------------------</p>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  disabled="disabled" name="login" value=""  />
</div>
<div id="textos">
<p>Login de usuario<b> :</b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="1"  />
</div>
<div id="textradio"><p>Administrador</p></div>
</div>
<div id="textos">
<p>Nivel de acceso :</p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="2" />
</div>
<div id="textradio"><p>Usuario</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>

<div id="cajas2"    >
<div id="radiotex1">
<div id="radiotex2">
<input type="radio" disabled="disabled" name="acceso" value="3"  />
</div>
<div id="textradio"><p>Jefe de &aacute;rea</p></div>
</div>
<div id="textos">
<p><b></b></p>
</div>
</div>


<div id="cajas" >
<div id="inputtex">
<input type="text"  name="pass" value="" disabled="disabled" />

</div>
<div id="textos">
<p><b> Contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="confirmar" value="" disabled="disabled" />

</div>
<div id="textos">
<p><b> Confirmar contrase&ntilde;a :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="nombre" value="" disabled="disabled" />
</div>
<div id="textos">
<p>Nombre<b> :</b></p>
</div>
</div>

<div id="cajas">
<div id="inputtex">
<input type="text"  name="apellido" value="" disabled="disabled" />
</div>
<div id="textos">
<p>Apellido :</p>
</div>
</div>


<div id="cajas" >
<div id="selecttex">
<select name="area" size="1" disabled="disabled" >
</select>
</div>
<div id="textos">
<p><b> &Aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="subarea" size="1" disabled="disabled">
</select>
</div>
<div id="textos">
<p><b> Sub-&aacute;rea :</b></p>
</div>
</div>

<div id="cajas" >
<div id="selecttex">
<select name="ccosto" size="1" disabled="disabled">
</select>
</div>
<div id="textos">
<p><b> Centro de costo :</b></p>
</div>
</div>


<div id="cajas" >
<div id="inputtex">
<input type="text"  name="cargo" value="" disabled="disabled" />

</div>
<div id="textos">
<p>Cargo<b> :</b></p>
</div>
</div>

<div id="cajas" >
<div id="inputtex">
<input type="text"  name="contrato" value="" disabled="disabled" />

</div>
<div id="textos">
<p><b> Contrato :</b></p>
</div>
</div>

<input type="hidden" disabled="disabled" name="empresa" value="" />
<div id="cajas" >
<div id="inputtex">
<input type="text"  name="proveedor" value="" disabled="disabled" />
</div>
<div id="textos">
<p><b> Proveedor :</b></p>
</div>
</div>

<div id="cajasbotom">
<div id="inputbotom">
<input type="submit" disabled="disabled" value="Eliminar Usuario"/>
</div>
</div>
</div>


<?php
}
?>
