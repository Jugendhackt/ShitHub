#ShitHub
ShitHub is a collaborative platform, created to check your own and/or foreign code for security vulnerabilitys and design issues.

#MySQL Structure
##Table users

CREATE TABLE users (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
uname VARCHAR(45) null,
pwhash VARCHAR(255) null,
email VARCHAR(255) not null,
lastlogin VARCHAR(10) null
);
