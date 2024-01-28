require('dotenv').config()

const express = require('express')
const app = express()

app.use(express.json())

const rutaBase = '/api';
app.use(rutaBase, require('../routes/userRoutes'));



app.listen(process.env.PORT)
console.log(`Servicio arrancado en ${process.env.PORT}`)