package BBDD

import java.sql.*

import BBDD.ConexionEstatica.abrirConexion
import BBDD.ConexionEstatica.cerrarConexion

import modelo.Heroe

object ConexionHeroes {

    //crear heroe
    fun crearHeroe(heroe: Heroe): Int {

        var cod = 0

        val sentencia =
            "INSERT INTO " + Constantes.TablaHeroes + " (nombre, tipo, max_capacidad, capacidad_actual) VALUES (?, ?, ?, ?)"

        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setString(1, heroe.nombre)
            pstmt.setString(2, heroe.tipo)
            pstmt.setInt(3, heroe.max_capacidad)
            pstmt.setInt(4, heroe.capacidad_actual)
            cod = pstmt.executeUpdate()
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return cod
    }

    //modificar capacidad
    fun modificarCapacidad(id: Int, capacidad_actual: Int): Int {

        var cod = 0

        val sentencia =
            "UPDATE " + Constantes.TablaHeroes + " SET capacidad_actual = ? WHERE id = ?"

        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, capacidad_actual)
            pstmt.setInt(2, id)
            cod = pstmt.executeUpdate()
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return cod
    }

    //lista de heroes
    fun getHeroes(): ArrayList<Heroe> {

        val heroes = ArrayList<Heroe>()

        val sentencia = "SELECT * FROM " + Constantes.TablaHeroes

        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                heroes.add(
                    Heroe(
                        ConexionEstatica.registros!!.getInt("id"),
                        ConexionEstatica.registros!!.getString("nombre"),
                        ConexionEstatica.registros!!.getString("tipo"),
                        ConexionEstatica.registros!!.getInt("max_capacidad"),
                        ConexionEstatica.registros!!.getInt("capacidad_actual")
                    )
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return heroes
    }

    //heroe por id
    fun getHeroe(id: Int): Heroe? {

        var heroe: Heroe? = null

        val sentencia = "SELECT * FROM " + Constantes.TablaHeroes + " WHERE id = ?"

        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)

            pstmt.setInt(1, id)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                heroe = Heroe(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getString("nombre"),
                    ConexionEstatica.registros!!.getString("tipo"),
                    ConexionEstatica.registros!!.getInt("max_capacidad"),
                    ConexionEstatica.registros!!.getInt("capacidad_actual")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return heroe
    }

}