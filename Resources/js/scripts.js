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
    event.preventDefault()
    const dataForm = document.getElementById('mainForm')
    const data = Object.fromEntries(
        new FormData(dataForm)
    )
    const keys = Object.keys(data)
    let controlFormulario = 0
    for (const elem of keys) {
        console.log(elem);
        if(elem === 'ciudad_empresa') {
            if(data[elem] === '-Escoge-' || data[elem] === '' || data[elem] === ' ') {
                controlFormulario++
                const mensaje = 'Por favor, agrege una ciudad válida.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'migrante-retornado') {
            if(data[elem] === '-Escoge-' || data[elem] === '' || data[elem] === ' ') {
                controlFormulario++
                const mensaje = 'El campo: ¿Alguno de los socios o accionistas de la empresa es migrante venezolano o colombiano retornado? se encuentra vacío.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'adjuntar_balance_general') {
            if(data[elem].name === "") {
                controlFormulario++
                const mensaje = 'Por favor, adjunte archivo de Balance general.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'adjuntar_estado_de_resultado') {
            if(data[elem].name === "") {
                controlFormulario++
                const mensaje = 'Por favor, adjunte archivo de Estado de resultado.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'adjuntar_declaracion_renta') {
            if(data[elem].name === "") {
                controlFormulario++
                const mensaje = 'Por favor, adjunte archivo de Declaración de renta.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'terminos_condiciones') {
            if(data[elem] === "" || data[elem] === "no-acepto") {
                controlFormulario++
                const mensaje = 'Por favor, acepte los términos y condiciones para realizar el registro.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else if(elem === 'consulta_centrales_de_riesgo') {
            if(data[elem] === "" || data[elem] === " ") {
                controlFormulario++
                const mensaje = 'Por favor, llene el campo Consulta en centrales de riesgo.'
                mostrarModalMensajes(mensaje)
                break;
            }
        }else {
            if(data[elem] === "") {
                controlFormulario++
                const mensaje = 'Por favor, llena todos los campos'
                mostrarModalMensajes(mensaje)
                break;
            }
        }
    }
    controlFormulario === 0 
        ? console.log(`Se puede enviar ${controlFormulario}`) 
        : console.log(`No se puede enviar ${controlFormulario}`);

        // $.ajax({
        //     type: 'POST',
        //     url: 'guardar_datos_nuevo_formulario',
        //     // data:  $(mainForm).serialize(),
        //     data:  JSON.stringify(data),
        //     success: function (datas) {
        //         console.log('Data de regreso success')
        //         console.log(JSON.stringify(datas));                            
        //     },
        //     complete: function (datas) {
        //         // if (data.responseText != "success") {
        //         //     console.log("Error al registrar los datos");
        //         // }
        //         console.log('Data de regreso complete');
        //         console.log(JSON.stringify(datas));
        //     }
        // });
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

// function validarValorSolicitado(elem) {
//     let val = elem.value.replace(/\./g,"");
//     console.log({val});
//     elem.value = val
// }