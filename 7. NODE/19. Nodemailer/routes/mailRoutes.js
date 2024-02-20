const { Router } = require('express');
const mailcontroller = require('../controllers/mailcontroller')
const router = Router();

router.get('/',mailcontroller.enviarCorreo)

module.exports = router