function mostrarModalTerminosCondiciones(id) {
    const modalTerminosCondiciones = document.getElementById(id)
    if (modalTerminosCondiciones.classList.contains('hide')) {
        modalTerminosCondiciones.classList.remove('hide')
        modalTerminosCondiciones.classList.add('show')
    }else if (modalTerminosCondiciones.classList.contains('show')) {
        modalTerminosCondiciones.classList.remove('show')
        modalTerminosCondiciones.classList.add('hide')
    }
}

function validarBotonAutorizacion(elem) {
    elem.classList.toggle('active')
}
function validarBotonAutorizacionCentrales(elem, id) {
    const anotherButton = document.getElementById(id)
    if (elem.classList.contains('active')) {
        elem.classList.remove('active')
    }else {
        elem.classList.add('active')
        anotherButton.classList.remove('active')
    }
}

function verificarDatosFormulario(event) {
    document.getElementById('btnSiguiente').setAttribute('disabled', 'true')
    event.preventDefault()
    const dataForm = document.getElementById('mainForm')
    const data = Object.fromEntries(
        new FormData(dataForm)
    )
    const keys = Object.keys(data)
    let controlFormulario = 0
    for (const elem of keys) {
        if(elem === 'ciudad_empresa') {
            if(data[elem] === '-Escoge-' || data[elem] === '' || data[elem] === ' ') {
                controlFormulario++
                const mensaje = 'Por favor, agrege una ciudad válida.'
                mostrarModalMensajes(mensaje)
                document.getElementById('btnSiguiente').removeAttribute('disabled')
                break;
            }
        }else if(elem === 'migrante-retornado') {
            if(data[elem] === '-Escoge-' || data[elem] === '' || data[elem] === ' ') {
                controlFormulario++
                const mensaje = 'El campo: ¿Alguno de los socios o accionistas de la empresa es migrante venezolano o colombiano retornado? se encuentra vacío.'
                mostrarModalMensajes(mensaje)
                document.getElementById('btnSiguiente').removeAttribute('disabled')
                break;
            }
        }else if(elem === 'terminos_condiciones') {
            if(data[elem] === "" || data[elem] === "no-acepto") {
                controlFormulario++
                const mensaje = 'Por favor, acepte los términos y condiciones para realizar el registro.'
                mostrarModalMensajes(mensaje)
                document.getElementById('btnSiguiente').removeAttribute('disabled')
                break;
            }
        }else if(elem === 'consulta_centrales_de_riesgo') {
            if(data[elem] === "" || data[elem] === " ") {
                controlFormulario++
                const mensaje = 'Por favor, llene el campo Consulta en centrales de riesgo.'
                mostrarModalMensajes(mensaje)
                document.getElementById('btnSiguiente').removeAttribute('disabled')
                break;
            }
        }else {
            if(data[elem] === "") {
                controlFormulario++
                const mensaje = 'Por favor, llena todos los campos'
                mostrarModalMensajes(mensaje)
                document.getElementById('btnSiguiente').removeAttribute('disabled')
                break;
            }
        }
    }
    controlFormulario === 0 
        ? document.getElementById("mainForm").submit()
        : null;
}
const modalParaLosMensajes = document.getElementById('modalParalosMensajes')
const textoDimanico = document.getElementById('texto-dinamico')

function mostrarModalMensajes (mensaje) {
    textoDimanico.innerText = mensaje
    modalParaLosMensajes.classList.replace('hide', 'show')
}
function ocultarModalMensajes (elem, mensaje) {
    textoDimanico.innerText = mensaje
    modalParaLosMensajes.classList.replace('show', 'hide')
}
function validar(elem) {
    if(elem.value < 3000000) {
        textoDimanico.innerText = "Monto mínimo de 3'000.000 COP"
        modalParaLosMensajes.classList.replace('hide', 'show')
    }
}
function animacionBotonAdjuntarAlPresionar(elem) {
    document.getElementById(elem).classList.add('boton-adjuntar-presionado')
    setTimeout(() => {
        document.getElementById(elem).classList.remove('boton-adjuntar-presionado')
    }, 200)
}

function validarDocumentos(elem, id) {
    console.log(elem.files);
    const label = document.getElementById(id)
    if(elem.files.length) {
        if (elem.files[0].size > 26214400) {
            alert("El archivo no puede superar los 25MB");
            elem.value = "";
            return;
        }
        label.classList.add('boton-adjuntar-cedula-activo')
    }else {
        label.classList.remove('boton-adjuntar-cedula-activo')
    }
}
function validarBotonAutorizacion(elem) {
    const terminosCondicionesdocument = document.getElementById('terminos_condiciones')
    const boton = document.getElementById("btnAutorizacion")
    if (boton.classList.contains("active")) {
        terminosCondicionesdocument.value = "no-acepto"
        boton.classList.remove('active');
        // $("#div_terminos_y_condiciones_icono_pendiente").show();
        // $("#div_terminos_y_condiciones_icono_completo").hide();
    }
    else {
        terminosCondicionesdocument.value = "acepto"
        boton.classList.add('active');
        // $("#div_terminos_y_condiciones_icono_pendiente").hide();
        // $("#div_terminos_y_condiciones_icono_completo").show();
    }
}
function validarBotonAutorizacionCentrales(elem) {
    const centralesDeRiesgo = document.getElementById('consulta_centrales_de_riesgo')
    const btnNoAcepto = document.getElementById('btnNoCentralesRiesgo')
    const btnSiAcepto = document.getElementById('btnSiCentralesRiesgo')
    if(elem.innerText === "No acepto") {
        if(btnNoAcepto.classList.contains("active")) {
            centralesDeRiesgo.value = ''
            btnNoAcepto.classList.remove('active');
            btnSiAcepto.classList.remove('active');
            // $("#div_centrales_riesgo_icono_pendiente").show();
            // $("#div_centrales_riesgo_icono_completo").hide();                    
        }else {
            centralesDeRiesgo.value = 'no-acepto'
            btnNoAcepto.classList.add('active');
            btnSiAcepto.classList.remove('active');
            // $("#div_centrales_riesgo_icono_pendiente").hide();
            // $("#div_centrales_riesgo_icono_completo").show();
        }                    
    }else if(elem.innerText === "Acepto") {
        if(btnSiAcepto.classList.add("active")) {
            centralesDeRiesgo.value = ''
            btnSiAcepto.classList.remove('active');
            btnNoAcepto.classList.remove('active');
            // $("#div_centrales_riesgo_icono_pendiente").show();
            // $("#div_centrales_riesgo_icono_completo").hide();                    
        }else {
            centralesDeRiesgo.value = 'acepto'
            btnSiAcepto.classList.add('active');
            btnNoAcepto.classList.remove('active');
            // $("#div_centrales_riesgo_icono_pendiente").hide();
            // $("#div_centrales_riesgo_icono_completo").show();
        }
    }
}