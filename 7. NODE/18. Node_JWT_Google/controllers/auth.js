const {response,request} = require('express');
const Conexion = require('../database/Conexion');
const {generarJWT} = require('../helpers/generate_jwt');
const { googleVerify } = require('../helpers/google-verify');


const login =  (req, res = response) => {
    const {dni, clave} = req.body;
    try{
        //Verificar si existe el usuario.
        const conx = new Conexion();
        u = conx.getUsuarioRegistrado(dni, clave)    
            .then( usu => {
                console.log('Usuario correcto!  ' + usu[0].DNI);
                const token = generarJWT(usu[0].DNI)
                console.log(usu)
                console.log(token);
                res.status(200).json({usu, token});
            })
            .catch( err => {
                console.log('No hay registro de ese usuario.');
                res.status(500).json({'msg':'Login incorrecto.'});
            });
            

        //res.status(200).json({'msg':'Login ok', DNI, Clave});
    }
    catch(error){
        console.log(error);
        res.status(500).json({'msg':'Error en el servidor.'});
    }
    
}


//---------------------------------------------
//https://developers.google.com/identity/gsi/web/guides/overview?hl=es-419
const googleSignin = async(req, res = response) => {

    const { id_token } = req.body;
    console.log(`Token recibido desde el cliente: ${id_token}`);
    //Para probar inicialmente que recibimos el token del front:
    //res.status(200).json({msg:"Token recibido",id_token});
    
    //Una vez comprobado que el token se recibe desde el front, instalamos: npm install google-auth-library --save 
    //Y ya podemos usar el código siguiente para verificar el token.
    try {
        const { correo, nombre, img } = await googleVerify( id_token );
        //Si seguimos y no salta la excepción estarmos verificados por Google.

        //let usuario = await Usuario.findOne({ correo });
        console.log(`Comprobaríamos el usuario: ${correo}, ${nombre} ${img}`);
        //Verificar si existe el usuario. Además de la verificación del token de Google, vemos si existe en nuestra BD, caso de no existir lo creamos.
        // const conx = new Conexion();
        // u = conx.getUsuarioRegistrado(dni, clave)    
        //     .then( usu => {
        //         console.log('Usuario correcto!  ' + usu[0].DNI);
        //         const token = generarJWT(usu[0].DNI)
        //         console.log(usu)
        //         console.log(token);
        //         //res.status(200).json({usu, token});
        //     })
        //     // .catch( err => {
        //     //     console.log('No hay registro de ese usuario.');
        //     //     res.status(500).json({'msg':'Login incorrecto.'});
        //     // });

        // if ( !u ) {
        //     // Tengo que crearlo
        //     const data = {
        //         nombre,
        //         correo,
        //         password: ':P',
        //         img,
        //         google: true
        //     };
        //     //Crearíamos el usario con Mongoose o con MySQL, según lo que usemos.
        //     console.log(`Creando el usuario ${data}`)
        // }


        const token = generarJWT(correo); //Si entramos, podemos generar nuestro propio token de seguridad con el correo del usuario. Ese token será el que usemos para el uso de la API.
        res.status(200).json({correo, token, img});
        
    } catch (error) {

        res.status(400).json({
            msg: 'Token de Google no es válido'
        })

    }



}

//---------------------------------------------


module.exports = {
    login,
    googleSignin
}