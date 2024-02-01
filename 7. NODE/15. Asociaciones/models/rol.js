'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class Rol extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      this.belongsToMany(models.User, { through: models.RolAsignado, foreignKey: 'idR', as: 'users' });
      
    }
  }
  Rol.init({
    desc: DataTypes.STRING
  }, {
    sequelize,
    modelName: 'Rol',
    tableName:'roles'
  });
  return Rol;
};