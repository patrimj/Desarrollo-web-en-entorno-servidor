const { gql } = require('graphql-tag')

const typeDefs = gql`

 type Persona {
    id: Int
    nombre: String
    edad: Int
    tfno: String
 }

 type Comentario {
      idU: Int
      comment: String
      likes: Int
      timestamp: String
 }
 
 type ComentarioAsignado {
    _id: String
    comentarios: [Comentario]
}
 

 type Query {
    personas: [Persona]
    persona(pid: Int!): Persona
    comentarios: [Comentario]
    comentariosAsignados: [ComentarioAsignado]
    comentariosAsignadosA(id: Int!): [ComentarioAsignado]
 }

 type Mutation {
    agregarPersona(id:Int, nombre: String!, edad: Int!, tfno: String): Persona
    eliminarPersona(id: Int!): Boolean
    actualizarPersona(id: Int, nombre: String, edad: Int, tfno: String): Int!
 }
`

module.exports = typeDefs;
