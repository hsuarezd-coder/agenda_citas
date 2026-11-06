
jQuery(function () {
	//Sistema de Citas
	$('#btnBuscarPacienteAdm').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena="";
					//cadena=cadena+"<tr>";
					if(data[i].faltas>=3){
						cadena=cadena+"<tr style='background:#F64620;'>";
					}else if(data[i].faltas>=2){
						cadena=cadena+"<tr style='background:#F2F5A9;'>";
					}else{
						cadena=cadena+"<tr>";
					}
					cadena=cadena+'<td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td><td>'+data[i].descripcion_estado_paciente+'</td>';
					cadena=cadena+'<td><a href="#" onclick="muestraModal('+data[i].clave_paciente+',\''+nombre+'\')">'+data[i].faltas+' </a></td>';
					cadena=cadena+'<td>';
					if(data[i].descripcion_estado_paciente==='ACTIVO'){
						cadena=cadena+'<a href="citasregistrar1.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
						cadena=cadena+'<img src="images/calendario_agregar.png"/></a>&nbsp;&nbsp;&nbsp;';						
					}
					else{
						cadena=cadena+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
					}
					cadena=cadena+'<a href="citaseliminar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/calendario_eliminar.png"/></a>&nbsp;&nbsp;&nbsp;';
					cadena=cadena+'<a href="citasconsultarpaciente.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/calendario_ver.png"/></a></td></tr>';					
					$("#resultado").append(cadena);
				 }
			});
		});
		
		$('#btnBuscarPacienteCC').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td>';
					cadena=cadena+'<td><a href="citasregistrar1.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';					
					cadena=cadena+'<a href="consultarcitaspaciente2.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/calendario_ver.png"/></a></td></tr>';					
					$("#resultado").append(cadena);
				 }
			});
		});
		$('#btnBuscarPacienteCC2').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td>';
					cadena=cadena+'<td><a href="citasregistrar1.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';					
					cadena=cadena+'<a href="consultarcitaspaciente4.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/calendario_ver.png"/></a></td></tr>';					
					$("#resultado").append(cadena);
				 }
			});
		});
		
		
		
		
		$('#btnBuscarPacienteRM').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td>';
					cadena=cadena+'<td><a href="resonanciamagneticaregistrar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/aceptar.png"/></a></td></tr>';					
					$("#resultado").append(cadena);
				 }
			});
		});
		
		$('#btnBuscarPacienteAdmP').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td><td>'+data[i].descripcion_estado_paciente+'</td>';
					cadena=cadena+'<td><a href="pacienteeditar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/editar.png"/></a>&nbsp;&nbsp;';
					
					if(data[i].clave_estado_paciente==="1" ){
						cadena=cadena+'<a href="#" onclick="desactivarpaciente('+data[i].clave_paciente+',\''+nombre+'\')"><img src="images/activo.png"/></a>&nbsp;&nbsp;';					
					}else if(data[i].clave_estado_paciente==="2" ){
						cadena=cadena+'<a href="#" onclick="activarpaciente('+data[i].clave_paciente+',\''+nombre+'\')"><img src="images/inactivo.png"/></a>&nbsp;&nbsp;';	
					}else{
						cadena=cadena+'<img src="images/baja.png"/>&nbsp;&nbsp;';
					}
					
					cadena=cadena+'<a href="pacientedetalles.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/detalles.png"/></a>&nbsp;&nbsp;';
					cadena=cadena+'<a href="pacienteeliminar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/eliminar.png"/></a></td></tr>'
					$("#resultado").append(cadena);
				 }
			});
		});
		
		$('#btnBuscarCitasEstudio').on('click', function(){
			var form = $( "#formulario" );
			if(!form.valid()){
				$('html,body').scrollTop(0);
				mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
				return;
			}
			var estudios=$("#estudios").val();
			var estados=$("#estados").val();
			var fecha_inicio=$("#fecha_inicio").val();			
			var fecha_fin=$("#fecha_fin").val();
			$.getJSON('servicios/citasPorEstudio.php?clave_estudio='+estudios+'&clave_estado_cita='+estados+'&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin, function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 					
					var cadena='<tr><td>'+data[i].paciente+'</td>';
					cadena=cadena+'<td>'+data[i].nombre_estudio+'</td>';
					cadena=cadena+'<td>'+data[i].fecha_cita+'</td>';
					cadena=cadena+'<td>'+data[i].descripcion_estado_cita+'</td>';
					cadena=cadena+'<td>'+data[i].hora+'</td>';
					cadena=cadena+'<td>'+data[i].personal+'</td>';
					cadena=cadena+'<td>';
					if(data[i].clave_estado_cita==="6"  && data[i].reporte==="1" ){
						cadena=cadena+'<a href="uploads/'+data[i].clave_cita+'.docx"><img src="images/icono_word.png"/></a>';					
					}else{
						
					}
					cadena=cadena+'</td></tr>'
					$("#resultado").append(cadena);
				 }
			});
		});
		
		
		
	$('#btnBuscarPaciente').on('click', function(){
			$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td>';
					cadena=cadena+'<td><a href="citasregistrar1.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/aceptar.png"/></td></tr>'
					$("#resultado").append(cadena);
				 }
			});
		});
	
	//Sistema de Citas
	$("div.mensaje").html("<span class='img' /><span id='msj' class='msj' />");
	ocultarMensajes();
	
	$('#btnTerminar').on('click', function(){
						 window.location.href="principal.php";
					});

});

function activarpaciente(id,nombre){
	if(confirm("Esta seguro que desea activar a "+nombre)){
		var url="servicios/cambiarEstadoPaciente.php?clave_paciente="+id+"&clave_estado_paciente=1";
		$.getJSON(url, function(data) {	
			$('html,body').scrollTop(0);
			if(data[0].resultado=="1"){					
				mostrarMensajeOkSinURL("Se activo correctamente el paciente",3);
				consultarPacientes();
			}else{
				mostrarMensajeError("Hubo un error al activar el paciente, favor de contactar al administrador",5);
			}
		});
	}
}

function desactivarpaciente(id,nombre){
	if(confirm("Esta seguro que desea desactivar a "+nombre)){
		var url="servicios/cambiarEstadoPaciente.php?clave_paciente="+id+"&clave_estado_paciente=2";
		$.getJSON(url, function(data) {	
			$('html,body').scrollTop(0);
			if(data[0].resultado=="1"){					
				mostrarMensajeOkSinURL("Se desactivo correctamente el paciente",3);
				consultarPacientes();
			}else{
				mostrarMensajeError("Hubo un error al desactivar el paciente, favor de contactar al administrador",5);
			}
		});
	}
}

function consultarPacientes(){
	$.getJSON('servicios/consultarPaciente.php?palabra='+$("#paciente").val(), function(data) {
				$("#resultado").html("");				
				for(var i = 0; i < data.length; i++) { 
					var nombre=data[i].nombre_paciente+" "+data[i].apellido_paterno_paciente+" "+data[i].apellido_materno_paciente;
					var cadena='<tr><td>'+data[i].codigo_paciente+'</td><td>'+data[i].nombre_paciente+'</td><td>'+data[i].apellido_paterno_paciente+'</td><td>'+data[i].apellido_materno_paciente+'</td><td>'+data[i].descripcion_estado_paciente+'</td>';
					cadena=cadena+'<td><a href="pacienteeditar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/editar.png"/></a>&nbsp;&nbsp;';
					
					if(data[i].clave_estado_paciente==="1" ){
						cadena=cadena+'<a href="#" onclick="desactivarpaciente('+data[i].clave_paciente+',\''+nombre+'\')"><img src="images/activo.png"/></a>&nbsp;&nbsp;';					
					}else if(data[i].clave_estado_paciente==="2" ){
						cadena=cadena+'<a href="#" onclick="activarpaciente('+data[i].clave_paciente+',\''+nombre+'\')"><img src="images/inactivo.png"/></a>&nbsp;&nbsp;';	
					}else{
						cadena=cadena+'<img src="images/baja.png"/>&nbsp;&nbsp;';
					}
					
					cadena=cadena+'<a href="pacientedetalles.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/detalles.png"/></a>&nbsp;&nbsp;';
					cadena=cadena+'<a href="pacienteeliminar.php?clave_paciente='+data[i].clave_paciente+'&nombre_paciente='+nombre+'">';
					cadena=cadena+'<img src="images/eliminar.png"/></a></td></tr>'
					$("#resultado").append(cadena);
				 }
			});
}

function mostrarMensajeInf(mensaje, segundosTimeout) {
    var le = $("#main").width() / 2 - $("#mensajeInfo").width() / 2
    $("#mensajeInfo").css({
        top: $("#main").offset().top + 5,
        left: $("#main").offset().left + le
    });
    $("#mensajeInfo").fadeIn();
    $("#mensajeInfo #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajeInf()", segundosTimeout * 1000);
    }
}

function mostrarMensajeError(mensaje, segundosTimeout) {	
    var le = $("#main").width() / 2 - $("#mensajeError").width() / 2
    $("#mensajeError").css({
        top: $("#main").offset().top + 50,
        left: $("#main").offset().left + le
    });
    $("#mensajeError").fadeIn();
    $("#mensajeError #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajeError()", segundosTimeout * 1000);
    }
}

function mostrarMensajeCargando(mensaje, segundosTimeout) {
    var le = $("#main").width() / 2 - $("#mensajeCargando").width() / 2
    $("#mensajeCargando").css({
        top: $("#main").offset().top + 5,
        left: $("#main").offset().left + le
    });
    $("#mensajeCargando").fadeIn();
    $("#mensajeCargando #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajeCargando()", segundosTimeout * 1000);
    }
}

function mostrarMensajeOkSinURL(mensaje, segundosTimeout) {	
    var le = $("#main").width() / 2 - $("#mensajeOK").width() / 2
    $("#mensajeOK").css({
        top: $("#main").offset().top + 50,
        left: $("#main").offset().left + le
    });
    $("#mensajeOK").fadeIn();
    $("#mensajeOK #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajeOK()", segundosTimeout * 1000);
    }
}

function mostrarMensajeOK(mensaje, segundosTimeout,url) {
    var le = $("#main").width() / 2 - $("#mensajeOK").width() / 2
    $("#mensajeOK").css({
        top: $("#main").offset().top + 5,
        left: $("#main").offset().left + le
    });
    $("#mensajeOK").fadeIn();
    $("#mensajeOK #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajeOK()", segundosTimeout * 1000);
		if(url=="refresh"){
			setTimeout(function () {
			   window.location.reload();
			}, segundosTimeout*1000);
		}else if(url!=""){
			setTimeout(function () {
			   window.location.href=url;
			}, segundosTimeout*1000);
		}
    }		
}


function mostrarMensajePreventivo(mensaje, segundosTimeout) {
    var le = $("#main").width() / 2 - $("#mensajePreventivo").width() / 2
    $("#mensajePreventivo").css({
        top: $("#main").offset().top + 5,
        left: $("#main").offset().left + le
    });
    $("#mensajePreventivo").fadeIn();
    $("#mensajePreventivo #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajePreventivo()", segundosTimeout * 1000);
    }
}

function mostrarMensajePreventivoRef(mensaje, segundosTimeout) {
    var le = $("#main").width() / 2 - $("#mensajePreventivo").width() / 2
    $("#mensajePreventivo").css({
        top: $("#main").offset().top + 5,
        left: $("#main").offset().left + le
    });
    $("#mensajePreventivo").fadeIn();
    $("#mensajePreventivo #msj").html(mensaje);
    if (segundosTimeout) {
        setTimeout("ocultarMensajePreventivo()", segundosTimeout * 1000);
		setTimeout(function () {
			   window.location.reload();
			}, segundosTimeout*1000);
    }	
}

function ocultarMensajeInf() {
    $("#mensajeInfo").hide();
}

function ocultarMensajeCargando() {
    $("#mensajeCargando").hide();
}

function ocultarMensajeError() {
    $("#mensajeError").hide();
}

function ocultarMensajeOK() {
    $("#mensajeOK").hide();
}

function ocultarMensajePreventivo() {
    $("#mensajePreventivo").hide();
}

function ocultarMensajes() {
    ocultarMensajeInf();
    ocultarMensajeError();
    ocultarMensajeCargando();
    ocultarMensajeOK();
    ocultarMensajePreventivo();
}

