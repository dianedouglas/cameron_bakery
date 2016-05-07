# Cameron's Bakery
## By: Jared Beckler | Epicodus | May 6, 2016

This is a Drupal website created to display multipule modules and sub-themes for client view.

## Prerequisites
You will need the following things properly installed on your computer.
- [Git](http://git-scm.com/)
- [MAMP](https://www.mamp.info/en/)
- [PHP](http://php.net/manual/en/install.php)

## Installation
- git clone `https://github.com/jaredbeckler/cameron_bakery`
- open MAMP and click "Preferences"
- go to the "Web Server" tab and change the document root to the project folder and start the MAMP server
- under phpMyAdmin click on the "Import" tab
- select the zipped database file from `sites/db-backup/` and click go
- after the database imports, click on `bakery` in the database list and then click the "Privileges" tab
- next click the "Add User" link on the bottom and enter the username `cameron`, change the dropdown menu in host to `localhost`, then enter the password `cameron`, and then click "Go" on the bottom of the page
- to view the site, use your web browser to navigate to localhost:8888
- admin username: `cameron`
- admin password: `cameron`

## Known Bugs
Drupal needs to be updated?

## Support and contact details
If you have any issues, questions, ideas, or concerns contact me through GitHub. If you would like to make a contribution to the code, feel free to do so and notify me by e-mail.

## Technologies Used
- GIT
- Drupal
- PHP
- Drush

### License
Copyright © 2016  |  Jared Beckler  |  Epicodus  |  Portland, OR