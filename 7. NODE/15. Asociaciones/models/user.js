
'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class User extends Model {
   
    static associate(models) {
      this.hasMany(models.Comment, {
        foreignKey: 'userId',
        as: 'commentsUser',
      });
      this.belongsToMany(models.Rol, { through: models.RolAsignado, foreignKey: 'idU', as: 'roles' });
    }
  }
  User.init({
    firstName: DataTypes.STRING,
    lastName: DataTypes.STRING,
    email: DataTypes.STRING,
    password: DataTypes.STRING
  }, {
    sequelize,
    modelName: 'User',
    tableName : 'users',
  });
    return User;
};

