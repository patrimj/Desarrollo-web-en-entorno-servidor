const { Router } = require('express');
const controlador = require('../controllers/controlador');
const router = Router();
const middlewares = require('../middlewares/middleware');


router.get('/:numero', middlewares.fechaLimite, controlador.calcularFecha);

module.exports = router

