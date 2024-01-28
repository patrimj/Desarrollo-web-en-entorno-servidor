const { Sequelize } = require('sequelize');
const Persona = require('../models/Persona');
const RolAsignado = require('../models/RolesAsignados');
const Roles = require('../models/Roles');

class ConexionSequilze {

    constructor() {
        this.db = new Sequelize(process.env.DB_DATABASE, process.env.DB_USER, process.env.DB_PASSWORD, {
            host: process.env.DB_HOST,
            dialect:'mysql', /* one of 'mysql' | 'postgres' | 'sqlite' | 'mariadb' | 'mssql' | 'db2' | 'snowflake' | 'oracle' */
            pool: {
                max: 5, //5 hilos maximo de pool
                min: 0,
                acquire: 30000,
                idle: 10000
             },
          });
    }

    /**
     * Sequelize will keep the connection open by default, and use the same connection for all queries. If you need to close the connection, 
     * call sequelize.close() (which is asynchronous and returns a Promise).
     */

    //https://sequelize.org/docs/v6/core-concepts/model-querying-basics/

    conectar = () => {
        this.db.authenticate().then(() => {
            console.log('Connection has been established successfully.');
        }).catch((error) => {
            console.error('Unable to connect to the database: ', error);
        });
    }

    desconectar = () => {
        //this.db.close();
        process.on('SIGINT', () => conn.close())
    }

    getlistado = async() => {
        let resultado = [];
        this.conectar();
        //console.log('Accediendo a los datos...')
        resultado = await Persona.findAll();
        this.desconectar();
        return resultado;
    }

    getUsuario = async(dni) => {
        let resultado = [];
        this.conectar();
        resultado = await Persona.findByPk(dni);
        this.desconectar();
        if (!resultado){
            throw error;
        }
        return resultado;
    }

    //registrarUsuario = async(dni, nombre, clave, tfno) => {
    registrarUsuario = async(body) => {
        let resultado = 0;
        this.conectar();
        try{
            // const usuarioNuevo = new Persona(body); //Con esto añade los timeStamps.
            // await usuarioNuevo.save(); ES LO MISMO QUE EL CREATE
            const usuarioNuevo = await Persona.create(body);
            resultado = 1; // Asume que la inserción fue exitosa
        } catch (error) {
            if (error instanceof Sequelize.UniqueConstraintError) {
                console.log(`El DNI ${body.DNI} ya existe en la base de datos.`);
            } else {
                console.log('Ocurrió un error desconocido: ', error);
            }
            throw error; 
        } finally {
            this.desconectar();
        }
        return resultado;
    }

    //modificarUsuario = async(dni, nombre, clave, tfno) => {
    modificarUsuario = async(dni, body) => {
        this.conectar();
        let resultado = await Persona.findByPk(dni);
        if (!resultado){
            this.desconectar();
            throw error;
        }
        await resultado.update(body);
        this.desconectar();
        return resultado;
    }

    borrarUsuario = async(dni) => {
        this.conectar();
        let resultado = await Persona.findByPk(dni);
        if (!resultado){
            this.desconectar();
            throw error;
        }
        await resultado.destroy();
        this.desconectar();
        return resultado;
    }

    //----------------------------------------
    getRoles = async() => {
        let resultado = [];
        this.conectar();
        //console.log('Accediendo a los datos...')
        resultado = await Roles.findAll();
        this.desconectar();
        return resultado;
    }

    getRolesAsignados = async() => {
        let resultado = [];
        this.conectar();
        //console.log('Accediendo a los datos...')
        resultado = await RolAsignado.findAll();
        this.desconectar();
        return resultado;
    }

    getRolesAsignadosDNI = async(dn) => {
        let resultado = [];
        this.conectar();
        //console.log('Accediendo a los datos...')

        //  resultado = await RolesAsignados.findOne({ where: { DNIRol: dn } , include: ["RolA"]});
        
        resultado = await Persona.findOne({ where: { DNI: dn } , include: ["RolesAsignados"]});
        //resultado = await Roles.findOne({ where: { id: dn } , include: ["RolesAsignados"]});
        this.desconectar();
        return resultado;
    }
}

module.exports = ConexionSequilze;
