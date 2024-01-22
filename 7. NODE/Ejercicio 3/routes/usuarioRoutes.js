const { Router } = require('express');
const controladorPersona = require('../controllers/usuario.controller');
const router = Router();
const { check } = require('express-validator');
const midsJWT = require("../middlewares/validarJWT");
const midsRoles = require("../middlewares/validarRoles");


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
    ], midsJWT.validarJWT, controladorPersona.cambiarPassword);

//RUTAS ADMINISTRADOR

router.post('/usuario/alta', // ALTA USUARIO
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], midsJWT.validarJWT,midsRoles.esAdmin, controladorPersona.altaUsuario);

router.delete('/usuario/baja/:id', midsJWT.validarJWT,midsRoles.esAdmin, controladorPersona.bajaUsuario); // BAJA USUARIO

router.put('/usuario/modificar/:id', // MODIFICAR USUARIO
    [
        check('nombre', 'El nombre es obligatorio').not().isEmpty(),
        check('email', 'El correo no es válido').isEmail(),
        check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    ], midsJWT.validarJWT, midsRoles.esAdmin, controladorPersona.modificarUsuario);

module.exports = router;