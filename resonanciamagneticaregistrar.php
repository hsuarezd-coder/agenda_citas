<?php include("header.php"); 
$clave_paciente=$_GET['clave_paciente'];
$nombre_paciente=$_GET['nombre_paciente'];
?>	

<h2>Registrar Resonancia Magnética para <?php echo $nombre_paciente; ?></h2>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>

    $(document).ready(function () {
        var form = $("#formulario");
        /*form.validate();*/


        $("#fecha_estudio").datepicker({dateFormat: 'yy-mm-dd'});
        $("#tabs").tabs();


        /*$.getJSON('servicios/consultaEntidadesFederativas.php', function(data) {
         $("#entidades_federativas").html("");
         $("#entidades_federativas").append('<option value="0">Selecciona una Entidad Federativa</option>');			
         for(var i = 0; i < data.length; i++) { 					
         $("#entidades_federativas").append('<option value="'+data[i].clave_entidad_federativa+'">'+data[i].nombre+'</option>');
         }
         });*/
		 
		 $('#btnRegistrarRM').on('click', function(){		
			if(!form.valid()){
					$('html,body').scrollTop(0);
					mostrarMensajePreventivo("Favor de Capturar los campos requeridos.",5);
					return;
				}
		 });

    });
</script>
<style>





</style>
<form id="formulario">
	<input type="hidden" name="clave_paciente" id="clave_paciente" value="<?php echo $clave_paciente;?>">
	<input type="hidden" name="nombre_paciente" id="nombre_paciente" value="<?php echo $nombre_paciente;?>">
	<input type="hidden" name="clave_personal" id="clave_personal" values="<?php echo $clave_personal;?>">
		
    <div id="tabs" style="width:980px;">
        <ul>
            <li><a href="#tabs-1">Región supratentorial</a></li>
            <li><a href="#tabs-2">Región infratentorial</a></li>
            <li><a href="#tabs-3">Resonancias anteriores</a></li>
        </ul>
        <div id="tabs-1">
            <div class="display-form">
                <div class="editor-label">
                    Fecha de estudio:
                </div>
                <div class="editor-field">
                    <input type="text" id="fecha_estudio" required>
                </div> 
            </div>		
            <div class="display-form">
                <div class="editor-label">
                    Edad en el estudio:
                </div>
                <div class="editor-field">
                    <input type="text" name="edad_en_estudio" id="edad_en_estudio" required/>
                </div> 
            </div>
            <div class="display-form">
                <div class="editor-label">
                    Edad corregida en el estudio:
                </div>
                <div class="editor-field">
                    <input type="text" name="edad_corregida_estudio" id="edad_corregida_estudio" required/>
                </div> 
            </div>
            <div class="display-form">
                <div class="editor-label">
                    Número de estudio:
                </div>
                <div class="editor-field">
                    <input type="text" name="numero_estudio" id="numero_estudio" required/>
                </div> 
            </div>	
			<div class="display-form">
                <div class="editor-label">
                    Estudio:
                </div>
                <div class="editor-field">
                    <select id="estudio" class="mitad" required>
                        <option value="">Selecciona una opción</option>					
						<option value="completo">Completo</option>					
						<option value="incompleto">Incompleto</option>					
                    </select>
                </div> 
            </div>
            <div class="display-form">
                <div class="editor-label">
                    Equipo:
                </div>
                <div class="editor-field">
                    <select id="equipo" class="mitad" required>
                        <option value="">Selecciona una opción</option>					
                    </select>
                </div> 
            </div>
            

            <fieldset class="contenedorFormulario">
                <legend>Secuencias</legend>
                <input type="checkbox" name="secuencias" id="secuencias" value="T1W 3D">T1W 3D&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="secuencias" id="secuencias" value="T2W 3D">T2W 3D&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="secuencias" id="secuencias" value="ANGIO 3D TOF">ANGIO 3D TOF&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="secuencias" id="secuencias" value="DTI">DTI&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="secuencias" id="secuencias" value="AXT2W FSE">AXT2W FSE&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="secuencias" id="secuencias" value="FMRI RESTING-STATE">FMRI RESTING-STATE&nbsp;&nbsp;&nbsp;&nbsp;
            </fieldset>

            <fieldset class="contenedorFormulario">
                <legend>Ventrículo lateral derecho</legend>
                <div class="display-form">
                    <div class="editor-label">
                        Ventrículo lateral derecho:
                    </div>
                    <div class="editor-field">
                        <input type="text" name="ven_lat_der" id="ven_lat_der" required/>
                    </div> 
                </div>		
                <div class="display-form">
                    <div class="editor-label">
                        Morfología:
                    </div>
                    <div class="editor-field">
                        <select id="morfolo_vent_lat_der" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form">
                    <div class="editor-label">
                        Volumetría:
                    </div>
                    <div class="editor-field">
                        <select id="dimensiones_vent_lat_der" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
            </fieldset>

            <fieldset class="contenedorFormulario">
                <legend>Cuerpo calloso</legend>
                <div class="display-form">
                    <div class="editor-label">
                        Cuerpo calloso:
                    </div>
                    <div class="editor-field">
                        <input type="text" name="vol_cuerpo_calloso" id="vol_cuerpo_calloso" required/>
                    </div> 
                </div>		
                <div class="display-form">
                    <div class="editor-label">
                        Morfología:
                    </div>
                    <div class="editor-field">
                        <select id="morfolo_cuerpo_calloso" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form">
                    <div class="editor-label">
                        Volumetría:
                    </div>
                    <div class="editor-field">
                        <select id="dimensiones_cuerpo_calloso" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
            </fieldset>
            <fieldset class="contenedorFormulario">
                <legend>Ventrículo lateral izquierdo</legend>
                <div class="display-form">
                    <div class="editor-label">
                        Ventrículo lateral izquierdo:
                    </div>
                    <div class="editor-field">
                        <input type="text" name="ven_lat_izq" id="ven_lat_izq" required/>
                    </div> 
                </div>		
                <div class="display-form">
                    <div class="editor-label">
                        Morfología:
                    </div>
                    <div class="editor-field">
                        <select id="morfolo_vent_lat_izq" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form">
                    <div class="editor-label">
                        Volumetría:
                    </div>
                    <div class="editor-field">
                        <select id="dimensiones_vent_lat_izq" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
            </fieldset>
			<!--falta-->
            <fieldset class="contenedorFormulario">
                <legend>Descripción de la lesión</legend>				
                <div class="display-form">
                    <div class="editor-label">
                        Morfología:
                    </div>
                    <div class="editor-field">
                        <select id="morfolog_dif_sustan_blancgris" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form-long">
                    <div class="editor-label">
                        Volumetría:
                    </div>
                    <div class="editor-field-long">
                        <textarea name="observ_dif_sustan_blancgris" id="observ_dif_sustan_blancgris" >
                        </textarea>
                    </div> 
                </div>
            </fieldset>
			<!--falta-->
            <fieldset class="contenedorFormulario">
                <legend>Espacio subaracnoideo</legend>				
                <div class="display-form">
                    <div class="editor-label">
                        Dimensiones:
                    </div>
                    <div class="editor-field">
                        <select id="dimensiones_espacio_subaracno" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form">
                    <div class="editor-label">
                        Región:
                    </div>
                    <div class="editor-field">
                        <select id="region_espacio_subaracno" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
            </fieldset>
        </div>
        <div id="tabs-2">
            <fieldset class="contenedorFormulario">
                <legend>Estructura Osea</legend>				
                <div class="display-form">
                    <div class="editor-label">
                        Estructura Osea:
                    </div>
                    <div class="editor-field">
                        <select id="Jestrucctura_osea" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form-long">
                    <div class="editor-label">
                        Observaciones:
                    </div>
                    <div class="editor-field-long">
                        <textarea name="Jestrucctura_osea_observaciones" id="Jestrucctura_osea_observaciones">
                        </textarea>
                    </div> 
                </div>
            </fieldset>
            <fieldset class="contenedorFormulario">
                <legend>Angioresonancia</legend>				
                <div class="display-form">
                    <div class="editor-label">
                        Angioresonancia:
                    </div>
                    <div class="editor-field">
                        <select id="angioresonancia" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form-long">
                    <div class="editor-label">
                        Observaciones:
                    </div>
                    <div class="editor-field-long">
                        <textarea name="angioresonancia_observaciones" id="angioresonancia_observaciones">
                        </textarea>
                    </div> 
                </div>
            </fieldset>

            <fieldset class="contenedorFormulario">
                <legend>Clasificación Diagnóstica</legend>				
                <div class="display-form">
                    <div class="editor-label">
                        Encefalopatía del prematuro:
                    </div>
                    <div class="editor-field">
                        <select id="encefalopatia_prematuro" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
                <div class="display-form-long">
                    <div class="editor-label">
                        Observaciones generales:
                    </div>
                    <div class="editor-field-long">
                        <textarea name="observaciones_generales" id="observaciones_generales">
                        </textarea>
                    </div> 
                </div>
            </fieldset>
			<fieldset class="contenedorFormulario">
                <legend>Región Infretentorial</legend>				
				<div class="display-form">
                    <div class="editor-label">
                        IV Ventrículo:
                    </div>
                    <div class="editor-field">
                        <select id="regio_infratent_iv_ventric" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
				<div class="display-form">
                    <div class="editor-label">
                        Cerebelo:
                    </div>
                    <div class="editor-field">
                        <select id="regio_infratent_cerebelo" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>	
				<div class="display-form">
                    <div class="editor-label">
                        Angulos Puntocerebelosos:
                    </div>
                    <div class="editor-field">
                        <select id="regio_infratent_angul_puntocerebe" class="mitad" required>
                            <option value="">Selecciona una opción</option>					
                        </select>
                    </div> 
                </div>
				<div class="display-form-long">
                    <div class="editor-label">
                        Descripción de la lesión:
                    </div>
                    <div class="editor-field-long">
                        <textarea name="regio_infratent_descrip_lesion" id="regio_infratent_descrip_lesion" >
                        </textarea>
                    </div> 
                </div>
            </fieldset>
			<fieldset class="contenedorFormulario">
                <legend>Otros</legend>	
				<div class="display-form-long">
					<div class="editor-label">
						Conclusiones:
					</div>
					<div class="editor-field-long">
						<textarea name="conclusiones" id="conclusiones" >
						</textarea>
					</div> 
				</div>
				<div class="display-form-long">
					<div class="editor-label">
						Senos Paranasales:
					</div>
					<div class="editor-field-long">
						<textarea name="senos_paranasales" >
						</textarea>
					</div> 
				</div>
				<div class="display-form">
					<div class="editor-label">
						Impacto neurológico:
					</div>
					<div class="editor-field">
						<select id="impacto_neurologico" class="mitad" required>
							<option value="">Selecciona una opción</option>					
						</select>
					</div> 
				</div>
				<div class="display-form-long">
					<div class="editor-label">
						Análisis Tractográfico:
					</div>
					<div class="editor-field-long">
						<textarea name="analisis_tractograf" id="analisis_tractograf" >
						</textarea>
					</div> 
				</div>
			</fieldset>
        </div>
        <div id="tabs-3">
			<fieldset style="font-size:12px;">
			<legend>Lista de Resonancias anteriores</legend>	
			<style>
				.wmd-view-topscroll, .wmd-view {
					overflow-x: scroll;
					overflow-y: hidden;
					width: 900px;
					border: none 0px RED;
				}

				.wmd-view-topscroll { height: 20px; }
				.wmd-view { height: 400px; }
				.scroll-div1 { 
					width: 4000px; 
					overflow-x: scroll;
					overflow-y: hidden;
				}
				.scroll-div2 { 
					width: 4000px; 
					height:20px;
				}
				
				.scroll-div2 table{
					width: 4000px;
				}
			</style>
			<script>
				$(function(){
					$(".wmd-view-topscroll").scroll(function(){
						$(".wmd-view")
							.scrollLeft($(".wmd-view-topscroll").scrollLeft());
					});
					$(".wmd-view").scroll(function(){
						$(".wmd-view-topscroll")
							.scrollLeft($(".wmd-view").scrollLeft());
					});
				});
			</script>
			<div class="wmd-view-topscroll">
				<div class="scroll-div1">
				</div>
			</div>
			<div class="wmd-view">
				<div class="scroll-div2">

				<table>
					<thead>
						<tr>
							<th>Fecha de Estudio</th>
							<th>Edad en el estudio</th>
							<th>Edad corregida en el estudio</th>
							<th>Número de estudio</th>  
							<th>Equipo</th>  
							<th>Estudio</th>  
							<th>Secuencias</th>  
							<th>Ventrículo lateral derecho</th>  
							<th>VLD Morfología</th>  
							<th>VLD Volumetría</th>  
							<th>Cuerpo calloso</th>  
							<th>CC Morfología</th>  
							<th>CC Volumetría</th>  
							<th>Ventrículo lateral izquierdo</th>  
							<th>VLI Morfología</th>  
							<th>VLI Volumetría</th>  
							<th>Descripción de la lesión morfología</th>  
							<th>Descripción de la lesión Volumetría</th>  
							<th>Espacio subaracnoideo dimensiones</th>  
							<th>Espacio subaracnoideo Región</th>  
							<th>Estructura Osea</th>  
							<th>EO Observaciones</th> 
							<th>Angioresonancia </th>  
							<th>A Observaciones</th>  
							<th>CD Encefalopatía del prematuro</th>  
							<th>CD Observaciones generales</th>  
							<th>RI IV Ventrículo</th>  
							<th>RI Cerebelo</th>  
							<th>RI Angulos Puntocerebelosos</th> 
							<th>RI Descripción de la lesión</th>  
							<th>Conclusiones</th> 
							<th>Senos Paranasales</th>  
							<th>Impacto neurológico</th> 
							<th>Análisis Tractográfico</th>
						</tr>
					</thead>
					<tbody id="resultadoResonancias">
										 
					</tbody>
				</table>
				</div>
			</div>				
		</fieldset>
        </div>
    </div>

    <div style="width:100%;height:20px;display:inline-block;"></div>
    <div style="text-align:center;">
        <input type="button" class="button" id="btnRegistrarRM" value="Registrar">
    </div>
    <div style="width:100%;height:20px;display:inline-block;"></div>

</form>


<?php include("footer.php"); ?>