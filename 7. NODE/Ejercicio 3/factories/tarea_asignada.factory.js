const { Tarea_Asignada, Tarea, User } = require('../models');

const genTareasAsignadas = async (ctos = 1) => { 
    let tareasAsignadasGen = []

    // Obtenemos las tareas y usuarios que tenemos en la bbdd para asignarlos
    const tareas = await Tarea.findAll();
    const usuarios = await User.findAll();

    // Para no repetir las combinaciones
    let datos = [];
    for (let tarea of tareas) {
        for (let usuario of usuarios) {
            datos.push({ id_tarea: tarea.id, id_usuario: usuario.id }); // Por cada tarea y usuario se crea una combinación
        }
    }

    // Mezclamos pero no repetimos
    datos.sort(() => Math.random());

    // Si hay menos combinaciones que ctos, se para el bucle para evitar errores de inserción ya que no hay más combinaciones
    for(let i = 0; i < ctos; i++) {
        if (i >= datos.length) {
            break;
        }
        tareasAsignadasGen.push(Tarea_Asignada.create(datos[i])) 
    }
    return Promise.all(tareasAsignadasGen); 
}

module.exports = {
    genTareasAsignadas
}