<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>-----</title>
</head>

<body>



<form name="insertardatos" action="correcciones_cambios_insertar.php" method="post" >

<table style="width: 785px">
<tr>

<td>
<label>ORIGEN</label>
</td>

<td>
<label>a&ntilde;o copiar :</label>
</td>
<td>
<input type="text" name="anioI" value="" placeholder="year copiar" style="width: 246px" />
</td>

<td>
<label>mes copiar :</label>
</td>
<td>
<input type="text" name="mesI" value="" placeholder="mes copiar formato dos digitos" style="width: 277px" />
</td>

</tr>

<!--#################################################################################################-->

<tr>
<td>
<label>DESTINO</label>
</td>

<td>
<label>a&ntilde;o nuevo :</label>
</td>
<td>
<input type="text" name="anioF" value="" placeholder="year nuevo" style="width: 245px" />
</td>

<td>
<label>mes nuevo :</label>
</td>
<td>
<input type="text" name="mesF" value="" placeholder="mes nuevo, formato: dos digitos. Ej: 01,09,12" style="width: 277px" />
</td>

</tr>


</table>

<input type="submit" name="enviar" value="enviar" style="width: 80px; height: 45px" />

</form>


</body>

</html>
