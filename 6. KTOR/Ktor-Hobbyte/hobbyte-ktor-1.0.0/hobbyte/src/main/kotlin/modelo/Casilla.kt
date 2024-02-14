package modelo

import kotlinx.serialization.Serializable

@Serializable
data class Casilla (
    val id:Int,
    val id_prueba:Int,
    val id_heroe:Int,
    val id_partida:Int,
    val estado:Boolean
    ) {

}