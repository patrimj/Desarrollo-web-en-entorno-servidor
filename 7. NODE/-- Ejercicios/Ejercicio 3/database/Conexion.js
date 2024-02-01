
require('dotenv').config();
const mysql = require('mysql2');

class Conexion {

    constructor() {
        this.config = {
            host: process.env.DB_HOST,
            user: process.env.DB_USER,
            password: process.env.DB_PASSWORD,
            database: process.env.DB_DATABASE,
            waitForConnections: true,
            connectionLimit: process.env.DB_MAXCONNECTIONS,
            queueLimit: 0
        };
        this.pool = mysql.createPool(this.config);
    }

    query = (sql, values) => {
        return new Promise((resolve, reject) => {
            this.pool.query(sql, values, (err, rows) => {
                if (err) {
                    reject(err)
                } else {
                    if (rows.length === 0) {
                        reject(err);
                    }
                    resolve(rows)
                }
            })
        })
    }
}

module.exports = Conexion;
