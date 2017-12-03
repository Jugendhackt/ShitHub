# ShitHub
ShitHub is a collaborative platform, created to check your own and/or foreign code for security vulnerabilitys and design issues.

# MySQL Structure
## Table users

| Field     | Type         | Null | Key | Default | Extra          |
|-----------|--------------|------|-----|---------|----------------|
| id        | int(11)      | NO   | PRI | NULL    | auto_increment |
| uname     | varchar(45)  | YES  |     | NULL    |                |
| pwhash    | varchar(255) | YES  |     | NULL    |                |
| email     | varchar(255) | NO   |     | NULL    |                |
| lastlogin | varchar(10)  | YES  |     | NULL    |                |


SQL-Syntax for creation: 

```sql
CREATE TABLE users (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
uname VARCHAR(45) null,
pwhash VARCHAR(255) null,
email VARCHAR(255) not null,
lastlogin VARCHAR(10) null
);
```

## Table snippets

| Field       | Type         | Null | Key | Default | Extra          |
|-------------|--------------|------|-----|---------|----------------|
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| title       | varchar(150) | NO   |     | NULL    |                |
| description | varchar(250) | YES  |     | NULL    |                |
| language    | varchar(10)  | NO   |     | NULL    |                |
| tags        | varchar(250) | YES  |     | NULL    |                |

```sql
CREATE TABLE snippets (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(150) not null,
description VARCHAR(250) null,
language VARCHAR(20) not null,
tags VARCHAR(250) null
);
```
