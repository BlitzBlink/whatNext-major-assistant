CREATE DATABASE whatnext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE whatnext;

-- Account, User & Admin Tables

CREATE TABLE Account (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('user', 'admin') NOT NULL
);

CREATE TABLE User (
    account_id INT PRIMARY KEY,
    fName VARCHAR(100) NOT NULL,
    lName VARCHAR(100) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id) ON DELETE CASCADE
);

CREATE TABLE Admin (
    account_id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id) ON DELETE CASCADE
);


--Trait table

CREATE TABLE Trait (
    trait_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);


--Major & MajorTrait tables

CREATE TABLE Major (
    major_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE MajorTrait (
    major_id INT,
    trait_id INT,
    weight INT NOT NULL,
    PRIMARY KEY (major_id, trait_id),
    FOREIGN KEY (major_id) REFERENCES Major(major_id) ON DELETE CASCADE,
    FOREIGN KEY (trait_id) REFERENCES Trait(trait_id) ON DELETE CASCADE
);

--ResultMajor table

CREATE TABLE ResultMajor (
    account_id INT,
    ranking INT CHECK (ranking BETWEEN 1 AND 3),
    major_id INT,
    PRIMARY KEY (account_id, ranking),
    UNIQUE (account_id, major_id),
    FOREIGN KEY (account_id) REFERENCES Account(account_id) ON DELETE CASCADE,
    FOREIGN KEY (major_id) REFERENCES Major(major_id) ON DELETE CASCADE
);
