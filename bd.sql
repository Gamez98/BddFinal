CREATE DATABASE IF NOT EXISTS blogs;

USE blogs;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    last_name VARCHAR(45) NOT NULL,
    phone VARCHAR(45) NOT NULL,
    age VARCHAR(45) NOT NULL,
    username VARCHAR(45) NOT NULL,
    mail VARCHAR(45) NOT NULL,
    password VARCHAR(45) NOT NULL,
    img VARCHAR(100) NOT NULL,
);

CREATE TABLE post (
    usuario VARCHAR(45) NOT NULL,
    tema VARCHAR(45) NOT NULL,
    contenido VARCHAR(45) NOT NULL,
    id INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    dia DATE NOT NULL,
    contenido VARCHAR(500) NOT NULL,
    usuario_contenido VARCHAR(100) NOT NULL,
    CONSTRAINT fk_user_comment FOREIGN KEY (post_id)
    REFERENCES post(id)
);