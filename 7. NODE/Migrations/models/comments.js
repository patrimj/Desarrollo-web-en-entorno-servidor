'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class Comment extends Model {
   
    static associate(models) {

    }
  }
  Comment.init({
    comentario: DataTypes.STRING,
    puntuacion: DataTypes.STRING,
    userId: DataTypes.INTEGER
  }, 
  {
    sequelize,
    modelName: 'Comment',
    tableName: 'comments' // los modelos en mayuscula y singular y los nombres de las tablas en minuscula y plural
  });
  return Comment;
};
