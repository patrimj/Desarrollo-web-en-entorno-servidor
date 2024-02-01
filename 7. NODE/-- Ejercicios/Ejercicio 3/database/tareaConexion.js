const Conexion = require('./Conexion');

class tareaConexion {
    constructor() {
        this.con = Conexion();
    }

    //CRUD TAREAS
    crearTarea = async (descripcion, duracion, dificultad, realizada, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('INSERT INTO tareas VALUES (?,?,?,?,?)', [descripcion, duracion, dificultad, realizada, persona_id]);
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getTareas = async () => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM tareas');
        } catch (error) {
            throw error;
        }
        return resultado;
    }

    getTarea = async (id) => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM tareas WHERE Id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    getTareasPersona = async (id) => {
        let resultado = [];
        try {
            resultado = await this.con.query('SELECT * FROM tareas WHERE Persona_id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    eliminarTarea = async (id) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('DELETE FROM tareas WHERE Id = ?', [id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    modificarTarea = async (id, descripcion, duracion, dificultad, realizada, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('UPDATE tareas SET Descripcion = ?, Duracion = ?, Dificultad = ?, Realizada = ?, Persona_id = ? WHERE Id = ?', [descripcion, duracion, dificultad, realizada, persona_id, id]);
        }
        catch (error) {
            throw error;
        }
        return resultado;
    }

    asignarTarea = async (id_tarea, persona_id) => {
        let resultado = 0;
        try {
            resultado = await this.con.query('UPDATE tareas SET Persona_id = ? WHERE Id = ?', [persona_id, id_tarea])
        } catch (error) {
            throw error;
        }
        return resultado;
    }
}