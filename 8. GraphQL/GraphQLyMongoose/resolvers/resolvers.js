const { v4: uuidv4 } = require('uuid');
//const { addPersona, getPersona, removePersonaAt, updatePersonaAt, valores } = require('../database/basededatos.js');
const {usuariosGet, usuarioGet, usuariosPost, usuariosPut, usuariosDelete} = require('../controllers/userController.js');
const {comentariosGet, comentariosGetAsignados, comentarioGetAsignadoA} = require('../controllers/commentsController.js');
const { Persona } = require('../models/Persona')

const resolvers = {
 Query: {
    personas: () => usuariosGet(),
    persona: (_, { pid }) => usuarioGet(pid),
    comentarios: () => comentariosGet(),
    comentariosAsignados: () => comentariosGetAsignados(),
    comentariosAsignadosA: (_, { id }) => comentarioGetAsignadoA(id)
 },
 Mutation: {
    agregarPersona: (_, { id, nombre, edad, tfno }) => {
      const nuevaPersona = {
         id: id,
         nombre: nombre,
         edad: edad,
         tfno: tfno,
       };
 
       const personaAgregada = usuariosPost(nuevaPersona);
 
       return personaAgregada;
    },
    eliminarPersona: (_, { id }) => {
      const resp = usuariosDelete(id)
      return resp
    },
    actualizarPersona: (_, { id, nombre, edad, tfno }) => {
      const resp = usuariosPut(id, { nombre, edad, tfno })
      return resp
    },
 },
};

module.exports = resolvers;