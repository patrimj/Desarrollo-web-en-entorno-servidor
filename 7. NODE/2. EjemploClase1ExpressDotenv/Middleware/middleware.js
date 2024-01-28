let valores = require('../Models/basededatos')

//middleware

const limite = (req, res, next) => {
    let indice = parseInt(req.params.id,10)
    if (indice >= 0 && indice < valores.length){
        next() // si no hay mas middleware, se pasa al controlador
    }else{
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
    }
}

const otroMid = (req, res, next) => {
    if (1==1){
        next()
    }else{
        res.status(200).json({'msg' : 'Error, posición no existe', 'valores' : valores})
    }
}

exports.limiter = {
    limite,
    otroMids
}