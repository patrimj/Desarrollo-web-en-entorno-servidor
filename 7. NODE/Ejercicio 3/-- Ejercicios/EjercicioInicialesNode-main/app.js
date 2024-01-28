require('dotenv').config();

const express = require('express');
const middlewares = require('./middlewares/middleware');
const controladores = require('./controllers/controlador')
const app = express();

app.use(express.json());

//  Ejercicio 1
app.get('/fecha/:year', middlewares.checkYear, controladores.calculoDiaMes);

//  Ejercicio 2
app.post('/complemento', middlewares.checkBinario, controladores.calculoComplemento)

//  Ejercicio 3
app.get('/formacion/:legionarios', middlewares.checkLegionarios, controladores.calculoLegionarios)

app.listen(process.env.PORT)
console.log(`Servidor iniciado en puerto ${process.env.PORT}`)