const UserModel = require('../models/usuarioMongoose.js');
const Comentario = require('../models/comentarioMongoose.js');



const comentariosGet = async () => {
    try {
        const comentarios = await Comentario.find();
        if (comentarios.length > 0) {
            console.log(comentarios)
            console.log('Listado correcto!');
            return(comentarios);
        } else {
            console.log('No hay registros!');
            return null;
        }
    } catch (error) {
        throw new Error('Error al obtener comentarios!', error);
        // console.error('Error al obtener comentarios:', error);
        // return null;
    }
};

const comentariosGetAsignados = async () => {
    try {
        const comentariosPorUsuario = await Comentario.aggregate([
            {
                $lookup: {
                    from: 'usuarios',  
                    localField: 'idU',
                    foreignField: 'id',
                    as: 'usuario'
                }
            },
            {
                $unwind: '$usuario'
            },
            {
                $group: {
                    _id: '$usuario.nombre',
                    comentarios: {
                        $push: {
                            commentId: '$_id',
                            comment: '$comment',
                            likes: '$likes',
                            timestamp: '$timestamp'
                        }
                    }
                }
            }
        ]);

        console.log(comentariosPorUsuario);
        return(comentariosPorUsuario)

    } catch (error) {
        throw new Error('Error al obtener comentarios por usuario!', error);
        // console.error('Error al obtener comentarios por usuario:', error);
        // return null
    }     
}


const comentarioGetAsignadoA = async (userId) => {
    try {
        const comentariosPorUsuario = await Comentario.aggregate([
            {
                $match: {
                    idU: userId
                }
            },
            {
                $lookup: {
                    from: 'usuarios',  
                    localField: 'idU',
                    foreignField: 'id',
                    as: 'usuario'
                }
            },
            {
                $unwind: '$usuario'
            },
            {
                $group: {
                    _id: '$usuario.nombre',
                    comentarios: {
                        $push: {
                            commentId: '$_id',
                            comment: '$comment',
                            likes: '$likes',
                            timestamp: '$timestamp'
                        }
                    }
                }
            }
        ]);

        console.log(comentariosPorUsuario);
        return(comentariosPorUsuario);

    } catch (error) {
        throw new Error('Error al obtener comentarios por usuario!', error);
        // console.error('Error al obtener comentarios por usuario:', error);
        // return null
    }     
}


module.exports = {
    comentariosGet,
    comentariosGetAsignados,
    comentarioGetAsignadoA
};