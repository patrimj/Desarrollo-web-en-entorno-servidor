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
    tableName: 'comments'
  });
  return Comment;
};
