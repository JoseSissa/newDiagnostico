<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico CCTN</title>
    <link rel="stylesheet" href="Resources/css/style.css">
</head>

<body>
    <header class="banner">
        <div class="imagenes-logos">
            <img src="Resources/img/logos/CCB.png" alt="Logo-ccb">
            <img src="Resources/img/logos/CCTN.jpg" alt="Logo-cctn">
            <img src="Resources/img/logos/PNUD.jpg" alt="Logo-pnud">
            <img src="Resources/img/logos/5T.png" alt="Logo-5t">
        </div>
    </header>

    <main>
        <form class="" id="" name="" action="./" method="POST" role="form" enctype="multipart/form-data" autocomplete="on" >
            <div class="deudor-contenedor" id="div_tipo_persona" name="div_tipo_persona" >
                <div class="deudor-caja">
                    <div class="deudor-encabezado">
                        <h4 class="deudor-encabezado__titulo">DATOS GENERALES</h4>
                        <div class="deudor-seccion-icono">
                            <img src="Resources/img/icono-datos-personales.svg" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="deudor-control deudor-control__valor-solicitado">
                            <label for="valor_solicitado">Valor</label>
                            <div class="input-icon">
                                <input type="text" inputmode="numeric" pattern="[0-9.]*" class="form-control" id="valor_solicitado" name="valor_solicitado" oninput="validarValorSolicitado(this)" style="padding-left: 25px;" onchange="validarDivPersona()" onfocusout="mensajeValorSolicitado(this)" placeholder="Escribe..." value="<?php if (isset($_SESSION['valor_solicitado'])) { echo $_SESSION['valor_solicitado']; } ?>" required >
                                <i>$</i>
                            </div>
                        </div>
                        <div class="deudor-control deudor-control__plazo">
                            <label for="plazo">Plazo (meses)</label>
                            <select class="form-control" id="plazo" name="plazo" onchange="validarDivPersona()" required >
                                <option value="" >-Escoge-</option>
                                <option value="6" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "6") { echo " selected "; } } ?> >6</option>
                                <option value="12" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "12") { echo " selected "; } } ?> >12</option>
                                <option value="18" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "18") { echo " selected "; } } ?> >18</option>
                                <option value="24" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "24") { echo " selected "; } } ?> >24</option>
                                <option value="30" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "30") { echo " selected "; } } ?> >30</option>
                                <option value="36" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "36") { echo " selected "; } } ?> >36</option>
                                <option value="42" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "42") { echo " selected "; } } ?> >42</option>
                                <option value="48" <?php if (isset($_SESSION['plazo'])) { if ($_SESSION['plazo'] == "48") { echo " selected "; } } ?> >48</option>
                            </select>
                        </div>
                        <div class="deudor-control deudor-control__destino-credito">
                            <label for="destino_credito">Por favor describir el rubro del plan de inversión</label>
                            <input type="text" class="form-control" id="destino_credito" name="destino_credito" onchange="validarDivPersona()" placeholder="Escribe..." value="<?php if (isset($_SESSION['destino_credito'])) { echo $_SESSION['destino_credito']; } ?>" required >
                        </div>
                    </div>
                </div>
            </div>

            <div class="deudor-contenedor" id="div_datos_empresariales" name="div_datos_empresariales" >
                <div class="deudor-encabezado">
                    <h4 class="deudor-encabezado__titulo">TUS DATOS EMPRESARIALES</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-datos-personales.svg" />
                    </div>
                </div>
                <div class="deudor-caja">
                    <div class="row">
                        <div class="deudor-control" >
                            <label for="nombre_empresa">Nombre de la empresa (verifique que sea el nombre como registra en certificado de Cámara de Comercio o de Registro Único Tributario (RUT))</label>
                            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" onchange="validarDivDatosEmpresariales()" placeholder="Escribe..." value="<?php if (isset($_SESSION['nombre_empresa'])) { echo $_SESSION['nombre_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 200px;" >
                            <label for="nit">NIT</label>
                            <input type="text" inputmode="numeric" pattern="[0-9.-]*" class="form-control" id="nit" name="nit" onchange="validarDivDatosEmpresariales()" placeholder="Escribe..." value="<?php if (isset($_SESSION['nit'])) { echo $_SESSION['nit']; } ?>" required >
                        </div>
                        <div class="deudor-control">
                            <label for="direccion_empresa">Dirección</label>
                            <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" onchange="validarDivDatosEmpresariales()" placeholder="Escribe..." value="<?php if (isset($_SESSION['direccion_empresa'])) { echo $_SESSION['direccion_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control campo-ciudad" style="display: flex; flex-direction: column;">
                            <label for="ciudad_empresa">Ciudad</label>
                            <select class="form-control js-example-basic-single" id="ciudad_empresa" name="ciudad_empresa" onchange="validarDivDatosEmpresariales()" required >
                                <option selected>-Escoge-</option>
                                <?php
                                for ($i = 0; $i < sizeof($listado_ciudades); $i++) {
                                    echo '<option value="' . $listado_ciudades[$i]['codigo'] . '" ';
                                    if (isset($_SESSION['ciudad_empresa'])) { if ($_SESSION['ciudad_empresa'] == $listado_ciudades[$i]['codigo']) { echo " selected "; } }
                                    echo ' >' . mb_convert_case($listado_ciudades[$i]['ciudad'], MB_CASE_TITLE, "UTF-8") . ' (' . mb_convert_case($listado_ciudades[$i]['departamento'], MB_CASE_TITLE, "UTF-8") . ')</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="deudor-control" style="width: 200px;">
                            <label for="numero_contacto_empresa">Número de contacto</label>
                            <input type="text" inputmode="numeric" pattern="[0-9.]*" class="form-control" id="numero_contacto_empresa" name="numero_contacto_empresa" maxlength="15" onchange="validarDivDatosEmpresariales()" placeholder="XXX XXX XXXX" value="<?php if (isset($_SESSION['numero_contacto_empresa'])) { echo $_SESSION['numero_contacto_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 230px;">
                            <label for="antiguedad_empresa">Antigüedad empresa</label>
                            <input type="number" class="form-control" id="antiguedad_empresa" name="antiguedad_empresa" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="validarDivDatosEmpresariales()" placeholder="Años..." value="<?php if (isset($_SESSION['antiguedad_empresa'])) { echo $_SESSION['antiguedad_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 270px">
                            <label for="migrante_retornado">¿Alguno de los socios o accionistas de la empresa es migrante venezolano o colombiano retornado?</label>
                            <select class="form-control" id="migrante_retornado" name="migrante_retornado" onchange="validarDivPersona()" required >
                                <option value="" >-Escoge-</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="deudor-contenedor" id="" name="" >
                <div class="deudor-encabezado">
                    <h4 class="deudor-encabezado__titulo">INFORMACIÓN FINANCIERA</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-informacion-financiera.svg" />
                    </div>
                    <div class="deudor-seccion-listo-con-encabezado" id="div_informacion_financiera_persona_juridica_icono_pendiente" name="div_informacion_financiera_persona_juridica_icono_pendiente" >
                        <img src="Resources/img/pending.svg" />
                    </div>
                    <div class="deudor-seccion-listo-con-encabezado" id="div_informacion_financiera_persona_juridica_icono_completo" name="div_informacion_financiera_persona_juridica_icono_completo">
                        <img src="Resources/img/complete.svg" />
                    </div>
                </div>
                <div class="deudor-caja">
                    <div class="row d-flex justify-content-center" style="padding-top: 25px; padding: 25px 30px 0 30px; margin-bottom: 30px;">
                        <span>Adjunta los siguientes documentos (En formato de excel de preferencia):</span>
                    </div>
                    <div class="row d-flex" style="padding-top: 25px; justify-content: space-evenly;">
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Balance general (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_estados_financieros_label" name="adjuntar_estados_financieros_label" for="adjuntar_balance_general" ><p>Balance general</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_estados_financieros_icono_adjuntar" name="adjuntar_estados_financieros_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_balance_general" name="adjuntar_balance_general" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar($('#adjuntar_estados_financieros_label'));" onchange="" required multiple >
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Estado de resultados (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_estado_de_resultado_label" name="adjuntar_estado_de_resultado_label" for="adjuntar_estado_de_resultado" ><p>Estado de resultados</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_estados_resultado_icono_adjuntar" name="adjuntar_estados_resultado_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_estado_de_resultado" name="adjuntar_estado_de_resultado" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar($('#adjuntar_estado_de_resultado_label'));" onchange="validarEstadosFinancieros(); if( $(this).is(':invalid') == false ){ $('*').unbind('invalid'); } " oninvalid="$('*').on('invalid', function(e) { return false }); $('#modalValidacionEstadoResultado').modal('show'); document.getElementById('div_informacion_financiera_persona_juridica').scrollIntoView(); " required multiple >
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Declaración de renta (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_declaracion_renta_label" name="adjuntar_declaracion_renta_label" for="adjuntar_declaracion_renta" ><p>Declaración de renta</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_declaracion_renta_icono_adjuntar" name="adjuntar_declaracion_renta_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_declaracion_renta" name="adjuntar_declaracion_renta" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar($('#adjuntar_declaracion_renta_label'));" onchange="validarEstadosFinancieros(); if( $(this).is(':invalid') == false ){ $('*').unbind('invalid'); } " oninvalid="$('*').on('invalid', function(e) { return false }); $('#modalValidacionDeclaracionRenta').modal('show'); document.getElementById('div_informacion_financiera_persona_juridica').scrollIntoView(); " required multiple >
                        </div>
                    </div>
                </div>
            </div>
            <div class="deudor-contenedor" id="div_autorizaciones" name="div_autorizaciones" >
                <div class="deudor-encabezado" style="height: 65px">
                    <h4 class="deudor-encabezado__titulo" style="margin: 0" >PROTECCIÓN DE DATOS</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-terminos-condiciones.svg" />
                    </div>
                    <!-- <div class="deudor-seccion-listo-con-encabezado" id="div_terminos_y_condiciones_icono_pendiente" name="div_terminos_y_condiciones_icono_pendiente" >
                        <img src="Resources/img/pending.svg" />
                    </div>
                    <div class="deudor-seccion-listo-con-encabezado" id="div_terminos_y_condiciones_icono_completo" name="div_terminos_y_condiciones_icono_completo">
                        <img src="Resources/img/complete.svg" />
                    </div> -->
                </div>
                <div class="deudor-caja" style="margin: 20px 0 0 0 !important" >
                    <div class="row" style="text-align: justify !important; padding: 0px 30px">
                        <p style="word-break: break-word;">
                        Yo en mi calidad de titular de la información, por medio de la presente, manifiesto mi consentimiento previo, libre, expreso e informado para que Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) o a quien represente sus derechos para tratar, consultar, solicitar, procesar, reportar y divulgar los datos personales por mi suministrados, conforme su Política de Tratamiento de Datos Personales y finalidades indicadas.
                        </p>
                    </div>
                    <div class="row d-flex justify-content-center" style="padding-top: 4px">
                        <a onclick="$('#modalTerminosYCondiciones').modal('toggle');"><u>Ver términos y condiciones</u></a>
                    </div>
                    <div class="row d-flex justify-content-center" style="padding-top: 20px">
                        <input id="terminos_condiciones" name="terminos_condiciones" type="hidden" value="no-acepto">
                        <button id="btnAutorizacion" name="btnAutorizacion" class="boton-formulario" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacion(this)" >Acepto</button>
                    </div>
                </div>
            </div>

            <div class="deudor-contenedor" id="div_autorizaciones_consulta_centrales" name="div_autorizaciones_consulta_centrales" >
                <div class="deudor-encabezado" style="height: 65px">
                    <h4 class="deudor-encabezado__titulo" style="margin: 0" >CONSULTA EN CENTRALES DE RIESGO</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-terminos-condiciones.svg" />
                    </div>
                    <div class="deudor-seccion-listo-con-encabezado" id="div_centrales_riesgo_icono_pendiente" name="div_centrales_riesgo_icono_pendiente" >
                        <img src="Resources/img/pending.svg" />
                    </div>
                </div>
                <div class="deudor-caja" style="margin: 20px 0 0 0 !important" >
                    <div class="row" style="text-align: justify !important; padding: 0px 30px">
                        <p style="word-break: break-word;">
                        Por medio del presente escrito autorizo a Vanka SAS (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) o a quien represente sus derechos, para que adelante la consulta en relación al comportamiento financiero en las bases de datos propias o de centrales de riesgo (Datacrédito, Cifin, entre otras similares).
                        </p>
                    </div>
                    <div class="row d-flex justify-content-center" style="padding-top: 4px">
                        <a onclick="$('#modalConsultaCentrales').modal('toggle');"><u>Ver términos y condiciones</u></a>
                    </div>
                    <div class="row d-flex" style="justify-content: space-evenly; padding-top: 20px">
                        <input id="consulta_centrales_de_riesgo" name="consulta_centrales_de_riesgo" type="hidden" value="">
                        <button id="btnSiCentralesRiesgo" name="btnSiCentralesRiesgo" class="boton-terminos" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacionCentrales(this)"><img src="Resources/img/complete-gray.svg" alt="check"></button>
                        <button id="btnNoCentralesRiesgo" name="btnNoCentralesRiesgo" class="boton-terminos" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacionCentrales(this)"><img src="Resources/img/wrong-cancel.svg" alt="check"></button>
                    </div>
                </div>
            </div>

            <div style="text-align: center; padding-top: 30px; padding-bottom: 200px;" id="div_botones" name="div_botones" >

                <div style="display: flex; flex-direction: row; align-items: flex-start; justify-content: center; flex-wrap: wrap">
                    <button id="btnSiguiente" name="btnSiguiente" class="boton-siguiente" type="submit" onclick="verificarDatosFormulario(event)">Enviar</button>
                </div>

            </div>
        </form>
    </main>

    <footer>

    </footer>
</body>

</html>