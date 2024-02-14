package BBDD

import java.sql.*

import BBDD.ConexionEstatica.abrirConexion
import BBDD.ConexionEstatica.cerrarConexion
import modelo.Partida

object ConexionPartidas {

    //todas las partidas
    fun getPartidas(): Partida? {
        var partida: Partida? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaPartidas
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            // pstmt.setInt(1, 30000);
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                partida = Partida(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getInt("id_usuario"),
                    ConexionEstatica.registros!!.getBoolean("estado"),
                    ConexionEstatica.registros!!.getInt("casillas_destapadas"),
                    ConexionEstatica.registros!!.getInt("heroes_vivos")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return partida
    }

    //partidas de un usuario
    fun getPartidasUsuario(id_usuario: Int): Partida? {
        var partida: Partida? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaPartidas + " WHERE id_usuario = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_usuario)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                partida = Partida(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getInt("id_usuario"),
                    ConexionEstatica.registros!!.getBoolean("estado"),
                    ConexionEstatica.registros!!.getInt("casillas_destapadas"),
                    ConexionEstatica.registros!!.getInt("heroes_vivos")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return partida
    }

    //partida por id
    fun getPartida(id: Int): Partida? {
        var partida: Partida? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaPartidas + " WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                partida = Partida(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getInt("id_usuario"),
                    ConexionEstatica.registros!!.getBoolean("estado"),
                    ConexionEstatica.registros!!.getInt("casillas_destapadas"),
                    ConexionEstatica.registros!!.getInt("heroes_vivos")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return partida
    }

    //cambiar estado partida a terminada
    fun completarPartida(id: Int): Boolean {
        var completado = false
        try {
            abrirConexion()
            val sentencia = "UPDATE " + Constantes.TablaPartidas + " SET estado = true WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id)
            ConexionEstatica.registros = pstmt.executeQuery()
            completado = true
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return completado
    }

    //crear partida
    fun crearPartida(id_usuario: Int): Partida? {
        var nuevaPartida: Partida? = null

        try {
            abrirConexion()
            val sentencia =
                "INSERT INTO " + Constantes.TablaPartidas + " (id_usuario, estado, casillas_destapadas, heroes_vivos) VALUES (?, ?, ?, ?)"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id_usuario)
            pstmt.setBoolean(2, false)
            pstmt.setInt(3, 0)
            pstmt.setInt(4, 3)

        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return nuevaPartida

    }


}