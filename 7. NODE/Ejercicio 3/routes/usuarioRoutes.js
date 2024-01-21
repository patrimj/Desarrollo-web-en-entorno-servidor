const { Router } = require('express');
const controladorPersona = require('../controllers/usuario.controller');
const controladorTarea = require('../controllers/tarea.controller');
const router = Router();
const { check } = require('express-validator');
const { validarAdmin } = require('../middlewares/validar-admin');


//RUTAS CUALQUIER USUARIO

router.post('/login', //LOGIN
    [
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
        
    ], controladorPersona.login);


router.post('/registrarse', // REGISTRARSE
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], controladorPersona.registro);

router.put('/perfil/password/:email', // CAMBIAR PASSWORD
    [
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], controladorPersona.cambiarPassword);

//RUTAS ADMINISTRADOR

router.post('/usuario/alta', // ALTA USUARIO
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], controladorPersona.altaUsuario);

router.delete('usuario/baja/:id', controladorPersona.bajaUsuario); // BAJA USUARIO

router.put('usuario/modificar/:id', // MODIFICAR USUARIO
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], controladorPersona.modificarUsuario);

router.get('/tareas', controladorTarea.listarTareas); // LISTAR TAREAS

module.exports = router;