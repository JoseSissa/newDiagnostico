<?php 

include './connection.php';
$connection = new Connection();
$listado_ciudades = $connection->obtDatos();
// echo gettype($listado_ciudades);
echo "<pre>";
// var_dump($listado_ciudades);
echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico CCTN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mulish:300,400,500,700&display=swap">
    <link rel="stylesheet" href="Resources/css/style.css">
    <script src="Resources/js/scripts.js" defer></script>
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
        <form class="needs-validation" id="mainForm" name="mainForm" action="./guardarDatos.php" method="POST" role="form" enctype="multipart/form-data" autocomplete="on" >
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
                                <input type="number" inputmode="numeric" pattern="[0-9.]*" class="form-control" id="valor_solicitado" name="valor_solicitado"  style="padding-left: 25px;" onchange="validar(this)" onfocusout="validar(this)" placeholder="Escribe..." required >
                                <i>$</i>
                            </div>
                        </div>
                        <div class="deudor-control deudor-control__plazo">
                            <label for="plazo">Plazo (meses)</label>
                            <select class="form-control" id="plazo" name="plazo" required >
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
                            <input type="text" class="form-control" id="destino_credito" name="destino_credito" placeholder="Escribe..." value="<?php if (isset($_SESSION['destino_credito'])) { echo $_SESSION['destino_credito']; } ?>" required >
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
                            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Escribe..." value="<?php if (isset($_SESSION['nombre_empresa'])) { echo $_SESSION['nombre_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 200px;" >
                            <label for="nit">NIT</label>
                            <input type="text" inputmode="numeric" pattern="[0-9.-]*" class="form-control" id="nit" name="nit" placeholder="Escribe..." value="<?php if (isset($_SESSION['nit'])) { echo $_SESSION['nit']; } ?>" required >
                        </div>
                        <div class="deudor-control">
                            <label for="direccion_empresa">Dirección</label>
                            <input type="text" class="form-control" id="direccion_empresa" name="direccion_empresa" placeholder="Escribe..." value="<?php if (isset($_SESSION['direccion_empresa'])) { echo $_SESSION['direccion_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control campo-ciudad" style="display: flex; flex-direction: column;">
                            <label for="ciudad_empresa">Ciudad</label>
                            <select class="form-control js-example-basic-single" id="ciudad_empresa" name="ciudad_empresa" required >
                                <option selected>-Escoge-</option>
                                <?php
                                for ($i = 0; $i < sizeof($listado_ciudades); $i++) {
                                    echo '<option value="' . $listado_ciudades[$i]['ciudad'] .' - '. $listado_ciudades[$i]['departamento'] . '" ';
                                    echo ' >' . mb_convert_case($listado_ciudades[$i]['ciudad'], MB_CASE_TITLE, "UTF-8") . ' (' . mb_convert_case($listado_ciudades[$i]['departamento'], MB_CASE_TITLE, "UTF-8") . ')</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="deudor-control" style="width: 200px;">
                            <label for="numero_contacto_empresa">Número de contacto</label>
                            <input type="text" inputmode="numeric" pattern="[0-9.]*" class="form-control" id="numero_contacto_empresa" name="numero_contacto_empresa" maxlength="15" placeholder="XXX XXX XXXX" value="<?php if (isset($_SESSION['numero_contacto_empresa'])) { echo $_SESSION['numero_contacto_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 230px;">
                            <label for="antiguedad_empresa">Antigüedad empresa</label>
                            <input type="number" class="form-control" id="antiguedad_empresa" name="antiguedad_empresa" min=0 onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Años..." value="<?php if (isset($_SESSION['antiguedad_empresa'])) { echo $_SESSION['antiguedad_empresa']; } ?>" required >
                        </div>
                        <div class="deudor-control" style="width: 270px">
                            <label for="migrante_retornado">¿Alguno de los socios o accionistas de la empresa es migrante venezolano o colombiano retornado?</label>
                            <select class="form-control" id="migrante_retornado" name="migrante_retornado" required >
                                <option value="" >-Escoge-</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="deudor-contenedor" id="div_informacion_financiera_persona_juridica" name="div_informacion_financiera_persona_juridica" >
                <div class="deudor-encabezado">
                    <h4 class="deudor-encabezado__titulo">INFORMACIÓN FINANCIERA</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-informacion-financiera.svg" />
                    </div>
                    <!-- <div class="deudor-seccion-listo-con-encabezado" id="div_informacion_financiera_persona_juridica_icono_pendiente" name="div_informacion_financiera_persona_juridica_icono_pendiente" >
                        <img src="Resources/img/pending.svg" />
                    </div>
                    <div class="deudor-seccion-listo-con-encabezado" id="div_informacion_financiera_persona_juridica_icono_completo" name="div_informacion_financiera_persona_juridica_icono_completo">
                        <img src="Resources/img/complete.svg" />
                    </div> -->
                </div>
                <div class="deudor-caja">
                    <div class="row d-flex justify-content-center" style="padding-top: 25px; padding: 25px 30px 0 30px; margin-bottom: 30px;">
                        <span>Adjunta los siguientes documentos (En formato de excel de preferencia):</span>
                    </div>
                    <div class="row d-flex" style="padding: 25px 16px 0; justify-content: space-evenly; align-items: center;">
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Balance general (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_estados_financieros_label" name="adjuntar_estados_financieros_label" for="adjuntar_balance_general" ><p>Balance general</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_estados_financieros_icono_adjuntar" name="adjuntar_estados_financieros_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_balance_general" name="adjuntar_balance_general" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar('adjuntar_estados_financieros_label')"
                            onchange="validarDocumentos(this, 'adjuntar_estados_financieros_label')" required >
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Estado de resultados (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_estado_de_resultado_label" name="adjuntar_estado_de_resultado_label" for="adjuntar_estado_de_resultado" ><p>Estado de resultados</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_estados_resultado_icono_adjuntar" name="adjuntar_estados_resultado_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_estado_de_resultado" name="adjuntar_estado_de_resultado" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar('adjuntar_estado_de_resultado_label')" onchange="validarDocumentos(this, 'adjuntar_estado_de_resultado_label')" required >
                        </div>
                        <div style="display: flex; flex-direction: column; justify-content: space-between; max-width: 250px;">
                            <p>Declaración de renta (del año 2022 o del último año que se tenga)</p>
                            <label class="boton-adjuntar-cedula boton-adjuntar-estados-financieros" style="background-image: url(Resources/img/boton-adjuntar-cedula.svg)" id="adjuntar_declaracion_renta_label" name="adjuntar_declaracion_renta_label" for="adjuntar_declaracion_renta" ><p>Declaración de renta</p><img class="boton-adjuntar-cedula-icono-adjuntar" style="height: 70% !important; " id="adjuntar_declaracion_renta_icono_adjuntar" name="adjuntar_declaracion_renta_icono_adjuntar" src="Resources/img/icono-adjuntar.svg" /></label>
                            <input id="adjuntar_declaracion_renta" name="adjuntar_declaracion_renta" type="file" accept="image/*, application/pdf" onclick="animacionBotonAdjuntarAlPresionar('adjuntar_declaracion_renta_label')" onchange="validarDocumentos(this, 'adjuntar_declaracion_renta_label')" required >
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
                    <div class="row d-flex justify-content-center" style="padding-top: 4px; text-align: center;">
                        <a onclick="mostrarModalTerminosCondiciones('modalTerminosYCondiciones')"><u>Ver términos y condiciones</u></a>
                    </div>
                    <div class="row d-flex justify-content-center centrar-boton" style="padding-top: 20px">
                        <input id="terminos_condiciones" name="terminos_condiciones" type="hidden" value="no-acepto">
                        <button id="btnAutorizacion" name="btnAutorizacion" class="boton-formulario" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacion(this)">Acepto</button>
                    </div>
                </div>
            </div>

            <div class="deudor-contenedor" id="div_autorizaciones_consulta_centrales" name="div_autorizaciones_consulta_centrales" >
                <div class="deudor-encabezado" style="height: 65px">
                    <h4 class="deudor-encabezado__titulo" style="margin: 0" >CONSULTA EN CENTRALES DE RIESGO</h4>
                    <div class="deudor-seccion-icono">
                        <img src="Resources/img/icono-terminos-condiciones.svg" />
                    </div>
                    <!-- <div class="deudor-seccion-listo-con-encabezado" id="div_centrales_riesgo_icono_pendiente" name="div_centrales_riesgo_icono_pendiente" >
                        <img src="Resources/img/pending.svg" />
                    </div> -->
                </div>
                <div class="deudor-caja" style="margin: 20px 0 0 0 !important" >
                    <div class="row" style="text-align: justify !important; padding: 0px 30px">
                        <p style="word-break: break-word;">
                        Por medio del presente escrito autorizo a Vanka SAS (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) o a quien represente sus derechos, para que adelante la consulta en relación al comportamiento financiero en las bases de datos propias o de centrales de riesgo (Datacrédito, Cifin, entre otras similares).
                        </p>
                    </div>
                    <div class="row d-flex justify-content-center" style="padding-top: 4px; text-align: center;">
                        <a onclick="mostrarModalTerminosCondiciones('modalConsultaCentrales')"><u>Ver términos y condiciones</u></a>
                    </div>
                    <div class="row d-flex centrales-riesgo-botones" style="justify-content: space-evenly; padding-top: 20px">
                        <input id="consulta_centrales_de_riesgo" name="consulta_centrales_de_riesgo" type="hidden" value="">
                        <button id="btnSiCentralesRiesgo" name="btnSiCentralesRiesgo" class="boton-formulario" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacionCentrales(this, 'btnNoCentralesRiesgo')">Acepto 
                        <!-- <img src="Resources/img/complete-gray.svg" alt="check"> -->
                        </button>
                        <button id="btnNoCentralesRiesgo" name="btnNoCentralesRiesgo" class="boton-formulario" style="margin-bottom: 20px" type="button" onclick="validarBotonAutorizacionCentrales(this, 'btnSiCentralesRiesgo')">No acepto 
                        <!-- <img src="Resources/img/wrong-cancel.svg" alt="check"> -->
                        </button>
                    </div>
                </div>
            </div>

            <div style="text-align: center; padding-top: 30px; padding-bottom: 200px;" id="div_botones" name="div_botones" >

                <div style="display: flex; flex-direction: row; align-items: flex-start; justify-content: center; flex-wrap: wrap">
                    <button id="btnSiguiente" name="btnSiguiente" class="boton-siguiente" type="submit" onclick="verificarDatosFormulario(event)">Enviar</button>
                </div>

            </div>
        </form>


        <!-- Modal para los términos y condiciones -->
        <div class="modal fade hide" style="overflow-y: scroll; -webkit-overflow-scrolling: touch; " data-backdrop="static" data-keyboard="false" id="modalTerminosYCondiciones" tabindex="-1" role="dialog" aria-labelledby="modalTitulo" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 900px !important; padding: 0 8px;" role="document">
                <div class="modal-content" style="max-width: 900px" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitulo">Términos y condiciones</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="mostrarModalTerminosCondiciones('modalTerminosYCondiciones')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <b>Protección de Datos Personales.</b> Yo <b><span id="proteccion_datos_nombre" name="proteccion_datos_nombre"></span> <span id="proteccion_datos_primer_apellido" name="proteccion_datos_primer_apellido"></span> <span id="proteccion_datos_segundo_apellido" name="proteccion_datos_segundo_apellido"></span></b>
                            en mi calidad de titular de la información, por medio de la presente, manifiesto mi consentimiento previo, libre, expreso e informado para que
                            Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) o a quien represente sus derechos para tratar, consultar, solicitar, procesar, reportar y divulgar los datos personales por mi
                            suministrados, conforme su Política de Tratamiento de Datos Personales y finalidades indicadas. De igual forma, manifiesto que Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio), de
                            manera clara y expresa, me informó de lo siguiente: (1) los datos personales que serán recolectados o que han sido recolectados; (2) las
                            finalidades específicas del tratamiento de los datos personales recolectados y para los cuales se obtiene el consentimiento; (3) el tratamiento
                            al cual serán sometidos los datos personales y las Políticas para el Tratamiento de Datos Personales, así como el lugar en donde puedo consultar
                            las Políticas y/o solicitar copia de la misma; (4) el carácter facultativo de la respuesta a las preguntas que le sean hechas, cuando estas
                            versen sobre datos sensibles o sobre los datos de las niñas, niños y adolescentes; (5) los derechos que me asisten como titular y el
                            procedimiento para su ejercicio; (6) la identificación, dirección física o electrónica y teléfono del Responsable del Tratamiento. Lo anterior
                            en base a las leyes 1712 de 2014 y 1377 de 2013.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="boton-formulario active" type="button" data-dismiss="modal" onclick="mostrarModalTerminosCondiciones('modalTerminosYCondiciones')">Regresar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Consulta en centrales de riesgo -->
        <div class="modal fade hide" style="overflow-y: scroll; -webkit-overflow-scrolling: touch; " data-backdrop="static" data-keyboard="false" id="modalConsultaCentrales" tabindex="-1" role="dialog" aria-labelledby="modalTitulo" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 900px !important; padding: 0 8px;" role="document">
                <div class="modal-content" style="max-width: 900px" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitulo">Consulta en centrales de riesgo</h5>
                        <button type="button" class="close" data-dismiss="modal" onclick="mostrarModalTerminosCondiciones('modalConsultaCentrales')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <b>Consulta en centrales de riesgo.</b> Yo <b><span id="consulta_centrales_nombre" name="consulta_centrales_nombre"></span> <span id="consulta_centrales_primer_apellido" name="consulta_centrales_primer_apellido"></span> <span id="consulta_centrales_segundo_apellido" name="consulta_centrales_segundo_apellido"></span></b>
                            autorizo, de forma expresa, informada y consentida a Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) o a quien represente sus derechos, para que adelante las consultas que sean
                            necesarias en las bases o bancos de datos propias o de centrales de riesgo (desacredito, cifin, entre otras y similares) relativas a mi
                            comportamiento comercial, crediticio y el manejo de los diferentes productos de las entidades financieras, solidarias, del sector real y
                            similares que tenga y, en general, sobre el cumplimiento de todas las obligaciones de carácter pecuniario a mi cargo. Igualmente, autorizo a
                            Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio) para que haga los reportes pertinentes a las centrales de riesgos existentes o que llegaren a existir, de datos, tratados o sin
                            tratar, tanto sobre el cumplimiento oportuno como sobre el incumplimiento, si lo hubiera, de las obligaciones, o de los deberes legales o
                            contractuales de contenido patrimonial cuando quiera que incurra en mora en el pago de mis obligaciones con Vanka S.A.S. (aliado de 5T SAS y Cámara de Comercio de Bucaramanga para el programa Creciendo con tu Negocio).
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="boton-formulario active" type="button" data-dismiss="modal" onclick="mostrarModalTerminosCondiciones('modalConsultaCentrales')" >Regresar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para los mensajes -->
        <div class="modal fade hide" id="modalParalosMensajes">
            <div class="modal-dialog" style="max-width: 500px !important;" role="document">
                <div class="modal-content" style="max-width: 500px" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitulo">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ocultarModalMensajes(this, ' ')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-valor-solicitado-body" style="overflow-y: hidden; padding: 8px 16px">
                        <p style="margin: 0" id="texto-dinamico">
                            Monto mínimo de 3'000.000 COP
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="boton-formulario active" type="button" data-dismiss="modal" onclick="ocultarModalMensajes(this, ' ')">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <footer>

    </footer>
</body>

</html>