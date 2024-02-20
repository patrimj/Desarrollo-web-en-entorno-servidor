const nodemailer = require('nodemailer');

let transporter = nodemailer.createTransport({
    service: 'gmail', 
    auth: {
        type: 'OAuth2',
        user: process.env.MAIL_USER,
        pass: process.env.MAIL_PASSWORD,
        clientId: process.env.MAIL_CLIENT_ID,
        clientSecret: process.env.MAIL_CLIENT_SECRET,
        refreshToken: process.env.MAIL_REFRESH_TOKEN,
        accessToken: process.env.MAIL_ACCESS_TOKEN
    }
});

let mailOptions = {
    from: process.env.MAIL_USER, 
    to: 'faranzabe@gmail.com', 
    subject: 'Prueba de Nodemailer', 
    text: 'Esto es una prueba de Nodemailerrrll...' 
};




const enviarCorreo = (req, res) => {
    transporter.sendMail(mailOptions, function(error, info) {
        if (error) {
            console.log('Error al enviar el correo electrónico:', error);
            res.status(203).json({'msg' : 'Correo NO enviado'})
        } else {
            console.log('Correo electrónico enviado exitosamente:', info.response);
            res.status(200).json({'msg' : 'Correo enviado'})
        }
    });
}

module.exports = {
    enviarCorreo
}