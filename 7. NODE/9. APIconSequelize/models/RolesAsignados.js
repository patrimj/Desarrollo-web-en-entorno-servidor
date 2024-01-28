const { Sequelize, DataTypes, Model }= require('sequelize');
const db = require('../database/connection');
// const Persona = require('./Persona');
// const Rol = require('./Roles');


//https://sequelize.org/docs/v6/core-concepts/model-basics/
//https://stackoverflow.com/questions/29233896/sequelize-table-without-column-
//https://sebhastian.com/sequelize-timestamps/
//https://www.bezkoder.com/sequelize-associate-one-to-many/
//https://codehandbook.org/implement-has-many-association-in-sequelize/
const RolesAsignados = db.define('rolesasignado', {
    idra: {
        type: DataTypes.BIGINT,
        primaryKey: true      //La establecemos como PK. En lugar de id por defecto.
    },
    DNIRol: {
        type: DataTypes.STRING,
        // references: {
        //     model: Persona,
        //     key: 'DNI'
        //   }
    },
    idRol: {
        type: DataTypes.BIGINT,
        // references: {
        //     model: Rol,
        //     key: 'id'
        //   }
    },
},
{ 
    timestamps: false 
},
{
    tableName: 'rolesasignados'
});


// RolesAsignados.belongsTo(Rol);
// RolesAsignados.belongsTo(Persona);

// RolesAsignados.belongsToMany(Rol, {as: 'Rol', foreignKey: 'id'});

// RolesAsignados.hasMany(Rol, {as: 'RolA', foreignKey: 'idRol'});
// RolesAsignados.hasMany(Persona, {as: 'PersonaA', foreignKey: 'DNIRol'});


module.exports = RolesAsignados;