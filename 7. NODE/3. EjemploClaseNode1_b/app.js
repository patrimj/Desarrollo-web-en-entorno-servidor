require('dotenv').config()

const express = require('express')
const app = express()
// const port = 9090
const controlador = require('./controllers/controlador')
const middlewares = require('./middlewares/middleware')

app.use(express.json()) // para que saque el body en formato json



app.get('/',  controlador.funGet)

app.get('/:id?', middlewares.enLimite, controlador.funGetUnParametro)

app.delete('/:id', middlewares.enLimite, controlador.funDelete)

app.post('/',controlador.funPost)

app.put('/:id',  middlewares.enLimite, controlador.funPut)


app.listen(process.env.PORT)
console.log(`Servicio arrancado en ${process.env.PORT}`)