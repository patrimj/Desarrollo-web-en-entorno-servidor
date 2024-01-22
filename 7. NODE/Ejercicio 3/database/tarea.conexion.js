const mysql = require('mysql2');
const Conexion = require('./ConexionSequelize');
const { Sequelize, Op } = require('sequelize'); // Op es para los operadores de sequelize
const models = require('../models/index.js'); //Esto tiene acceso a todos los modelos., lo genera solo el sequelize-cli

class TareaConexion {

    constructor() {
        this.conexion = new Conexion();
    }

    conectar = () => {
        this.conexion.conectar();
    }

    desconectar = () => {
        this.conexion.desconectar();
    }

    // RUTAS PROGRAMADOR

    //LISTAR TAREAS LIBRES
    //router.get('/tareas/libres', controladorTarea.listarTareasLibres);

    listarTareasLibres = async () => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                where: { id_usuario: null },
                required: false
            }]
        });
        this.desconectar();
        return resultado;
    }

    //ASIGNAR TAREA QUE NO ESTÉ ASIGNADA
    //router.put('/tarea/asignar/:id', controladorTarea.asignarTarea);

    asignarTarea = async (id_tarea, id_usuario) => {
        let resultado = 0;
        this.conectar();
        try {
            const tareaAsignada = await models.Tarea_Asignada.create({
                id_tarea: id_tarea,
                id_usuario: id_usuario
            });
            resultado = 1;
        } catch (error) {
            if (error instanceof Sequelize.UniqueConstraintError) {
                console.log(`La tarea ${id_tarea} ya está asignada al usuario ${id_usuario}.`);
            } else {
                console.log('Ocurrió un error desconocido: ', error);
            }
            throw error;
        } finally {
            this.desconectar();
        }
        return resultado;
    }


    //QUITARSE TAREA QUE TENGA MI ID ES DECIR QUE ESTÉ ASIGNADA A MI
    //router.put('/tarea/desasignar/:id', controladorTarea.desasignarTarea);
    desasignarTarea = async (id_tarea, id_usuario) => {
        this.conectar();
        let resultado = await models.Tarea_Asignada.findOne({
            where: {
                id_tarea: id_tarea,
                id_usuario: id_usuario
            }
        });
        if (!resultado) {
            this.desconectar();
            throw error;
        }
        await resultado.destroy();
        this.desconectar();
        return resultado;
    }


    //LISTAR TODAS LAS TAREAS ASIGNADAS a mi id
    //router.get('/tareas/asignadas', controladorTarea.listarTareasAsignadas);

    listarTareasAsignadas = async (id_usuario) => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                where: { id_usuario: id_usuario },
                required: true
            }]
        });
        this.desconectar();
        return resultado;
    }

    // CONSULTAR TAREA ASIGNADA a mi id
    //router.get('/tarea/asignada/:id', controladorTarea.consultarTareaAsignada);

    consultarTareaAsignada = async (id_tarea, id_usuario) => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                where: { id_usuario: id_usuario, id_tarea: id_tarea },
                required: true
            }]
        });
        this.desconectar();
        return resultado;

    }

    //LISTAR TODAS LAS TAREAS
    //router.get('/tareas', controladorTarea.listarTareas);

    listarTareas = async () => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                required: false
            }]
        });
        this.desconectar();
        return resultado;
    }

    // RUTAS ADMIN

    ///CREAR TAREA
    /*router.post('/tarea/crear',
        [
            check('descripcion', 'La descripción es obligatoria').not().isEmpty(),
            check('dificultad', 'La dificultad es obligatoria').not().isEmpty(),
            check ('horas_previstas', 'Las horas previstas son obligatorias').not().isEmpty(),
            check ('horas_realizadas', 'Las horas realizadas son obligatorias').not().isEmpty(),
            check ('porcentaje_realizacion', 'El porcentaje de realización es obligatorio').not().isEmpty(),
            check ('completada', 'El campo completada es obligatorio').not().isEmpty(),
        ], controladorTarea.crearTarea);*/

    crearTarea = async (body) => {
        try {
            this.conectar();
            let resultado = await models.Tarea.create(body);
            this.desconectar();
            return resultado;
        } catch (error) {
            this.desconectar();
            console.error('Error al crear la tarea:', error);
            throw error; // Lanza el error para que pueda ser manejado por el llamador
        }
    }

    //MODIFICAR TAREA 
    /*router.put('/tarea/modificar/:id',
        [
            check('descripcion', 'La descripción es obligatoria').not().isEmpty(),
            check('dificultad', 'La dificultad es obligatoria').not().isEmpty(),
            check ('horas_previstas', 'Las horas previstas son obligatorias').not().isEmpty(),
            check ('horas_realizadas', 'Las horas realizadas son obligatorias').not().isEmpty(),
            check ('porcentaje_realizacion', 'El porcentaje de realización es obligatorio').not().isEmpty(),
            check ('completada', 'El campo completada es obligatorio').not().isEmpty(),
        ], controladorTarea.modificarTarea);*/

    modificarTarea = async (id, body) => {
        this.conectar();
        let resultado = await models.Tarea.findByPk(id);
        if (!resultado) {
            this.desconectar();
            throw error;
        }
        await resultado.update(body);
        this.desconectar();
        return resultado;
    }
    //ELIMINAR TAREA
    //router.delete('/tarea/eliminar/:id', controladorTarea.eliminarTarea);

    eliminarTarea = async (id) => {
        this.conectar();
        let resultado = await models.Tarea.findByPk(id);
        if (!resultado) {
            this.desconectar();
            throw error;
        }
        await resultado.destroy();
        this.desconectar();
        return resultado;
    }
    //ASIGNAR TAREA A USUARIO
    //router.put('/tarea/asignar/:id/:id_usuario', controladorTarea.asignarTarea);

    asignarTareaUsuario = async (id_tarea, id_usuario) => {
        let resultado = 0;
        this.conectar();
        try {
            const tareaAsignada = await models.Tarea_Asignada.create({
                id_tarea: id_tarea,
                id_usuario: id_usuario
            });
            resultado = 1;
        } catch (error) {
            if (error instanceof Sequelize.UniqueConstraintError) {
                console.log(`La tarea ${id_tarea} ya está asignada al usuario ${id_usuario}.`);
            } else {
                console.log('Ocurrió un error desconocido: ', error);
            }
            throw error;
        } finally {
            this.desconectar();
        }
        return resultado;
    }
    // VER TAREAS PROGRAMADOR
    //router.get('/tareas/programador/:id_usuario', controladorTarea.verTareasProgramador);

    verTareasProgramador = async (id_usuario) => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                where: { id_usuario: id_usuario },
                required: true
            }]
        });
        this.desconectar();
        return resultado;
    }
    // VER TODAS LAS TAREAS REALIZADAS // el atributo compeltada es true
    //router.get('/tareas/realizadas', controladorTarea.verTareasRealizadas);

    verTareasRealizadas = async () => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            where: { completada: true },
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                required: true
            }]
        });
        this.desconectar();
        return resultado;
    }
    // VER TODAS LAS TAREAS PENDIENTES // el atributo compeltada es false
    //router.get('/tareas/pendientes', controladorTarea.verTareasPendientes);

    verTareasPendientes = async () => {

        let resultado = [];
        this.conectar();
        resultado = await models.Tarea.findAll({
            attributes: ['id', 'descripcion', 'dificultad', 'horas_previstas', 'horas_realizadas', 'porcentaje_realizacion', 'completada'],
            where: { completada: false },
            include: [{
                model: models.Tarea_Asignada,
                as: 'tarea_asignada',
                required: true
            }]
        });
        this.desconectar();
        return resultado;
    }


    // VER RANKING DE TAREAS // sacar los usuarios que más tareas terminadas tiene a su id
    //router.get('/ranking', controladorTarea.verRanking);
    ranking = async () => {
        let resultado = [];
        this.conectar();
        resultado = await models.Tarea_Asignada.findAll({
            attributes: ['id_usuario', [Sequelize.fn('COUNT', Sequelize.col('id_usuario')), 'tareas_realizadas']],
            where: { id_usuario: { [Op.ne]: null } },
            group: ['id_usuario'],
            order: [[Sequelize.fn('COUNT', Sequelize.col('id_usuario')), 'DESC']]
        });
        this.desconectar();
        return resultado;
    }

}

module.exports = TareaConexion;