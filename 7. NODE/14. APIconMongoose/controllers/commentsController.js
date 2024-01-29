const UserModel = require('../models/usuarioMongoose.js');
const Comentario = require('../models/comentarioMongoose.js');



const comentariosGet = async (req, res) => {
    try {
        const comentarios = await Comentario.find();
        if (comentarios.length > 0) {
            console.log(comentarios)
            console.log('Listado correcto!');
            res.status(200).json(comentarios);
        } else {
            console.log('No hay registros!');
            res.status(200).json({ 'msg': 'No se han encontrado registros' });
        }
    } catch (error) {
        console.error('Error al obtener comentarios:', error);
        res.status(500).json({ 'msg': 'Error al obtener comentarios' });
    }
};

const comentariosGetAsignados = async (req, res) => {
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
        res.status(200).json(comentariosPorUsuario);

    } catch (error) {
        console.error('Error al obtener comentarios por usuario:', error);
        res.status(500).json({ 'msg': 'Error al obtener comentarios' });
    }     
}


const comentarioGetAsignadoA = async (req, res) => {
    try {
        const userId = parseInt(req.params.id);  //Esto es necesario porque al usar $match se pone un poco tiquismiquis con los tipos y req.params.id no es int (que es como está definido).
        const comentariosPorUsuario = await Comentario.aggregate([
            {
                $match: { ///match es como un where
                    idU: userId
                }
            },
            {
                $lookup: { ///lookup es como un join
                    from: 'usuarios',  
                    localField: 'idU',
                    foreignField: 'id',
                    as: 'usuario'
                }
            },
            {
                $unwind: '$usuario' ///unwind es como un select
            },
            {
                $group: { ///group es como un group by
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
        res.status(200).json(comentariosPorUsuario);

    } catch (error) {
        console.error('Error al obtener comentarios por usuario:', error);
        res.status(500).json({ 'msg': 'Error al obtener comentarios' });
    }     
}


module.exports = {
    comentariosGet,
    comentariosGetAsignados,
    comentarioGetAsignadoA
};