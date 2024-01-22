'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class User extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      this.hasMany(models.Rol_Asignado, {
        foreignKey: 'id_usuario',
        as: 'rolesAsignados'
      });
      this.hasMany(models.Tarea_Asignada, {
        foreignKey: 'id_usuario',
        as: 'tareasAsignadas'
      });
    }
  }
  User.init({
    nombre: DataTypes.STRING,
    email: {
      type: DataTypes.STRING,
      unique: true
  },
    password: DataTypes.STRING
  }, {
    sequelize,
    modelName: 'User',
    tableName: 'users'
  });
  return User;
};