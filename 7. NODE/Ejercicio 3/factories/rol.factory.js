const genRoles = async () => {

    let rolGen = []
    const nombres = ['Admin', 'Programador'];

    for(let i = 0; i < nombres.length; i++) {
        let u = 
            {
                nombre: nombres[i],
                createdAt: new Date(),
                updatedAt: new Date()
            }
            rolGen.push(u)
    }
    return Promise.all(rolGen);
}

module.exports = {
    genRoles
}