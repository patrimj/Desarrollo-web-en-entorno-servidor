const mysql = require('mysql2');

/**
 * En esta clase encapsularemos la comunicación con la base de datos.
 */
class Conexion {

    constructor(options) {
        this.connection = mysql.createConnection({
            host: process.env.DB_HOST,
            user: process.env.DB_USER,
            password: process.env.DB_PASSWORD,
            database: process.env.DB_DATABASE,
            port: process.env.DB_PORT
        });
    }
 
    
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
    }


    query = ( sql, values ) => {
    //Devolver una promesa
    //console.log(sql + values);
    return new Promise(( resolve, reject ) => {
        this.connection.query(sql, values, ( err, rows) => {
            if ( err ) {
                reject( err )
            } else {
                // console.log('Llego aquí');
                if (rows.length === 0) {
                    reject(err);
                }
                resolve( rows )
            }
            })
        })
    }

    //REGISTRO 
    registrarPersona = async(nombre, email) => {
        let resultado = 0;
        this.conectar();
        try {
            resultado = await this.query('INSERT INTO personas VALUES (?,?)', [nombre, email]);
            // console.log('Y aquí');
            this.desconectar();
        } catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    //LOGIN
    login = async(email) => {
        let resultado = [];
        this.conectar();
        try {
            resultado = await this.query('SELECT * FROM personas WHERE Email = ?', [email]);
            this.desconectar();
        }
        catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    //CRUD TAREAS
    crearTarea = async(descripcion, duracion, dificultad, realizada, persona_id) => {
        let resultado = 0;
        this.conectar();
        try {
            resultado = await this.query('INSERT INTO tareas VALUES (?,?,?,?,?)', [descripcion, duracion, dificultad, realizada, persona_id]);
            this.desconectar();
        } catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    getTareas = async(id) => {
        let resultado = [];
        this.conectar();
        try {
            resultado = await this.query('SELECT * FROM tareas WHERE Id = ?', [id]);
            this.desconectar();
        }
        catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    getTareasPersona = async(id) => {
        let resultado = [];
        this.conectar();
        try {
            resultado = await this.query('SELECT * FROM tareas WHERE Persona_id = ?', [id]);
            this.desconectar();
        }
        catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    eliminarTarea = async(id) => {
        let resultado = [];
        this.conectar();
        try {
            resultado = await this.query('DELETE FROM tareas WHERE Id = ?', [id]);
            this.desconectar();
        }
        catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }

    modificarTarea = async(id, descripcion, duracion, dificultad, realizada) => {
        let resultado = [];
        this.conectar();
        try {
            resultado = await this.query('UPDATE tareas SET Descripcion = ?, Duracion = ?, Dificultad = ?, Realizada = ? WHERE Id = ?', [descripcion, duracion, dificultad, realizada, id]);
            this.desconectar();
        }
        catch (error) {
            this.desconectar();
            throw error;
        }
        return resultado;
    }
}

module.exports = Conexion;
