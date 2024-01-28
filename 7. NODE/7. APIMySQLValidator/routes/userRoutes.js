const {Router } = require('express');
const controlador = require('../controllers/userController');
const router = Router();
const mids = require("../middlewares/userMiddlewares");

const { check } = require('express-validator');
const { validarCampos } = require('../middlewares/validar-campos');
const { edadCorrecta, dniExiste } = require('../helpers/db-validators');


//El segundo parámetro (optativo) son los middlewares.
router.get('/', controlador.usuariosGet);
router.get('/:dni', controlador.usuarioGet);
/*
En el post recibiremos:
{
    "dni": "999",
    "nombre": "DAW2",
    "email" : "daw2@gmail.com"
    "clave": 2324,
    "tfno": "661 0234234 22",
    "rol" : "Admin"
  }

  Aunque los campos de email y rol no se están guardando realmente, es solo para probar el validator.
*/
router.post('/', 
[
    check('dni').custom( dniExiste ),
    check('nombre', 'El nombre es obligatorio').not().isEmpty(),
    //check('password', 'El password debe de ser más de 6 letras').isLength({ min: 6 }),
    check('email', 'El correo no es válido').isEmail(),
    check('clave','El campo clave no es correcto').isInt().isLength({ max:3 }),
    check('clave','Valores de edad no correctos').custom(edadCorrecta),
    check('tfno', 'Teléfono incorrecto').not().isMobilePhone(),
    check('rol', 'Rol incorrecto').isIn(['Admin','Mindundi']),
    validarCampos
 ],
controlador.usuariosPost);
router.put('/:dni?', controlador.usuariosPut);
router.delete('/:dni', controlador.usuariosDelete);

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