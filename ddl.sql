--
-- Create the schems for all tables.
-- By jeso20 for the project in the course MVC.
-- 2021-05-28
--

--
-- Drop tables
--
DROP TABLE IF EXISTS mvc_project_highscore;
DROP TABLE IF EXISTS mvc_project_log;
DROP TABLE IF EXISTS mvc_project_monster_character;
DROP TABLE IF EXISTS mvc_project_monster_dice;

--
-- Create tables
--
CREATE TABLE mvc_project_highscore
(
    id INT AUTO_INCREMENT UNIQUE,
    game_number INT,
    name VARCHAR(255),
    kills INT,
    heal INT,
    damage_dealt INT,
    damage_taken INT,
    score INT,
    exp INT,

    PRIMARY KEY (id)
);

CREATE TABLE mvc_project_log
(
    id INT AUTO_INCREMENT UNIQUE,
    time VARCHAR(255),
    name VARCHAR(255),
    monster_name VARCHAR(255),
    game_number INT,
    type VARCHAR(255),
    value INT,

    PRIMARY KEY (id)
);

CREATE TABLE mvc_project_monster_character
(
    id INT AUTO_INCREMENT UNIQUE,
    name VARCHAR(255),
    hp FLOAT,
    experience INT,
    monster_rank INT,

    PRIMARY KEY (id)
);

CREATE TABLE mvc_project_monster_dice
(
    id INT AUTO_INCREMENT UNIQUE,
    monster_id INT,
    dice VARCHAR(255),
    faces FLOAT,

    PRIMARY KEY (id)
);
