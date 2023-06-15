# [Connect Four](https://en.wikipedia.org/wiki/Connect_Four) - a web based version of the popular game 
*This is a clone of the original private repository located here: https://github.com/emmytran/Connect-four (linked in case it becomes public).*
### CSU-Fresno [CSCI 130](https://github.com/romevang) - Web Development: Game project
*Assignment*: Create a web based version of the game Connect Four within 9 weeks with a team of up to 3 people. Using all of the knowledge gained from the course and any prior knowledge.

## Team Members
- [Emmy Tran](https://www.linkedin.com/in/emmytran/) - Frontend developer
- [Romeo Vanegas](https://www.linkedin.com/in/romeovanegas/) - *Mostly* Backend developer

### How to run game using [XAMPP](https://www.apachefriends.org/):
*Warning, as the game sits, it is not safe to publish directly on the internet, run on local environments only. Properly configured and hardened API's are needed to make game fully featured and ready to use online.* 
1. Place all file contents inside of **htdocs** folder
2. Go to http://localhost/phpmyadmin/
4. Go to browser, type http://localhost/Connect-four/c4connection.php to make sure that it is connected to the database
5. If it is connected, then run http://localhost/Connect-four/aioDBsetup.php, this will create a databse name "c4db" and a data table "players"
6. Go to browser, type http://localhost/Connect-four/login.php to login into the game. 

## Screenshots of UI

![Login Screen](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/c4login.png?raw=true)
![Welcome Screen](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/WelcomeScreen.png?raw=true)
![Main Menu](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/MainMenu.png?raw=true)
![Player Board](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/GameProgress.png?raw=true)
![Winner](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/Winner.png?raw=true)
![LeaderBoard](https://github.com/romevang/CF130-WebGame/blob/main/screenshots/LeaderBoard.png?raw=true)

