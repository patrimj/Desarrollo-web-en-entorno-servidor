const {response,request} = require('express');
const Conexion = require('./Conexion');

const usuariosGet =  (req, res = response) => {
    const conx = new Conexion();
    conx.getlistado()    
        .then( msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay registros');
            res.status(200).json({'msg':'No se han encontrado registros'});
        });
}

const usuarioGet =  (req, res = response) => {
    const conx = new Conexion();
    // console.log(req.params.dni+"!!!!!");
    conx.getUsuario(req.params.dni)    
        .then( msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay registro!');
            res.status(200).json({'msg':'No se ha encontrado el registro'});
        });
}

const usuariosPost =  (req = request, res = response) => {
    const conx = new Conexion();
    // console.log(req.params.dni+"!!!!!");
    conx.registrarUsuario(req.body.dni, req.body.nombre, req.body.clave, req.body.tfno)    
        .then( msg => {
            console.log('Insertado correctamente!');
            res.status(201).json(msg);
        })
        .catch( err => {
            console.log('Fallo en el registro!');
            res.status(203).json(err);
        });
}

const usuariosDelete =  (req, res = response) => {
    const conx = new Conexion();
    // console.log(req.params.dni+"!!!!!");
    conx.borrarUsuario(req.params.dni)    
        .then( msg => {
            console.log('Borrado correctamente!');
            res.status(202).json(msg);
        })
        .catch( err => {
            console.log('Fallo en el borrado!');
            res.status(203).json(err);
        });
}

const usuariosPut =  (req, res = response) => {
    const conx = new Conexion();
    // console.log(req.params.dni+"!!!!!");
    conx.modificarUsuario(req.params.dni, req.body.nombre, req.body.clave, req.body.tfno)    
        .then( msg => {
            console.log('Modificado correctamente!');
            res.status(202).json(msg);
        })
        .catch( err => {
            console.log('Fallo en la modificación!');
            res.status(203).json(err);
        });
}


module.exports = {
    usuariosGet,
    usuariosDelete,
    usuariosPost,
    usuariosPut,
    usuarioGet
}