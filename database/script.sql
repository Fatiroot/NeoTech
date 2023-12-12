CREATE DATABASE NeoTech;


-- Role Table
CREATE TABLE role (
    id INT  PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL UNIQUE
    

);
-- User Table
CREATE TABLE `user` (
    id INT PRIMARY KEY AUTO_INCREMENT ,
    name VARCHAR (255) NOT NULL UNIQUE,
    email VARCHAR (255) NOT NULL,
    password VARCHAR(255)NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES role(id)

) ;
