const {response,request} = require('express');
const ConexionUsuario = require('../database/usuarioConexion');

const getUsuarios =  (req, res = response) => {
    const conx = new ConexionUsuario();

    conx.getUsuarios()    
        .then( msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay registros');
            res.status(200).json({'msg':'No se han encontrado registros'});
        });
}

const getUsuarioId =  (req, res = response) => {
    const conx = new ConexionUsuario();
    
    conx.getUsuarioId(req.params.id)    
        .then( msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch( err => {
            console.log('No hay registro!');
            res.status(200).json({'msg':'No se ha encontrado el registro'});
        });
}

const registrarUsuario =  (req = request, res = response) => {
    const conx = new ConexionUsuario();
    
    conx.registrarUsuario(req.body.nombre, req.body.email, req.body.password)    
        .then( msg => {
            console.log('Insertado correctamente!');
            res.status(201).json(msg);
        })
        .catch( err => {
            console.log('Fallo en el registro!');
            res.status(203).json(err);
        });
}


const login =  (req = request, res = response) => {
    const conx = new ConexionUsuario();

    conx.login (req.body.email, req.body.password)
        .then (msg => {
            console.log ('Usuario iniciado');
            res.status(201).json(msg);
        })
        .catch ( err => {
            console.log('Fallo en el inicio de sesión');
            console.log(err);
            res.status(203).json(err);
        })
}

const borrarUsuario =  (req, res = response) => {
    const conx = new ConexionUsuario();
    
    conx.borrarUsuario(req.params.id)    
        .then( msg => {
            console.log('Borrado correctamente!');
            res.status(202).json(msg);
        })
        .catch( err => {
            console.log('Fallo en el borrado!');
            res.status(203).json(err);
        });
}

const modificarUsuario =  (req, res = response) => {
    const conx = new ConexionUsuario();
    
    conx.modificarUsuario(req.body.nombre, req.body.email, req.body.password)    
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
    getUsuarios,
    getUsuarioId,
    registrarUsuario,
    borrarUsuario,
    modificarUsuario,
    login
}