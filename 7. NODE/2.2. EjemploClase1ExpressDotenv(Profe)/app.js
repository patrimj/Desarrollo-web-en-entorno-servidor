const express = require('express')
const app = express()
const port = 9090

let controlador = require('./controllers/controlador')
let mid = require('./middlewares/middleware')

app.use(express.json())

app.get('/', controlador.funGet)
  
app.get('/:id?', [mid.enLimite, mid.otroControlador] ,controlador.funGetAt)
  
app.delete('/:id', mid.enLimite ,controlador.funDelete)
  
app.post('/',  controlador.funPost)

app.put('/:id', mid.enLimite ,controlador.funPut)
  

app.listen(port)
console.log(`Servicio levantado en ${port}`)