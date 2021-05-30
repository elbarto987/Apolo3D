# Apolo3D
Plataforma para subir y reproducir modelos en 3D

el proyecto esta desarrollado  con html, css, javascript  y php.

esta diseñado para que  el usuario pueda ver los modelos que ya se han subido pero para poder subir modelos primero se tiene que registrar,
una vez registrado se activaran algunas opciones como las de hacer comentarios a los modelos o responder comentarios ya registrados,
actualmente la plataforma admite 3 tipos de modelos los cuales son: stl, obj, 3mf.

para que la plataforma funcione correctamente tiene  que tener acceso a la base de datos del siguiente script:

CREATE DATABASE IF NOT EXISTS Plataforma DEFAULT CHARACTER SET utf8;
USE Plataforma;

CREATE TABLE IF NOT EXISTS usuario(

	usuario_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (usuario_id),
	usuario_nombre  VARCHAR(45),
	usuario_email VARCHAR(60),
	usuario_rutafoto VARCHAR(45),
	usuario_user VARCHAR(20),
	usuario_pass VARCHAR(200),
	usuario_descripcion VARCHAR(1000)
	);

CREATE TABLE IF NOT EXISTS modelo3d(
	
	modelo_id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(modelo_id),
	modelo_nombre VARCHAR(45),
	modelo_descripcion VARCHAR(3000),
	modelo_ruta VARCHAR(100),
	modelo_ruta_foto VARCHAR(100),
	usuario_usuario_id INT NOT NULL,
	FOREIGN KEY(usuario_usuario_id)
	REFERENCES usuario(usuario_id)
	);

CREATE TABLE IF NOT EXISTS comentario(
	
	comentario_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(comentario_id),
	comentario VARCHAR(400),
	comentario_usuario VARCHAR(45),
	comentario_fecha DATETIME,
	modelo_modelo_id INT NOT NULL,
	FOREIGN KEY(modelo_modelo_id)
	REFERENCES modelo3d(modelo_id)
	);


CREATE TABLE IF NOT EXISTS Replicacomentario(
	
	Replicacomentario_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(Replicacomentario_id),
	comentario VARCHAR(400),
	comentario_usuario VARCHAR(45),
	comentario_fecha DATETIME,
	replica_comentario_id INT NOT NULL,
	FOREIGN KEY(replica_comentario_id)
	REFERENCES comentario(comentario_id)
	);

CREATE TABLE IF NOT EXISTS megusta(
	
	megusta_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(megusta_id),
	megusta_usuario VARCHAR(45),
	megusta_fecha DATETIME,
	modelo_modelo_id INT NOT NULL,
	FOREIGN KEY(modelo_modelo_id)
	REFERENCES modelo3d(modelo_id)
	);


CREATE TABLE IF NOT EXISTS view(
	
	view_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(view_id),
	view_usuario VARCHAR(45),
	view_fecha DATETIME,
	modelo_modelo_id INT NOT NULL,
	FOREIGN KEY(modelo_modelo_id)
	REFERENCES modelo3d(modelo_id)
	);



