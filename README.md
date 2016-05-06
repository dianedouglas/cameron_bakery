# Cameron's Bakery [![TeamCity CodeBetter](https://img.shields.io/teamcity/codebetter/bt428.svg?maxAge=2592000)]()
### Altered By: Ben Ronda
### Forked From: Diane Douglas

***

## Description
This is a mock site for a bakery called Cameron's Bakery. It was used to demonstrate the understanding of theming and alter hooks.

***
## Technologies Used
* Drupal 7  
* PHP  
* MAMP
* HTML/CSS
* JavaScript/jQuery 

***
## Custom Modules
* Hide Subject
    * Hides the subject line for in the comment form of an article.  

***
## Custom Themes
* Bakery Custom
    * Custom theme made from scratch.
    * Includes no JavaScript.
    * Used to give Client a basic layout idea.

* Bakery - Zen Sub
    * Built off of Zen theme as a base.
    * Includes jQuery Animation for toggling the side bar.

***
## Installation and Setup

1. Open your terminal and run `git clone https://github.com/ben-ronda/cameron_bakery.git`  
2. Download and Install MAMP here: https://www.mamp.info/en/  
3. Launch MAMP and navigate to Preferences>Web Server then Click the little folder icon and choose the folder you cloned from GitHub earlier.  
4. Go to localhost:8888/phpMyAdmin in your Browser  
5. Create a new datebase in the upper left-hand corner named 'bakery' and with the collation: utf8_general_ci
6. Go to the Import tab and import the database file stored in the sites>db_backup within the project directory  
7. After the Database is imported go to the privileges tab and create a user with the following criteria:
    * Username: cameron  
    * Password: cameron   
8. Set the Host field to localhost  
9. Hit Go!  
10. Now when you visit localhost:8888 everything should show up!  

***
## Additional Information
* Site Maintenance Info:
    * Username: cameron
    * Password: cameron
