CREATE DATABASE IF NOT EXISTS prueba_tareas;

USE prueba_tareas;

CREATE TABLE IF NOT EXISTS users(
id int(255) not null auto_increment,
role varchar(50),
name varchar(100),
surname varchar(200),
email varchar(255),
password varchar(255),
created_at datetime,
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Paco', 'Garcia', 'paco@paco.com', 'paco', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Manolo', 'Perez', 'manolo@manolo.com', 'manolo', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Carlos', 'Sanchez', 'carlos@carlos.com', 'carlos', CURTIME());


CREATE TABLE IF NOT EXISTS tasks(
id int(255) not null auto_increment,
user_id int(255) not null,
title varchar(255),
content text,
priority varchar(20),
hours int(100),
created_at datetime,
CONSTRAINT pk_tasks PRIMARY KEY(id),
CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB;

INSERT INTO tasks VALUES(NULL, 1, 'Tarea 1', 'Contenido de prueba 1', 'high', 40, CURTIME());
INSERT INTO tasks VALUES(NULL, 1, 'Tarea 2', 'Contenido de prueba 2', 'low', 20, CURTIME());
INSERT INTO tasks VALUES(NULL, 2, 'Tarea 3', 'Contenido de prueba 3', 'medium', 10, CURTIME());
INSERT INTO tasks VALUES(NULL, 3, 'Tarea 4', 'Contenido de prueba 4', 'high', 50, CURTIME());