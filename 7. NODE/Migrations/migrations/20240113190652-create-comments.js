'use strict';
/** @type {import('sequelize-cli').Migration} */
module.exports = {
  async up(queryInterface, Sequelize) {
    await queryInterface.createTable('comments', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      comentario: {
        type: Sequelize.STRING
      },
      puntuacion: {
        type: Sequelize.STRING
      },
      userId: {//te crea este campo en la bbdd
        type: Sequelize.DataTypes.INTEGER,
        references: {
          model: {
            tableName: 'users' //que la migration automaticamente haga la foreing key
          },
          key: 'id'
        },
        allowNull: false
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  async down(queryInterface, Sequelize) {
    await queryInterface.dropTable('comments');
  }
};