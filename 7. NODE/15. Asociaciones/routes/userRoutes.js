const {Router } = require('express');
const controlador = require('../controllers/userController');
const router = Router();

//El segundo parámetro (optativo) son los middlewares.
router.get('/', controlador.usuariosGet);
router.get('/:dni', controlador.usuarioGet);
router.post('/', controlador.usuariosPost);
router.put('/:dni?', controlador.usuariosPut);
router.delete('/:dni', controlador.usuariosDelete);

router.get('/roles/:id', controlador.getRolesUsuario);
module.exports = router;