
function trim(str, filter){
filter || ( filter = '\\s|\\&nbsp;' );
return ltrim(rtrim(str, filter), filter);
}

//---------------------------------------------------------------------------------------------------------
//var nav4 = window.Event ? true : false;

function acceptNumhorasNada4(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
//var key = nav4 ? evt.which : evt.keyCode;
return (false);
}

//------------------------------------------------------------------------------------------------------

var nav4 = window.Event ? true : false;
function acceptNumhorasNada(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
var key = nav4 ? evt.which : evt.keyCode;
return (key == 2000);
}

//------------------------------------------------------------------------------------------------------


//VALIDACION PARA GENERAR EL REPORTE POR EMPRESA PERFIL ADMINISTRADOR

function reporte_empresa_admin(form)
{
if (form.area.value == "")
{ alert("Por favor, seleccione una empresa"); form.area.focus(); return false; }

if (form.estado.value == "abiertos")
{
if (form.proyec.value == "")
{ 
alert("Error, la empresa seleccionada no tiene proyectos en curso"); form.estado.focus(); return false; 
}
}


if (form.estado.value == "cerrados")
{
if (form.proyec.value == "")
{ 
alert("Error, la empresa seleccionada no tiene proyectos finalizados"); form.estado.focus(); return false; 
}
}

}


//VALIDACION PARA GENERAR EL REPORTE POR AREA PERFIL ADMINISTRADOR

function reporte_area_admin(form)
{

if (form.area.value == "")
{ alert("Por favor, seleccione una \u00e1rea"); form.area.focus(); return false; }

}


//VALIDACION PARA GENERAR EL REPORTE POR COLABORADOR PERFIL ADMINISTRADOR

function reporte_colaborador_admin(form)
{

if (form.area.value == "")
{ alert("Por favor, seleccione una \u00e1rea"); form.area.focus(); return false; }

if (form.colaborador.value == "")
{ alert("Por favor, seleccione un colaborador"); form.colaborador.focus(); return false; }

}


//VALIDACION PARA GENERAR EL REPORTE AST MENSUAL PERFIL ADMINISTRADOR

function reporte_mensual(form)
{

if (form.area.value == "")
{ alert("Por favor, seleccione una \u00e1rea"); form.area.focus(); return false; }

}

//VALIDACION PARA GENERACION DE REPORTES PEFIL JEFE-REPORTE COLABORADOR

function reporte_jefe_colaborador(form)
{
if (form.colaborador.value == "")
{ alert("Por favor, seleccione un colaborador"); form.colaborador.focus(); return false; }
}

//VALIDACION PARA GENERACION DE REPORTES EN PERFIL USUARIOS

function reportes_usuarios_colaborador(form)
{

if (form.inicio.value == "")
{ alert("Por favor, ingrese la fecha de inicio del reporte"); form.inicio.focus(); return false; }

if (form.fin.value == "")
{ alert("Por favor, ingrese la fecha de fin del reporte"); form.fin.focus(); return false; }

}


//----CONVERTIR A MAYUSCULAS Y MINUSCULAS-----------------------------
function toUpper(control)
{
if (/[a-z]/.test(control.nombre.value))
{
control.nombre.value = control.nombre.value.toUpperCase();
control.mostrar.value= control.nombre.value.toLowerCase();
}
}

function mostrarr()
{
var datos=document.empresas.nombre.value;

if (/[a-z]/.test(datos))
{
document.empresas.mostrar.value = datos.toLowerCase();
}
}

//----------------------------------------------------------------------

//Funcion para colocar si es planilla o no

function tipo(forma){
//var opcion=document.sesiones.contrato.value;
var vopcion=forma.contrato;

var op=vopcion.options[vopcion.selectedIndex].value;
//var opcion=document.sesiones.contrato.options[vopcion.selectedIndex].value;
if(op=="")
{
document.sesiones.proveedor.value="";
}
else
{
if(op=="Planilla")
{
document.sesiones.proveedor.value="SITES";
}
else
{
document.sesiones.proveedor.value="";
}
}
}


//------------------------------------------------------------------------------------------------------

function acceptNumhorasNada(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
var key = nav4 ? evt.which : evt.keyCode;
return (false);
}
//------------------------------------------------------------------------------------------------------

function acceptNumhorasNada3(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
var key = nav4 ? evt.which : evt.keyCode;
return (false);
}

//------------------------------------------------------------------------------------------------------

//VALIDACION PARA SELECCIONAR REPORTE MENSUAL AST------------------------------------------------------------

function validarreporteseleccionar(form)
{
if (form.area.value == "")
{ alert("Por favor, seleccione el \u00e1rea del reporte"); form.area.focus(); return false; }

return true;
}

//------------------------------------------------------------------------------------------------------

//FUNCION PARA VALIDAR EL LOGIN-------------------------------------------------------------------------------

function validarlogin(form)
{
if (form.usuario.value == "")
{ alert("Por favor, ingrese su id de usuario"); form.usuario.focus(); return false; }

if (form.pass.value == "")
{ alert("Por favor, ingrese su contrase\u00f1a"); form.pass.focus(); return false; }

return true;
}

//------------------------------------------------------------------------------------------------------

//FUNCION PARA LOS CENTRO DE COSTO-----------------------------------------------------------------------------------

function validarccosto(form)
{
if (form.codigo.value == "")
{ alert("Por favor, ingrese el c\u00f3digo del centro de costo"); form.codigo.focus(); return false; }

if (form.nombre.value == "")
{ alert("Por favor, ingrese el nombre del centro de costo"); form.nombre.focus(); return false; }

return true;
}

//FUNCION PARA LOS GRUPOS-----------------------------------------------------------------------------------

function validargrupo(form)
{
if (form.nombre.value == "")
{ alert("Por favor, ingrese un nombre para el grupo"); form.nombre.focus(); return false; }

return true;
}

//FUNCION PARA LAS ACTIVIDADES-----------------------------------------------------------------------------------

function validaractividades(form)
{
if (form.nombreacti.value == "")
{ alert("Por favor, ingrese un nombre para la actividad"); form.nombreacti.focus(); return false; }

return true;
}


//FUNCION PARA LAS ACTIVIDADES-----------------------------------------------------------------------------------

function validar_correo(form)
{
if (form.asunto.value == "")
{ alert("Por favor, ingrese el asunto para el mensaje"); form.asunto.focus(); return false; }

if (form.cuerpo.value == "")
{ alert("Por favor, ingrese el texto que contendra el mensaje"); form.cuerpo.focus(); return false; }

return true;
}


//------------------------------------------------------------------------------------------------------
//VALIDACIONES PARA LAS EMPRESAS----------------------------------------------------------------------------------

function validarempresa(form)
{
if (form.nombre.value == "")
{ alert("Por favor, ingrese un nombre para la empresa"); form.nombre.focus(); return false; }

if (form.grupo2.value == "")
{ alert("Por favor, Seleccione el grupo al cual pertenece la empresa"); form.grupo2.focus(); return false; }

return true;
}

//------------------------------------------------------------------------------------------------------

function validarempresamodificar(form)
{
if (form.empresa.value == "")
{ alert("Por favor, Seleccione una empresa para modificar sus datos"); form.empresa.focus(); return false; }
}

//------------------------------------------------------------------------------------------------------

//extraemos las siglas de la empresa, SE TOMARAN 5 SIGLAS
function sigla()
{
document.empresas.siglas.value = letras(document.empresas.nombre.value)
}

//------------------------------------------------------------------------------------------------------

function letras(variable)
{
var primeras = variable.substr(0, 5);
return primeras;
}

//------------------------------------------------------------------------------------------------------
//VALIDACIONES PARA LOS DEPARTAMENTOS------------------------------------------------------------------------------

function validardepartamento(form)
{
if (form.nombre.value == "")
{ alert("Por favor, ingrese un nombre para el departamento"); form.nombre.focus(); return false; }

if (form.codigo.value == "")
{ alert("Por favor, ingrese un c\u00f3digo o las siglas del departamento"); form.codigo.focus(); return false; }

return true;
}


function validarsubdepartamento(form)
{
if (form.nombre.value == "")
{ alert("Por favor, ingrese un nombre para el departamento"); form.nombre.focus(); return false; }

if (form.codigo.value == "")
{ alert("Por favor, ingrese un c\u00f3digo o las siglas del departamento"); form.codigo.focus(); return false; }

if (form.area.value == "")
{ alert("Por favor, seleccione el \u00e1rea a la que pertenece el subdepartamento"); form.codigo.focus(); return false; }

return true;
}


//------------------------------------------------------------------------------------------------------

function validardepartamentomodificar(form)
{
if (form.departamento.value == "")
{ alert("Por favor, Seleccione un departamento para modificar sus datos"); form.departamento.focus(); return false; }
}

//------------------------------------------------------------------------------------------------------
//VALIDACIONES PARA LOS PROYECTOS---------------------------------------------------------------------------------

function validarproyectoseleccionar(form)
{
if (form.empresa.value == "")
{ alert("Por favor, Seleccione una empresa para asociarla al proyecto"); form.empresa.focus(); return false; }
}

//------------------------------------------------------------------------------------------------------

function validarproyectomodificar(form)
{
if (form.proyecto.value == "")
{ alert("Por favor, Seleccione un proyecto para modificar sus datos"); form.proyecto.focus(); return false; }
}

//------------------------------------------------------------------------------------------------------

function validarproyectocerrar(form)
{
if (form.cierre.value == "0000-00-00")
{ alert("Por favor, Seleccione una fecha real de cierre para el proyecto"); form.cierre.focus(); return false; }
}


//------------------------------------------------------------------------------------------------------

function validarproyecto(form)
{
if (form.opcion1.value == "")
{ alert("Por favor, Ingrese una empresa para asociarla al proyecto"); form.opcion1.focus(); return false; }

if (form.opcion2.value == "")
{ alert("Por favor, Seleccione una \u00e1rea para el proyecto"); form.opcion2.focus(); return false; }

if ( form.nombre.value == "")
{ alert("Por favor, Ingrese un nombre para el proyecto"); form.nombre.focus(); return false; }

if ( form.descripcion.value == "")
{ alert("Por favor, Ingrese una descripci\u00f3n para el proyecto"); form.descripcion.focus(); return false; }


if (form.coordinador.value == "")
{ alert("Por favor, Seleccione una coordinador para el proyecto"); form.coordinador.focus(); return false; }

if (form.inicio.value == "")
{ alert("Por favor, Ingrese una fecha de inicio del proyecto"); form.inicio.focus(); return false; }

if (form.fin.value == "")
{ alert("Por favor, Ingrese una fecha de finalizaci\u00f3n del proyecto"); form.fin.focus(); return false; }

//if (form.cierre.value == "")
//{ alert("Por favor, Ingrese una fecha de cierre del proyecto"); form.cierre.focus(); return false; }

if (form.anio.value == "")
{ alert("Por favor, Ingrese el a\u00f1o de inicio del proyecto"); form.anio.focus(); return false; }

return true;
}

//------------------------------------------------------------------------------------------------------
//VALIDACIONES PARA LOS USUARIOS----------------------------------------------------------------------------------
function validarusuario(form)
{
if (form.login.value == "")
{ alert("Por favor, Ingresar un nombre para el campo login "); form.login.focus(); return false; }

if (form.pass.value == "")
{ alert("Por favor, Ingresar una contrase\u00f1a "); form.pass.focus(); return false; }

if (form.confirmar.value == "")
{ alert("Por favor, Ingresar nuevamente la contrase\u00f1a para confirmarla "); form.confirmar.focus(); return false; }

if (form.confirmar.value != form.pass.value)
{ alert("Error las contrase\u00f1as no coinciden"); form.confirmar.focus(); return false; }

if (form.nombre.value == "")
{ alert("Por favor, Ingresar el o los nombres del usuario "); form.nombre.focus(); return false; }

if (form.apellido.value == "")
{ alert("Por favor, Ingresar el o los apellidos del usuario "); form.apellido.focus(); return false; }

if (form.area.value == "")
{ alert("Por favor, Seleccione el \u00e1rea  "); form.area.focus(); return false; }

if (form.cargo.value == "")
{ alert("Por favor, Ingresar el cargo que desempe\u00f1ara el usuario "); form.cargo.focus(); return false; }

if (form.contrato.value == "")
{ alert("Por favor, Ingresar el tipo de contrato del usuario "); form.contrato.focus(); return false; }

if (form.empresa.value == "")
{ alert("Por favor, Seleccione la empresa para la que trabaja el usuario"); form.empresa.focus(); return false; }

if (form.proveedor.value == "")
{ alert("Por favor, Ingrese la compa\u00f1ia que contrata al usuario"); form.proveedor.focus(); return false; }

if (form.correo.value == "")
{ alert("Por favor, Ingresar un correo electronico"); form.correo.focus(); return false; }

return true;
}

//------------------------------------------------------------------------------------------------------

function validarusuariomodificar(form)
{
if (form.usuario.value == "")
{ alert("Por favor, Seleccione un usuario para modificar sus datos"); form.usuario.focus(); return false; }
}

//--------------------------------------------------------------------------------------------------------------------

