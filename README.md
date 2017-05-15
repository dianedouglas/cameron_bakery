# Cameron's Bakery

#### Independent project for Epicodus, 05.05.2017

#### By _**Patrick McGreevy**_


## Description

This website is a fork of an [Epicodus template](https://github.com/epicodus-lessons/cameron_bakery).


## Setup
1. Clone repository to **`<repo_pathname>`**
2. Set up connection to database system in MAMP (see bellow)
3. Import database from repo in phpMyAdmin (see bellow)
4. Create database admin in phpMyAdmin (see bellow)
* Site maintenance account info: username = "cameron", password = "cameron"

### Database connection
1. In MAMP > Preferences:
 - Apache Port: `8888`
 - MySQL Port: `8889`
 - Document root: **`<repo_pathname>`**
2. Click 'Start servers'

### Import database
* Visit **`localhost:8888/phpMyAdmin`** in browser
* Click 'Import' tab
 - Character set: utf-8
 - File: **`<repo_pathname>/sites/db-backup/<backup_filename>`**

### Create database admin
* Visit **`localhost:8888/phpMyAdmin`** in browser
* Click 'Privileges' tab for `bakery` database.
* Add user
 - Name: `cameron`
 - Password: `cameron`
 - Host: local
 - All privileges for `bakery` database


### Exporting database
* Visit **`localhost:8888/phpMyAdmin`** in browser
* Click 'Export' tab for `bakery`
* Choose 'Custom'
 - Select all tables
 - Save output to file:
  - Character set: utf-8
  - Compression: zipped
 - Format: SQL
 - Object creation: Check all except 'IF NOT EXISTS'
* Move exported zip into **`<repo_pathname>/sites/db-backup>`**, replacing contents if necessary

## Technologies Used

* MySQL
* Drupal

## Known Bugs

_No known bugs._

## Support

_Please contact patrick7490@icloud.com with questions or concerns._


### License

*MIT License*

Copyright (c) 2017 _**Patrick McGreevy**_
