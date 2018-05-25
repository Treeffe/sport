-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 28 nov. 2017 à 16:36
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

    -- --------------------------------------------------------

    --
    -- Structure de la table `user`
    --

    CREATE TABLE `user` (
      `idUser` int(11) NOT NULL AUTO_INCREMENT,
      `prenomUser` text NOT NULL,
      `nomUser` text NOT NULL,
      `mailUser` text NOT NULL,
      `adresseUser` text NOT NULL,
      `villeUser` text NOT NULL,
      `loginUser` text NOT NULL,
      `mdpUser` text NOT NULL,
      `saltSys` text NOT NULL,
        `role` varchar(255) NOT NULL,
        primary key (idUser)
    );

    CREATE TABLE CatSport (
      idCatSport int AUTO_INCREMENT,
      libelleCatSport varchar(255),
      primary key (idCatSport)
    );

    CREATE TABLE sport (
      idSport int AUTO_INCREMENT,
      libelleSport varchar(255) NOT NULL,
      PRIMARY KEY (idSport)
    );

    CREATE TABLE court (
      idCourt int AUTO_INCREMENT,
      ville varchar(255) NOT NULL,
      numeroRueCourt varchar(255) NOT NULL,
      rueCourt varchar(255) NOT NULL,
      cpCourt varchar(5) NOT NULL,
      imageCourt varchar(255) NOT NULL,
      descriptionCourt varchar(255) NOT NULL,
      idUser int NOT NULL,
      idCatSport int NOT NULL,
      PRIMARY KEY (idCourt)
    );

    CREATE TABLE courtSport (
      idCourtSport int AUTO_INCREMENT,
      idCourt int NOT NULL,
      idSport int NOT NULL,
      PRIMARY KEY (idCourtSport)
    );

    INSERT INTO user VALUES (0, 'thibaut', 'cornado',  'cornado@hotmail.fr', 'X', 'Lyon', 'treef', 'YRKBx8oeQ2sLBrEqjJeqc8UwC9HPp+Ed6dhCeeHPQJ9vY4vbMepUbS14/rE6njWr4RZd4E+tU4pcOMI0h8Z6UA==', 'mnPEaJNz6,rUPbAYGg6$UXt', 'ROLE_ADMIN');
    INSERT INTO CatSport VALUES (0, 'test');