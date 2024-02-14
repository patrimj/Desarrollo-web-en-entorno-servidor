package BBDD

import java.sql.*

import BBDD.ConexionEstatica.abrirConexion
import BBDD.ConexionEstatica.cerrarConexion
import modelo.Prueba


object ConexionPruebas {

    //lisa de todas las pruebas
    fun getPruebas(): Prueba? {
        var prueba: Prueba? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaPruebas
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            // pstmt.setInt(1, 30000);
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                prueba = Prueba(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getString("tipo"),
                    ConexionEstatica.registros!!.getInt("esfuerzo"),
                    ConexionEstatica.registros!!.getBoolean("completada")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return prueba
    }

    //completar una prueba
    fun completarPrueba(id: Int): Boolean {
        var completada: Boolean = false
        try {
            abrirConexion()
            val sentencia = "UPDATE " + Constantes.TablaPruebas + " SET completada = true WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id)
            ConexionEstatica.registros = pstmt.executeQuery()
            completada = true
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return completada
    }

    //crear una prueba
    fun crearPrueba(prueba: Prueba): Prueba? {
        var cod = 0
        var nuevaPrueba: Prueba? = null
        try {
            abrirConexion()
            val sentencia = "INSERT INTO " + Constantes.TablaPruebas + " (tipo, esfuerzo, completada) VALUES (?, ?, ?)"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia, Statement.RETURN_GENERATED_KEYS)
            pstmt.setString(1, prueba.tipo)
            pstmt.setInt(2, prueba.esfuerzo)
            pstmt.setBoolean(3, prueba.completada)
            pstmt.executeUpdate()
            val generatedKeys = pstmt.generatedKeys
            if (generatedKeys.next()) {
                nuevaPrueba = Prueba(
                    generatedKeys.getInt(1),
                    prueba.tipo,
                    prueba.esfuerzo,
                    prueba.completada
                )
            }
        } catch (ex: SQLException) {
            cod = ex.errorCode
        } finally {
            cerrarConexion()
        }
        return nuevaPrueba
    }
}