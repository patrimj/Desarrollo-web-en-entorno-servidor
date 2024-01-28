let valores = require('../models/basededatos')

const funGet = (req, res) => {
    res.status(200).json({'msg' : 'Gestión del vector', 'valores' : valores})
}

const funGetAt = (req, res) => {
    let indice = parseInt(req.params.id, 10)
    res.status(200).json({'msg' : 'Gestión del vector', 'pos' : parseInt(req.params.id,10), 'valor' : valores[indice]})
}

const funPost = (req, res) => {
    let pos = req.body.posicion
    let nuevoValor = req.body.valor
 
    valores.splice(pos, 0, nuevoValor);
    console.log(valores); 
    res.status(201).json({'msg' : 'Elemento insertado', 'valores' : valores})
    
}

const funDelete = (req, res) => {
    let indice = parseInt(req.params.id,10)
    valores.splice(indice, 1)
    res.status(202).json({'msg' : 'Elemento borrado', 'valores' : valores})
    console.log(valores)
   
}

const funPut = (req, res) => {
    let indice = parseInt(req.params.id,10)
    valores[indice] = req.body.valor
    res.status(202).json({'msg' : 'Elemento modificado', 'valores' : valores})
   
}

module.exports = {
    funGet,
    funGetAt,
    funPost,
    funDelete,
    funPut
}