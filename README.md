![Travis](https://travis-ci.com/jeso20BTH/mvc_project.svg?branch=main)
![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jeso20BTH/mvc_project/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/jeso20BTH/mvc_project/?branch=main)
![Code Coverage](https://scrutinizer-ci.com/g/jeso20BTH/mvc_project/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/jeso20BTH/mvc_project/?branch=main)
![Build Status](https://travis-ci.org/jeso20BTH/mvc_project.svg?branch=main)](https://travis-ci.org/jeso20BTH/mvc_project)

# Dice combat
## Introduction
This is an dice-game webpage with an simple rpg game with dice based combat. It got an database of enemies which is randomly generated. Apart from your regular dices do you also have dices that Increase your damage, heal you or protect you. You can level up and by it inprove your skills.

Enjoy!

![Game]('public/game.png')

## Technologies
The webpage run on by Symfony which is an PHP based framework. The ORM towards the database is Doctrine. There is an development environment with tests by PHPUNIT.

## Installation
Before the start of the installation you would need PHP, Composser, Webbserver and GIT
1. Run ```git clone SSH:git@github.com:jeso20BTH/mvc_project.git```, to get the repository to the folder you curently is standing in.
2. Run ```composser install``` to get the stuff needed to run the program.
3. Run ```bash ```, to setup needed MySQL database tables.
4. In ```.env``` update the connection to MySQL with your host-address and user data.


## How to play
1. Start the game, you will be asked to enter an name end setup you base stats for your character.
2. Select what direction you wanna move, you will enter an fight with an generated enemy.
3. It's time to battle,
    - You can chose to attack which will roll your dices and compare to the enemy and count the damage away.
    - Your second choice is if you run low on health you can go into your backpack and eat some taste food to regain some health.
    - You also got an log were you can keep track of all that happens during the game.
4. You will be in battle til either you or the enemy is defeated. Then you will see an summary or an screen where you can add points if you level up.
5. As long as you don't die you will repeat step 2-4, when you die you will see an summary and your score will be saved to an highscore.

LETS ROLL!!!
