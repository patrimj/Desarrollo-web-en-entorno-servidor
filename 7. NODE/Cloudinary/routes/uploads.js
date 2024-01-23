const { Router } = require('express');

const { validarArchivoSubir } = require('../middlewares/validar-archivo');
const { cargarArchivo, actualizarImagen, borrarImagen, obternerImagenes } = require('../controllers/uploads');
//const { coleccionesPermitidas } = require('../helpers');


const router = Router();


router.post( '/', validarArchivoSubir, cargarArchivo );

router.get('/', obternerImagenes);

router.put('/:id', actualizarImagen )

router.delete('/:id', borrarImagen  )

module.exports = router;