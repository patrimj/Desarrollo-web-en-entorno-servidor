package BBDD

import java.sql.*
import BBDD.ConexionEstatica.abrirConexion
import BBDD.ConexionEstatica.cerrarConexion
import modelo.Casilla

object ConexionCasillas {

    //Obtener todas las casillas de una partida
    fun getCasillasPartida(id_partida: Int): List<Casilla>? {
        var casillas: MutableList<Casilla>? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaCasillas + " WHERE id_partida = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_partida)
            ConexionEstatica.registros = pstmt.executeQuery()
            casillas = mutableListOf()
            while (ConexionEstatica.registros!!.next()) {
                casillas.add(
                    Casilla(
                        ConexionEstatica.registros!!.getInt("id"),
                        ConexionEstatica.registros!!.getInt("id_prueba"),
                        ConexionEstatica.registros!!.getInt("id_heroe"),
                        ConexionEstatica.registros!!.getInt("id_partida"),
                        ConexionEstatica.registros!!.getBoolean("estado")
                    )
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return casillas
    }
    //Obtener una casilla específica de una partida
    fun getCasillaPartida(id_partida: Int, id_casilla: Int): Casilla? {
        var casilla: Casilla? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaCasillas + " WHERE id_partida = ? AND id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_partida)
            pstmt.setInt(2, id_casilla)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                casilla = Casilla(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getInt("id_prueba"),
                    ConexionEstatica.registros!!.getInt("id_heroe"),
                    ConexionEstatica.registros!!.getInt("id_partida"),
                    ConexionEstatica.registros!!.getBoolean("estado")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return casilla
    }

    //Obtener una casilla aleatoria de una partida
    fun getCasillaAleatoria(id_partida: Int): Casilla? {
        var casilla: Casilla? = null
        try {
            abrirConexion()
            val sentencia =
                "SELECT * FROM " + Constantes.TablaCasillas + " WHERE id_partida = ? AND estado = false ORDER BY RAND() LIMIT 1"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_partida)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                casilla = Casilla(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getInt("id_prueba"),
                    ConexionEstatica.registros!!.getInt("id_heroe"),
                    ConexionEstatica.registros!!.getInt("id_partida"),
                    ConexionEstatica.registros!!.getBoolean("estado")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return casilla
    }

    //Modificar una casilla de una partida
    fun modificarCasilla(casilla: Casilla): Casilla? {
        var cod = 0
        var nuevaCasilla: Casilla? = null
        try {
            abrirConexion()
            val sentencia =
                "UPDATE " + Constantes.TablaCasillas + " SET id_prueba = ?, id_heroe = ?, id_partida = ?, estado = ? WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, casilla.id_prueba)
            pstmt.setInt(2, casilla.id_heroe)
            pstmt.setInt(3, casilla.id_partida)
            pstmt.setBoolean(4, casilla.estado)
            pstmt.setInt(5, casilla.id)
            pstmt.executeUpdate()

        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return nuevaCasilla
    }

    ///Completar una casilla de una partida
    fun completarCasilla(id_casilla: Int): Boolean {

        var completada: Boolean = false
        try {
            abrirConexion()
            val sentencia = "UPDATE " + Constantes.TablaCasillas + " SET estado = true WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_casilla)
            ConexionEstatica.registros = pstmt.executeQuery()
            completada = true
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return completada
    }


}