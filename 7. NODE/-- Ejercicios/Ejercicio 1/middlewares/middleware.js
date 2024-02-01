const fechaLimite = (req, res, next) => {
    let numero = parseInt(req.params.numero, 10);
    if (numero < 1 || numero > 365) {
        res.status(400).json({ error: 'El número no est entre 1 y 365' });
    } else {
        next();
    }
}
module.exports = { fechaLimite };

