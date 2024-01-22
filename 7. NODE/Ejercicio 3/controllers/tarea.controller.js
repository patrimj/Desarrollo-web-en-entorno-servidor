const { response, request } = require('express');
const ConexionTarea = require('../database/tarea.conexion');
const { validarJWT } = require('../middlewares/validarJWT');

//LISTAR TAREAS LIBRES
const listarTareasLibres = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.listarTareasLibres()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

//ASIGNAR TAREA
//router.put('/tarea/asignar/:id', validarJWT, controladorTarea.asignarTarea);

const asignarTarea = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;
    const id_usuario = req.idToken;

    conx.asignarTarea(id, id_usuario)
        .then(msg => {
            console.log('Tarea asignada correctamente!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No se ha podido asignar la tarea');
            res.status(200).json({ 'msg': 'No se ha podido asignar la tarea' });
        });
}

//QUITARSE TAREA QUE TENGA MI ID ES DECIR QUE ESTÉ ASIGNADA A MI
//router.put('/tarea/desasignar/:id', controladorTarea.desasignarTarea);

const desasignarTarea = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;
    const id_usuario = req.idToken;

    conx.desasignarTarea(id, id_usuario)
        .then(msg => {
            console.log('Tarea desasignada correctamente!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No se ha podido desasignar la tarea');
            res.status(200).json({ 'msg': 'No se ha podido desasignar la tarea' });
        });
}


//LISTAR TAREAS ASIGNADAS
//router.get('/tareas/asignadas', controladorTarea.listarTareasAsignadas);

const listarTareasAsignadas = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id_usuario = req.idToken;

    conx.listarTareasAsignadas(id_usuario)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}
// CONSULTAR TAREA ASIGNADA
//router.get('/tarea/asignada/:id', controladorTarea.consultarTareaAsignada);

const consultarTareaAsignada = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;
    const id_usuario = req.idToken;

    conx.consultarTareaAsignada(id, id_usuario)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}


//LISTAR TODAS LAS TAREAS
//router.get('/tareas', controladorTarea.listarTareas);
const listarTareas = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.listarTareas()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
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

    const crearTarea = (req = request, res = response) => {
        const conx = new ConexionTarea();

            conx.crearTarea(req.body.descripcion, req.body.dificultad, req.body.horas_previstas, req.body.horas_realizadas, req.body.porcentaje_realizacion, req.body.completada)
            .then(msg => {
                console.log('Tarea creada correctamente!');
                res.status(200).json(msg);
            })
            .catch(err => {
                console.log('No se ha podido crear la tarea');
                res.status(200).json({ 'msg': 'No se ha podido crear la tarea' });
            });
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

const modificarTarea = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;

    conx.modificarTarea(id, req.body.descripcion, req.body.dificultad, req.body.horas_previstas, req.body.horas_realizadas, req.body.porcentaje_realizacion, req.body.completada)
        .then(msg => {
            console.log('Tarea modificada correctamente!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No se ha podido modificar la tarea');
            res.status(200).json({ 'msg': 'No se ha podido modificar la tarea' });
        });
}

//ELIMINAR TAREA
//router.delete('/tarea/eliminar/:id', controladorTarea.eliminarTarea);

const eliminarTarea = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;

    conx.eliminarTarea(id)
        .then(msg => {
            console.log('Tarea eliminada correctamente!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No se ha podido eliminar la tarea');
            res.status(200).json({ 'msg': 'No se ha podido eliminar la tarea' });
        });
}

//ASIGNAR TAREA A USUARIO
//router.put('/tarea/asignar/:id/:id_usuario', controladorTarea.asignarTarea);

const asignarTareaAUsuario = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id = req.params.id;
    const id_usuario = req.params.id_usuario;

    conx.asignarTarea(id, id_usuario)
        .then(msg => {
            console.log('Tarea asignada correctamente!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No se ha podido asignar la tarea');
            res.status(200).json({ 'msg': 'No se ha podido asignar la tarea' });
        });
}

// VER TAREAS PROGRAMADOR
//router.get('/tareas/programador/:id_usuario', controladorTarea.verTareasProgramador);

const verTareasProgramador = (req = request, res = response) => {
    const conx = new ConexionTarea();
    const id_usuario = req.params.id_usuario;

    conx.verTareasProgramador(id_usuario)
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

// VER TODAS LAS TAREAS REALIZADAS // el atributo compeltada es true
//router.get('/tareas/realizadas', controladorTarea.verTareasRealizadas);

const verTareasRealizadas = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.verTareasRealizadas()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}
// VER TODAS LAS TAREAS PENDIENTES // el atributo compeltada es false
//router.get('/tareas/pendientes', controladorTarea.verTareasPendientes);
const verTareasPendientes = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.verTareasPendientes()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

// VER RANKING DE TAREAS // sacar los usuarios que más tareas terminadas tiene a su id
//router.get('/ranking', controladorTarea.verRanking);

const ranking = (req = request, res = response) => {
    const conx = new ConexionTarea();

    conx.ranking()
        .then(msg => {
            console.log('Listado correcto!');
            res.status(200).json(msg);
        })
        .catch(err => {
            console.log('No hay registros');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        });
}

module.exports = {
    listarTareasLibres,
    asignarTarea,
    desasignarTarea,
    listarTareasAsignadas,
    consultarTareaAsignada,
    listarTareas,
    crearTarea,
    modificarTarea,
    eliminarTarea,
    asignarTareaAUsuario,
    verTareasProgramador,
    verTareasRealizadas,
    verTareasPendientes,
    ranking
}
