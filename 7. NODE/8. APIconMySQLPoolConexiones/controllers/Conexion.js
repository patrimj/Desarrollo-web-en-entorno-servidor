const mysql = require('mysql2');

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
 
    
    // conectar = () => {
    //     this.connection.connect( (err) => {
    //         if (err) {
    //             console.error('Error de conexion: ' + err.stack);
    //             return;
    //         }
    //         console.log('Conectado con el identificador ' + this.connection.threadId);
    //     });
    // }

    // desconectar = () => {
    //     this.connection.end( (err) => {
    //         if (err) {
    //             console.error('Error de conexion: ' + err.stack);
    //             return;
    //         }
    //     console.log('Desconectado con éxito');
    //     });
    // }


    query = ( sql, values ) => {
    //Devolver una promesa
    return new Promise(( resolve, reject ) => {
        this.pool.query(sql, values, ( err, rows) => {
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

    getlistado = async() => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM personas');
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getUsuario = async(dni) => {
        let resultado = [];
        try {
            resultado = await this.query('SELECT * FROM personas WHERE DNI = ?', [dni]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    registrarUsuario = async(dni, nombre, clave, tfno) => {
        let resultado = 0;
        try {
            resultado = await this.query('INSERT INTO personas VALUES (?,?,?,?)', [dni, nombre, clave, tfno]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    modificarUsuario = async(dni, nombre, clave, tfno) => {
        let resultado = 0;
        try {
            resultado = await this.query('UPDATE personas SET Nombre=?,Clave=?,Tfno=? WHERE DNI = ?', [nombre, clave, tfno, dni]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    borrarUsuario = async(dni) => {
        let resultado = 0;
        try {
            resultado = await this.query('DELETE FROM  personas  WHERE DNI = ?', [dni]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    
}

module.exports = Conexion;
