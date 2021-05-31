--
-- Create the database and an user for it.
-- By jeso20 for the project in the course MVC.
-- 2021-05-28
--

-- Drop the database completly
DROP DATABASE IF EXISTS mvc;


-- CREATE DATABASE mvc;
CREATE DATABASE IF NOT EXISTS mvc;

USE mvc;

--Removes user
DROP USER IF EXISTS 'user'@'%';

-- Create an user
CREATE USER 'user'@'%'
IDENTIFIED
WITH mysql_native_password -- Only MySQL > 8.0.4
BY 'pass'
;

-- Grant the user all rights
GRANT ALL PRIVILEGES
    ON *.*
    TO 'user'@'%'
;
