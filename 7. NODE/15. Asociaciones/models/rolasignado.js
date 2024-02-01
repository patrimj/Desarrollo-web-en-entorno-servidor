'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class RolAsignado extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      this.belongsTo(models.User, { foreignKey: 'idU' });
      this.belongsTo(models.Rol, { foreignKey: 'idR' });
    }
  }
  RolAsignado.init({
    idU: DataTypes.INTEGER,
    idR: DataTypes.INTEGER
  }, {
    sequelize,
    modelName: 'RolAsignado',
    tableName  : 'rolesasignados'
    });
  return RolAsignado;
};