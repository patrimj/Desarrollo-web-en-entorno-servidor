const {Router } = require('express');
const controlador = require('../controllers/commentController');
const router = Router();

router.get('/', controlador.getComments);
router.get('/:id?', controlador.getCommentsId);


module.exports = router;