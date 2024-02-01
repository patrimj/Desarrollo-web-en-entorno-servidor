// PRIMER EJERCICIO DE NODE - SERVIDOR
/*
1) Fechas a partir de números 
La ruta admitirá un número comprendido entre 1 y 365 y calculará el mes y el día del mes que corresponde (año no bisiesto). 
Por ejemplo, para el número 75, se devolverá el día 16 del mes 3, en formato JSON.[CONTROLADOR]
Se controlará el error de que el número proporcionado no esté comprendido entre 1 y 365.[MIDDLEWARE]
*/

require('dotenv').config()

const express = require('express')
const app = express()

///const controlador = require('../controllers/controlador')
//const middlewares = require('../middlewares/middleware')

app.use(express.json())

const rutaBase = '/api';
app.use(rutaBase, require('../routes/numerosRoutes'));

//app.get('/fecha/:numero', middlewares.fechaLimite, controlador.calcularFecha);

app.listen(process.env.PORT)
console.log(`Servicio arrancado en ${process.env.PORT}`)

