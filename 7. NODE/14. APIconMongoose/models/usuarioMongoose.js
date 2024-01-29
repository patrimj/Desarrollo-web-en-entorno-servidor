const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
    id: { type: Number},
    nombre: { type: String },
    edad: { type: Number },
    tfno : { type: String }
}, { collection: 'usuarios' , versionKey: false }); //@v control de versiones [por ahora en falso]

const UserModel = mongoose.model('User', userSchema);

module.exports = UserModel;

/*
hay que hacer un modelo para dialogar con mongo */