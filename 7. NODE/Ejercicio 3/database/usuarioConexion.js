const mysql = require('mysql2');
const Conexion = require('./Conexion.js');

class usuarioConexion {

    constructor() {
        this.con = new Conexion();
    }

    //REGISTRO  
    registrarUsuario = async (nombre, email, password) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('INSERT INTO personas (nombre, email, password) VALUES (?,?,?)', [nombre, email, password]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    login = async (email, password) => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM personas WHERE Email = ? and Password = ?', [email, password]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    //CRUD USUARIOS
    
    getUsuarios = async () => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM personas');
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getUsuarioId = async (id) => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM personas WHERE Id = ?', [id]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    modificarUsuario = async (nombre, email, password) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('UPDATE personas SET Nombre=?, Email=?,Password=?', [nombre, email, password]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    borrarUsuario = async (id) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('DELETE FROM personas WHERE Id = ?', [id]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }
}

module.exports = usuarioConexion;