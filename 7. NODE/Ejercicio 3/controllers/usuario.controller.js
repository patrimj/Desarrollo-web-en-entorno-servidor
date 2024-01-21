const { response, request } = require('express');
const ConexionUsuario = require('../database/usuario.conexion');

//LOGIN
const login = (req = request, res = response) => {
    const conx = new ConexionUsuario();

    conx.login(req.body.email, req.body.password)
        .then(msg => {
            console.log('Usuario iniciado');
            res.status(201).json(msg);
        })
        .catch(err => {
            console.log('Fallo en el inicio de sesión');
            console.log(err);
            res.status(203).json(err);
        })
}

// REGISTRARSE
const registro = (req, res = response) => {
    const conx = new ConexionUsuario();

    conx.registro(req.body)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

// CAMBIAR PASSWORD
const cambiarPassword = (req, res = response) => {
    const conx = new ConexionUsuario();

    conx.cambiarPassword(req.params.email, req.body.password)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

//ALTA USUARIO
const altaUsuario = (req, res = response) => {
    const conx = new ConexionUsuario();

    conx.altaUsuario(req.body)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

//BAJA USUARIO

const bajaUsuario = (req, res = response) => {  
    const conx = new ConexionUsuario();

    conx.bajaUsuario(req.params.id)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

//MODIFICAR USUARIO

const modificarUsuario = (req, res = response) => {
    const conx = new ConexionUsuario();

    conx.modificarUsuario(req.params.id, req.body)
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
    login,
    registro,
    cambiarPassword,
    altaUsuario,
    bajaUsuario,
    modificarUsuario
}