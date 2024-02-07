const {Router } = require('express');
const controlador = require('../controllers/commentsController');
const router = Router();

router.get('/', controlador.comentariosGet);
router.get('/asignados', controlador.comentariosGetAsignados);
router.get('/asignados/:id', controlador.comentarioGetAsignadoA);


module.exports = router;