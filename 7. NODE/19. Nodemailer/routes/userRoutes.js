const { Router } = require('express');
const controlador = require('../controllers/controlador');
const router = Router();
const mids = require("../middlewares/middleware");

router.get('/',controlador.funGet);
//Comentar las dos siguientes líneas para probar las subrrutas de /acceso
router.get('/:id?', mids.enLimite, controlador.funGetUnParametro);
router.post('/',controlador.funPost);
router.delete('/:id', mids.enLimite, controlador.funDelete);
router.put('/:id',  mids.enLimite, controlador.funPut);


router.route('/acceso') 
    .get(mids.ejemploParaRutas, (req, res) => { 
        res.status(200).json({'msg':'Acceso con get!!'});
    })
    .post(mids.ejemploParaRutas, (req, res) => {
        res.status(202).json({'msg':'Acceso con post!!'});
    });

module.exports = router