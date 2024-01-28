const { Router } = require('express');
const controladorPersona = require('../controllers/usuarioController');
const router = Router();
const { check } = require('express-validator');
const { validarCampos } = require('../middlewares/validar-campos');


router.post('/login', // funciona
    [
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
        validarCampos
    ], controladorPersona.login); //Login de un usuario


    router.post('/registrarse', // funciona
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], controladorPersona.registrarUsuario); //Registro de un usuario

router.get('/usuario', controladorPersona.getUsuarios); //Listar todos los usuarios

router.route('/usuario/:id')
    .get(controladorPersona.getUsuarioId) //Listar un usuario por id
    .put(
        [
            check('nombre', 'El nombre es obligatorio').not().isEmpty(),
            check('email', 'El correo no es válido').isEmail(),
            check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),

        ], controladorPersona.modificarUsuario) //Modificar un usuario
    .delete(controladorPersona.borrarUsuario); //Eliminar un usuario


//ASIGNAR TAREAS A PERSONAS




//TODO: CONTROLLER DE TAREAS SUS RUTAS CON VALIDATOR


/*
router.get('/', controlador.usuariosGet);
router.get('/:dni', controlador.usuarioGet);
router.post('/', controlador.usuariosPost);
router.put('/:dni?', controlador.usuariosPut);
router.delete('/:dni', controlador.usuariosDelete);*/

//Formas de agrupar rutas. Lo del middleware podría ir en la clase server pero quizá sea más entendible aquí, justo antes de la agrupación de rutas.
// router.use('/acceso',[mids.otroMiddleware, mids.esMayor]); //Para agrupar rutas y aplicarles middlewares.
// router.route('/acceso') 
//     .get( (req, res) => { 
//         res.status(200).json({'msg':'Acceso con get!!'});
//     })
//     .post( (req, res) => {
//         res.status(202).json({'msg':'Acceso con post!!'});
//     });

module.exports = router;