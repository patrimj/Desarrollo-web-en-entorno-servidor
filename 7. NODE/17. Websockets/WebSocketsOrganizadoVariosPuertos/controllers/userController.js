const {response,request} = require('express');

const usuariosGet =  (req, res = response) => {
    res.status(200).json({'msg':'Get desde controlador'});
}

const usuariosGetParametro =  (req, res = response) => {
    res.status(200).json({'msg':'Get desde controlador', 'id':req.params.id});
}

const usuariosPost =  (req = request, res = response) => {
    const {nombre, edad} = req.body;
    res.status(201).json({
        msg:'Post desde controlador...',
        nombre,
        edad
    });
}

const usuariosDelete =  (req, res = response) => {
    res.status(202).json({'msg':'Delete desde controlador', 'id':req.params.id});
}

const usuariosPut =  (req, res = response) => {
    const id = req.params.id;
    res.status(202).json({'msg':'Put desde controlador.', id});
}


module.exports = {
    usuariosGet,
    usuariosDelete,
    usuariosPost,
    usuariosPut,
    usuariosGetParametro
}