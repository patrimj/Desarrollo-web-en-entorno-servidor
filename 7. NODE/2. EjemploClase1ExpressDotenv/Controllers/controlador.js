let valores = require('../Models/basededatos') // valores es un array de números que ha sido exportado desde basededatos.js

// ESTO QUE HICIMOS EN APP.JS LO HACEMOS EN EL CONTROLADOR
app.get('/', (req, res)  => {
    res.status(200).json({'msg' : 'Gestión del vector', 'valores' : valores})
})
  
// ES LO MISMO QUE:
const funGet = (req, res) => {
    res.status(200).json({'msg' : 'Gestión del vector', 'valores' : valores})
}

const funGetId = (req, res) => {
    let indice = parseInt(req.params.id,10)
    res.status(200).json({'msg' : 'Gestión del vector', 'pos' : parseInt(req.params.id,10), 'valor' : valores[indice]})

}

const funDelete = (req, res) => {
    let indice = parseInt(req.params.id,10)
    if (indice >= 0 && indice < valores.length){
        valores.splice(indice, 1)
        res.status(200).json({'msg' : 'Elemento borrado', 'valores' : valores})
        console.log(valores)
        }
    else  {
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
    }
}

//con los middleware podemos quitar los else y dejar solo el if // y en el middleware ponemos el else y quitamos valores

const funPost = (req, res) => {
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
}

const funPut = (req, res) => {
    let indice = parseInt(req.params.id,10)
    if (indice >= 0 && indice < valores.length){
        valores[indice] = req.body.valor
        res.status(200).json({'msg' : 'Elemento modificado', 'valores' : valores})
    }
    else {
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
    }

}

//FUNCIONES EXPORTADAS

module.exports = funGet
module.exports = funGetId
module.exports = funDelete
module.exports = funPost
module.exports = funPut