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