const {Router } = require('express');
const controlador = require('../controllers/userController');
const router = Router();
const mids = require("../middlewares/userMiddlewares");
const midsJWT = require("../middlewares/validarJWT");
const midsRoles = require("../middlewares/validarRoles");

//El segundo parámetro (optativo) son los middlewares.
router.get('/', midsJWT.validarJWT, controlador.usuariosGet);
router.get('/:dni', midsJWT.validarJWT, controlador.usuarioGet);
router.post('/', controlador.usuariosPost);
router.put('/:dni?', [midsJWT.validarJWT, midsRoles.esAdmin], controlador.usuariosPut);
router.delete('/:dni', [midsJWT.validarJWT, midsRoles.esAdmin] ,controlador.usuariosDelete);


module.exports = router;