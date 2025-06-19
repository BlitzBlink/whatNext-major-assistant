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


-- Quiz, Question & Option tables

CREATE TABLE Quiz (
    quiz_id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE Question (
    question_no INT,
    quiz_id INT,
    content TEXT NOT NULL,
    PRIMARY KEY (question_no, quiz_id),
    FOREIGN KEY (quiz_id) REFERENCES Quiz(quiz_id) ON DELETE CASCADE
);

CREATE TABLE Option (
    option_no INT,
    question_no INT,
    quiz_id INT,
    value TEXT NOT NULL,
    PRIMARY KEY (option_no, question_no, quiz_id),
    FOREIGN KEY (question_no, quiz_id) REFERENCES Question(question_no, quiz_id) ON DELETE CASCADE
);


-- QuizAttempt & QuizAnswer tables

CREATE TABLE QuizAttempt (
    attempt_id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    quiz_id INT NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES Quiz(quiz_id) ON DELETE CASCADE
);

CREATE TABLE QuizAnswer (
    attempt_id INT,
    question_no INT,
    option_no INT,
    quiz_id INT,
    PRIMARY KEY (attempt_id, question_no),
    FOREIGN KEY (attempt_id) REFERENCES QuizAttempt(attempt_id) ON DELETE CASCADE,
    FOREIGN KEY (option_no, question_no, quiz_id)
        REFERENCES Option(option_no, question_no, quiz_id) ON DELETE CASCADE
);


--Trait & OptionTrait tables

CREATE TABLE Trait (
    trait_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE OptionTraitPoint (
    option_no INT,
    question_no INT,
    quiz_id INT,
    trait_id INT,
    points INT NOT NULL,
    PRIMARY KEY (option_no, question_no, quiz_id, trait_id),
    FOREIGN KEY (option_no, question_no, quiz_id)
        REFERENCES Option(option_no, question_no, quiz_id) ON DELETE CASCADE,
    FOREIGN KEY (trait_id)
        REFERENCES Trait(trait_id) ON DELETE CASCADE
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

--Result & ResultMajor tables

CREATE TABLE Result (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    summary TEXT,
    FOREIGN KEY (attempt_id) REFERENCES QuizAttempt(attempt_id) ON DELETE CASCADE
);

CREATE TABLE ResultMajor (
    result_id INT,
    major_id INT,
    PRIMARY KEY (result_id, major_id),
    FOREIGN KEY (result_id) REFERENCES Result(result_id) ON DELETE CASCADE,
    FOREIGN KEY (major_id) REFERENCES Major(major_id) ON DELETE CASCADE
);


--ChatSession & Message tables

CREATE TABLE ChatSession (
    chat_id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    result_id INT NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id) ON DELETE CASCADE,
    FOREIGN KEY (result_id) REFERENCES Result(result_id) ON DELETE CASCADE
);

CREATE TABLE Message (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id INT NOT NULL,
    sender INT NOT NULL,
    content TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES ChatSession(chat_id) ON DELETE CASCADE,
    FOREIGN KEY (sender) REFERENCES Account(account_id) ON DELETE CASCADE
);
