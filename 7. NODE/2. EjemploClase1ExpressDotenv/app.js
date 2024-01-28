// es un servicio de aplicación, esto quiere decir que cada vez que cargue el servicio se ejecutará el código, es decir si añadimos un valor al array, este se reiniciará cada vez que se ejecute el servicio, cada cosa nueva que añadamos se reiniciará, es decir, no se guardará en memoria, por lo que no es un servicio de base de datos, es un servicio de aplicación
// nodemon app para ejecutar el servicio
// npm install express para instalar express
// npm install nodemon -g para instalar nodemon de forma global
// para sacar node_modules con el comando npm install
// para sacar package.json con el comando npm init
// para sacar package-lock.json con el comando npm install

const express = require('express')
const dotenv = require('dotenv')
const app = express()
const port = 9090

app.use(express.json())

let valores = [1,2,3,4]


///AQUÍ SE UTILIZA EL CONTROLADOR Y LA LOGICA ESTÁ EN EL CONTROLADOR Y NO EN BRUTO COMO ABAJO
let controlador = require('./Controllers/controlador')
let mid = require('./Middleware/middleware')

app.get('/', controlador.funGet)
app.get('/:id?', controlador.funGetId)
app.delete('/:id', controlador.funDelete)
app.post('/', controlador.funPost)

// con middleware
app.put('/:id', controlador.funPut) //mid.limite, controlador.funPut
// con 2 middleware
app.put('/:id', mid.limite, mid.otroMid, controlador.funPut)
//con 2 middleware en un array
app.put('/:id', [mid.limite, mid.otroMid], controlador.funPut)



//app.get('/', (req, res)  => {
  // quitamos esto porque lo metemos en el controlador -> res.status(200).json({'msg' : 'Gestión del vector', 'valores' : valores})
//})

/*
app.get('/:id?', (req, res) => {
    let indice = parseInt(req.params.id,10)
    res.status(200).json({'msg' : 'Gestión del vector', 'pos' : parseInt(req.params.id,10), 'valor' : valores[indice]})
  })

app.delete('/:id', (req, res) => {
    let indice = parseInt(req.params.id,10)
    if (indice >= 0 && indice < valores.length){
        valores.splice(indice, 1)
        res.status(200).json({'msg' : 'Elemento borrado', 'valores' : valores})
        console.log(valores)
        }
    else  {
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
}
})

//aqui está en bruto sin controllers

app.post('/', (req, res) => {
    //res.status(200).json({'nombre' : req.body.nombre, 'edad' : req.body.edad})
    let pos = req.body.posicion
    let nuevoValor = req.body.valor

    if (pos >= 0 && pos <= valores.length){
        valores.splice(pos, 0, nuevoValor);
        console.log(valores); 
        res.status(200).json({'msg' : 'Elemento insertado', 'valores' : valores})
     }
     else {
        console.log('Error, posición no existe');
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
     }
})

app.put('/:id', (req, res) => {
    let indice = parseInt(req.params.id,10)
    if (indice >= 0 && indice < valores.length){
        valores[indice] = req.body.valor
        res.status(200).json({'msg' : 'Elemento modificado', 'valores' : valores})
    }
    else {
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
    }

})*/


app.listen(port)
app.listen(process.env.PORT)

console.log(`Servicio arrancado en ${port}`)
console.log(`Servicio arrancado en ${process.env.PORT}`)