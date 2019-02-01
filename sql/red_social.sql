CREATE TABLE usuarios
( `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(20) NOT NULL ,
  `nombre` VARCHAR(20) NOT NULL ,
  `apellidos` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT chk_password  CHECK (CHAR_LENGTH(PASSWORD)>=8),
  CONSTRAINT uk_username UNIQUE (username)
);

CREATE TABLE muros(
  id_muro INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL ,
  PRIMARY KEY ( id_muro ),
  FOREIGN KEY (username) REFERENCES usuarios(username)
) ENGINE=INNODB;

CREATE TABLE mensajes(
  id_mensaje INT NOT NULL AUTO_INCREMENT,
  contenido VARCHAR( 200 ) NOT NULL ,
  valoracion INT NOT NULL,
  username VARCHAR(20) NOT NULL,
  id_muro INT NOT NULL,
  PRIMARY KEY ( id_mensaje ),
  FOREIGN KEY (username) REFERENCES usuarios(username),
  FOREIGN KEY (id_muro) REFERENCES muros(id_muro),
  CONSTRAINT chk_valoracion CHECK (valoracion>=0 AND valoracion<=5)
) ENGINE=INNODB;

SELECT * FROM usuarios;
select * from muros;
DROP TABLE  usuarios;

# PLANTILLA PARA CREAR MENSAJES
INSERT INTO mensajes(username,contenido,valoracion, id_muro) values ('vic','Holas',4,2);

# PLANTILLA PARA CREAR MUROS
INSERT INTO muros (id_usuario) (
                               SELECT id_usuario from usuarios where usuarios.username = 'vic'
                               );
INSERT INTO muros (id_usuario) (
                               SELECT usernname from usuarios where usuarios.username = 'vic');

ALTER TABLE mensajes AUTO_INCREMENT = 1;

DELETE FROM mensajes WHERE id_mensaje = 10;

ALTER TABLE mensajes DROP id_mensaje;

ALTER TABLE mensajes ADD id_mensaje INT NOT NULL AUTO_INCREMENT PRIMARY KEY;

INSERT INTO mensajes(username,contenido,valoracion, id_muro) values ("vic","Prueba de comentario",0,1);