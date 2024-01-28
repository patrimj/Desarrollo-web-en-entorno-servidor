const moment = require('moment');

const calcularFecha = (req, res) => {
    let numero = parseInt(req.params.numero, 10);
    let fecha = moment().dayOfYear(numero);
    res.status(200).json({ dia: fecha.date(), mes: fecha.month()});
}
module.exports = { 
    calcularFecha 
};

/* APUNTES

- moment es una librería para trabajar con fechas
- dayOfYear es un método sacado de moment -> la fecha a partir del día del año
- date nos saca el día del mes
- month  nos saca el mes del año */