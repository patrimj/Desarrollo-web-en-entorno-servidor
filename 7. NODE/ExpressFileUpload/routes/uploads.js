const { Router } = require('express');

const { validarArchivoSubir } = require('../middlewares/validar-archivo');
const { cargarArchivo, actualizarImagen, obtenerImagen, borrarImagen } = require('../controllers/uploads');
//const { coleccionesPermitidas } = require('../helpers');


const router = Router();


router.post( '/', validarArchivoSubir, cargarArchivo );

router.put('/:id', actualizarImagen )

router.delete('/:id', borrarImagen  )

//router.get('/:coleccion/:id', obtenerImagen  )  //Lo más correcto sería pasar el id en ruta, buscar ese documento en la bd y obtener el campo string con el nombre del archivo.
router.get('/:id', obtenerImagen  )  //Para probar le pasaré el nombre del archivo en el body, por ejemplo: {"nomArchivo":"470fc03f-92cc-4cad-800a-f696d4e676b2.jpeg"}  

module.exports = router;