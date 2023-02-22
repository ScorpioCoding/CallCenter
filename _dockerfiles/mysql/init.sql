CREATE DATABASE IF NOT EXISTS scorpio;

USE scorpio;

CREATE TABLE IF NOT EXISTS User ( 
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) UNIQUE,   
  email VARCHAR(255) UNIQUE,
  email_validated BOOLEAN DEFAULT FALSE,
  permission VARCHAR(50) NOT NULL,
  psw_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT NOW()
);


CREATE TABLE IF NOT EXISTS Company (
  id SERIAL PRIMARY KEY,
  comType ENUM('customer','vendor'),
  comName VARCHAR(50),  
  comEmail VARCHAR(255),
  comPhone VARCHAR(20),
  comVat VARCHAR(20),
  userId BIGINT UNSIGNED
);

CREATE TABLE IF NOT EXISTS Address (
  id SERIAL PRIMARY KEY,
  comType ENUM('customer','vendor'),  
  comName VARCHAR(255),
  addType ENUM('location','billing','warehouse'),
  addLine1 VARCHAR(255),
  addLine2 VARCHAR(255),
  addPostal VARCHAR(50),
  addCity VARCHAR(255),
  addState VARCHAR(255),
  addCountry VARCHAR(255),
  companyId BIGINT UNSIGNED,
  userId BIGINT UNSIGNED
);

CREATE TABLE IF NOT EXISTS Contacts (
  id SERIAL PRIMARY KEY,
  comType ENUM('customer','vendor'),
  comName VARCHAR(255),
  conFullName VARCHAR(255),
  conGender ENUM('male','female','other'),
  conFName VARCHAR(255),
  conLName VARCHAR(255),  
  conEmail VARCHAR(255),
  conPhone VARCHAR(255),
  companyId BIGINT UNSIGNED,
  userId BIGINT UNSIGNED
);

CREATE TABLE IF NOT EXISTS Calls (
  id SERIAL PRIMARY KEY,
  comType ENUM('customer','vendor'),
  comName VARCHAR(255),
  conFullName VARCHAR(255),
  callStatus VARCHAR(50),
  callLastDate DATE,
  callNextDate Date,
  callLog TEXT,
  contactId BIGINT UNSIGNED,
  userId BIGINT UNSIGNED
);

