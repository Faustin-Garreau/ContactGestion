CREATE DATABASE IF NOT EXISTS contact;

USE contact;

CREATE TABLE informations (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50),
  prenom VARCHAR(50),
  email VARCHAR(50),
  adresse VARCHAR(100),
  code_postal VARCHAR(10),
  entreprise VARCHAR(100),
  telephone VARCHAR(20)
);
