DROP DATABASE IF EXISTS SocialMediaDB;
CREATE DATABASE SocialMediaDB;
USE SocialMediaDB;

CREATE TABLE Users (
    username VARCHAR(50) PRIMARY KEY,
    password_hash VARCHAR(255) NOT NULL,
    created_at DATE
);

/* tisha / 12345 */

INSERT INTO Users (username, password_hash, created_at)
VALUES ('tisha', '$2y$10$U4DFeqkwlGrh9KKIMvhhgua1bmKJIyYWuZuQyvLYdA0ZCnxbTLT3u','2024-01-01');

/* student1 / pass123 */

INSERT INTO Users (username, password_hash, created_at)
VALUES ('student1', '$2y$10$zzN3cZHabL2UTyhrSAkgAuZq09BkKk/JzNT/goAO6Z1i2Bq50hdly','2024-02-01');

CREATE TABLE UserDetails (
    username VARCHAR(50) PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    city VARCHAR(50),
    created_at DATE,
    FOREIGN KEY (username) REFERENCES Users(username)
);

INSERT INTO UserDetails (username, full_name, email, city, created_at)
VALUES ('tisha', 'Sirazum Tisha', 'tisha@email.com', 'Orlando','2024-01-01');

INSERT INTO UserDetails (username, full_name, email, city, created_at)
VALUES ('student1', 'John Miller', 'john@email.com', 'Miami','2024-02-01');

SELECT *
FROM Users
JOIN UserDetails
ON Users.username = UserDetails.username;

SELECT *
FROM Users
INNER JOIN UserDetails
USING (username);