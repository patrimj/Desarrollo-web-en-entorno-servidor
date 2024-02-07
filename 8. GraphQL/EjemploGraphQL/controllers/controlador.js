// let valores = require('../database/basededatos')
const { Persona } = require('../models/Persona')
const { addPersona, getPersona, getPersonas, removePersonaAt, updatePersonaAt } = require('../database/basededatos')

const funGet = (req, res) => {
    res.status(200).json({'msg' : 'Gestión del vector', 'valores' : getPersonas()});
}

const funGetUnParametro = (req, res) => {
    let indice = parseInt(req.params.id,10)
    res.status(200).json({'pos' : parseInt(req.params.id,10), 'persona' : getPersona(indice)})
}

const funPost = (req, res) => {
    let nuevaPersona = new Persona(req.body.id, req.body.nombre, req.body.edad)

    addPersona(nuevaPersona);
    console.log(getPersonas()); 
    res.status(201).json({'msg' : 'Elemento insertado', 'valores' : getPersonas()});
}

const funDelete = (req, res) => {
    let indice = parseInt(req.params.id,10)

    removePersonaAt(indice);
    console.log(getPersonas());
    res.status(202).json({'msg' : 'Elemento borrado', 'valores' : getPersonas()});
}

const funPut = (req, res) => {
    let indice = parseInt(req.params.id,10)
    let nuevaPersona = new Persona(req.body.id, req.body.nombre, req.body.edad)
    
    updatePersonaAt(indice, nuevaPersona);
    res.status(202).json({'msg' : 'Elemento modificado', 'valores' : getPersonas()})
}

module.exports = {
    funGet,
    funGetUnParametro,
    funPost,
    funDelete,
    funPut
}