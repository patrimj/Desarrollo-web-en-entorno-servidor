const calculoDiaMes = (req, res) => {
    let numero = req.params.year
    const diasEnMeses = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    let diaAcumulado = 0;
    let mesCorrespondiente;

    for (let i = 0; i < diasEnMeses.length; i++) {
        diaAcumulado += diasEnMeses[i];

        if (numero <= diaAcumulado) {
            mesCorrespondiente = i + 1;
            break;
        }
    }

    const diaEnMes = numero - (diaAcumulado - diasEnMeses[mesCorrespondiente - 1]);

    let devolver = {
        mes: mesCorrespondiente,
        dia: diaEnMes,
    };

    res.status(200).json({ mssg: devolver });
}

const calculoComplemento = (req, res) => {
    let numero = req.body.numero
    
    let numeroInvertido = Array.from(String(numero), Number);

    for (let index = 0; index < numeroInvertido.length; index++) {
        if (numeroInvertido[index] === 0) {
            numeroInvertido[index] = 1
        }else if (numeroInvertido[index] === 1) {
            numeroInvertido[index] = 0
        }
    }
    numeroInvertido = parseInt(numeroInvertido.join(''));

    let devolver = {
        numero: numero,
        complemento: numeroInvertido,
        resultado: parseInt(numero,2)
    }
    res.status(200).json({mssg: devolver})
}

const calculoLegionarios = (req, res) => { 
    let numeroLegionarios = parseInt(req.params.legionarios)

    let devolver = { 
        formaciones: [],
        escudos: 0
    }

    while (numeroLegionarios > 0) {
        let cuadrado = Math.sqrt(numeroLegionarios);
        cuadrado = Math.floor(cuadrado);
        numeroLegionarios -= cuadrado * cuadrado;
        devolver.formaciones.push(cuadrado)
        devolver.escudos += (cuadrado * 4) + (cuadrado * cuadrado)
    }

    res.status(200).json({formacion: devolver}) 
}

module.exports = {
    calculoDiaMes,
    calculoComplemento,
    calculoLegionarios
}