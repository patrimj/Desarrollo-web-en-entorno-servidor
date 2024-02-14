const {Router } = require('express');
const router = Router();
const controlador = require('../controllers/userController');

router.get('/', controlador.usuariosGet);
router.get('/:id?', controlador.usuariosGetParametro)
router.post('/', controlador.usuariosPost);
router.put('/:id?', controlador.usuariosPut);//Con parámetro optativo.
router.delete('/:id', controlador.usuariosDelete);



module.exports = router;