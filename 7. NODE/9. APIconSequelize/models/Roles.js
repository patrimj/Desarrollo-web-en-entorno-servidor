const { Sequelize, DataTypes, Model }= require('sequelize');
const db = require('../database/connection');
const RolesAsignados = require('./RolesAsignados');
const Persona = require('./Persona');


//https://sequelize.org/docs/v6/core-concepts/model-basics/
//https://stackoverflow.com/questions/29233896/sequelize-table-without-column-
//https://sebhastian.com/sequelize-timestamps/
//https://www.bezkoder.com/sequelize-associate-one-to-many/
const Roles = db.define('roles', {
    id: {
        type: DataTypes.BIGINT,
        primaryKey: true      //La establecemos como PK. En lugar de id por defecto.
    },
    descripcion: {
        type: DataTypes.STRING,
    },
},
{ 
    timestamps: false 
},
{
    tableName: 'roles'
});


Roles.hasMany(RolesAsignados, {as: 'RolesAsignados', foreignKey: 'idRol'});

// Roles.belongsToMany(Persona, { through: RolesAsignados, foreignKey: 'idRol' });


module.exports =  Roles;