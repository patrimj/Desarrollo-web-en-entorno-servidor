const {response,request} = require('express');
const Conexion = require ('../database/Conexion');

const getUsuarios =  (req, res = response) => {
    const conx = new Conexion();

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
    const conx = new Conexion();
    
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
    const conx = new Conexion();
    
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
    const conx = new Conexion();

    conx.login (req.params.email, req.params.password)
        .then (msg => {
            console.log ('Usuario iniciado');
            res.status(201).json(msg);
        })
        .catch ( err => {
            console.log('Fallo en el inicio de sesión!');
            res.status(203).json(err);
        })
}

const borrarUsuario =  (req, res = response) => {
    const conx = new Conexion();
    
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
    const conx = new Conexion();
    
    conx.modificarUsuario(req.params.nombre, req.body.email, req.body.password)    
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