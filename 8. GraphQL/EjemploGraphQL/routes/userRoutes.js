const { Router } = require('express');
const controlador = require('../controllers/controlador');
const router = Router();
const mids = require("../middlewares/middleware");

router.get('/', controlador.funGet);
router.get('/:id?',  controlador.funGetUnParametro);
router.post('/', controlador.funPost);
router.delete('/:id', mids.enLimite, controlador.funDelete);
router.put('/:id',  mids.enLimite, controlador.funPut);


module.exports = router