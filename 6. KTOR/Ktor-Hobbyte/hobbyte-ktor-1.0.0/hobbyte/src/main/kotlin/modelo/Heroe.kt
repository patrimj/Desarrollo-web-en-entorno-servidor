package modelo

import kotlinx.serialization.Serializable

@Serializable
data class Heroe (
    val id:Int,
    val nombre:String,
    val tipo:String,
    val max_capacidad:Int,
    val capacidad_actual:Int
    ) {



}