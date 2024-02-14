package factories

import modelo.Prueba

class PruebaFactory {

    fun tipos(): String {
        val tipos = listOf("magia", "fuerza", "habilidad")
        val random = (0..2).random()
        return tipos[random]
    }

    fun esfuerzo(): Int {
        val esfuerzo = listOf(5, 10, 15, 20, 25, 30, 35, 40, 45, 50)
        val random = (0..9).random()
        return esfuerzo[random]
    }

    fun crear(): List<Prueba> {
        val pruebas = mutableListOf<Prueba>()

        for (i in 1..20) {
            val id = i  // Usa el contador del bucle como ID
            val tipo = tipos()
            val esfuerzo = esfuerzo()
            val completada = false
            val prueba = Prueba(id, tipo, esfuerzo, completada)
            pruebas.add(prueba)
        }

        return pruebas
    }


}