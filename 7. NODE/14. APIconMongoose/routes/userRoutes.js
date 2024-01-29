const {Router } = require('express');
const controlador = require('../controllers/userController');
const router = Router();
const mids = require("../middlewares/userMiddlewares");

//El segundo parámetro (optativo) son los middlewares.
router.get('/', controlador.usuariosGet);
router.get('/:id', controlador.usuarioGet);
router.post('/', controlador.usuariosPost);
router.put('/:id?', controlador.usuariosPut);
router.delete('/:id', controlador.usuariosDelete);


module.exports = router;