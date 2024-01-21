const Conexion = require('./ConexionSequelize');
const { Sequelize, Op } = require('sequelize'); // Op es para los operadores de sequelize

const Tarea = require('../models/tarea');

class TareaConexion{
    
    constructor(){
        this.conexion = new Conexion();
    }

    conectar = () => {
        this.conexion.conectar();
    }

    desconectar = () => {
        this.conexion.desconectar();
    }

    listarTareas = async () => {
        let resultado = [];
        this.conectar();
        resultado = await Tarea.findAll({ 
            attributes: ['id', 'descripcion', 'dificultad'] 
        });
        this.desconectar();
        return resultado;
    }
}

module.exports = TareaConexion;