const mysql = require('mysql2');
const { query } = require('express');

/**
 * En esta clase encapsularemos la comunicación con la base de datos.
 */
class Conexion {

    constructor(options) {
        this.config = {
            host: process.env.DB_HOST,
            user: process.env.DB_USER,
            password: process.env.DB_PASSWORD,
            database: process.env.DB_DATABASE,
            connectionLimit: process.env.DB_MAXCONNECTIONS, //Por defecto son 10.
            port: process.env.DB_PORT
        };
        this.pool = mysql.createPool(this.config);
        // aqqui ya no hay que conectar y desconectar, solo hay pool y ya lo hace espera 4 consultas (o 10 por defecto) y espera a que se libere una para ejecutarla
    }

    /* AL USAR POOL YA NO HAY QUE CONECTAR Y DESCONECTAR
    conectar = () => {
        this.connection.connect( (err) => {
            if (err) {
                console.error('Error de conexion: ' + err.stack);
                return;
            }
            console.log('Conectado con el identificador ' + this.connection.threadId);
        });
    }

    desconectar = () => {
        this.connection.end( (err) => {
            if (err) {
                console.error('Error de conexion: ' + err.stack);
                return;
            }
        console.log('Desconectado con éxito');
        });
    }*/

    query = (sql, values) => {
        //Devolver una promesa
        return new Promise((resolve, reject) => {
            this.pool.query(sql, values, (err, rows) => {
                if (err) {
                    reject(err)
                } else {
                    if (rows.length === 0) {
                        reject(err);
                    }
                    resolve(rows)
                }
            })
        })
    }

    //REGISTRO 
    registrarUsuario = async (nombre, email, password) => {
        let resultado = 0;
        //this.conectar();
        try {
            resultado = await this.query('INSERT INTO personas VALUES (?,?,?)', [nombre, email, password]);
            // ya con pool no es necesario conectar y desconectar
            //this.desconectar();
        } catch (error) {
            //this.desconectar();s
            throw error;
        }
        return resultado;
    }

    //LOGIN
    login = async (email, password) => {
        let resultado = [];
        //this.conectar();
        try {
            resultado = await this.query('SELECT * FROM personas WHERE Email = ? and Password = ?', [email, password]);
            //this.desconectar();
        }
        catch (error) {
            //this.desconectar();
            throw error;
        }
        return resultado;
    }

    //CRUD PERSONAS
    getUsuarios = async () => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM personas');
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getUsuarioId = async (id) => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM personas WHERE Id = ?', [id]);
        } catch (error) {
            throw error;
        }
        return resultados;
    }

    modificarUsuario = async (nombre, email, password) => {
        let resultado = 0;
        try {
            resultado = await this.query('UPDATE personas SET Nombre=?, Email=?,Password=?', [nombre, email, password]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    borrarUsuario = async (id) => {
        let resultado = 0;
        try {
            resultado = await this.query('DELETE FROM personas WHERE Id = ?', [id]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    //CRUD TAREAS
    crearTarea = async (descripcion, duracion, dificultad, realizada, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.query('INSERT INTO tareas VALUES (?,?,?,?,?)', [descripcion, duracion, dificultad, realizada, persona_id]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getTareas = async () => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM tareas');
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getTarea = async (id) => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM tareas WHERE Id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    getTareasPersona = async (id) => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM tareas WHERE Persona_id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    eliminarTarea = async (id) => {
        let resultado = 0;
        try {
            resultado = await this.query('DELETE FROM tareas WHERE Id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    modificarTarea = async (id, descripcion, duracion, dificultad, realizada, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.query('UPDATE tareas SET Descripcion = ?, Duracion = ?, Dificultad = ?, Realizada = ?, Persona_id = ? WHERE Id = ?', [descripcion, duracion, dificultad, realizada, persona_id, id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    asignarTarea = async (id_tarea, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.query('UPDATE tareas SET Persona_id = ? WHERE Id = ?', [persona_id, id_tarea])
        } catch (error) {
            throw error;
        }
        return resultado;
    }

}

module.exports = Conexion;
module.exports = query;
