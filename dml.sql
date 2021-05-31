--
-- All inserts to set up database.
-- By jeso20 for the project in the course MVC.
-- 2021-05-28
--

--
-- Empty the tables of data;
--
DELETE FROM mvc_project_monster_character;
DELETE FROM mvc_project_monster_dice;

-- Make sure monster id always start on one.
ALTER TABLE mvc_project_monster_character AUTO_INCREMENT = 1;

--
-- Add data to tables
--
INSERT INTO
mvc_project_monster_character
(name, hp, experience, monster_rank)
VALUES
('Golum', 1.2, 20, 1),
('Darth Vader', 0.8, 40, 3),
('Handsome Jack', 1, 30, 2),
('Voldemort', 0.8, 100, 4),
('Moriarty', 0.5, 50, 3),
('Bad Maw', 0.6, 10, 1),
('Bane', 1.1, 30, 2),
('Scar', 0.6, 10, 1),
('Cruella de vil', 0.9, 20, 1),
('Hades', 1.2, 40, 3)
;

INSERT INTO
mvc_project_monster_dice
(monster_id, dice, faces)
VALUES
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(1, 'normal', 2),
(2, 'damage3', 6),
(2, 'damage3', 6),
(2, 'shield3', 6),
(2, 'shield3', 6),
(3, 'damage3', 4),
(3, 'damage3', 4),
(3, 'damage3', 4),
(4, 'health3', 3),
(4, 'health3', 3),
(4, 'health3', 3),
(4, 'shield3', 3),
(4, 'normal', 20),
(5, 'shield3', 3),
(5, 'shield3', 3),
(5, 'normal', 20),
(5, 'normal', 20),
(6, 'normal', 3),
(6, 'normal', 3),
(6, 'shield2', 3),
(6, 'shield2', 3),
(7, 'shield3', 3),
(7, 'normal', 20),
(7, 'normal', 20),
(8, 'normal', 3),
(8, 'normal', 3),
(8, 'damage2', 6),
(9, 'normal', 6),
(9, 'normal', 6),
(9, 'damage2', 6),
(10, 'damage3', 6),
(10, 'damage3', 6),
(10, 'damage3', 6),
(10, 'damage3', 6)
;
