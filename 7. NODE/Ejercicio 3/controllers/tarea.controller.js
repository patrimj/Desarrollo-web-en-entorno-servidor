const { response, request } = require('express');

const ConexionTarea = require('../database/tarea.conexion');

//LOGIN
const listarTareas = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.listarTareas()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

module.exports = {
listarTareas
}
