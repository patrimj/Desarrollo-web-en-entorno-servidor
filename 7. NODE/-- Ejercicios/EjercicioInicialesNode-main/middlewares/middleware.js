
const checkYear = (req, res, next) => { 
    let ano = parseInt(req.params.year, 10)
    if (ano >= 1 && ano <= 365) {
        next();
    }else {
        res.status(404).json({message:'Año invalido'});
    }
}

const checkBinario = (req, res, next) => { 
    let numero = parseInt(req.body.numero);
    let arrayNumero = Array.from(String(numero), Number);
    let esBinario = true;
    for (let index = 0; index < arrayNumero.length; index++) {
        if (arrayNumero[index] !== 1 && arrayNumero[index] !== 0) {
            esBinario = false;
            break;
        } else {
            esBinario = true;
        }
    }

    if (esBinario) {
        next();
    } else {
        res.status(404).json({message: 'El numero no es binario'});
    }
}

const checkLegionarios = (req, res, next) => { 
    let legionarios = parseInt(req.params.legionarios)
    
    if (legionarios > 0 && !isNaN(legionarios)) {
        next();
    }else {
        res.status(404).json({message: 'Debe ser un numero mayor que 0'})
    }
}

module.exports = {
    checkYear,
    checkBinario,
    checkLegionarios
}