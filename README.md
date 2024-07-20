Steps to Run the Project

1. Import the Database

   - Go to the 'Sql' folder and import the 'teacher_portal.sql' database table.
   - If you face issues with the import, follow these alternative steps:

     Alternative Steps:
     1. Create a database named 'teacher_portal.
     2. Import the 'students' and 'users' tables.

     Or you can run the following SQL commands to create the database and tables manually:

     
     CREATE DATABASE teacher_portal;

     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(255) NOT NULL,
         password VARCHAR(255) NOT NULL
     );

     CREATE TABLE students (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         subject VARCHAR(255) NOT NULL,
         marks INT NOT NULL
     );

     INSERT INTO users (username, password) VALUES ('teacher', MD5('teacher@123'));
     

2. Run the Project Using XAMPP

   - Put the complete 'teacher_portal' folder (which you have downloaded from GitHub) into the 'htdocs' folder of XAMPP.

3. Access the Application

   - go to 'http://localhost/teacher_portal/'.

4. Login Credentials

   - Use the following credentials to log in:
     - Username: 'teacher'
     - Password: 'teacher@123'
