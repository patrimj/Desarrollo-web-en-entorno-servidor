const { Rol_Asignado, Roles, User } = require('../models');

const genRolesAsignados = async (ctos = 1) => { 
    let rolAsignadoGen = []

    // TODO: sacamos los roles y usuarios que tenemos en la bbdd para asignarlos
    const roles = await Roles.findAll();
    const usuarios = await User.findAll();

    // para no se repitan las combinaciones
    let datos = [];
    for (let rol of roles) {
        for (let usuario of usuarios) {
            datos.push({ id_rol: rol.id, id_usuario: usuario.id }); // por cada rol y usuario se crea una combinacion
        }
    }

    // mezclamos pero no repetimos
    datos.sort(() => Math.random());

    // si hay menos combinaciones que ctos, se para el bucle para evitar errores de insercion ya que no hay mas combinaciones
    for(let i = 0; i < ctos; i++) {
        if (i >= datos.length) {
            break;
        }
        rolAsignadoGen.push(Rol_Asignado.create(datos[i])) 
    }
    return Promise.all(rolAsignadoGen); 
}

module.exports = {
    genRolesAsignados
}