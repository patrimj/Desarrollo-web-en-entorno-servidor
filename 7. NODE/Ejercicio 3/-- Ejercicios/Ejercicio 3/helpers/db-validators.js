const Conexion = require('../database/Conexion');

//AQUI VAN LOS VALIDATOR CUSTOMIZADOS

//EJEMPLO:
return new Promise((resolve, reject) => {
    const conx = new Conexion();
    conx.dniExisteValidator(dni)
      .then(msg => {
        console.log('Existe');
        resolve(true);
      })
      .catch(err => {
        console.log('No existe');
        reject(new Error('DNI existe'));
      });
  });
 };

const edadCorrecta = async(edad)=>{
  if (edad <0){
      throw new Error('Edad incorrecta');
  }
}


module.exports = {
    dniExiste,
    edadCorrecta
}