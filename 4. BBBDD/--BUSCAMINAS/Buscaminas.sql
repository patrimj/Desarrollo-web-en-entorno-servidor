CREATE TABLE persona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pass VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    partidasganadas INT DEFAULT 0
);


CREATE TABLE partida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario INT NOT NULL,
    tablerooculto TEXT NOT NULL,
    tablerojugador TEXT NOT NULL,
    finalizada TINYINT(1) DEFAULT 0,
    FOREIGN KEY (usuario) REFERENCES persona(id)
);