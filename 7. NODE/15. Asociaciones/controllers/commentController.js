const {response,request} = require('express');
const Conexion = require('../database/ConexionSequelize')


const getComments =  (req, res = response) => {
    const conx = new Conexion();

    conx.getComments()
        .then( msg => {
            console.log('Listado de comentarios correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay comentarios');
            res.status(203).json({'msg':'No se han encontrado registros'});
        });
}

const getCommentsId =  (req, res = response) => {
    const conx = new Conexion();

    conx.getCommentsId(req.params.id)    
        .then( msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay registros');
            res.status(203).json({'msg':'No se han encontrado registros'});
        });
}


module.exports = {
    getComments,
    getCommentsId
}